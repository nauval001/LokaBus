<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model {
    protected $fillable = ['bus_id', 'origin', 'destination', 'price', 'departure_time', 'arrival_time'];

    protected $casts = [
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime',
    ];

    public function bus() {
        return $this->belongsTo(Bus::class);
    }
    public function seats() {
        return $this->hasMany(Seat::class);
    }
    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
}