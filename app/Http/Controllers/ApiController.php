<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function retData($data, $status) {
        return response()->json(array('status' => $status, 'success' => true, 'data' => $data), 200)->header('Content-Type', 'application/json');        
    }

    public function getAllUsers()
    {        
        $users = User::with('posts')->get();
        return $this->retData($users, 200);
    }

    public function getUser($id)
    {
        if (User::where('id', $id)->exists()) {
            $user = User::with('posts')->where('id', $id)->get();
            return $this->retData($user, 200);
        } else {
            return $this->retData(array("message" => "Usuário não encontrado"), 404);
        }
    }

    public function createUser(Request $request)
    {
        try {
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->save();
            if ($user->id > 0){
                return $this->retData($user, 201);    
            } else {
                return $this->retData(array("message" => "Usuário não inserido"), 400);
            }
        } catch (\Throwable $th) {
            return response()->json(array('status' => 500, 'success' => false, 'errorInfo' => $th->errorInfo), 500)->header('Content-Type', 'application/json');        
        }
    }

    public function createPost(Request $request)
    {
        try {
            if (User::where('id', $request->user_id)->exists()) {
                $post = new Post();
                $post->title = $request->title;
                $post->description = $request->description;
                $post->user_id = $request->user_id;
                $post->save();
                if ($post->id > 0){
                    return $this->retData($post, 201);    
                } else {
                    return $this->retData(array("message" => "Post não criado"), 400);
                }
            } else {
                return $this->retData(array("message" => "Usuário não encontrado!"), 200);
            }
        } catch (\Throwable $th) {
            return response()->json(array('status' => 500, 'success' => false, 'errorInfo' => $th->errorInfo), 500)->header('Content-Type', 'application/json');        
        }
        
    }

    public function updatePost(Request $request, $id)
    {
        if (Post::where('id', $id)->exists()) {
            $post = Post::find($id);

            $post->title = is_null($request->title) ? $post->title : $request->title;
            $post->description = is_null($request->description) ? $post->description : $request->description;
            $post->save();
            return $this->retData($post, 201);            
        } else {
            return $this->retData(array("message" => "Post não existe!"), 400);
        }
    }

    public function deletePost($id)
    {
        if (Post::where('id', $id)->exists()) {
            $post = Post::find($id);
            $post->delete();
            return $this->retData(array("message" => "Removido com sucesso!"), 200);
        } else {
            return response()->json([
                "message" => "Post não encontrado"
            ], 404);
        }
    }
}
