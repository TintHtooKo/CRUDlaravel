@extends('master')
@section('content')
<div class="container">
    <div class="row">
        <div><a href="{{url('read/'.$post['id'])}}"><i class="fa-solid fa-backward"></i> Back</a></div>
        <div class="col-3 offset-4">
            <form action="{{url('updatePost/'.$post['id'])}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" class="form-control" name="postTitle" value="{{$post['title']}}"><br><br>
                <input type="hidden" name="postId" value="{{$post['id']}}">
                <textarea name="postBody" class="form-control" id="" cols="30" rows="10">{{$post['body']}}</textarea>
                <br><br>
                @if($post['image'])
                <img src="{{asset('storage/'.$post->image)}}" class="img-thumbnail" alt="">
                @else
                <img src="{{asset('storage/404.png')}}" class="img-thumbnail" alt="">
                @endif
                <br><br>
                <input type="file" class="form-control" name="postImage" value="{{old('postImage',$post->image)}}"><br><br>
                <input type="text" class="form-control" name="postAddress" value="{{$post['address']}}"><br><br>
                <input type="text" class="form-control" name="postFee" value="{{$post['price']}}"><br><br>
                <input type="text" class="form-control" name="postRate" value="{{$post['rating']}}"><br><br>
                <input type="submit" class="btn btn-warning" value="Edit">
            </form>
        </div>
    </div>
</div>
@endsection