import React from 'react';
import { useFieldArray, FieldValues, UseFormReturn } from 'react-hook-form';
import Label from '../components/forms/Label';
import { Input } from '../components/forms/Input';

interface KaryaIlmiah {
    title: string;
    type: string;
    year: string;
    link: string;
}

interface KaryaIlmiahFormProps {
    form: UseFormReturn<any>;
}

export default function KaryaIlmiahForm({ form }: KaryaIlmiahFormProps) {
    const { control, register, getValues, setValue } = form;
    const { fields, append, remove } = useFieldArray({
        control,
        name: "karyaIlmiah"
    });

    const addKaryaIlmiah = () => {
        const currentNewKarya = getValues('newKarya');

        // Validate required fields
        if (!currentNewKarya.title || !currentNewKarya.type || !currentNewKarya.year) {
            alert('Judul, Jenis, dan Tahun wajib diisi!');
            return;
        }

        // Add to array
        append({
            title: currentNewKarya.title,
            type: currentNewKarya.type,
            year: currentNewKarya.year,
            link: currentNewKarya.link || ''
        });

        // Reset only the newKarya fields
        setValue('newKarya', {
            title: '',
            type: '',
            year: '',
            link: ''
        });
    };

    return (
        <div className="grid grid-cols-1 gap-2 md:grid-cols-3 md:gap-8 items-start">
            <div>
                <Label className="text-sm text-gray-700">
                    Karya ilmiah
                </Label>
                <p className="mt-1 text-[13px] text-gray-500">
                    Tambahkan karya ilmiah atau publikasi yang telah Anda buat.
                </p>
            </div>

            <div className="md:col-span-2 space-y-4">
                {/* Display existing entries */}
                {fields.length > 0 && (
                    <div className="space-y-3">
                        {fields.map((field, index) => (
                            <div key={field.id} className="border border-gray-200 rounded-md p-4 bg-gray-50">
                                <div className="flex justify-between items-start">
                                    <div className="flex-1">
                                        <h4 className="font-medium text-gray-900 text-sm">
                                            {field.title}
                                        </h4>
                                        <p className="text-xs text-gray-600 mt-1">
                                            {field.id} • {field.year}
                                        </p>
                                        {field.link && (
                                            <a
                                                href={field.link}
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                className="text-xs text-blue-600 hover:text-blue-800 mt-1 inline-block"
                                            >
                                                Lihat Publikasi →
                                            </a>
                                        )}
                                    </div>
                                    <button
                                        type="button"
                                        onClick={() => remove(index)}
                                        className="text-red-600 hover:text-red-800 ml-4 p-1"
                                        title="Hapus"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            className="h-5 w-5"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fillRule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clipRule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        ))}
                    </div>
                )}

                {/* Add new entry form */}
                <div className="border border-gray-300 rounded-md p-4">
                    <div className="grid gap-4 md:grid-cols-2 w-full">
                        <div className="space-y-4">
                            <div className="space-y-2">
                                <Label htmlFor="new_karya_title" className="text-sm text-gray-700">
                                    Judul <span className="text-red-500">*</span>
                                </Label>
                                <Input
                                    id="new_karya_title"
                                    {...register('newKarya.title')}
                                    className="w-full"
                                />
                            </div>
                            <div className="space-y-2">
                                <Label htmlFor="new_karya_year" className="text-sm text-gray-700">
                                    Tahun <span className="text-red-500">*</span>
                                </Label>
                                <Input
                                    type="number"
                                    id="new_karya_year"
                                    {...register('newKarya.year')}
                                    placeholder="2024"
                                    className="w-full"
                                />
                            </div>
                        </div>
                        <div className="space-y-4">
                            <div className="space-y-2">
                                <Label htmlFor="new_karya_type" className="text-sm text-gray-700">
                                    Jenis karya ilmiah <span className="text-red-500">*</span>
                                </Label>
                                <select
                                    id="new_karya_type"
                                    {...register('newKarya.type')}
                                    className="flex-1 min-w-0 block w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-green-500 focus:border-transparent text-sm"
                                >
                                    <option value="">Pilih jenis...</option>
                                    <option value="Jurnal">Jurnal</option>
                                    <option value="Konferensi">Konferensi</option>
                                    <option value="Buku">Buku</option>
                                    <option value="Skripsi">Skripsi</option>
                                    <option value="Tesis">Tesis</option>
                                    <option value="Disertasi">Disertasi</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div className="space-y-2">
                                <Label htmlFor="new_karya_link" className="text-sm text-gray-700">
                                    Tautan (opsional)
                                </Label>
                                <Input
                                    type="url"
                                    id="new_karya_link"
                                    {...register('newKarya.link')}
                                    placeholder="https://..."
                                    className="w-full"
                                />
                            </div>
                        </div>
                    </div>
                    <div className="flex justify-end mt-4">
                        <button
                            type="button"
                            onClick={addKaryaIlmiah}
                            className="inline-flex items-center gap-2 justify-center border-primary-green-800 border-b-2 rounded-md text-sm bg-primary-green-500 py-2 px-4 font-medium text-white transition-all duration-200 hover:bg-primary-green-600 active:scale-95"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="18"
                                height="18"
                                viewBox="0 0 512 512"
                            >
                                <path
                                    fill="#ffffff"
                                    d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zm149.3 277.3c0 11.8-9.5 21.3-21.3 21.3h-85.3V384c0 11.8-9.5 21.3-21.3 21.3h-42.7c-11.8 0-21.3-9.6-21.3-21.3v-85.3H128c-11.8 0-21.3-9.6-21.3-21.3v-42.7c0-11.8 9.5-21.3 21.3-21.3h85.3V128c0-11.8 9.5-21.3 21.3-21.3h42.7c11.8 0 21.3 9.6 21.3 21.3v85.3H384c11.8 0 21.3 9.6 21.3 21.3v42.7z"
                                />
                            </svg>
                            Tambah
                        </button>
                    </div>
                </div>
            </div>
        </div>
    );
}
