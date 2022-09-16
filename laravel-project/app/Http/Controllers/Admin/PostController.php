<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;

use App\Category;
use App\Post;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $posts = Post::all();
        $request_info = $request->all();
        
        $deleted_message = isset($request_info['deleted']) ? $request_info['deleted'] : null;
        $data = [
            'posts' => $posts,
            'deleted_message' => $deleted_message
        ];
        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $data = [
            'categories' => $categories,
            'tags' => $tags
        ];
        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:60000',
            'category_id' => 'nullable | exists:categories,id',
            'tags'=> 'nullable|exists:tags,id',
            'cover' => 'image|max:1024'
        ]);
        $form_data = $request->all();
        if(isset($form_data['image'])){
            //per caricare il film image nella cartella
            $img_path = Storage::put('post-covers', $form_data['image']);
            $form_data['cover'] = $img_path;
        }
        //per posts
        $new_post = new Post();
        $new_post->fill($form_data);
        $new_post->slug = $this->getFreeSlug($new_post->title);
        $new_post->save();

        // per tags
        if(isset($form_data['tags'])){
            $new_post->tags()->sync($form_data['tags']);
        }
        //invio una mail

        return redirect()->route('admin.posts.show', ['post' => $new_post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        
        $now =  Carbon::now();
        $diff = $post->created_at->diffInDays($now);
        
        $data = [
           'post' => $post,
           'diff' => $diff,
          
        ];
        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        $data = [
            'post' => $post,
            'categories' => $categories,
            'tags'  => $tags
        ];
        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $form_data = $request->all();
        $post_to_update = Post::findOrFail($id);
        
       
        if(isset($form_data['image'])){
            //cancello la vecchia immagine
            if($post_to_update->cover){
                Storage::delete($post_to_update->cover);
            }
             //carico il nuovo file
             $img_path = Storage::put('post-covers', $form_data['image']);
             $form_data['cover'] = $img_path;
        }
        if($form_data['title'] !== $post_to_update->title){
            $form_data['slug'] = $this->getFreeSlug($form_data['title']);
        }else{
            $form_data['slug'] = $post_to_update->slug;
        }
         
        $post_to_update->update($form_data);
      
        
        //aggiornamento tag

        if(isset($form_data['tags'])){
            $post_to_update->tags()->sync($form_data['tags']);
        }else{
            $post_to_update->tags()->sync([]);
        }
        

        return redirect()->route('admin.posts.show', ['post' => $post_to_update->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $post_to_delete = Post::findOrFail($id);
       $post_to_delete->delete();
       $data =[
        'deleted' => 'yes'
       ];
       return redirect()->route('admin.posts.index', $data);
    }

    protected function getFreeSlug($title){
        $slug_to_save = Str::slug($title, '-');
        $slug_base = $slug_to_save;
        //verifico se esiste
        $existing_slug = Post::where('slug', '=',$slug_to_save )->first();
        //se non lo trovo appendo un numero
        $counter = 1;
        while($existing_slug){
            $slug_to_save = $slug_base. '-' .$counter;

            $existing_slug = Post::where('slug', '=',$slug_to_save )->first();

            $counter++;
        }
        return $slug_to_save;
    }
}
