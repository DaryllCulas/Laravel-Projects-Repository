<?php

namespace App\Models;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function jobs()
    {
        // Many-to-Many relationship with Job model = This tag has many jobs
        return $this->belongsToMany(Job::class, relatedPivotKey: 'job_listings_id');
    }
}
