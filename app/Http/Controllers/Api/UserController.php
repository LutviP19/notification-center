<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\RefreshTokenRepository;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $status = 200;
            $user = Auth::user();
            $response = [
                'user' => [
                        'id' => Helpers::encrypt_decrypt_js('encrypt', $user->id),
                        'name' => $user->name,
                        'email' => Helpers::encrypt_decrypt_js('encrypt', $user->email),
                        'google_id' => $user->google_id ?: Helpers::encrypt_decrypt_js('encrypt', $user->google_id),
                ],
                'token' => $user->createToken('userToken')->accessToken,
            ];
        }else{
            $status = 401;
            $response = ['error' => true, 'error_msg' => 'The email or password is incorrect.'];
        }

        return response()->json($response, $status);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:25',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            //return response()->json(['errors' => $validator->errors()], 401);
            return response()->json([
                'error' => true,
                'error_msg' => $validator->errors()
            ], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $response = [
                'user' => [
                        'id' => Helpers::encrypt_decrypt_js('encrypt', $user->id),
                        'name' => $user->name,
                        'email' => Helpers::encrypt_decrypt_js('encrypt', $user->email),
                        'google_id' => $user->google_id ?: Helpers::encrypt_decrypt_js('encrypt', $user->google_id),
                ],
                'token' => $user->createToken('userToken')->accessToken,
            ];

        return response()->json($response, 200);
    }

    public function show(User $user)
    {
        return response()->json($user,200);
    }

    public function getUser()
    {
        return response()->json(auth()->user(), 200);
    }

    public function logout()
    {
        $token = auth()->user()->token();

        $token->revoke();
        $token->delete();

        $refreshTokenRepository = app(RefreshTokenRepository::class);
        $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($token->id);

        return response()->json(['message' => 'Logged out successfully']);
    }

    public function loginGrant(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'data' => [$validator->errors()]
            ], 400);
        }

        $data = [
            'username' => $request->email,
            'password' => $request->password,
            'client_id' => config('passport.password_grant_client.id'),
            'client_secret' => config('passport.password_grant_client.secret'),
            'grant_type' => 'password'
        ];
        $request = Request::create('/oauth/token', 'POST', $data);
        $content = json_decode(app()->handle($request)->getContent());

        return response()->json([
            'error' => isset($content->error) ? true : false,
            'data' => [ $content ]
        ], 200);
    }

    public function refreshToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'refresh_token' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'data' => [$validator->errors()]
            ], 400);
        }

        $data = [
            'refresh_token' => $request->refresh_token,
            'client_id' => config('passport.password_grant_client.id'),
            'client_secret' => config('passport.password_grant_client.secret'),
            'grant_type' => 'refresh_token'
        ];
        $request = Request::create('/oauth/token', 'POST', $data);
        $content = json_decode(app()->handle($request)->getContent());

        return response()->json([
            'error' => isset($content->error) ? true : false,
            'data' => [ $content ]
        ], 200);
    }
}
