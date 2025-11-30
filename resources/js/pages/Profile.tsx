import React, { useEffect } from 'react'
import { useForm, SubmitHandler, useFieldArray } from 'react-hook-form'
import Header from '../components/Header'
import Label from '../components/forms/Label'
import { Input } from '../components/forms/Input'
import KaryaIlmiahForm from '../forms/KaryaIlmiahForm'
import Button from '../components/Button';
import { useMutation, useQuery, useQueryClient } from '@tanstack/react-query'
import axios from 'axios'
import useAuthHeader from 'react-auth-kit/hooks/useAuthHeader'

interface KaryaIlmiah {
    judul: string;
    jenis: string;
    tahun: string;
    tautan: string;
}

interface ProfileForm {
    nama: string;
    email: string;
    telepon: string;
    nama_perusahaan: string;
    posisi: string;
    kota: string;
    provinsi: string;
    instagram: string;
    linkedin: string;
    twitter: string;
    facebook: string;
    karya_ilmiah: KaryaIlmiah[];
}

export default function Profile() {
    const authHeader = useAuthHeader();
    const queryClient = useQueryClient();
    const form = useForm<ProfileForm>({
        defaultValues: {
            nama: '',
            email: '',
            telepon: '',
            nama_perusahaan: '',
            posisi: '',
            kota: '',
            provinsi: '',
            instagram: '',
            linkedin: '',
            twitter: '',
            facebook: '',
            karya_ilmiah: [{
                judul: '',
                jenis: '',
                tahun: '',
                tautan: ''
            }],
        }
    });

    const { control, register, handleSubmit, formState: { errors }, reset } = form;
    const { fields: karyaIlmiahFields, append: appendKaryaIlmiah, remove: removeKaryaIlmiah } = useFieldArray({
        control,
        name: "karya_ilmiah",
    });
    const { data: profileData, isLoading, isError, error } = useQuery({
        queryKey: ['profile'],
        queryFn: async () => {
            const response = await axios.get('/api/auth/profile', {
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
            const response = await axios.post('/api/auth/profile', data, {
                headers: {
                    Authorization: authHeader,
                    'Content-Type': 'application/json'
                }
            });
            return response.data;
        },
        onSuccess: (data) => {
            queryClient.invalidateQueries({ queryKey: ['profile'] });
            alert(data.message || 'Profil berhasil diperbarui!');
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
        if (profileData) {
            reset({
                nama: profileData.nama || '',
                email: profileData.email || '',
                telepon: profileData.telepon || '',
                nama_perusahaan: profileData.nama_perusahaan || '',
                posisi: profileData.posisi || '',
                kota: profileData.kota || '',
                provinsi: profileData.provinsi || '',
                instagram: profileData.instagram || '',
                linkedin: profileData.linkedin || '',
                twitter: profileData.twitter || '',
                facebook: profileData.facebook || '',
                karya_ilmiah: profileData.karya_ilmiah?.length > 0
                    ? profileData.karya_ilmiah.map((k: { id: string, judul: string, jenis: string, tahun: number, tautan: string }) => ({
                        id: k.id,
                        judul: k.judul || '',
                        jenis: k.jenis || '',
                        tahun: k.tahun || '',
                        tautan: k.tautan || ''
                    }))
                    : [],
            });
        }
    }, [profileData, reset]);

    return (
        <div className='w-full min-h-screen bg-gray-50'>
            <Header />
            <div className="w-full max-w-4xl mx-auto md:my-4">
                <div className="bg-white shadow-sm rounded-lg">
                    <div className="p-4 pt-6 md:p-0 md:px-6 md:py-5 border-b border-gray-200">
                        <h2 className="text-xl font-semibold text-gray-900">Profil</h2>
                        <p className="mt-1 text-sm text-gray-500">
                            Perbarui foto dan detail pribadi Anda di sini.
                        </p>
                    </div>

                    <form onSubmit={handleSubmit(onSubmit)} className='p-4 md:p-6 space-y-10'>

                        {/* Nama Lengkap */}
                        <div className="grid grid-cols-1 gap-2 md:grid-cols-3 md:gap-8 items-start">
                            <Label className="text-sm text-gray-700 md:pt-2">Nama lengkap</Label>
                            <div className="md:col-span-2">
                                <Input {...register('nama')} className="w-full text-sm" placeholder="Masukkan nama lengkap" />
                            </div>
                        </div>

                        {/* Email */}
                        <div className="grid grid-cols-1 gap-2 md:grid-cols-3 md:gap-8 items-start">
                            <Label className="text-sm text-gray-700 md:pt-2">Email</Label>
                            <div className="md:col-span-2">
                                <Input {...register('email')} type="email" className="w-full text-sm" placeholder="nama@email.com" />
                            </div>
                        </div>

                        {/* Telepon */}
                        <div className="grid grid-cols-1 gap-2 md:grid-cols-3 md:gap-8 items-start">
                            <Label className="text-sm text-gray-700 md:pt-2">Nomor telepon</Label>
                            <div className="md:col-span-2">
                                <Input {...register('telepon')} type="tel" className="w-full text-sm" placeholder="+62 812 3456 7890" />
                            </div>
                        </div>

                        {/* Foto Profil */}
                        <div className="grid grid-cols-1 gap-2 md:grid-cols-3 md:gap-8 items-start">
                            <div className='mb-4 md:mb-0'>
                                <Label className="block text-sm font-medium text-gray-700">
                                    Foto profil anda
                                </Label>
                                <p className="mt-1 text-[13px] text-gray-500">
                                    Foto ini akan ditampilkan di profil Anda.
                                </p>
                            </div>

                            <div className="md:col-span-2">
                                <div className="flex items-center space-x-4">
                                    <div className="shrink-0">
                                        <div className="h-16 w-16 rounded-full bg-gray-300 flex items-center justify-center">
                                            <span className="text-gray-600 text-xl">👤</span>
                                        </div>
                                    </div>
                                    <button
                                        type="button"
                                        className="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50"
                                    >
                                        Ubah foto
                                    </button>
                                </div>
                            </div>
                        </div>

                        {/* Informasi Pekerjaan */}
                        <div className="grid grid-cols-1 gap-2 md:grid-cols-3 md:gap-8 items-start">
                            <div className='mb-4 md:mb-0'>
                                <Label className="text-sm text-gray-700">Pekerjaan</Label>
                                <p className="mt-1 text-[13px] text-gray-500">
                                    Informasi tentang pekerjaan dan lokasi Anda saat ini.
                                </p>
                            </div>

                            <div className="md:col-span-2 grid gap-4 md:grid-cols-2 w-full">

                                {/* Kolom 1 */}
                                <div className="space-y-4">
                                    <div className="space-y-2">
                                        <Label htmlFor="nama_perusahaan" className="text-sm text-gray-700">Nama Perusahaan</Label>
                                        <Input {...register('nama_perusahaan')} id="nama_perusahaan" className="w-full text-sm" placeholder="PT. Contoh" />
                                    </div>
                                    <div className="space-y-2">
                                        <Label htmlFor="kota" className="text-sm text-gray-700">Kota</Label>
                                        <Input {...register('kota')} id="kota" className="w-full text-sm" placeholder="Jakarta" />
                                    </div>
                                </div>

                                {/* Kolom 2 */}
                                <div className="space-y-4">
                                    <div className="space-y-2">
                                        <Label htmlFor="posisi" className="text-sm text-gray-700">Posisi</Label>
                                        <Input {...register('posisi')} id="posisi" className="w-full text-sm" placeholder="Software Engineer" />
                                    </div>
                                    <div className="space-y-2">
                                        <Label htmlFor="provinsi" className="text-sm text-gray-700">Provinsi</Label>
                                        <Input {...register('provinsi')} id="provinsi" className="w-full text-sm" placeholder="DKI Jakarta" />
                                    </div>
                                </div>

                            </div>
                        </div>

                        {/* Akun Media Sosial */}
                        <div className="grid grid-cols-1 gap-2 md:grid-cols-3 md:gap-8 items-start">
                            <div className='mb-4 md:mb-0'>
                                <Label className="block text-sm font-medium text-gray-700">Akun Media Sosial Anda</Label>
                                <p className="mt-1 text-[13px] text-gray-500">
                                    Tambahkan akun media sosial Anda agar orang lain dapat terhubung dengan Anda.
                                </p>
                            </div>

                            <div className="md:col-span-2 grid gap-4 md:grid-cols-2 w-full">

                                {/* Kolom 1 */}
                                <div className="space-y-4">

                                    {/* Instagram */}
                                    <div className="space-y-2">
                                        <Label htmlFor="instagram" className="text-sm text-gray-700">Instagram</Label>
                                        <div className="flex border border-gray-300 rounded-md w-full overflow-hidden">
                                            <span className="inline-flex items-center px-3 bg-gray-50 text-gray-500 text-sm border-r border-gray-300">
                                                instagram.com/
                                            </span>
                                            <Input {...register('instagram')} id="instagram" className="flex-1 w-full border-0 rounded-none text-sm" placeholder="username" />
                                        </div>
                                    </div>

                                    {/* LinkedIn */}
                                    <div className="space-y-2">
                                        <Label htmlFor="linkedin" className="text-sm text-gray-700">LinkedIn</Label>
                                        <div className="flex border border-gray-300 rounded-md w-full overflow-hidden">
                                            <span className="inline-flex items-center px-3 bg-gray-50 text-gray-500 text-sm border-r border-gray-300">
                                                linkedin.com/
                                            </span>
                                            <Input {...register('linkedin')} id="linkedin" className="flex-1 w-full border-0 rounded-none text-sm" placeholder="in/username" />
                                        </div>
                                    </div>
                                </div>

                                {/* Kolom 2 */}
                                <div className="space-y-4">

                                    {/* Twitter */}
                                    <div className="space-y-2">
                                        <Label htmlFor="twitter" className="text-sm text-gray-700">X (Twitter)</Label>
                                        <div className="flex border border-gray-300 rounded-md w-full overflow-hidden">
                                            <span className="inline-flex items-center px-3 bg-gray-50 text-gray-500 text-sm border-r border-gray-300">
                                                x.com/
                                            </span>
                                            <Input {...register('twitter')} id="twitter" className="flex-1 w-full border-0 rounded-none text-sm" placeholder="username" />
                                        </div>
                                    </div>

                                    {/* Facebook */}
                                    <div className="space-y-2">
                                        <Label htmlFor="facebook" className="text-sm text-gray-700">Facebook</Label>
                                        <div className="flex border border-gray-300 rounded-md w-full overflow-hidden">
                                            <span className="inline-flex items-center px-3 bg-gray-50 text-gray-500 text-sm border-r border-gray-300">
                                                facebook.com/
                                            </span>
                                            <Input {...register('facebook')} id="facebook" className="flex-1 w-full border-0 rounded-none text-sm" placeholder="username" />
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {/* Karya Ilmiah Section */}
                        <div className="grid grid-cols-1 gap-2 md:grid-cols-3 md:gap-8 items-start">
                            <div className='mb-4 md:mb-0'>
                                <Label className="text-sm text-gray-700">Karya ilmiah</Label>
                                <p className="mt-1 text-[13px] text-gray-500">
                                    Tambahkan karya ilmiah atau publikasi yang telah Anda buat.
                                </p>
                            </div>

                            <div className='md:col-span-2 space-y-4'>
                                {karyaIlmiahFields.map((field, index) => (
                                    <div key={field.id} className="border border-gray-300 rounded-md p-4">
                                        <div className="flex justify-end items-center mb-4">
                                            {karyaIlmiahFields.length > 1 && (
                                                <button
                                                    type="button"
                                                    onClick={() => removeKaryaIlmiah(index)}
                                                    className="text-red-600 hover:text-red-800 text-sm font-medium"
                                                >
                                                    Hapus
                                                </button>
                                            )}
                                        </div>

                                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div className="space-y-2">
                                                <Label className="text-sm text-gray-700">Judul</Label>
                                                <Input
                                                    {...register(`karya_ilmiah.${index}.judul`)}
                                                    className="w-full text-sm"
                                                    placeholder="Judul karya ilmiah"
                                                />
                                            </div>
                                            <div className="space-y-2">
                                                <Label className="text-sm text-gray-700">Tahun</Label>
                                                <Input
                                                    {...register(`karya_ilmiah.${index}.tahun`)}
                                                    className="w-full text-sm"
                                                    placeholder="Tahun terbit"
                                                    type="number"
                                                    min="1900"
                                                    defaultValue={new Date().getFullYear()}
                                                />
                                            </div>
                                            <div className="space-y-2">
                                                <Label className="text-sm text-gray-700">Jenis Karya Ilmiah</Label>
                                                <Input
                                                    {...register(`karya_ilmiah.${index}.jenis`)}
                                                    className="w-full text-sm"
                                                    placeholder="Jurnal, Konferensi, dll"
                                                />
                                            </div>
                                            <div className="space-y-2">
                                                <Label className="text-sm text-gray-700">Tautan (Opsional)</Label>
                                                <Input
                                                    {...register(`karya_ilmiah.${index}.tautan`)}
                                                    className="w-full text-sm"
                                                    placeholder="https://..."
                                                    type="url"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                ))}

                                <button
                                    type="button"
                                    onClick={() => appendKaryaIlmiah({
                                        judul: '',
                                        jenis: '',
                                        tahun: '',
                                        tautan: ''
                                    })}
                                    className="w-full px-4 py-2 border-2 border-dashed border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:border-gray-400 hover:bg-gray-50"
                                >
                                    + Tambah Karya Ilmiah
                                </button>
                            </div>
                        </div>

                        {/* Submit */}
                        <div className="flex justify-end pt-4 border-t border-gray-200">
                            <Button type='submit' className='px-4'>
                                Simpan
                            </Button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    )
}
