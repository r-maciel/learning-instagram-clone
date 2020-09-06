@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            {{-- We call the method we have created in our model --}}
            <img src="{{  $user->profile->profileImage() }}" class="rounded-circle w-100">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-4">
                    <div class="h4">{{ $user->username }}</div>
                    {{-- We create this component with vue in /resources/js/components/FollowButton.js --}}
                    <follow-button></follow-button>
                </div>
                @can('update', $user->profile)
                    <a href="{{ route('posts.create') }}">Add New Post</a>
                @endcan
            </div>
            {{-- Using the policy in our view to print ir not some html --}}
            @can('update', $user->profile)
                <a href="{{ route('profile.edit', ['user' => $user->id]) }}">Edit Profile</a>
            @endcan
            <div class="d-flex">
                <div class="pr-5"><strong>{{ $user->posts->count() }}</strong> posts</div>
                <div class="pr-5"><strong>23k</strong> followers</div>
                <div class="pr-5"><strong>252</strong> follows</div>
            </div>
            <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="#">{{ $user->profile->url }}</a></div>
        </div>
    </div>
    <div class="row pt-5">
        @forelse($user->posts as $post)
        <div class="col-4 pb-4">
            <a href="{{ route('posts.show', ['post' => $post->id]) }}"><img src="/storage/{{ $post->image }}" style="width: 100%"></a>
        </div>
        @empty
        <div class="col-4">
            No image available
        </div>
        @endforelse
    </div>
</div>
@endsection
