<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;
    
    protected $fillable = ['sender_id', 'receiver_id', 'message'];

    protected $table = 'messages';
}
