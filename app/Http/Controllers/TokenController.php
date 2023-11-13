<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TokenController extends Controller
{
    /*
    *Generate Token person access
    */
    public function generateToken(User $user)
    {
        $token = $user->createToken('token-streamingapp');

        //Update field with data token
        $user->remember_token = $token->plainTextToken;
        $user->save();

        //Redirect or show with message exist
        return redirect()->route('users.show', $user->id)->with('success', 'Token generated and save succesfull');
    }
}
