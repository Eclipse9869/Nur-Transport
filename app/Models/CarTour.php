<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarTour extends Model
{
    use HasFactory;

    protected $table = 'car_tours';
    protected $fillable = ['cars_id', 'types_id', 'locations_id', 'desc', 'price', 'start_date', 'start_time'];

    public function car()
    {
        return $this->belongsTo(Car::class, 'cars_id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'types_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'locations_id');
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'car_tours_id');
    }
}

