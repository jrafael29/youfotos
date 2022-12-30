<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class MyImagesController extends Controller
{
    public function index(Request $request)
    {
        $imagesOfthatUserLogged = Image::where('user_id', Auth::user()->id)->get();
        return Inertia::render('MyImages', [
            'assets' =>asset(''),
            'images' => fn() => $imagesOfthatUserLogged
        ]);
    }
    public function images()
    {
        $imagesOfthatUserLogged = Image::where('user_id', Auth::user()->id)->get();
        return response()->json( $imagesOfthatUserLogged );
    }

    public function store_image(Request $request)
    {
        try {
            $pathOfImageRecentlyStored = $request->file('image')->store('public/images');
            $newImage = new Image([
                'user_id' => $request->user()->id,
                'path_name' => $pathOfImageRecentlyStored,
                'description' => $request->description ?? ''
            ]);
            $newImage->save();
            return Redirect::back()->with(['success' => 'success']);
            // return response()->json(['erro' => 'sucesso mentira']);
        } catch (\Throwable $th) {

            return response()->json(['erro' => $th]);
        }
    }

    public function delete_image(Request $request, Image $image)
    {
        return $image->delete();    
    }

    public function toggle_image_archived_status(Request $request, Image $image)
    {
        $image->archived = !$image->archived;
        return $image->save();
    }
}
