<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostUpdatedRequest;
use App\Models\post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
       
    { 
        $user = auth()->user();

        $query = Post::with(['user','media'])
        ->withCount('claps')
        ->latest();
        if($user){
            $ids = $user->following()->pluck('users.id');
            $query->whereIn('user_id', $ids);
        }


        $posts = $query->simplePaginate(5);
        return view('post.index', ['posts' => $posts,]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {    $categories = Category::get();
         return view('post.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image'=> ['required','image','mimes:jepg,png,jpg,gif,svg','max:2048'],
            'title'=>'required',
            'content'=>'required',
            'category_id'=>['required','exists:categories,id'],
        ]);
            // $image = $data['image'];
            // unset($data['image']);
            $data['user_id'] = Auth::id();
        

            // $imagePath = $image->store('posts','public');
            // $data['image'] = $imagePath;

        $post = Post::create($data);
        $post->addMediaFromRequest('image')->toMediaCollection();
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show( string $username , post $post)
    {
        return view('post.show',[
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(post $post)
    {
        if($post->user_id !== Auth::id()){
            abort(403, 'Unauthorized action.');
        }
        $categories = Category::get();
        return view('post.edit', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdatedRequest $request, post $post)
    {
        if($post->user_id !== Auth::id()){
            abort(403, 'Unauthorized action.');
        }

        $data = $request->validated();

        $post->update($data);
        if($data['image'] ?? false){
            $post->addMediaFromRequest('image')
            ->toMediaCollection();
        }

        return redirect()->route('myPosts');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(post $post)
    {
        if($post->user_id !== Auth::id()){
            abort(403, 'Unauthorized action.');
        }
        $post->delete();
        return redirect()->route('dashboard');
    }

    public function category(Category $category)
    {
        $posts = $category->posts()
        ->with(['user','media'])
        ->withCount('claps')
        ->latest()
        ->simplePaginate(5);
        return view('post.index', ['posts' => $posts]);
    }

    public function myPosts()
    {
        $user = auth()->user();
        $posts = $user->posts()
        ->with(['user','media'])
        ->withCount('claps')
        ->latest()
        ->simplePaginate(5);
        return view('post.index', ['posts' => $posts]);
    }
}
