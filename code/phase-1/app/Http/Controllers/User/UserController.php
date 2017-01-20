<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Game;

class UserController extends Controller
{
    public function showProfile(User $user, Game $selectedGame){
    	return view("user.my-account.profile", compact('user', 'selectedGame'));
    }
}
