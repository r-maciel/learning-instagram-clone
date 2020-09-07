<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\User;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
    	//Order by latest the posts
    	/*$user->load(['posts' => function($q){
    		$q->latest();
    	}]);*/

        /* If the user is auth, then we check if the user is following the user's profile we recieved as parameter if is correct then is true, if is not is false*/

        /* We can pass the $user->id or $user->profile because both user_id and profile_id has the same value because they're created at the same moment, 
        As we define in our model user, following is the relationship to the profiles, so is gonna look for the profile_id, so the value we pass in the contains() (the user id or the profile) is gonna be compared with the column of profile_id in our profile_user table */
        $follows = auth()->user() ? auth()->user()->following->contains($user->profile) : false;

        /* Cache::remember let us to use the cache instead of asking for the data to the database each time we need it,  as parameters recieve a unique name/id, ho much is gonna last tha cache until we ask for the data again, and the function for the data we want*/
        $postCount = Cache::remember('count.posts.'.$user->id, now()->addSeconds(30), function() use($user){
            return $user->posts->count();
        });

        $followersCount = Cache::remember('count.followers.'.$user->id, now()->addSeconds(30), function() use($user){
            return $user->profile->followers->count();
        });

        $followingCount = Cache::remember('count.following.'.$user->id, now()->addSeconds(30), function() use($user){
            return $user->following->count();
        });
    	
        return view('profiles.index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
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
    		'image' => 'image',
    	]);
    	

        if (request('image')) {
        	$imagePath = request('image')->store('profile', 'public');
        	$image = Image::make('storage/'.$imagePath)->fit(1000,1000)->save();
        	/* We crate this variable if there is an image in the request */
    		$imageArray = ['image' => $imagePath];
        }

        /* with array merge we mix arays, as $data has a field called $data['image'], this will be override with the valu of $imageArray that is equal to 'image' => $imagePath, both have the same name */
        auth()->user()->profile()->update(array_merge(
        	$data,
        	/* If the variable is not defined then we pass an empty array, this way if we don't pass a image we do not override the image we already have with a null */
        	$imageArray ?? []
        ));

        return redirect()->route('profile.show', ['user' => auth()->user()->id]);
    }
}
