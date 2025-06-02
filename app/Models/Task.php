<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'due_date',
        'category_id',
        'sub_category_id',
        'assigned_to_user_id',
        'created_by_user_id'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function subCategory() {
        return $this->belongsTo(SubCategory::class);
    }

    public function assignedTo() {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }
    
    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }
    
}
