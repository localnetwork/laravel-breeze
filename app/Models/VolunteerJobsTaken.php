<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerJobsTaken extends Model
{
    
    use HasFactory;
    protected $fillable = ['job_id', 'taken_by', 'status']; 

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id')->with(['user_id', 'address', 'tree']);
    }
}
