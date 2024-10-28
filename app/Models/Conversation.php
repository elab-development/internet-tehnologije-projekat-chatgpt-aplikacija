<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'created_at',
    ];

    // Relacija: Konverzacija pripada jednom korisniku
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacija: Konverzacija može imati više poruka
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
