<?php

namespace App\Http\Controllers;
use App\Models\CarTour;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Mail\TransactionCompletedMail;
use Illuminate\Support\Facades\Mail;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $transactions = Transaction::with([
            'user',
            'transactionDetails.carTour.car.carType',
            'transactionDetails.carTour.type',
            'transactionDetails.carTour.location',
            // 'transactionDetails.package'
        ])
        ->orderByDesc('created_at')
        ->get();
    
        return view('staff/admin.transaction', compact('transactions'));
    }

    public function dashboard()
    {
        $transactions = Transaction::with([
            'user',
            'transactionDetails.carTour.car.carType',
            'transactionDetails.carTour.type',
            'transactionDetails.carTour.location',
        ])
        ->where('status', 'Paid')
        ->orderByDesc('created_at')
        ->paginate(5);

        // User dengan jumlah transaksi terbanyak
        $topUserByCount = Transaction::select('users_id', DB::raw('COUNT(*) as total'))
            ->groupBy('users_id')
            ->orderByDesc('total')
            ->with('user')
            ->first();

        // Mobil paling sering digunakan
        $topCar = TransactionDetail::join('car_tours', 'transaction_details.car_tours_id', '=', 'car_tours.id')
            ->join('cars', 'car_tours.cars_id', '=', 'cars.id')
            ->select('cars.name', DB::raw('COUNT(*) as total'))
            ->groupBy('cars.name')
            ->orderByDesc('total')
            ->first();

        // Lokasi pick up terpopuler
        $topLocation = TransactionDetail::join('car_tours', 'transaction_details.car_tours_id', '=', 'car_tours.id')
            ->join('locations', 'car_tours.locations_id', '=', 'locations.id')
            ->select('locations.name', DB::raw('COUNT(*) as total'))
            ->groupBy('locations.name')
            ->orderByDesc('total')
            ->first();

        // User dengan total transaksi terbesar
        $topUserByTotal = Transaction::select('users_id', DB::raw('SUM(total) as total'))
            ->groupBy('users_id')
            ->orderByDesc('total')
            ->with('user')
            ->first();

        return view('staff/admin.dashboard', compact(
            'transactions',
            'topUserByCount',
            'topCar',
            'topLocation',
            'topUserByTotal'
        ));
    }

    public function cancel($id)
    {
        $transaction = Transaction::findOrFail($id);

        if (strtolower(trim($transaction->status)) !== 'pending payment') {
            return redirect()->back()->with('error', 'Only pending transactions can be cancelled.');
        }

        $transaction->update(['status' => 'Cancelled']);

        return redirect()->back()->with('success', 'Transaction has been cancelled.');
    }

    public function viewOrder($id)
    {
        $transaction = Transaction::with([
            'transactionDetails.carTour.car',
            'transactionDetails.carTour.type',
            'transactionDetails.carTour.location',
            'transactionDetails'
        ])
        ->where('users_id', auth()->id())
        ->findOrFail($id);

        // if ($transaction->status === 'Paid') {
        //     return redirect()->route('customer.index')->with('success', 'Transaction has been successfully paid.');
        // }

        if ($transaction->status === 'Cancelled') {
            return redirect()->route('customer.index')->with('error', 'This transaction has been cancelled.');
        }

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        \Midtrans\Config::$overrideNotifUrl = config('app.url').'/api/midtrans-callback';

        $user = auth()->user();

        $params = array(
            'transaction_details' => array(
                'order_id' => 'NRT-' . $transaction->id . '-' . time(),
                'gross_amount' => (int) round($transaction->total),
            ),
            'customer_details' => array(
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
            ),
        );
        // dd($params);

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('customer.order', compact('transaction', 'snapToken'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture' or $request->transaction_status == 'settlement'){
                $id = (int) str_replace('NRT-', '', $request->order_id);
                $transaction = Transaction::find($id);
                $transaction->update(['status' => 'Paid']);
                $this->sendTransactionCompletedEmail($transaction);
            }
        }
    }

    protected function sendTransactionCompletedEmail(Transaction $transaction)
    {
        // Simpan locale sekarang supaya bisa dikembalikan nanti
        $currentLocale = app()->getLocale();

        // Gunakan locale user (misal default 'en' kalau kosong)
        $locale = $transaction->user->locale ?? 'en';
        app()->setLocale($locale);

        // Kirim email dengan bahasa sesuai locale
        Mail::to($transaction->user->email)
            ->send(new TransactionCompletedMail($transaction));

        // Balik lagi ke locale semula
        // app()->setLocale($currentLocale);
    }

    public function myTransactions()
    {
        $transactions = Transaction::with([
            'transactionDetails.carTour.car.carType',
            'transactionDetails.carTour.type',
            'transactionDetails.carTour.location',
        ])
        ->where('users_id', auth()->id())
        ->orderByDesc('created_at')
        ->get();

        return view('customer.my-transaction', compact('transactions'));
    }

    public function salesOverview(Request $request)
    {
        $filter = $request->query('filter', 'weekly'); // default weekly
        $now = Carbon::now();

        if ($filter === 'weekly') {
            // Mulai dari Senin minggu ini
            $startOfWeek = $now->copy()->startOfWeek(Carbon::MONDAY);
        
            $data = collect(range(0, 6))->map(function ($i) use ($startOfWeek) {
                $date = $startOfWeek->copy()->addDays($i);
                $total = Transaction::whereDate('created_at', $date)->sum('total');
                return [
                    'label' => $date->format('D'), // Mon, Tue, etc
                    'value' => (int)$total / 1000
                ];
            });
        } elseif ($filter === 'monthly') {
            $data = collect(range(0, 3))->map(function ($week) use ($now) {
                $start = $now->copy()->startOfMonth()->addWeeks($week);
                $end = $start->copy()->addDays(6);
                $total = Transaction::whereBetween('created_at', [$start, $end])->sum('total');
                return [
                    'label' => 'Minggu ' . ($week + 1),
                    'value' => (int)$total / 1000
                ];
            });
        } elseif ($filter === 'yearly') {
            $data = collect(range(1, 12))->map(function ($month) use ($now) {
                $total = Transaction::whereYear('created_at', $now->year)
                    ->whereMonth('created_at', $month)
                    ->sum('total');
                return [
                    'label' => Carbon::create()->month($month)->format('M'),
                    'value' => (int)$total / 1000
                ];
            });
        }

        return response()->json([
            'categories' => $data->pluck('label'),
            'series' => [[
                'name' => 'Total Transaksi (Ribu)',
                'data' => $data->pluck('value'),
            ]],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
