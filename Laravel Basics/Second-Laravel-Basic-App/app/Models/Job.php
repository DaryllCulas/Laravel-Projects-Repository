<?php

namespace App\Models;

use App\Models\Employer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Job extends Model
{
    use HasFactory;

    protected $table = 'job_listings';

    protected $fillable = ['title', 'salary'];


    public function employer()
    {

        // One-to-One | One-to-Many | Relationship (belongsTo) = This job belongs to an employer
        return $this->belongsTo(Employer::class);
    }
}
