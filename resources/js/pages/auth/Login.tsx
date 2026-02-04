import React from "react"
import { useCallback } from "react"
import { Navigate, useNavigate } from 'react-router-dom';
import axios from 'axios'
import useSignIn from 'react-auth-kit/hooks/useSignIn';
import { useForm, SubmitHandler } from "react-hook-form";
import { Input } from "../../components/forms/Input";
import { Label } from "../../components/forms/Label";
import Button from "../../components/Button";
import { AuthenticationError } from "../../enums";

interface LoginForm {
    email: string,
    password: string,
    rememberMe: boolean,
};

enum LoginError {
    USER_NOT_VERIFIED = 'USER_NOT_VERIFIED',
    UNAUTHORIZED_ACCESS = 'UNAUTHORIZED_ACCESS',
    INVALID_CREDENTIALS = 'INVALID_CREDENTIALS'
}

export const LoginErrorMessage = ({ type }: { type: string }) => {
  return (
    <div
      className={`p-4 text-sm font-medium border-[0.3px] bg-opacity-50 ${
        type === AuthenticationError.USER_NOT_VERIFIED
          ? 'text-primary-green-600 border-primary-green-400 bg-primary-green-200'
          : 'text-red-500 border-red-400 bg-red-200'
      }`}
    >
      {type === AuthenticationError.USER_NOT_VERIFIED
        ? 'Akun Anda saat ini sedang dalam proses verifikasi. Mohon menunggu hingga akun Anda aktif.'
        : type === AuthenticationError.UNAUTHORIZED_ACCESS
        ? 'Akses tidak diizinkan. Silakan hubungi kami.'
        : type === AuthenticationError.INVALID_CREDENTIALS
        ? 'Email atau password yang Anda masukkan salah.'
        : 'Terjadi kesalahan yang tidak diketahui.'}
    </div>
  );
};

export const Login = () => {
    const navigate = useNavigate();
    const login = useSignIn();
    const { register, handleSubmit, setError, formState: { errors } } = useForm<LoginForm>()

    const onSubmit: SubmitHandler<LoginForm> = (data) => {
        axios.post('/api/auth/login', data)
            .then((res) => {
                if (res.status === 200) {
                    if (login({
                        auth: {
                            token: res.data.access_token,
                            type: 'Bearer',
                        },
                        userState: res.data.authUserState,
                        refresh: res.data.access_token,
                        expiresIn: Math.floor(res.data.expires_in / 60), // Convert seconds to minutes
                        refreshExpiresIn: 60 // 60 minutes refresh window
                    })) {
                        console.log(res.data.access_token)
                        navigate('/')
                    } else {

                    }
                } else {


                }
            }).catch((error) => {
                console.log(error)
                const { type, message } = error.response.data.error;

                setError('root.serverError', {
                    type: typeof type === 'string' ? type : 'unknown',
                    message: message ?? 'An unexpected error occured'
                });
            });
    }
    // const onSubmit = useCallback((e: Event) => {
    //     e.preventDefault();

    // }, []);
    return (
        <div className="max-w-md h-screen w-full mx-auto bg-white">
            <div className="border-b-gray-200 border-b-[0.3px] w-full flex justify-center p-6">
                <img src="/images/drm.webp" alt="" className="w-20 h-full" />
            </div>
            <div className="p-6 space-y-4">
                <h1 className="font-sora text-2xl font-semibold">Login</h1>
                <form onSubmit={handleSubmit(onSubmit)} className="space-y-4">
                    <div className="space-y-2">
                        <Label>Email</Label>
                        <Input {...register('email', {
                            required: 'Email wajib diisi',
                            pattern: {
                                value: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
                                message: 'Format email tidak valid',
                            },
                        })} className="w-full m-0" />
                        {errors.email && (
                            <ul className="text-sm text-red-600 mt-1">
                                {errors.email.message as string}
                            </ul>
                        )}

                    </div>
                    <div className="space-y-2">
                        <Label>Password</Label>
                        <Input {...register('password', {
                            required: 'Kata sandi wajib diisi',
                            minLength: {
                                value: 8,
                                message: 'Kata sandi minimal harus 8 karakter',
                            },
                        })} className="w-full m-0" type="password" />
                        {errors.password && (
                            <ul className="text-sm text-red-600 mt-1">
                                {errors.password.message as string}
                            </ul>
                        )}
                    </div>
                    <div className="flex justify-between">
                        <div className="flex items-center space-x-2">
                            <Input {...register('rememberMe')} type="checkbox" className="border-gray-300 text-primary-green-500 focus:ring-primary-green-500" />
                            <span className="text-sm text-gray-600">Remember me</span>
                        </div>
                        <a className="underline text-smp" href="/lupa-password">Lupa Password?</a>
                    </div>
                    {errors.root?.serverError && <LoginErrorMessage type={errors.root.serverError.type as string} />}

                    <Button variant="primary" className="w-full px-5 py-2.5 gap-2" type="submit">
                        <span className="text-smp text-white">Masuk</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 15 15"><path fill="#ffffff" d="M8.293 2.293a1 1 0 0 1 1.414 0l4.5 4.5a1 1 0 0 1 0 1.414l-4.5 4.5a1 1 0 0 1-1.414-1.414L11 8.5H1.5a1 1 0 0 1 0-2H11L8.293 3.707a1 1 0 0 1 0-1.414Z" /></svg>
                    </Button>
                    <div className="text-sm text-center">
                        <p>Belum punya akun? <a href="/daftar" className="text-primary-green-800 tracking-tight hover:underline">Daftar</a></p>
                    </div>
                </form>
            </div>
        </div>
    )
}

export default Login;
