<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthenticateRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends BaseController
{
    /**
     * This action will be fired when the user tries to authenticate.
     *
     * @param AuthenticateRequest $request The request for authentication.
     *
     * @return JsonResponse The token in a JSON format.
     */
    public function authenticate(AuthenticateRequest $request)
    {

        $token = JWTAuth::attempt($this->getCredentials($request));

        if (!$token) {
            return $this->respondUnauthorized('Invalid credentials', 40101);
        }

        return $this->respond(compact('token'));
    }

    /**
     * Return the credential that are mandatory.
     *
     * @param  AuthenticateRequest $request The request for authentication.
     * @return Array The credentials.
     */
    public function getCredentials(AuthenticateRequest $request)
    {
        return [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
    }
}
