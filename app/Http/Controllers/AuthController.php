<?php

namespace App\Http\Controllers;

use App\Enums\AppError;
use App\Events\AlumniRegistered;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\PasswordReset;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

use DB;

use App\Models\Alumni;
use App\Enums\Status;
use Str;
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'forgotPassword', 'resetPassword', 'refresh']]);
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:alumni,email',
                'nim' => 'required|string|unique:alumni,nim|regex:/^\d{8,10}$/',
                'password' => 'required|string|min:8',
            ]);
            event(new AlumniRegistered(
                Alumni::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'nim' => $request->nim,
                    'password' => Hash::make($request->password),
                    'status' => Status::PENDING
                ])
            ));
            return response()->json([
                'success' => true
            ], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000' || (isset($e->errorInfo[1]) && $e->errorInfo[1] === 1062)) {
                return response()->json([
                    'success' => false,
                    'error' => [
                        'type' => AppError::EMAIL_ALREADY_REGISTERED->value,
                    ]
                ], 409);
            }
            \Log::error('Database error during registration', ['exception' => $e]);
            return response()->json([
                'success' => false,
                'error' => [
                    'type' => AppError::INTERNAL_SERVER_ERROR->value,
                ]
            ], 500);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => [
                    'type' => AppError::VALIDATION_EXCEPTION->value,
                    'details' => $e->errors()
                ]
            ], 422);
        } catch (\Exception $th) {
             \Log::error('Unexpected error during registration', ['exception' => $th]);
            return response()->json([
                'success' => false,
                'error' => [
                    'type' => AppError::UNKNOWN_ERROR->value,
                ]
            ], 500);
        }
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:8'
            ]);

            /** @var \PHPOpenSourceSaver\JWTAuth\JWTAuth $auth */
            $auth = auth();

            if (!$token = $auth->guard('api')->attempt(request(['email', 'password']))) {

                return response()->json([
                    'success' => false,
                    'error' => [
                        'type' => AppError::INVALID_CREDENTIALS->value,
                    ]
                ], 401);
            }

            if (!$auth->guard('api')->user()->status->isVerified()) {
                $auth->logout();
                return response()->json([
                    'success' => false,
                    'error' => [
                        'type' => AppError::USER_NOT_VERIFIED->value,
                    ]
                ], 403);
            }

            return $this->respondWithToken($token);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => [
                    'type' => 'dinowd',
                ]
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Login error: ' . $e->getMessage(), [
                'exception' => $e->getMessage(),
                'email' => $request->email
            ]);
            return response()->json([
                'success' => false,
                'error' => [
                    'type' => $e->getMessage(),
                ]
            ], 500);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        /** @var \PHPOpenSourceSaver\JWTAuth\JWTAuth $auth */
        $auth = auth();
        $auth->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function forgotPassword(Request $request, AppError $error = AppError::SERVER_ERROR)
    {
        try {
            $request->validate(['email' => 'required|email']);

            $status = Password::broker('alumni')->sendResetLink($request->only('email'), function (CanResetPassword $user, string $token) use (&$error) {
                if (
                    DB::table('password_reset_tokens')
                        ->where('email', $user->email)
                        ->where('created_at', '>', now()->subHour())
                        ->count() === 3
                ) {
                    $error = AppError::RESET_ATTEMPTS_EXCEEDED->value;
                    return false;
                } else if (!$user->status->isVerified()) {
                    $error = AppError::USER_NOT_VERIFIED->value;
                    return false;
                }
                $user->sendPasswordResetNotification($token);
            });

            switch ($status) {
                case Password::RESET_LINK_SENT:
                    return response()->json([
                        'success' => true,
                    ], 200);

                case Password::INVALID_USER:
                    return response()->json([
                        'success' => false,
                        'error' => [
                            'type' => Password::INVALID_USER,
                        ],
                    ], 404);

                case Password::RESET_THROTTLED:
                    return response()->json([
                        'success' => false,
                        'error' => [
                            'type' => Password::RESET_THROTTLED,
                        ]
                    ], 429);

                case Password::INVALID_TOKEN:
                    return response()->json([
                        'success' => false,
                        'error' => [
                            'type' => Password::INVALID_TOKEN,
                        ],
                    ], 404);

                default:
                    if ($error === AppError::USER_NOT_VERIFIED) {
                        return response()->json([
                            'success' => false,
                            'error' => [
                                'type' => AppError::USER_NOT_VERIFIED->value,
                            ]
                        ], 403);
                    } else if ($error === AppError::RESET_ATTEMPTS_EXCEEDED) {
                        return response()->json([
                            'success' => false,
                            'error' => [
                                'type' => AppError::RESET_ATTEMPTS_EXCEEDED->value,
                            ]
                        ], 429);
                    }
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => [
                    'type' => AppError::VALIDATION_EXCEPTION->value,
                    'message' => $e->getMessage()
                ]
            ], 422);

        } catch (\Exception $e) {
            \Log::error('Forgot password error: ' . $e->getMessage(), [
                'exception' => $e,
                'email' => $request->email
            ]);

            return response()->json([
                'success' => false,
                'error' => [
                    'type' => AppError::INTERNAL_SERVER_ERROR->value,
                ]
            ], 500);
        }

        return response()->json([
            'success' => false,
            'error' => [
                'type' => $error->value,
            ]
        ], 422);
    }

    public function resetPassword(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',

            ]);

            $status = Password::broker('alumni')->reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function (Alumni $user, string $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));
                    $user->save();
                    event(new PasswordReset($user));
                }
            );

            switch ($status) {
                case Password::RESET_LINK_SENT:
                    return response()->json([
                        'success' => true,
                        'message' => 'Password berhasil direset. Silakan login dengan password baru Anda.'
                    ], 200);

                case Password::INVALID_USER:
                    return response()->json([
                        'success' => false,
                        'error' => [
                            'type' => Password::INVALID_USER,
                        ],
                    ], 404);

                case Password::RESET_THROTTLED:
                    return response()->json([
                        'success' => false,
                        'error' => [
                            'type' => Password::RESET_THROTTLED,
                        ]
                    ], 429);

                case Password::INVALID_TOKEN:
                    return response()->json([
                        'success' => false,
                        'error' => [
                            'type' => Password::INVALID_TOKEN,
                        ],
                    ], 404);

                default:
                    return response()->json([
                        'success' => false,
                        'error' => [
                            'type' => AppError::INTERNAL_SERVER_ERROR->value,
                        ]
                    ], 403);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => [
                    'type' => AppError::INTERNAL_SERVER_ERROR->value,
                    'details' => $e->errors()
                ]
            ], 422);

        } catch (\Exception $e) {
            \Log::error('Reset password error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'error' => [
                    'type' => AppError::INTERNAL_SERVER_ERROR->value,
                ]
            ], 500);
        }

    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        try {
            // Get the token from the request header
            $token = JWTAuth::parseToken()->refresh();

            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->guard('api')->factory()->getTTL() * 60
            ]);
        } catch (\PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['error' => 'Token has expired and cannot be refreshed'], 401);
        } catch (\PHPOpenSourceSaver\JWTAuth\Exceptions\TokenBlacklistedException $e) {
            return response()->json(['error' => 'Token has been blacklisted'], 401);
        } catch (\PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Token is invalid or missing'], 401);
        }
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
           /** @var \PHPOpenSourceSaver\JWTAuth\JWTAuth $auth */
        $auth = auth();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $auth->guard('api')->factory()->getTTL() * 60,
            'authUserState' => [
                'name' => $auth->guard('api')->user()->name,
                'email' => $auth->guard('api')->user()->email
            ]
        ]);
    }
}
