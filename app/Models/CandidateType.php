<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidateType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'candidate_types';

    protected $fillable = [
        'description',
    ];

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
