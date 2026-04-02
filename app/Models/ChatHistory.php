<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatHistory extends Model
{
    protected $table = 'chat_history';
    protected $fillable = ['user_id', 'user_message', 'ai_response'];
    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}