import React, { useEffect } from "react"
import axios from 'axios'
import { useMutation } from '@tanstack/react-query';
import { useForm, SubmitHandler } from "react-hook-form";
import { useSearchParams, useNavigate } from "react-router-dom";
import { Input } from "../../components/forms/Input";
import Label from "../../components/forms/Label";
import Button from "../../components/Button";

enum ResetPasswordError {
    RESET_FAILED = 'RESET_FAILED',
    INVALID_LINK = 'INVALID_LINK',
    VALIDATION_ERROR = 'VALIDATION_ERROR',
    SERVER_ERROR = 'SERVER_ERROR'
}

const ResetPasswordErrorMessage = ({ type, message }: { type: string; message?: string }) => {
    return (
        <div className="p-4 text-sm font-medium border-[0.3px] bg-opacity-50 text-red-600 border-red-400 bg-red-200">
            {message || "Terjadi kesalahan pada sistem."}
        </div>
    );
};

interface ResetPasswordForm {
    password: string;
    password_confirmation: string;
}

export const ResetPassword = () => {
    const [searchParams] = useSearchParams();
    const navigate = useNavigate();

    // Get token and email from URL
    const token = searchParams.get('token');
    const email = searchParams.get('email');

    const { register, handleSubmit, formState: { errors }, setError, clearErrors } = useForm<ResetPasswordForm>();

    const mutation = useMutation({
        mutationFn: (formData: ResetPasswordForm & { token: string; email: string }) =>
            axios.post('/api/auth/reset-password', formData).then(res => res.data)
    });

    useEffect(() => {
        if (!token || !email) {
            setError('root.serverError', {
                type: ResetPasswordError.INVALID_LINK,
                message: 'Link reset password tidak valid. Silakan minta link baru.'
            });
        }
    }, [token, email, setError]);

    const onSubmit: SubmitHandler<ResetPasswordForm> = (formData) => {
        clearErrors('root.serverError');

        if (!token || !email) {
            setError('root.serverError', {
                type: ResetPasswordError.INVALID_LINK,
                message: 'Link reset password tidak valid.'
            });
            return;
        }

        mutation.mutate({ ...formData, token, email }, {
            onSuccess: (data) => {
                if (data.success) {
                    setTimeout(() => navigate('/masuk'), 2000);
                } else if (data.error) {
                    setError('root.serverError', {
                        type: data.error.type,
                        message: data.error.message
                    });
                }
            },
            onError: (error) => {
                if (axios.isAxiosError(error) && error.response?.data?.error) {
                    setError('root.serverError', {
                        type: error.response.data.error.type,
                        message: error.response.data.error.message
                    });
                } else {
                    setError('root.serverError', {
                        type: ResetPasswordError.SERVER_ERROR,
                        message: 'Terjadi kesalahan sistem.'
                    });
                }
            }
        });
    };

    const isInvalidLink = !token || !email;

    return (
        <div className="max-w-md my-auto h-full w-full mx-auto bg-white">
            <div className="border-b-gray-200 border-b-[0.3px] w-full flex justify-center p-6">
                <img src="/images/drm.webp" alt="" className="w-20 h-full" />
            </div>
            <div className="p-6 space-y-4">
                <h1 className="font-sora text-2xl font-semibold">Reset Password</h1>
                <p className="text-sm text-gray-600">
                    Masukkan password baru Anda untuk akun <strong>{email}</strong>
                </p>

                {errors.root && errors.root.serverError.type === ResetPasswordError.INVALID_LINK ? (
                    <div className="space-y-4">
                        <ResetPasswordErrorMessage
                            type={ResetPasswordError.INVALID_LINK}
                            message="Link reset password tidak valid atau sudah kadaluarsa. Silakan minta link baru."
                        />
                        <Button
                            variant="primary"
                            className="w-full px-5 py-2.5"
                            onClick={() => { navigate('/lupa-password')} }
                        >
                            <span className="text-smp text-white">Minta Link Baru</span>
                        </Button>
                    </div>
                ) : (
                    <form onSubmit={handleSubmit(onSubmit)} className="space-y-4">
                        <div className="space-y-2">
                            <Label>Password Baru</Label>
                            <Input
                                {...register('password', {
                                    required: 'Password wajib diisi',
                                    minLength: {
                                        value: 8,
                                        message: 'Password minimal 8 karakter'
                                    }
                                })}
                                className="w-full m-0"
                                type="password"
                                disabled={mutation.isPending}
                            />
                            {errors.password && (
                                <p className="text-sm text-red-600 mt-1">{errors.password.message}</p>
                            )}
                        </div>

                        <div className="space-y-2">
                            <Label>Konfirmasi Password</Label>
                            <Input
                                {...register('password_confirmation', {
                                    required: 'Konfirmasi password wajib diisi',
                                    validate: (value, formValues) =>
                                        value === formValues.password || 'Password tidak sama'
                                })}
                                className="w-full m-0"
                                type="password"
                                disabled={mutation.isPending}
                            />
                            {errors.password_confirmation && (
                                <p className="text-sm text-red-600 mt-1">{errors.password_confirmation.message}</p>
                            )}
                        </div>

                        {mutation.isSuccess && mutation.data?.success && (
                            <div className="p-4 text-sm font-medium border-[0.3px] bg-opacity-50 text-green-600 border-green-400 bg-green-100">
                                Password berhasil direset! Mengalihkan ke halaman login...
                            </div>
                        )}

                        {errors.root?.serverError && (
                            <ResetPasswordErrorMessage
                                type={errors.root.serverError.type as string}
                                message={errors.root.serverError.message}
                            />
                        )}

                        <Button
                            variant="primary"
                            className="w-full px-5 py-2.5 gap-2"
                            type="submit"
                            disabled={mutation.isPending}
                        >
                            <span className="text-smp text-white">
                                {mutation.isPending ? 'Memproses...' : 'Reset Password'}
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 15 15">
                                <path fill="#ffffff" d="M8.293 2.293a1 1 0 0 1 1.414 0l4.5 4.5a1 1 0 0 1 0 1.414l-4.5 4.5a1 1 0 0 1-1.414-1.414L11 8.5H1.5a1 1 0 0 1 0-2H11L8.293 3.707a1 1 0 0 1 0-1.414Z" />
                            </svg>
                        </Button>

                        <div className="text-sm text-center">
                            <p>Sudah ingat password anda? <a href="/masuk" className="text-primary-green-800 tracking-tight hover:underline">Masuk</a></p>
                        </div>
                    </form>
                )}
            </div>
        </div>
    );
};
