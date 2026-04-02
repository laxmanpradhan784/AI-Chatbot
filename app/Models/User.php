<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password', 'user_type'];
    protected $hidden = ['password'];
    
    public function chatHistories()
    {
        return $this->hasMany(ChatHistory::class);
    }
    
    public function isAdmin()
    {
        return $this->user_type === 'admin';
    }
}