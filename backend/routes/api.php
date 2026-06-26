<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\AuthController;

Route::get('/scholarships', [ScholarshipController::class, 'index']);
Route::get('/scholarships/search', [ScholarshipController::class, 'search']);
Route::get('/scholarships/{id}', [ScholarshipController::class, 'show']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);



Route::get('/debug-token/{email}', function ($email) {
    $user = User::where('email', $email)->first();
    if (!$user) {
        return response()->json(['error' => 'Utilisateur non trouvé'], 404);
    }
    
    // Générer un token brut
    $token = Password::createToken($user);
    
    // Le sauvegarder en base (hashé) pour que le reset fonctionne
    \Illuminate\Support\Facades\DB::table('password_reset_tokens')->updateOrInsert(
        ['email' => $email],
        ['token' => Hash::make($token), 'created_at' => now()]
    );
    
    return response()->json([
        'message' => 'Token généré ! Copie-le vite.',
        'email' => $email,
        'brut_token' => $token  // 👈 Voici le token à copier !
    ]);
});