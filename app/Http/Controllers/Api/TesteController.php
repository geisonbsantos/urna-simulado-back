<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TesteController extends Controller
{
    public function getAllUsers(Request $request)
    {
        // return $this->service->getAll();
        return User::get();
    }

}
