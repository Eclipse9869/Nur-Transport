<?php

namespace App\Http\Controllers;
use App\Models\Car;
use App\Models\CarType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cars = Car::with('carType')->get(); // kalau relasi ada
        return view('staff/admin.car', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $carTypes = CarType::all(); // ambil semua tipe mobil
        return view('staff/admin.add-update-car', compact('carTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'descriptions' => 'required|string',
            'car_types_id' => 'required|exists:car_types,id',
            'seat' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
        ]);

        // Upload gambar ke storage/app/public/cars
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cars', 'public');
        }

        // Simpan data mobil ke database
        Car::create([
            'name' => $validated['name'],
            'descriptions' => $validated['descriptions'],
            'car_types_id' => $validated['car_types_id'],
            'price' => $validated['price'],
            'seat' => $validated['seat'],
            'image' => $imagePath, // ini nanti bisa diakses dengan url('storage/' . $imagePath)
        ]);

        return redirect()->route('cars.index')->with('success', 'Car has been successfully added!');
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
    public function edit(Car $car)
    {
        $carTypes = CarType::all();
        return view('staff/admin.add-update-car', compact('car', 'carTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'descriptions' => 'required|string',
            'car_types_id' => 'required|exists:car_types,id',
            'price' => 'required|numeric|min:0',
            'seat' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Jika ada file baru, hapus lama dan ganti
        if ($request->hasFile('image')) {
            if ($car->image && Storage::disk('public')->exists($car->image)) {
                Storage::disk('public')->delete($car->image);
            }

            $validated['image'] = $request->file('image')->store('cars', 'public');
        } else {
            // Jika tidak upload gambar baru, tetap gunakan gambar lama
            $validated['image'] = $car->image;
        }

        $car->update($validated);

        return redirect()->route('cars.index')->with('success', 'Car has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function filterByType($id)
    {
        $cars = Car::with('carType')
            ->where('car_types_id', $id)
            ->get();
    
        $carType = CarType::findOrFail($id);
    
        return view('staff/admin.car-by-type', compact('cars', 'carType'));
    }
    
    public function destroy(string $id)
    {
        //
    }
}
