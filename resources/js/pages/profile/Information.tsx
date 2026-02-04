import React, { ReactHTMLElement, useEffect, useRef, useState } from 'react'
import { useForm, SubmitHandler, useFieldArray, UseFormRegisterReturn, UseFormRegister, UseFormReturn } from 'react-hook-form'
import Header from '@/components/Header'
import { Label } from '@/components/forms/Label'
import { Input } from '@/components/forms/Input'
import Button from '@/components/Button';
import { Image } from '@/components/forms/Image'
import { useMutation, useQuery, useQueryClient } from '@tanstack/react-query'
import axios from 'axios'
import useAuthHeader from 'react-auth-kit/hooks/useAuthHeader'
import Cropper, { ReactCropperElement } from "react-cropper";
import "../../../css/cropper.css";

interface ProfileForm {
    name: string;
    nim: string;
    image: string;
    email: string;
    phone: string;
    bib: number;
    company: string;
    profession: string;
    city: string;
    province: string;
    instagram: string;
    linkedin: string;
    x: string;
    facebook: string;
}

export default function Information() {
    const authHeader = useAuthHeader(), queryClient = useQueryClient();
    const form = useForm<ProfileForm>({
        defaultValues: {
            name: '',
            image: '',
            email: '',
            phone: '',
            company: '',
            profession: '',
            city: '',
            province: '',
            instagram: '',
            linkedin: '',
            x: '',
            facebook: '',
        }
    });

    const { control, register, handleSubmit, formState: { errors }, setValue, reset } = form;

    const { data: profile, isLoading, isError, error } = useQuery<ProfileForm>({
        queryKey: ['profile'],
        queryFn: async () => {
            const response = await axios.get('/api/profile', {
                headers: {
                    Authorization: authHeader
                }
            });
            return response.data;
        },
        staleTime: 5 * 60 * 1000,
    });

    const mutation = useMutation<{
        success: boolean;
        message?: string
    }, Error, ProfileForm>({
        mutationFn: async (data: ProfileForm) => {
            return axios.post('/api/profile', data, {
                headers: {
                    Authorization: authHeader,
                    'Content-Type': 'application/json'
                }
            });
        },
        onSuccess: (data) => {
            queryClient.invalidateQueries({ queryKey: ['profile'] });
        },
        onError: (error) => {
            if (axios.isAxiosError(error)) {
                const errorMessage = error.response?.data?.error?.message
                    || error.response?.data?.message
                    || 'Gagal memperbarui profil. Silakan coba lagi.';
                alert(errorMessage);
            } else {
                alert('Terjadi kesalahan. Silakan coba lagi.');
            }
        }
    });

    const onSubmit: SubmitHandler<ProfileForm> = (data) => {
        mutation.mutate(data);
    };

    useEffect(() => {
        if (profile) {
            reset({
                name: profile.name,
                email: profile.email,
                phone: profile.phone,
                bib: profile.bib,
                company: profile.company,
                profession: profile.profession,
                city: profile.city,
                province: profile.province,
                instagram: profile.instagram,
                linkedin: profile.linkedin,
                x: profile.x,
                facebook: profile.facebook,
                image: profile.image || ''
            });
        }
    }, [profile, reset]);

    return (
        <div className='flex w-full h-full'>
            <div className="w-full max-w-4xl mx-auto md:my-4">
                <div className="bg-white shadow-sm rounded-lg">
                    <div className="p-4 pt-6 md:p-0 md:px-6 md:py-5 border-b border-gray-200">
                        <h2 className="text-xl font-semibold text-gray-900">Profil</h2>
                        <p className="mt-1 text-sm text-gray-500">
                            Perbarui foto dan detail pribadi Anda di sini.
                        </p>
                    </div>
                    {isLoading ? (
                        <div>Loading...</div>
                    ) : profile ? (
                        <form onSubmit={handleSubmit(onSubmit)} className='p-4 md:p-6 space-y-10'>
                            <Image defaultImage={profile.image} register={register('image')} setImageValue={(image: string) => {
                                setValue('image', image);
                            }}></Image>
                            {/* Nama */}
                            <div>
                                <Label>Nama Lengkap</Label>
                                <Input defaultValue={profile.name ?? ''}   {...register('name')} placeholder="Data belum terisi" />
                            </div>

                            <div className="flex gap-4">
                                <div>
                                    <Label>NIM</Label>
                                    <Input
                                        value={profile.nim ?? ''}
                                        disabled
                                        placeholder="Data belum terisi"
                                    />
                                </div>

                                <div>
                                    <Label>Nomor BIB</Label>
                                    <Input
                                        defaultValue={profile.bib ?? ''}
                                        {...register('bib')}
                                        disabled
                                        placeholder="Data belum terisi"
                                    />
                                </div>
                            </div>

                            <div>
                                <Label>Perusahaan</Label>
                                <Input
                                    defaultValue={profile.company ?? ''}
                                    {...register('company')}
                                    placeholder="Data belum terisi"
                                />
                            </div>

                            <div>
                                <Label>Profesi</Label>
                                <Input
                                    defaultValue={profile.profession ?? ''}
                                    {...register('profession')}
                                    placeholder="Data belum terisi"
                                />
                            </div>

                            <div>
                                <Label>Kota</Label>
                                <Input
                                    defaultValue={profile.city ?? ''}
                                    {...register('city')}
                                    placeholder="Data belum terisi"
                                />
                            </div>

                            <div>
                                <Label>Provinsi</Label>
                                <Input
                                    defaultValue={profile.province ?? ''}
                                    {...register('province')}
                                    placeholder="Data belum terisi"
                                />
                            </div>

                            {/* Sosial Media */}
                            <div>
                                <div className='flex'>
                                    <div>
                                        <Label>Instagram</Label>
                                        <Input
                                            defaultValue={profile.instagram ?? ''}
                                            {...register('instagram')}
                                            placeholder="Data belum terisi"
                                        />
                                    </div>

                                    <div>
                                        <Label>LinkedIn</Label>
                                        <Input
                                            defaultValue={profile.linkedin ?? ''}
                                            {...register('linkedin')}
                                            placeholder="Data belum terisi"
                                        />
                                    </div>
                                </div>
                                <div className='flex'>
                                    <div>
                                        <Label>Twitter</Label>
                                        <Input
                                            defaultValue={profile.x ?? ''}
                                            {...register('x')}
                                            placeholder="Data belum terisi"
                                        />
                                    </div>

                                    <div>
                                        <Label>Facebook</Label>
                                        <Input
                                            defaultValue={profile.facebook ?? ''}
                                            {...register('facebook')}
                                            placeholder="Data belum terisi"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div className="flex justify-end pt-4 border-t border-gray-200">
                                <Button type='submit' className='px-4'>
                                    Simpan
                                </Button>
                            </div>
                        </form>

                    ) : (
                        <div>Profile not found</div>
                    )}
                </div>
            </div>
        </div>
    )
}
