<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterTopic extends Model
{
    use HasFactory;
    protected $fillable = [
        'topic_id',
        'student_id',
        'lecturer_id',
        'registration_date',
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function lecturer()
    {
        return $this->belongsTo(User::class, 'lecturer_id');
    }
}
