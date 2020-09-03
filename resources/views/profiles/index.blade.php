@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="https://scontent-qro1-1.cdninstagram.com/v/t51.2885-19/s150x150/97566921_2973768799380412_5562195854791540736_n.jpg?_nc_ht=scontent-qro1-1.cdninstagram.com&_nc_ohc=2t8QuRbIh-0AX_Pdw94&oh=3021f27c64355e3677a4e3a36b8ee56b&oe=5F764467" class="rounded-circle">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1>{{ $user->username }}</h1>
                <a href="{{ route('posts.create') }}">Add New Post</a>
            </div>
            <div class="d-flex">
                <div class="pr-5"><strong>153</strong> posts</div>
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
        <div class="col-4">
            <img src="/storage/{{ $post->image }}" style="width: 100%">
        </div>
        @empty
        <div class="col-4">
            No image available
        </div>
        @endforelse
    </div>
</div>
@endsection
