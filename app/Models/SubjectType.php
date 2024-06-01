<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectType extends Model
{
    use HasFactory;
    protected $table= 'subject_types';
    protected $fillable = [
        'name_subject',
    ];
    public function topicProposals()
    {
        return $this->hasMany(TopicProposal::class);
    }
}
