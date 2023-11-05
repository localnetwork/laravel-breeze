<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tree;  

class Job extends Model {
    use HasFactory;

    public function tree()
    {
        return $this->belongsTo(Tree::class, 'id'); // 'tree_id' is the foreign key in the 'jobs' table
    } 

    protected $fillable = [
        'title',
        'user_id',
        'tree', 
        'quantity',
        'job_description'
    ];
}