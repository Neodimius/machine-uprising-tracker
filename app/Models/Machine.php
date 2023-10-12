<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = ['number'];

    /**
     * @return BelongsToMany
     */
    public function workers(): BelongsToMany
    {
        return $this->belongsToMany(Worker::class, 'worker_machine', 'machine_id', 'worker_id')
            ->withPivot('started_at', 'ended_at')
            ->withTimestamps();
    }
}
