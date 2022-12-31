<?php

namespace App\Http\Controllers\Follower;

use App\Http\Controllers\Controller;
use App\Models\Follower;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function follow_image_owner(Request $request, $image)
    {
        $data = $request->all();
        $data['image_id'] = $image;

        $userThatIsFollowed = User::find(Image::with(['user'])->find($data['image_id'])?->user->id);
        $newFollow = new Follower([
            'user_id' => $userThatIsFollowed->id,
            'follower_id' => Auth::user()->id
        ]);
        $newFollow->save();
        return $newFollow;
    }

    public function unfollow_image_owner(Request $request, $image)
    {
        $userThatIsUnfollowed = User::find(Image::with(['user'])->find($image)?->user->id);
        
        $follow = Follower::where('user_id', $userThatIsUnfollowed->id)->where('follower_id', Auth::user()->id)->first();
        $follow->delete();
        return $follow;
    }
}
