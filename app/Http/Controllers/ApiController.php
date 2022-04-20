<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getAllUsers()
    {
        $users = User::with('posts')->get()->toJson(JSON_PRETTY_PRINT);
        return response($users, 200);
    }

    public function getUser($id)
    {
        if (User::where('id', $id)->exists()) {
            $user = User::with('posts')->where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($user, 200);
        } else {
            return response()->json([
                "message" => "Usuário não encontrado"
            ], 404);
        }
    }

    public function createUser(Request $request)
    {
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->save();

        return response()->json([
            "message" => "Usuário criado com sucesso"
        ], 201);
    }

    public function createPost(Request $request)
    {
        if (User::where('id', $request->user_id)->exists()) {
            $post = new Post();
            $post->title = $request->title;
            $post->description = $request->description;
            $post->user_id = $request->user_id;
            $post->save();

            return response()->json([
                "message" => "Post criado com sucesso"
            ], 201);
        } else {
            return response()->json([
                "message" => "Usuário não existe"
            ], 404);
        }
    }

    public function updatePost(Request $request, $id)
    {
        if (Post::where('id', $id)->exists()) {
            $post = Post::find($id);

            $post->title = is_null($request->title) ? $post->title : $request->title;
            $post->description = is_null($request->description) ? $post->description : $request->description;
            $post->save();

            return response()->json([
                "message" => "Post atualizado com sucesso"
            ], 200);
        } else {
            return response()->json([
                "message" => "Post não encontrado"
            ], 404);
        }
    }

    public function deletePost(Request $request, $id)
    {
        if (Post::where('id', $id)->exists()) {
            $post = Post::find($id);
            $post->delete();

            return response()->json([
                "message" => "Post removido com sucesso"
            ], 200);
        } else {
            return response()->json([
                "message" => "Post não encontrado"
            ], 404);
        }
    }
}
