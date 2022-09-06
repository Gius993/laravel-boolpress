<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Post;
use Illuminate\Support\Str;
use Carbon\Carbon;
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
        return view('admin.posts.create');
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
        ]);
        $form_data = $request->all();

        $new_post = new Post();
        $new_post->fill($form_data);
       
        $new_post->slug = $this->getFreeSlug($new_post->title);
        $new_post->save();
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
           'diff' => $diff
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
        $data = [
            'post' => $post
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

        if($form_data['title'] !== $post_to_update->title){
            $form_data['slug'] = $this->getFreeSlug($form_data['title']);
        }else{
            $form_data['slug'] = $post_to_update->slug;
        }
        //aggiorno il post
        
        $post_to_update->update($form_data);
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
