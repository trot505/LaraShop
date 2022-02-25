<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    function __construct(){
        //проверка кто имеет права доступа
        $this->middleware('user_forbidden');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $title = 'Редактирование данных.';
        if(Auth::user()->is_admin) return view('admin.profile', compact('user', 'title'));
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

        $request->validate([
            'name' => 'required',
            'email' => "email|required|unique:users,email,{$user->id}",
            'avatar' => "mimetypes:image/*",
            'address' => "sometimes|nullable|string",
            'main' => "sometimes|accepted",
            'password' => 'nullable|string|min:8|confirmed|required_with:current_password',
            'current_password' => 'current_password|nullable|'
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
            $main = $request->boolean('main');
            if($a->isNotEmpty()){
                if($main) $a->first()->update(['main' => 0]);
            } else $main = 1;

            $user->addresses()->create(compact('address', 'main'));
        }

        if($r['password']){
            $user->password = Hash::make($r['password']);
        }

        $user->name = $r['name'];
        $user->email = $r['email'];
        $user->update();

        session()->flash('successAnswer', 'Данные успешно сохранены.');
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
        $user->delete();
        return back();
    }

    private function checkPassword(string $pas, User $user){
        return Hash::check($pas, $user->password);
    }
}
