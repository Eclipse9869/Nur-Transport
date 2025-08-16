<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable = ['date', 'status', 'total', 'qty', 'users_id', 'start_date', 'start_time', 'paid_at', 'expired_at'];
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'transactions_id');
    }
}
