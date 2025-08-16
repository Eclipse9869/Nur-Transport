<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'transaction_details';
    protected $fillable = ['transactions_id', 'car_tours_id', 'packages_id', 'name', 'phone', 'email', 'total'];
    protected $guarded = [];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transactions_id');
    }

    public function carTour()
    {
        return $this->belongsTo(CarTour::class, 'car_tours_id');
    }

    // public function package()
    // {
    //     return $this->belongsTo(Package::class, 'packages_id');
    // }
}
