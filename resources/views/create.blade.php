@extends('master')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if(session('delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('delete') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if(session('update'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('update') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <div class="row mt-5">
        <div class="col-5">
            <form action="{{url('create')}}" class="needs-validation"  enctype="multipart/form-data" method="post">
                @csrf
                <input type="text" placeholder="Title"  name="postTitle" value="{{old('postTitle')}}"  class="form-control is-invalid">
                @error('postTitle')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>                   
                @enderror
                <br><br>
                <textarea name="postBody" class="form-control is-invalid"   placeholder="Discription" id="" cols="30" rows="10">{{old('postBody')}}</textarea>
                @error('postBody')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>                   
                @enderror
                <br><br>
                <label for="">Image</label>
                <input type="file" name="postImage" class="form-control">
                @error('postBody')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>                   
                @enderror
                <br><br>

                <input type="number" value="{{old('postFee')}}" class="form-control" placeholder="Post Fees" name="postFee">
                @error('postFee')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>                   
                @enderror
                <br><br>

                <input type="text" name="postAddress" class="form-control" placeholder="Address" value="{{old('postAddress')}}">
                @error('postAddress')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>                   
                @enderror
                <br><br>
                <label for="">Rating</label>
                <input type="number" value="{{old('postRate')}}" min="0" max="5" name="postRate" class="form-control"><br><br>
                <input type="submit" value="create">
            </form>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-5"><h3>Total - {{$posts->total()}}</h3></div>
                <div class="col-5 offset-2">
                    <form action="{{route('homePage')}}" method="get">
                        <div class="d-flex">
                            <input class="form-control me-2" name="searchKey" value="{{request('searchKey')}}" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            @if(count($posts) != 0)
                @foreach ($posts as $item)
                <div class="shadow p-3 mb-5 bg-body rounded">
                    <h3>{{$item['title']}}</h3>
                    <h6>{{$item['created_at']->format("d/m/y | n:i:A")}}</h6>
                    <p>{{Str::words($item['body'],10,'...')}}</p>
                    @if($item['image'])
                    <img src="{{asset('storage/'.$item->image)}}" style="width:200px; height:220px" alt="">
                    @endif
                    <br>
                    <span>
                        <i class="fa-regular fa-money-bill-1 text-primary"></i>  {{$item['price']}} Kyats
                    </span>
                    |
                    <span><i class="fa-solid fa-location-dot text-danger"></i> {{$item['address']}}</span> |
                    <span>{{$item['rating']}} <i class="fa-solid fa-star text-warning"></i></span>
                    <br><br>
                    <a href="{{url('read/'.$item['id'])}}"><button class="btn btn-primary"><i class="fa-brands fa-readme"></i></i> Read</button></a>
                    <a href="{{url('delete/'.$item['id'])}}"><button class="btn btn-danger"><i class="fa-solid fa-trash"></i> delete</button></a>
                </div>
                @endforeach
            @else
                <h3 class="text-danger text-center mt-5">There is no data</h3>
            @endif
        </div>
        {{$posts->appends(request()->query()) -> links()}}
    </div>
    
</div>
@endsection