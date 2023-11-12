<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Tree;  

class Job extends Model {
    use HasFactory;

    public function tree()
    {
        return $this->belongsTo(Tree::class, 'id'); // 'tree_id' is the foreign key in the 'jobs' table
    } 
    public function user_id() {
        return $this->belongsTo(User::class, 'user_id'); // 'tree_id' is the foreign key in the 'jobs' table
    }
    public function address() {
        return $this->belongsTo(Barangay::class, 'address'); 
    }

    protected $fillable = [
        'title',
        'user_id',
        'tree', 
        'address', 
        'quantity',
        'job_description'
    ];
}