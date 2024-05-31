<?php

namespace App\Http\Controllers\Oreho;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (!$user || $user->is_admin != 1) abort(404, 'This page not found! ');
        $users = User::query()->paginate(2);
        // dd($users);
        return view('oreho.users.index', ['title' => 'List users'], compact('users'));
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $userAuth = auth()->user();
        if ($userAuth->is_admin != 1) abort(404, 'This page not found! ');
        $user = User::find($id);
        if ($user === null) abort(404, 'This page not found! ');
        return view('oreho.users.edit', ['name' => 'user', 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'avatar' => 'image',
        ]);
        $user = User::find($id);

        $data = $request->all();

        // $data['avatar'] = User::uploadImage($request, $user->avatar);
        // if (!empty($user->avatar)) Storage::delete($user->avatar);
        if ($request->hasFile('avatar')) {
            $folder = date('Y-m-d');
            $data['avatar'] = $request->file('avatar')->store("images/{$folder}");
        }

        $user->update($data);
        return redirect('/oreho/users')->with('success', "Данные user успешно изменены !");
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        Storage::delete($user->avatar);
        $user->delete();
        return redirect('/oreho/users')->with('success', "User delete successfully!");
    }
}
