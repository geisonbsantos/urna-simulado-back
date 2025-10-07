<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    protected $hidden = [
        'id',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'profile_id', 'id');
    }

    public function abilities()
    {
        return $this->belongsToMany(Ability::class, 'profile_abilities', 'profile_id', 'ability_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_profiles', 'profile_id', 'user_id');
    }

    public function getAbilities()
    {
        return $this->hasMany(Ability::class, 'profile_id');
    }
}
