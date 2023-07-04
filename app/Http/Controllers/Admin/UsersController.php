<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
   
        $users =  User::all();
        // dd($users);
        return view(
            'admin.users.index',
            [
                'title' => 'Users Table',
                'users' => $users
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $users)
    {

        $use =User::find($users->id);
        dd($use);
        return view('admin.users.edit', [
            'user' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $users)
    {

        $data = $request->validated();
        $users->update($data);
        $users->update($request->validated());
        return redirect()->route('users.index')->with('success', "Product {$users->password} updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
