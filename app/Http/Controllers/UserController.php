<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function edit(){
        if (Auth::user()){
            $user = User::find(Auth::user()->id);

            if ($user){
                return view("user.edit")->withUser($user);
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }

    public function update(Request $request){
        $user = User::find(Auth::user()->id);
        if($user){
            $validate = null;
            if (Auth::user()->email === $request["email"]){
                $validate=$request->validate([
                    "name"=>'required|min:3',
                    "email"=>'required|email'
                ]);
            }
            $validate=$request->validate([
                "name"=>'required|min:3',
                "email"=>'required|email|unique:users,email,'.$user->id,
            ]);
            if($validate){
                $user->name = $request["name"];
                $user->email = $request["email"];
                $user->save();
                $request->session()->flash("success","Your profile have been updated!");
                return redirect()->back();
            }   else{
                return redirect()->back();
            }
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }

    public function passwordUpdate(Request $request){
        $validate=$request->validate([
            "oldPassword"=>'required|min:8',
            "password"=>'required|min:8|required_with:password_confirmation'
        ]);
        $user=User::find(Auth::user()->id);
        if($user){
            if(Hash::check($request['oldPassword'], $user->password) && $validate){
                $password = $request->password;
                $user->password=\Hash::make($password);
                $user->update();
                $user->save();
                $request->session()->flash('success','Your password have been updated!');
                return redirect()->back();
            }else {
                $request->session()->flash('error','Password does not match your current password');
                return redirect()->route('password.edit');
            }
        }
    }


    public function passwordEdit(){
        if (Auth::user()){
            return view("user.password");
        }else{
            return redirect()->back();
        }
    }

    public function profile(){
        $user=User::find(auth()->user()->id);
        if($user){
            return view("user.profile")->withUser($user);

        }else{
            return redirect()->back();
        }
    }
}
