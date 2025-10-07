<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Election extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'elections';

    protected $fillable = [
        'address_id',
        'election_type_id',
        'user_id',
        'period',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    
    public function election_type()
    {
        return $this->belongsTo(ElectionType::class);
    }
}
