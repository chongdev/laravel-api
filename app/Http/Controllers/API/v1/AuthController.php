<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client as OClient;

class AuthController extends Controller
{
    private $successStatus = 200;

    public function login(Request $request)
    {
        $credentials  = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            // 'remember_me' => 'boolean'
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = $request->user();

        // // Creating a token with scopes...
        $scopes = ['place-orders'];
        $tokenResult = $user->createToken('Personal Access Token');
        // $accessToken = $user->createToken('My Token', $scopes)->accessToken;
        $token = $tokenResult->token;

        // $token->expires_at = Carbon::now()->addWeeks(1);
        $token->expires_at = Carbon::now()->addDays(15);
        //$token->scopes($scopes);
        $token->save();
        // $accessToken = Auth::user()->createToken('authToken')->accessToken();

        // $oClient = OClient::where('password_client', 1)->first();
        // return $this->getTokenAndRefreshToken($oClient, request('email'), request('password'));

        return response()->json([
            // 'user' => Auth::user(), 
            'token_type' => 'Bearer',
            'access_token' => $tokenResult->accessToken, 
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
        ], 200);
    }

    public function signup(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|confirmed'
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->save();

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function logout(Request $request){
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function user(Request $request){
        return response()->json($request->user());
    }

    private function getTokenAndRefreshToken(OClient $oClient, $email, $password) { 
        $oClient = OClient::where('password_client', 1)->first();
        $http = new Client;
        $response = $http->request('POST', 'http://mylemp-nginx/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $oClient->id,
                'client_secret' => $oClient->secret,
                'username' => $email,
                'password' => $password,
                'scope' => '*',
            ],
        ]);
        $result = json_decode((string) $response->getBody(), true);
        return response()->json($result, $this->successStatus);
    }
}
