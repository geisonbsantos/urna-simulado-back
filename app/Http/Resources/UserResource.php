<?php

namespace App\Http\Resources;

use App\Models\Profile;
use App\Models\ProfileAbility;
use App\Models\User;
use App\Models\UserProfiles;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'cpf' => $this->cpf,
            'email' => $this->email,
            'profile' => $this->profile->name,
            'profile_id' => $this->profile_id,
            'address' => $this->address ? $this->address->name : null,
            'ibge_code' => $this->address ? $this->address->ibge_code : null,
            'address_id' => $this->address_id,
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
            'abilities' => $this->abilities,
            'profiles' => $this->profiles->map(function ($profile) {
                return [
                    'id' => $profile->id,
                    'name' => $profile->name,
                    'abilities' => $profile->abilities->pluck('slug'),
                ];
            }),
        ];
    }
}
