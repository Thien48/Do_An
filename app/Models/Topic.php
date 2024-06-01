<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $table= 'topics';
    protected $fillable = [
        'id',
        'proposal_id',
    ];
    public function topicProposal()
    {
        return $this->belongsTo(TopicProposal::class, 'proposal_id', 'id');
    }

    public function registerTopics()
    {
        return $this->hasMany(RegisterTopic::class);
    }
}
