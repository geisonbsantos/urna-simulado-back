<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ElectionType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'election_types';

    protected $fillable = [
        'description',
    ];

    public function elections()
    {
        return $this->hasMany(Election::class);
    }
}
