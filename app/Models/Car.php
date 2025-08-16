<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $table = 'cars';
    protected $fillable = ['name', 'descriptions', 'image', 'price', 'seat', 'car_types_id'];
    protected $guarded = [];
    public function carType()
    {
        return $this->belongsTo(CarType::class, 'car_types_id');
    }
}
