<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruct extends Model
{
    use HasFactory;
    protected  $table= 'instructs';
    protected $fillable = [
        'topic_id',
        'lecturer_id',
        'student_id',
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
