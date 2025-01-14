<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            do {
                $uniqueNumber = random_int(100000, 999999);
            } while (self::where('room_number', $uniqueNumber)->exists());

            $model->room_number = $uniqueNumber;
        });
    }


    public function reservations(): HasOne
    {
        return $this->hasOne(Reservation::class);
    }
}
