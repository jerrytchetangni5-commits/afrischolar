<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword;

#[Fillable([
    'first_name',
    'last_name',
    'email',
    'password',
    'country',
    'role',
    'nationality',
    'birth_date',
    'gender',
    'study_level',
    'study_domain',
    'average',
    'languages',
    'english_level',
    'skills',
    'experiences',
    'interests'

])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /** @use HasFactory<UserFactory> */

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'languages' => 'array',
            'skills' => 'array',
            'experiences' => 'array',
            'interests' => 'array',
            'birth_date' => 'date',
            'average' => 'decimal:2'

        ];
    }

    public function sendPasswordResetNotification($token)
    {
        ResetPassword::createUrlUsing(function($user, string $token){
            $frontendUrl = env('FRONTEND_URL', 'http://localhost:4200');

            return "{$frontendUrl}/auth/reset-password?token={$token}&email=" .urlencode($user->email);
        });
        $this->notify(new ResetPassword($token));
    }
}
