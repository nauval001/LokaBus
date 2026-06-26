<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {
    protected $fillable = ['user_id', 'schedule_id', 'seat_numbers', 'total_price', 'status', 'payment_proof'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function schedule() {
        return $this->belongsTo(Schedule::class);
    }
}