<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use App\Models\tags;
use Illuminate\Support\Facades\DB;
use App\Models\comments;
use Illuminate\Support\Facades\Auth;
use App\Mail\contactus;
use Illuminate\Support\Facades\Mail;
use Image;

class blog_postsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth',['except'=>['index','edit']]);
    }

    public function index()
    {
        $posts = post::all();
        $tags = tags::all();
        return view('content.posts' , compact('posts','tags'));
        return view('content.post' , compact('posts','tags'));
    }
    public function post($id)
    {
        // $post = DB::table('posts')->find($id);
        $post = post::where('id',$id)->first();
        return view('content.post' , compact('post'));
    }
    public function store(request $request)
    {
        // dd($request);
        $this->validate(request(),[
            'title' => 'required',
            'body' => 'required',
            'url' => 'image|mimes:jpg,jpeg,png,gif|max:5048'
        ]);
        if(Auth::user()){
       $image_name = time(). '.'. $request->url->getClientOriginalExtension();

        $user = Auth::user();

        $post = new post;

        $post->title = request('title');
        $post->body = request('body');
        $post->url = $image_name;
        $post->user_id = $user->id;
        $post->save();

        $request->url->move(public_path('uploads'),$image_name);
            $post->tags()->sync($request->tag);
       return redirect('/');
        }else{return redirect('/')->with('error','login or register first');}
    // return $request;
    }
    public function dosend(request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'body' => 'required|min:10',
        ]);
        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $body = $request->input('body');

        Mail::to('ahmed.samir10044@gmail.com')->send(new contactus($name,$email,$subject,$body));
        session()->flash("success" , "'I got your message and will answer you asap.... psych!!!");
        return back();

    }
    public function editpost($id)
    {
        $post = post::where('id',$id)->first();
        $tags = tags::all();
        $userId = Auth::id();
        if ($post->user_id !== $userId ) {
            return back()->with('error', 'That is not your post !!!!');
        }
        return view('content.editpost',compact('post','tags'));
    }
    public function update(request $request)
    {
        $request->validate([
            'title' => 'bail|required|min:3',
            'body' => 'required',
             'url' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $post = post::findOrFail($request->id);

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        
          //Upload the featured image if any
          if ($request->hasFile('url')) {
            $url = $request->url;
            $filename = time() .'-'. $url->getClientOriginalName();
            // $location = public_path('uploads/'.$filename);

            // Image::make($url)->resize(800, 400)->save($location);
            $request->url->move(public_path('uploads'),$filename);
            
            $post->url = $filename;
        }

        $post->save();
        $post->tags()->sync($request->tag);
        session()->flash('add' , 'post edited successfully');
        return redirect('/');
    }
    public function delete($id)
    {

        $post = post::find($id);
        //Current User Id
        $userId = Auth::id();
        if ($post->user_id !== $userId ) {
            return back()->with('errors', 'That is not your post !!!!');
        }
        $post->delete();
        return redirect('/')->with('success','post has been deleted successfully');
    }
}
