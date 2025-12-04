<?php

namespace App\Http\Controllers;

use App\Enums\Enum\AuthError;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\PasswordReset;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

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
        $this->middleware('auth:api', ['except' => ['login', 'register', 'forgotPassword']]);
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
            event(new Registered(
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
        } catch (\Throwable $th) {
            \Log::error('User registration failed', ['exception' => $th]);
            if ($th instanceof \Illuminate\Database\QueryException) {
                return response()->json([
                    'success' => false,
                    'error' => [
                        'type' => 'DUPLICATE_ENTRY',
                        'message' => $th
                    ]
                ], 409);
            }
            return response()->json([
                'success' => false,
                'error' => [
                    'type' => 'SERVER_ERROR',
                    'message' => 'Gagal membuat akun. Silakan coba lagi.' . $th
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
                'email' => 'required',
                'password' => 'required'
            ]);

            /** @var \PHPOpenSourceSaver\JWTAuth\JWTAuth $auth */
            $auth = auth()->guard('api');
            if (!$token = $auth->attempt(request(['email', 'password']))) {
                return response()->json([
                    'success' => false,
                    'error' => [
                        'type' => AuthError::INVALID_CREDENTIALS->value,
                        'message' => 'The provided email or password is incorrect.'
                    ]
                ], 401);
            }
            /** @var Alumni $auth->user() */
            if (!$auth->user()->status->isVerified()) {
                $auth->logout();
                return response()->json([
                    'success' => false,
                    'error' => [
                        'type' => 'USER_NOT_VERIFIED',
                        'message' => 'User is not verified',
                    ]
                ], 405);
            }

            if ($request->boolean('remember_me', false)) {
                $auth->setTTL(120);
            }
            return $this->respondWithToken($token);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => [
                    'type' => 'VALIDATION_ERROR',
                    'message' => 'Please check your input.',
                ]
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Login error: ' . $e->getMessage(), [
                'exception' => $e,
                'email' => $request->email
            ]);
            return response()->json([
                'success' => false,
                'error' => [
                    'type' => AuthError::SERVER_ERROR->name,
                    'message' => 'An unexpected error occurred. Please try again later.'
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
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function forgotPassword(Request $request, AuthError $error = AuthError::SERVER_ERROR)
    {
        try {
            $request->validate(['email' => 'required|email']);

            $status = Password::sendResetLink($request->only('email'), function ($user) use (&$error) {
                if (
                    PasswordReset::where('email', $user->email)
                        ->where('created_at', '>', now()->subHours(1))
                        ->count() >= 3
                ) {
                    $error = AuthError::SERVER_ERROR->name;
                    return false;
                } else if (!$user->status->isVerified()) {
                    $error = AuthError::USER_NOT_VERIFIED->name;
                    return false;
                }
                return true;
            });

            return $status === Password::RESET_LINK_SENT
                ? response()->json([
                    'success' => true,
                    'message' => 'Link reset password telah dikirim ke email Anda. Silakan cek inbox atau folder spam.'
                ], 200)
                : response()->json([
                    'success' => false,
                    'error' => [
                        'type' => $error,
                    ]
                ], $error === AuthError::USER_NOT_VERIFIED->name ? 403 : 404);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => [
                    'type' => AuthError::VALIDATION_ERROR->name,
                    'message' => 'Format email tidak valid.',
                    'details' => $e->errors()
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
                    'type' => AuthError::SERVER_ERROR->name,
                    'message' => 'Terjadi kesalahan pada sistem. Silakan coba lagi nanti.'
                ]
            ], 500);
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',

            ]);

            $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
           function (Alumni $user, string $password) {
                        $user->forceFill([
                            'password' => Hash::make($password)
                        ])->setRememberToken(Str::random(60));
                        $user->save();
                        event(new PasswordReset($user));
                    }
            );

            return $status === Password::PasswordReset ?
            response()->json([
                'success' => true,
                'message' => 'Password berhasil direset. Silakan login dengan password baru Anda.'
            ], 200)
            :
            response()->json([
                'success' => false,
                'error' => [
                'type' => 'RESET_FAILED',
                'message' => $this->getResetErrorMessage($status)
            ]], 400);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => [
                    'type' => 'VALIDATION_ERROR',
                    'message' => 'Data tidak valid.',
                    'details' => $e->errors()
                ]
            ], 422);

        } catch (\Exception $e) {
            \Log::error('Reset password error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'error' => [
                    'type' => 'SERVER_ERROR',
                    'message' => 'Terjadi kesalahan pada sistem.'
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
        return $this->respondWithToken(auth()->refresh());
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
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
