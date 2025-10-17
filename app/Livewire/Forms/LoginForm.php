<?php

namespace App\Livewire\Forms;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\User;
use App\Enums\Status;
use App\Enums\UserRole;

class LoginForm extends Form
{
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    #[Validate('boolean')]
    public bool $remember = false;

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $user = User::where('email', $this->email)->first();

        if (! $user) {
            $this->failAuthentication(trans('auth.failed'));
        }

        if ($this->isAdmin($user)) {
            throw ValidationException::withMessages([
                'form.email' => trans('auth.failed')
            ]);
        }

        if (! $this->isVerified($user)) {
            $this->failAuthentication(__('Akun anda belum terverifikasi, mohon ditunggu.'));
        }

        if (! Auth::attempt($this->only(['email', 'password']), $this->remember)) {
            $this->failAuthentication(trans('auth.failed'));
        }

        RateLimiter::clear($this->throttleKey());
    }

    protected function isAdmin(User $user): bool
    {
        $role = $user->role;

        return $role instanceof UserRole
            ? $role->isAdmin()
            : $role === UserRole::Admin->value;
    }

    protected function isVerified(User $user): bool
    {
        $status = $user->status;

        return $status instanceof Status
            ? $status->isVerified()
            : $status === Status::Verified->value;
    }

    protected function failAuthentication(string $message): never
    {
        RateLimiter::hit($this->throttleKey());

        throw ValidationException::withMessages([
            'form.email' => $message,
        ]);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'form.email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}
