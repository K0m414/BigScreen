<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
// validate and create user
    public function register(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    "name" => "required",
                    "email" => "required|email|unique:users,email",
                    "password" => "required"
                ]
            );

            if ($validator->fails()) {
                return response()->json(
                    [
                        "status" => "401",
                        "errors" => $validator->errors()
                    ],
                    401
                );
            } else {

                $user = User::create([
                    "name" => $request->name,
                    "email" => $request->email,
                    "password" => Hash::make($request->password)
                ]);

                return response()->json(
                    [
                        "status" => "201",
                        "message" => "Utilisateur créé avec succès",
                        "token" => $user->createToken("AUTH_TOKEN")->plainTextToken

                    ],
                    201
                );
            }
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "status" => "500",
                    "message" => $th->getMessage()
                ],
                500
            );
        }
    }

    // admin login validate
    public function login(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    "email" => "required|email",
                    "password" => "required"
                ]
            );

            if ($validator->fails()) {
                return response()->json(
                    [
                        "status" => "401",
                        "errors" => $validator->errors()
                    ],
                    401
                );
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json(
                    [
                        "status" => "401",
                        "message" => "Adresse e-mail ou mot de passe incorrect"
                    ],
                    401
                );
            }


            $user = User::where('email', $request->email)->first();

            return response()->json(
                [
                    "status" => "201",
                    "message" => "Authentification reussie",
                    "token" => $user->createToken("AUTH_TOKEN")->plainTextToken
                ],
                201
            );
        } catch (\Throwable $th) {

            return response()->json(
                [
                    "status" => "500",
                    "message" => $th->getMessage()
                ],
                500
            );
        }
    }
}
