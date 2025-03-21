<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'price',
        'quantity',
        'image',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

     
      public function user()
      {
          return $this->belongsTo(User::class);
      }
}
