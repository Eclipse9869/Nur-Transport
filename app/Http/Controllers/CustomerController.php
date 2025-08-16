<?php

namespace App\Http\Controllers;
use App\Models\Car;
use App\Models\CarTour;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\CarType;
use App\Models\Type;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\DB;
use App\Mail\TransactionMail;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cars = Car::with('carType')->get();
        $carTypes = CarType::with('cars')->get();
        $types = Type::all();

        return view('Customer.dashboard-customer', compact('cars', 'carTypes', 'types'));
    }

    public function cars(Request $request)
    {
        $type = $request->query('type');

        if ($type && $type !== 'all') {
            $carType = CarType::where('name', $type)->first();

            if ($carType) {
                $cars = Car::where('car_types_id', $carType->id)
                            ->with('carType')
                            ->paginate(6)
                            ->appends(request()->query());

            } else {
                $cars = collect(); // jika tidak ditemukan
            }
        } else {
            $cars = Car::with('carType')->paginate(6)->appends(request()->query());
        }

        $carTypes = CarType::all();

        return view('Customer.all-cars', compact('cars', 'carTypes'));
    }

    public function contact()
    {
        //
        return view('Customer.contact-us');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        Mail::to('transport@nurtransbali.com')->send(new ContactMail($validated));

        return back()->with('success', 'Your message has been sent successfully!');
    }

    public function detail(Car $car)
    {
        $types = Type::all();
        $locations = Location::all();
        return view('customer.car-detail', compact('car', 'types', 'locations'));    
    }

    public function bookNow(Request $request)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validate([
                'cars_id' => 'required|exists:cars,id',
                'types_id' => 'required|exists:types,id',
                'locations_id' => 'required|exists:locations,id',
                'qty' => 'required|integer|min:1',
                'desc' => 'nullable|string',
                'name' => 'required|string',
                'phone' => 'required|string',
                'email' => 'required|email',
                'start_date' => 'required|date',
                'start_time' => 'required|date_format:H:i',
            ]);

            $car = Car::findOrFail($validated['cars_id']);
            $type = Type::findOrFail($validated['types_id']);
            $location = Location::findOrFail($validated['locations_id']);

            $unitPrice = $car->price + $type->price + $location->price;

            $carTour = CarTour::create([
                'cars_id' => $car->id,
                'types_id' => $type->id,
                'locations_id' => $location->id,
                'desc' => $validated['desc'],
                'price' => $unitPrice,
                'start_date' => $validated['start_date'],
                'start_time' => $validated['start_time'],
            ]);

            $transaction = Transaction::create([
                'date' => now(),
                'status' => 'Pending Payment',
                'total' => $unitPrice * $validated['qty'],
                'users_id' => auth()->id(),
                'qty' => $validated['qty'],
                'start_date' => $validated['start_date'],
                'start_time' => $validated['start_time'],
                'expired_at' => now()->addHours(24),
            ]);
            
            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'car_tours_id' => $carTour->id,
                'packages_id' => null,
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'total' => $unitPrice,
            ]);            

            DB::commit();
            Mail::to('transport@nurtransbali.com')->send(new TransactionMail($transaction));
            return redirect()->route('customer.order', ['id' => $transaction->id])->with('success', 'Booking success!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Booking failed! ' . $e->getMessage());
        }
    }

    public function order()
    {
        return view('customer.order');
    }

    public function invoice(Transaction $transaction)
    {
        $transaction->load([
            'transactionDetails.carTour.car.carType',
            'transactionDetails.carTour.type',
            'transactionDetails.carTour.location'
        ]);

        return view('customer.invoice', compact('transaction'));
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
