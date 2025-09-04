<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\UserLoginRequest;
use App\Http\Requests\Api\V1\UserRegisterRequest;
use App\Http\Resources\Api\V1\LoginResource;
use App\RestFullApi\Facade\ApiResponse;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    protected UserService $userService;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(UserLoginRequest $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];

        if($token = JWTAuth::attempt($credentials)) {

            $user=$this->userService->getUserById(auth()->user()->id);
            $user->touch();
            $user->token = $token;

            return LoginResource::make($user);
        }

        return ApiResponse::withMessage('The username or password is incorrect.')
            ->withStatus(Response::HTTP_UNAUTHORIZED)
            ->Builder();
    }

    public function register(UserRegisterRequest $request)
    {
        $user=$this->userService->createUser($request->validated());

        return LoginResource::make($user);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return ApiResponse::withMessage('Successfully logged out')->withStatus(Response::HTTP_OK)->Builder();
    }
}
