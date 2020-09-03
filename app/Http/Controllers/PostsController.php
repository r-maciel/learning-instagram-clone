<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function create()
    {
    	return view('posts.create');
    }

    public function store()
    {
    	$data = request()->validate([
    		'caption' => 'required',
    		'image' => ['required', 'image'],
    	]);

    	/* With store() we can define where to store our file, if we put / is gonna store it in storage/ in this case is gonna be stored in storage/uploads, the second parameter is the driver to upload our files in this case is public because we're storing our files in our local, after that we need to run 
    	>> php artisan storage:link to create a symbolic link from our directory public/storage to storage/app/public, the last one is where our file really is, but we need to find it in public/storge because it is the only route accessible for the public in our app*/
    	/* We need to save the url generated where our image is stored to save it in our DB */
    	$imagePath = request('image')->store('uploads', 'public');

    	auth()->user()->posts()->create([
    		'caption' => $data['caption'],
    		'image' => $imagePath,
    	]);

    	return redirect()->route('profile.show', ['user' => auth()->user()->id ]);
    }
}
