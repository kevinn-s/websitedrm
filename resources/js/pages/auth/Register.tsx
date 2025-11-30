import React from "react"
import { useCallback } from "react"
import axios from 'axios'
import { useMutation } from '@tanstack/react-query';
import useSignIn from 'react-auth-kit/hooks/useSignIn';
import { useForm, SubmitHandler } from "react-hook-form";
import { Input } from "../../components/forms/Input";
import Label from "../../components/forms/Label";
import Button from "../../components/Button";

enum ForgotPasswordError {
    DUPLICATE_USER = 'DUPLICATE_USER',
    SERVER_ERROR = 'SERVER_ERROR'
}

interface RegisterForm {
    name: string
    email: string,
    nim: string,
    password: string,
    confirmPassword: string
};

const RegisterSuccessMessage = () => {
    return (
        <div className="space-y-4">
            <div className="space-y-2 text-center">
                <h1 className="font-sora text-2xl font-semibold">Terima Kasih!</h1>
                <p className="text-sm text-gray-600">
                    Pendaftaran Anda telah berhasil.
                </p>
            </div>

            <div className="p-4 text-xm text-gray-800 bg-primary-green-400 bg-opacity-50">
                Akun Anda akan divalidasi terlebih dahulu sebelum dapat digunakan. Proses validasi biasanya memakan
                waktu 1-3 hari kerja.
                <p className="pt-1">Silakan cek email Anda untuk informasi lebih lanjut.</p>
            </div>

            <div className="space-y-3">
                <a href="/masuk" className="block">
                    <Button variant="primary" className="w-full px-5 py-2.5 gap-2">
                        <div className="flex items-center justify-center gap-2">
                            <span className="text-base">Ke Halaman Masuk</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 15 15">
                                <path fill="#ffffff"
                                    d="M8.293 2.293a1 1 0 0 1 1.414 0l4.5 4.5a1 1 0 0 1 0 1.414l-4.5 4.5a1 1 0 0 1-1.414-1.414L11 8.5H1.5a1 1 0 0 1 0-2H11L8.293 3.707a1 1 0 0 1 0-1.414Z" />
                            </svg>
                        </div>
                    </Button>
                </a>
                <a href="/" className="block">
                    <button type="button"
                        className="w-full border border-primary-green-600 text-primary-green-600 px-4 py-3 font-semibold hover:bg-primary-green-50 transition">
                        Kembali ke Beranda
                    </button>
                </a>
            </div>
        </div>
    )
}
export const Register = () => {
    const login = useSignIn();
    const {
        register,
        handleSubmit,
        setError,
        clearErrors,
        getValues,
        formState: { errors, isSubmitting }
    } = useForm<RegisterForm>({
        criteriaMode: 'all'
    });


    const mutation = useMutation<{
        success: boolean;
        message?: string; error?: {
            type: string;
            message: string;
        };
        token?: string, refreshToken?: string, authUserState?: string
    }, unknown, RegisterForm>({
        mutationFn: async (formData) => {
            const { confirmPassword, ...data } = formData;
            const res = await axios.post('/api/auth/register', data);
            return res.data;
        }
    });

    const onSubmit: SubmitHandler<RegisterForm> = (formData) => {
        clearErrors();
        mutation.mutate(formData, {
            onSuccess: (data) => {
                if (data.success) {
                    return true;
                } else if (data.error) {
                    setError('root.serverError', {
                        type: data.error.type,
                    });
                }
            },
            onError: (error) => {
                if (axios.isAxiosError(error) && error.response?.data?.error?.type) {
                    setError('root.serverError', {
                        type: error.response.data.error.type,
                        message: error.response.data.error.message ?? ''
                    });
                } else {
                    setError('root.serverError', {
                        type: ForgotPasswordError.SERVER_ERROR,
                        message: 'Terjadi kesalahan sistem. Silakan coba lagi.'
                    });
                }
            }
        });
    }

    return (
        <>
            <div className="max-w-md my-auto h-full w-full mx-auto bg-white">
                {
                    mutation.isSuccess && mutation.data?.success ?
                    <RegisterSuccessMessage />
                    :
                    <>
                        <div className="border-b-gray-200 border-b-[0.3px] w-full flex justify-center p-6">
                                <img src="/images/drm.webp" alt="" className="w-20 h-full" />
                        </div>
                        <div className="p-6 space-y-4">
                                <h1 className="font-sora text-2xl font-semibold">Daftar</h1>
                                <p className="text-sm text-gray-600">
                                    Lengkapi formulir ini untuk mendaftar. Akun Anda akan divalidasi terlebih dahulu sebelum dapat
                                    digunakan.
                                </p>
                                <form onSubmit={handleSubmit(onSubmit)} className="space-y-2 text-smp">
                                    <div className="space-y-2">
                                        <Label>Nama Lengkap</Label>
                                        <Input  {...register('name', {
                                            required: 'Nama wajib diisi'
                                        })} className="w-full m-0" disabled={isSubmitting} />
                                        {errors.name && (
                                            <ul className="text-sm text-red-600 mt-1">
                                                {errors.name.message as string}
                                            </ul>
                                        )}
                                    </div>
                                    <div className="space-y-2">
                                        <Label>Email</Label>
                                        <Input {...register('email', {
                                            required: 'Email wajib diisi',
                                            pattern: {
                                                value: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
                                                message: 'Format email tidak valid',
                                            },
                                        })} className="w-full m-0" disabled={isSubmitting} />
                                        {errors.email && (
                                            <ul className="text-sm text-red-600 mt-1">
                                                {errors.email.message as string}
                                            </ul>
                                        )}

                                    </div>
                                    <div className="space-y-2">
                                        <Label>NIM</Label>
                                        <Input {...register('nim', {
                                            required: 'NIM wajib diisi',
                                            pattern: {
                                                value: /^\d{9,}$/,
                                                message: 'NIM harus berisi 9 digit angka'
                                            }
                                        })} className="w-full m-0" disabled={isSubmitting} />
                                        {errors.nim && (
                                            <ul className="text-sm text-red-600 mt-1">
                                                {errors.nim.message as string}
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
                                        })} className="w-full m-0" type="password" disabled={isSubmitting} />
                                        {errors.password && (
                                            <ul className="text-sm text-red-600 mt-1">
                                                {errors.password.message as string}
                                            </ul>
                                        )}
                                    </div>
                                    <div className="space-y-2">
                                        <Label>Konfirmasi Password</Label>
                                        <Input {...register('confirmPassword', {
                                            required: 'Konfirmasi password wajib diisi',
                                            validate: (value) =>
                                                value === getValues('password') || 'Password tidak cocok'
                                        })} className="w-full m-0" type="password" disabled={isSubmitting} />
                                        {errors.confirmPassword && (
                                            <ul className="text-sm text-red-600 mt-1">
                                                {errors.confirmPassword.message as string}
                                            </ul>
                                        )}
                                    </div>
                                    <div className="space-y-4">
                                        <Button variant="primary" className="w-full px-5 py-2.5 gap-2" type="submit">
                                            <span className="text-smp text-white">Daftar</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 15 15"><path fill="#ffffff" d="M8.293 2.293a1 1 0 0 1 1.414 0l4.5 4.5a1 1 0 0 1 0 1.414l-4.5 4.5a1 1 0 0 1-1.414-1.414L11 8.5H1.5a1 1 0 0 1 0-2H11L8.293 3.707a1 1 0 0 1 0-1.414Z" /></svg>
                                        </Button>
                                        <div className="text-sm text-center">
                                            <p>Sudah punya akun? <a href="/masuk" className="text-primary-green-800 tracking-tight hover:underline">Masuk</a></p>
                                        </div>
                                    </div>
                                </form>
                        </div>
                     </>
                }
            </div>
        </>
    )
}
