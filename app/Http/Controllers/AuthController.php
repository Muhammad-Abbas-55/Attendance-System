<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        // dd(request());
        return view('auth.register');
    }


    public function store()
    {
        // dd(request());
        $validated = request()->validate(
            [
                'name' => 'required|min:3|max:40',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:8'
            ]
        );
        User::create(
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'])
            ]
        );
        return redirect()->route('login')->with('success', 'Account created Sucessfully');
    }


    public function login()
    {
        return view('auth.login');
    }


    public function edit(User $user)
    {
        // if(auth()->id() !== $user->id){
        //     abort(404);
        // }        

        $editing = true;
        return view('auth.profile', compact('user', 'editing'));
    }


    public function update(Request $request, $id)
    {
        // if(auth()->id() !== $user->id){
        //     abort(404);
        // }

        $request->validate([
            'name' => 'required|min:3|max:40',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp',

        ]);

        $data = $request->all();

        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/';
            $file->move(public_path($path), $filename);
            $data['image'] = $filename;
        }

        $user =  User::find($id);
        $user->update($data);

        return back()->with('success', 'Profile Updated Successfully');
    }


    public function authenticate()
    {
        // dd(request());
        $validated = request()->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]
        );

        // dd($validated);
        auth()->attempt($validated);
        if (Auth::check())

            return redirect()->route('dashboard')->with('success', 'Login Sucessfully');

        // }


        return redirect()->route('login')->withErrors([
            'email' => "Provided emil or password is not matching"
        ]);
    }


    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logged out Sucessfully');
    }
}
