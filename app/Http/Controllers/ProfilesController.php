<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
    	//Order by latest the posts
    	/*$user->load(['posts' => function($q){
    		$q->latest();
    	}]);*/
    	
        return view('profiles.index', compact('user'));
    }
}
