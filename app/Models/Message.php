<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'user_id',
        'content',
        'created_at',
    ];

    // Relacija: Poruka pripada jednoj konverzaciji
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    // Relacija: Poruka može pripadati korisniku koji je poslao poruku
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
