<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicProposal extends Model
{
    use HasFactory;
    protected $table='topic_proposals';

    public function subjectType()
    {
        return $this->belongsTo(SubjectType::class,'subject_id','id');
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
