<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function __construct(){
        $this->middleware("auth")->except(['show', 'index']);
    }

    public function index(User $user){

        $posts = Post::where("user_id", $user->id)->latest()->paginate(20);

        return view("dashboard", [
            "user"=> $user,
            'posts'=> $posts

        ]);
    }

    public function create(){
    
        return view("post.create");
    }

    public function store(Request $request){
        
        $this->validate($request, [
            "titulo"=> "required|max:255",
            "descripcion"=> "required",
            "imagen"=> "required",
        ]);

        /*Post::create([
            "titulo"=> $request->titulo,
            "descripcion"=> $request->descripcion,
            "imagen"=> $request->imagen,
            "user_id" => auth()->user()->id,
        ]);*/

        //otra forma
        //$post = new Post();
        //$post->titulo = $request->titulo;
        //$post->descripcion = $request->descripcion;
        //$post->imagen = $request->imagen;
        //$post->user_id = auth()->user()->id;
        //$post->save();

        //otra forma mas estilo de laravel
        $request->user()->post()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route("post.index", auth()->user()->username);
    }

    public function show(User $user, Post $post){
        return view('post.show',[
            'post' => $post,
            'user' => $user,
        ]);
    }

    public function destroy(Post $post){
        if($post->user_id === auth()->user()->id){
            $this->authorize('delete', $post);
            $post->delete();

            //Eliminar la imagen
            $imagen_path = public_path('uploads/'. $post->imagen);

            if(File::exists($imagen_path)){
                //File::delete($imagen_path); Aveces funciona
                unlink($imagen_path);
            }

            return redirect()->route('post.index', auth()->user()->username);
        }
    }


}
