<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BotReply extends Model
{
    use HasFactory;
    protected $fillable = [
        'keyword',
        'title',
        'response_text',
        'type',
    ];

    public function getRouteKeyName()
    {
        // Memberitahu Laravel untuk menggunakan kolom 'keyword' 
        // sebagai pengenal di URL, bukan 'id'.
        return 'keyword';
    }
}
