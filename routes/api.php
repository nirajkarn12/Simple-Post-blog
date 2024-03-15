<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/**
 * @OA\Info(
 *   title="Post API",
 *   version="1.0.0",
 *   description="API endpoints for managing posts."
 * )
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * @OA\Get(
 *     path="/api/posts",
 *     summary="Get all posts",
 *     @OA\Response(response="200", description="List of posts")
 * )
 */
Route::get('/posts', [PostApiController::class, 'index']);

/**
 * @OA\Get(
 *     path="/api/posts/{id}",
 *     summary="Get post by ID",
 *     @OA\Parameter(name="id", in="path", required=true, description="ID of the post"),
 *     @OA\Response(response="200", description="Post found"),
 *     @OA\Response(response="404", description="Post not found")
 * )
 */
Route::get('/posts/{id}', [PostApiController::class, 'show']);

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
Route::post('/posts', [PostApiController::class, 'store']);

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
Route::put('/posts/{id}', [PostApiController::class, 'update']);

/**
 * @OA\Delete(
 *     path="/api/posts/{id}",
 *     summary="Delete post by ID",
 *     @OA\Parameter(name="id", in="path", required=true, description="ID of the post"),
 *     @OA\Response(response="200", description="Post deleted"),
 *     @OA\Response(response="404", description="Post not found")
 * )
 */
Route::delete('/posts/{id}', [PostApiController::class, 'destroy']);
