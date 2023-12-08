<?php

namespace App\Http\Controllers;
use Storage;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function home(){
        // $posts = Post::orderBy('created_at','desc')->paginate(6);       

        
        $posts = Post::when(request('searchKey'),function($p){
            $search = request('searchKey');
            $p->where('title','like','%'.$search.'%');
        })->orderBy('created_at','desc')->paginate(6);
   
        
        return view('create',compact('posts'));
    } 

    public function create(Request $request){
        $this->validData($request);
        $post = $this->getPost($request);
        if($request->hasFile('postImage')){
            $fileName = uniqid() . $request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->storeAs('public',$fileName);
            $post['image'] = $fileName;
        }            
        Post::create($post);
        return back()->with(['success'=>'Post created successfully']);
    }

    public function postDelete($id){
        Post::find($id)->delete();
        return redirect()->route('homePage')->with(['delete'=>'Post deleted successfully']);
    }

    public function read($id){
        $post = Post::find($id);
        return view('read',compact('post'));        
    }

    public function update($id){
        $post = Post::find($id);
        return view('update',compact('post')); 
    }

    public function updatePost(Request $request){
        $postUpdate = $this->getPost($request);
        $id = $request->postId;

        if($request->hasFile('postImage')){
            $oldImage = Post::select('image')->where('id',$request->postId)->first()->toArray();
            $oldImage = $oldImage['image'];
            if($oldImage != null){
                Storage::delete('public/'.$oldImage);
            }
           
            $fileName = uniqid() . $request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->storeAs('public',$fileName);
            $postUpdate['image'] = $fileName;
        }    
        Post::where('id',$id)->update($postUpdate);
        return redirect()->route('homePage')->with(['update'=>'Post updated successfully']);
    }
    

    private function getPost($request){
        return [
            'title'=>$request->postTitle,
            'body'=>$request->postBody,
            'image'=>$request->postImage,
            'price'=>$request->postFee,
            'address'=>$request->postAddress,
            'rating'=>$request->postRate
        ];
    }

    private function validData($request){
        $valid = [
            'postTitle'=>'required | unique:posts,title',
            'postBody'=>'required',
            'postFee'=>'required',
            'postAddress'=>'required',
            'postRate'=>'required',
            'postImage'=>'mimes:jpg,png,jpeg,jiff'
           
        ];
        Validator::make($request->all(),$valid)->validate();
    }
}


