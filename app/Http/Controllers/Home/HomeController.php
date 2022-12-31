<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Follower;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imagesSuggestion = Image::where('id', '!=', $img->id)->where('archived', false)->get();

        return Inertia::render('Home', [
            'images' => $imagesSuggestion,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }

    public function image(Request $reques, $image)
    {
        $img = Image::findOrFail($image);

        $commentsImage = Comment::with(['user', 'image'])->where('image_id', $img->id)->orderBy('created_at', 'desc')->get();

        $ownerImage = User::find($img->user_id);
        $ownerImage = [
            'id' => $ownerImage->id,
            'name' => $ownerImage->name,
            'owner_profile_path' => $ownerImage->profile_photo_path,
            'owner_profile_url' => $ownerImage->profile_photo_url,
            'user' => Auth::user(),
        ];

        // sugestoes de imagens -- por enquanto serão todas
        $imagesSuggestion = Image::where('id', '!=', $img->id)->where('archived', false)->get();

        $followOwner = Follower::where('user_id', $ownerImage['id'])->where('follower_id', Auth::user()->id)->first() ? true : false;

        return Inertia::render('ImageView', [
            'assets' =>asset(''),
            'image' => $img,
            'owner' => $ownerImage, 
            'comments' => $commentsImage,
            'followOwner' => $followOwner,
            'imagesSuggestion' => $imagesSuggestion
        ]);
    }

    public function commentImage(Request $request, $image)
    {
        $img = Image::find($image);
        $data = $request->only(['user_id', 'comment']);
        $comment = new Comment([
            'image_id' => $img->id,
            'user_id' => $data['user_id'],
            'comment' => $data['comment']
        ]);
        $comment->save();
        return Redirect::back();

        // tenho que pegar o id da imagem que ta sendo comentada
        // o id da pessoa que ta comentando
        // o que a pessoa ta comentando
        
    }

    public function deleteCommentImage(Request $request, $image, Comment $comment)
    {
        $comment = Comment::find($comment->id);
        $comment->delete();
        return Redirect::back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
