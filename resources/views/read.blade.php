@extends('master')
@section('content')
<div class="container">
    <div><a href="{{route('homePage')}}"><i class="fa-solid fa-backward"></i> Back</a></div>
    <div class="row">
        <div class="col-3 offset-4 mt-5">
            <h3 class="shadow p-3 mb-5 bg-body rounded">{{$post->title}}</h3>
            <p class="shadow p-3 mb-5 bg-body rounded">{{$post['body']}}</p><br>
            @if($post['image'])
            <img src="{{asset('storage/'.$post->image)}}" class="img-thumbnail" alt="">
            @else
            <img src="{{asset('storage/404.png')}}" class="img-thumbnail" alt="">
            @endif
            <p class="shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-location-dot text-danger"></i> {{$post['address']}}</p><br>
            <p class="shadow p-3 mb-5 bg-body rounded"><i class="fa-regular fa-money-bill-1 text-primary"></i> {{$post['price']}} Ks</p><br>
            <p class="shadow p-3 mb-5 bg-body rounded">{{$post['rating']}} </p><br>

            <a href="{{route('updatePage',$post['id'])}}"><button class="btn btn-primary">Edit</button></a>
        </div>
    </div>
</div>
@endsection