<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GarbageCollectionRequest extends Model
{
    protected $fillable = [
        'user_id',
        'address_id',
        'status_id',
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

    public function assignment()
    {
        return $this->hasOne(GarbageCollectionRequestCollector::class, 'request_id','id');
    }

}
