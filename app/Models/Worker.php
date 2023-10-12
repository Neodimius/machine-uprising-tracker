<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * @return BelongsToMany
     */
    public function machines(): BelongsToMany
    {
        return $this->belongsToMany(Machine::class, 'worker_machine', 'worker_id', 'machine_id')
            ->withPivot('started_at', 'ended_at')
            ->withTimestamps();
    }
}
