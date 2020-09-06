<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class FollowsController extends Controller
{
    public function store(User $user)
    {
    	/* toggle($user->profile) let us attach or detach our authenticated user to the profile of the user we recieved as parameter, in simple words it links in our table profile_user our auth user and the profile we're receiving and creates a new row with the values of the user and the profile ids, if they are already attached (the row is olready in our table) the method detach them (delete the row from our table)  */
    	return auth()->user()->following()->toggle($user->profile);
    }
}
