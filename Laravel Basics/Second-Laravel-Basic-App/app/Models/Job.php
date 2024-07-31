<?php

namespace App\Models;

use App\Models\Employer;
use App\Models\Tag;
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

    public function tags()
    {
        // Many-to-Many | One-to-Many | Relationship (belongsToMany) = This job has many tags
        return $this->belongsToMany(Tag::class, foreignPivotKey: 'job_listings_id');
    }
}
