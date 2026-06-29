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
