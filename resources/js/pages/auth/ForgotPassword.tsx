import React, { useEffect } from "react"
import { useState } from "react"
import axios from 'axios'
import { useMutation } from '@tanstack/react-query';
import useSignIn from 'react-auth-kit/hooks/useSignIn';
import { useForm, SubmitHandler } from "react-hook-form";
import { Input } from "../../components/forms/Input";
import Label from "../../components/forms/Label";
import Button from "../../components/Button";

enum ForgotPasswordError {
    RESET_LINK_FAILED = 'RESET_LINK_FAILED',
    VALIDATION_ERROR = 'VALIDATION_ERROR',
    SERVER_ERROR = 'SERVER_ERROR'
}

const ForgotPasswordErrorMessage = ({ type }: { type: string }) => {
    return (
        <div className="p-4 text-sm font-medium border-[0.3px] bg-opacity-50 text-red-600 border-red-400 bg-red-200" >
            {
                type === ForgotPasswordError.RESET_LINK_FAILED ?
                    "Email tidak ditemukan dalam sistem kami." :
                    type === ForgotPasswordError.VALIDATION_ERROR ?
                        "Format email tidak valid." :
                        type === ForgotPasswordError.SERVER_ERROR ?
                            "Terjadi kesalahan pada sistem. Silakan coba lagi nanti." :
                            "Terjadi kesalahan yang tidak diketahui."
            }
        </div>
    );
};

interface ForgotPasswordForm {
    email: string,
};

export const ForgotPassword = () => {
    const { register, handleSubmit, formState: { isSubmitSuccessful, errors }, setError, clearErrors } = useForm<ForgotPasswordForm>()
    const mutation = useMutation<
            {
                success: boolean;
                message?: string; error?: {
                    type: string;
                    message: string;
                };
            },
            unknown,
            ForgotPasswordForm
        >({
            mutationFn: (formData) => axios.post('/api/auth/forgot-password', formData).then(res => res.data)
    });
    const onSubmit: SubmitHandler<ForgotPasswordForm> = (formData) => {
        clearErrors('root.serverError');

        mutation.mutate(formData, {
                onSuccess: (data) => {
                    if (data.success) {
                        console.log('Reset link sent!');
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
                            message: 'Terjadi kesalahan sistem. Silakan coba lagi.'
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
        <div className="max-w-md my-auto h-full w-full mx-auto bg-white">
            <div className="border-b-gray-200 border-b-[0.3px] w-full flex justify-center p-6">
                <img src="/images/drm.webp" alt="" className="w-20 h-full" />
            </div>
            <div className="p-6 space-y-4">
                <h1 className="font-sora text-2xl font-semibold">Lupa Password?</h1>
                <p className="text-sm text-gray-600">
                    Masukkan email Anda dan kami akan mengirimkan link untuk mengatur ulang password Anda.
                </p>
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

                    { mutation.isSuccess && mutation.data?.success && (
                        <div className="p-4 text-sm font-medium border-[0.3px] bg-opacity-50 text-primary-green-600 border-primary-green-400 bg-primary-green-200">
                            Link reset password telah dikirim ke email Anda. Silakan cek inbox atau folder spam.
                        </div>
                    )}
                    { errors.root?.serverError && (
                        <ForgotPasswordErrorMessage type={errors.root.serverError.type as string} />
                    )}
                    <Button variant="primary" className="w-full px-5 py-2.5 gap-2" type="submit">
                        <span className="text-smp text-white">Kirim Link Reset Password</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 15 15"><path fill="#ffffff" d="M8.293 2.293a1 1 0 0 1 1.414 0l4.5 4.5a1 1 0 0 1 0 1.414l-4.5 4.5a1 1 0 0 1-1.414-1.414L11 8.5H1.5a1 1 0 0 1 0-2H11L8.293 3.707a1 1 0 0 1 0-1.414Z" /></svg>
                    </Button>
                    <div className="text-sm text-center">
                        <p>Sudah ingat password anda? <a href="/masuk" className="text-primary-green-800 tracking-tight hover:underline">Masuk</a></p>
                    </div>
                </form>
            </div>
        </div>
    )
}
