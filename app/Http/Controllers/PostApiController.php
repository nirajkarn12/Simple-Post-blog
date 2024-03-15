<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *    title="Post API",
 *    version="1.0.0"
 * )
 */
class PostApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/posts",
     *     summary="Get all posts",
     *     @OA\Response(response="200", description="List of posts")
     * )
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json(['posts' => $posts], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/posts/{id}",
     *     summary="Get post by ID",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the post"),
     *     @OA\Response(response="200", description="Post found"),
     *     @OA\Response(response="404", description="Post not found")
     * )
     */
    public function show($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }
        return response()->json(['post' => $post], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/posts",
     *     summary="Create a new post",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title","description"},
     *             @OA\Property(property="title", type="string", example="New Post"),
     *             @OA\Property(property="description", type="string", example="Description of the new post")
     *         )
     *     ),
     *     @OA\Response(response="201", description="Post created"),
     *     @OA\Response(response="400", description="Invalid data")
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json(['post' => $post], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/posts/{id}",
     *     summary="Update post by ID",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the post"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title","description"},
     *             @OA\Property(property="title", type="string", example="Updated Post"),
     *             @OA\Property(property="description", type="string", example="Updated description of the post")
     *         )
     *     ),
     *     @OA\Response(response="200", description="Post updated"),
     *     @OA\Response(response="400", description="Invalid data"),
     *     @OA\Response(response="404", description="Post not found")
     * )
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $post = Post::find($id);
        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json(['post' => $post], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/posts/{id}",
     *     summary="Delete post by ID",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the post"),
     *     @OA\Response(response="200", description="Post deleted"),
     *     @OA\Response(response="404", description="Post not found")
     * )
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}
