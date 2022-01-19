<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    function lx_forbidden (User $user){
        $tu = Auth::user();
        if ($tu->is_admin) return false;
        if($tu->id !== $user->id) return true;
        else return false;
    }

    function is_admin (){
        return Auth::user()->is_admin;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if($this->lx_forbidden($user)) return redirect()->route('home');
        $title = 'Редактирование данных.';
        if($this->is_admin()) return view('admin.profile', compact('user', 'title'));
        else return view('pages.profile', compact('user', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if($this->lx_forbidden($user)) return redirect()->route('home');
        $request->validate([
            'name' => 'required',
            'email' => "email|required|unique:users,email,{$user->id}",
            'avatar' => "mimetypes:image/*"
        ]);

        $r = $request->all();

        $avatar = $request->file('avatar') ?? null;

        if ($avatar){
            $path = $avatar->store(config('my.images_user'));
            $user->avatar = pathinfo($path, PATHINFO_BASENAME);
        }

        $address = $r['address'] ?? null;
        if($address){
            $a = $user->addresses->where('main',1);
            $main = $r['main'] ?? 0;
            if($a->isNotEmpty()){
                if($main) $a->first()->update(['main' => 0]);
            } else $main = 1;

            $user->addresses()->create(compact('address', 'main'));
        }

        $user->name = $r['name'];
        $user->email = $r['email'];
        $user->update();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($this->lx_forbidden($user)) return redirect()->route('home');
        //
    }
}
