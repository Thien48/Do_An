<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterTopic extends Model
{
    use HasFactory;
    protected $table = 'register_topic';
    protected $fillable = [
        'topic_id',
        'student_id',
        'registration_date',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

}
