<?php

namespace App\Http\Controllers;

use App\Singer;
use App\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PersonalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('personal');
    }

    public function toModifyAccount()
    {
        return view('modifyAccount');
    }

    public function modifyAccount(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $oldAvatarUrl = $user->avatar_url;
        $avatarUrl = time() . '.' . $request->file('avatar')->getClientOriginalExtension();
        $user->avatar_url = $avatarUrl;
        if ($user->save()) {
            $uploadImg = $request->file('avatar');
            $image = Image::make($uploadImg);
            $image->resize(100,100);
            if($oldAvatarUrl !== 'default.png'){
                Storage::delete('avatar/'.$oldAvatarUrl);
            }
            Storage::put('avatar/'.$avatarUrl, $image->stream());
            return view('personal');
        }
    }

    public function toResetPassword()
    {
        return view('resetPassword');
    }

    public function resetPassword(Request $request)
    {
        $psd = Auth::user()->password;
        $oldPsd = $request->oldPsd;
        $newPsd = $request->newPsd;
        if(Hash::check($oldPsd, $psd))
        {
            $this->validate($request, [
                'newPsd' => 'min:6'
            ]);
            if($request->password_confirmation != $newPsd){
                return back()->withErrors(['passwords not match!']);
            }
            Auth::user()->password = bcrypt($newPsd);
            Auth::user()->save();
            Auth::logout();
            return redirect()->route('login');
        }
        else
        {
            return back()->withErrors(['password does not match credentials!']);
        }
    }

    public function getAccountImg($avatar_url)
    {
        $file = Storage::get('avatar/' . $avatar_url);
        return new Response($file, 200);
    }
}
