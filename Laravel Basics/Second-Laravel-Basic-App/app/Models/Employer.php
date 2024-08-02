<?php

namespace App\Models;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employer extends Model
{
    use HasFactory;

    public function jobs()
    {
        // One-to-Many relationship = This employer has many jobs
        return $this->hasMany(Job::class);
    }

    public function user(): BelongsTo
    {
        // One-to-One relationship = This employer belongs to user
        return $this->belongsTo(User::class);
    }
}
