<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use HasFactory;
    use Notifiable;
    
    protected $fillable = [
        'mssv',
        'name',
        'class',
        'gender',
        'telephone',
        'image',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registerTopics()
    {
        return $this->hasMany(RegisterTopic::class);
    }
    public function routeNotificationForMail($notification)
{
    return $this->email; // Chỉ định cột email của Student là nơi gửi notification
}
}
