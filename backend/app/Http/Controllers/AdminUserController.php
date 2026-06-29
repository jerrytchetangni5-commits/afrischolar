<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserController extends Controller
{
    //Liste des users
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return response->json([
            'success' => true,
            'data' => $users
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'country' => 'nullable|string,max:100',
            'role' => 'required|in:admin,student'
        ]);

        $user = User::create([
            'first_name' => $request->first_name,          
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'country' => $request->country,
            'role' => $request->role
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Utilisateur enregistrer'
        ]);
    }
    
    public function show($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id){

    }
}
