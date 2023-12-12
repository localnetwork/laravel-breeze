<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Tree;  

class Job extends Model {
    use HasFactory;

    

    protected $fillable = [
        // 'title',
        'user_id',
        'tree', 
        'address', 
        'quantity',
        'stocks', 
        // 'job_description'
    ];


    public function tree()
    {
        return $this->belongsTo(Tree::class, 'tree'); 
    } 
    public function user_id() {
        return $this->belongsTo(User::class, 'user_id'); 
    }
    public function address() {
        return $this->belongsTo(Barangay::class, 'address'); 
    }

    public function volunteer_jobs_takens()
    {
        return $this->hasMany(VolunteerJobsTaken::class);
    }
}