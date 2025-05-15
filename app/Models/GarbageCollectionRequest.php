<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GarbageCollectionRequest extends Model
{
    protected $fillable = [
        'user_id',
        'address_id',
        'status_id',
        'collector_id',
        'fecha_recoleccion'
    ];

    protected $casts = [
        'fecha_recoleccion' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function collector()
    {
        return $this->belongsTo(Collector::class);
    }
}
