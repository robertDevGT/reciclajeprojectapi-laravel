<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GarbageCollectionRequestCollector extends Model
{
    protected $fillable = [
        'request_id',
        'collector_id',
        'assigned_at',
        'completed_at',
    ];

    public function collector()
    {
        return $this->belongsTo(Collector::class, 'collector_id');
    }
}
