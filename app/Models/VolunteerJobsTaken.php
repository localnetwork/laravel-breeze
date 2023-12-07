<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerJobsTaken extends Model
{
    
    use HasFactory;
    protected $fillable = ['job_id', 'taken_by', 'status']; 

    public function job_id()
    {
        return  $this->belongsTo(Job::class, 'job_id'); 
    }
    public function tree()
    {
        return $this->belongsTo(Tree::class, 'job_id');
    }

    public function address()
    {
        return $this->belongsTo(Barangay::class, 'job_id');
    }
    public function user()
    {   
    
        return $this->hasOne(Job::class, 'id');
    }
}
