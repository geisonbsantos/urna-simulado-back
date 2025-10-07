<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'candidates';

    protected $fillable = [
        'name',
        'number',
        'acronym',
        'image',
        'candidate_type_id',
    ];

    public function candidate_type()
    {
        return $this->belongsTo(CandidateType::class);
    }
}
