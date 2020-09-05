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

    public function edit(User $user)
    {
    	$this->authorize('update', auth()->user()->profile);
    	
        return view('profiles.edit', compact('user'));
    }

    public function update()
    {
    	$this->authorize('update', auth()->user()->profile); 
    	
    	$data = request()->validate([
    		'title' => 'required',
    		'description' => 'required',
    		'url' => 'url',
    		'image' => '',
    	]);
    	

        if (request('image')) {
        	$imagePath = request('image')->store('profile', 'public');
        	$image = Image::make('storage/'.$imagePath)->fit(1000,1000)->save();
        }
        auth()->user()->profile()->update(array_merge(
        	$data,
        	['image' => $imagePath]
        ));

        return redirect()->route('profile.show', ['user' => auth()->user()->id]);
    }
}
