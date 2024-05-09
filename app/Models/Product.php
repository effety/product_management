<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'user_id',
        'category_id',
        'feature_ids',
    ];

    protected $casts = [
        'category_id' => 'json',
        'feature_ids' => 'json',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'feature_ids');
    }
}
