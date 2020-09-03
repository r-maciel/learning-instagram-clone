<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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

        /* We use the image from intervention/image we give the path (in the video their use public_path(), but is not necessary for the path), then we use the fit method, to cut and resize our image to fit the sizes we want

        We need the path because we already have our mage in uploaded we just need to modify it. 

        So when you do something like this try to fit the image before stored to see what happend and try to use this without linking the directories to see where is storaged by default,like this

        $image = Image::make(request('image'))->fit(1200,1200)->save('storage/uploads/algo2.jpg');

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => 'uploads/algo2.jpg',
        ]);
        You can use the above code without the symbilic link if you first create the route where you're gonna save your files in public directory because there is where is loking for the directory to save if you save it directly with the intervention/image package
        */
        
        $image = Image::make('storage/'.$imagePath)->fit(1200,1200)->save();

    	auth()->user()->posts()->create([
    		'caption' => $data['caption'],
    		'image' => $imagePath,
    	]);

    	return redirect()->route('profile.show', ['user' => auth()->user()->id ]);
    }
}
