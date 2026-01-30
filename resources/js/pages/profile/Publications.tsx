import React, { ReactHTMLElement, useEffect, useRef, useState, useCallback } from 'react';
import { useForm, SubmitHandler, useFieldArray, UseFormRegisterReturn, UseFormRegister, UseFormReturn, useWatch, Control, FieldArrayWithId, UseFieldArrayRemove, UseFieldArrayInsert, UseFieldArrayAppend } from 'react-hook-form';
import useAuthHeader from 'react-auth-kit/hooks/useAuthHeader';
import useAuthUser from 'react-auth-kit/hooks/useAuthUser';
import { useMutation, useQuery, useQueryClient } from '@tanstack/react-query';
import axios from 'axios';
import Header from '@/components/Header';

import { Input } from '@/components/forms/Input';
import { Label } from '@/components/forms/Label';
import { AuthUserState } from '@/types';
import { ApiResponse } from '@/types/api';
import { IPublication } from '@/types/publication';
import Inset from '@/components/Inset';
import Button from '@/components/Button';
import Chip from '@/components/Chip';
import { DateInput } from '@/components/DateInput';

interface PublicationProps extends IPublication {
    onUpdate?: (data: IPublication) => void;
    onDelete?: () => void;
};

const Publication = ({ onUpdate, onDelete, ...props }: PublicationProps) => {
    const [onEdit, setOnEdit] = useState<boolean>(false);

    const { control, register, handleSubmit, setValue, getValues, formState: { errors }, reset } = useForm<IPublication>({
        mode: 'onChange',
        defaultValues: {
            authors: [{ name: '' }]
        }
    });

    const onSubmit = (data: IPublication) => {
        onUpdate?.(data);
        setOnEdit(false);
    }

    return (
        <div>
            {onEdit && (
                <form className='border border-slate-100 p-4' onSubmit={handleSubmit(onSubmit)}>

                    <div className="py-6 border-b border-slate-200">
                        <div className="grid grid-cols-[40%_60%] w-full">
                            <Label className='text-smp font-semibold'>Judul Publikasi</Label>
                            <div>
                                <Input className='h-9 w-full bg-slate-50' {...register('title')} />
                            </div>
                        </div>
                    </div>

                    <div className="py-6 border-b    border-slate-200">
                        <div className="grid grid-cols-[40%_60%] w-full">
                            <Label className='text-smp font-semibold'>Penulis</Label>
                            <div>
                                <Authors control={control} register={register} setValue={setValue} getValues={getValues} />
                            </div>
                        </div>
                    </div>

                    <div className="py-6 border-b border-slate-200">
                        <div className="grid grid-cols-[40%_60%] w-full">
                            <Label className='text-smp font-semibold'>Tahun publikasi</Label>
                            <div>
                                <DateInput label='' name='date' control={control}></DateInput>
                            </div>
                        </div>
                    </div>

                    <div className='flex gap-2'>
                        <Button type='submit'>Simpan</Button>
                        <Button type='button' onClick={() => setOnEdit(false)}>Batal</Button>
                    </div>
                </form>
            )}
            {!onEdit && (
                <div className='space-y-3 border border-gray-300 p-2'>
                    <div className='space-y-1'>
                        <div className='font-semibold leading-tight'>
                            {props.title}
                        </div>
                        <div className='flex'>
                            {props.authors?.map((author, index, authors) => (
                                <div key={index} className='leading-none'>
                                    {index !== 0 && <>&nbsp;</>}
                                    <span className='underline text-sm underline-offset-1'>
                                        {author.name}{index !== authors.length - 1 ? ',' : ''}
                                    </span>
                                </div>
                            ))}
                        </div>
                    </div>
                    <div className='flex text-sm'>
                        <span className='pr-2 text-gray-400 inline-block leading-none'>First published: <a className='text-black'>{props.date.toUTCString()}</a></span>
                        <span className='border-l border-gray-400 pl-2 text-gray-400 leading-none'>Scholarly Journal</span>
                    </div>
                    <div className='flex'>
                        <Button type='button' className='px-4 py-1 tracking-normal' onClick={() => setOnEdit(true)}>Edit</Button>
                    </div>
                </div>
            )}
        </div>
    )
}

interface AuthorProps {
    control: Control<IPublication>;
    field: FieldArrayWithId<IPublication, "authors", "id">;
    index: number;
    register: UseFormRegister<IPublication>;
    remove: UseFieldArrayRemove;
    insert: UseFieldArrayInsert<IPublication, "authors">;
    append: UseFieldArrayAppend<IPublication, "authors">;
    authors: FieldArrayWithId<IPublication, "authors", "id">[];
}

const Author = React.memo<AuthorProps>(({ control, field, index, register, remove, insert, authors, append }) => {
    return (
        <div className='space-x-2 flex items-center'>
            <Input className='h-9 w-full bg-slate-50'></Input>
            {
                index !== authors.length - 1 ?
                    <button className="bg-slate-100 border border-transparent py-2 px-2 text-center text-sm transition-all text-slate-600 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type='button' onClick={(e) => remove(index)}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 20 20"><path fill="#676767" d="M17 2h-3.5l-1-1h-5l-1 1H3v2h14zM4 17a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V5H4z" /></svg>
                    </button>
                    :
                    <button className="bg-slate-100 border border-transparent py-2 px-2 text-center text-sm transition-all text-slate-600 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type='button' onClick={() => append({ name: '' })}>
                        <svg width="14" height="14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="#676767" d="M256 64c0-17.7-14.3-32-32-32s-32 14.3-32 32v160H32c-17.7 0-32 14.3-32 32s14.3 32 32 32h160v160c0 17.7 14.3 32 32 32s32-14.3 32-32V288h160c17.7 0 32-14.3 32-32s-14.3-32-32-32H256z" /></svg>
                    </button>
            }
        </div>
    )
});

Author.displayName = 'Author';

const Authors = ({ control, register, setValue, getValues }: Pick<UseFormReturn<IPublication>, 'control' | 'getValues' | 'setValue' | 'register'>) => {
    const { fields: authors, append, remove, insert } = useFieldArray({
        control,
        name: 'authors',
    });

    return (
        <div className='space-y-2'>
            <div className="space-y-2">
                {authors.map((field, index) => (
                    <Author
                        key={field.id}
                        control={control}
                        field={field}
                        index={index}
                        register={register}
                        insert={insert}
                        remove={remove}
                        append={append}
                        authors={authors}
                    />
                ))}
            </div>
        </div>
    )
}

export default function Publications() {
    const authHeader = useAuthHeader(), authUser = useAuthUser<AuthUserState>();
    const [publications, setPublications] = useState<IPublication[]>([]);

    const [name, setName] = useState(authUser?.name || '');

    const scholarProfileMutation = useMutation({
        mutationFn: async (name: string) => {
            const response = await axios.post('/api/profile/publication/search', {
                name: name
            }, {
                headers: { Authorization: authHeader }
            });
            return response.data;
        }
    });

    const { data, isLoading, isSuccess, isError, error } = useQuery({
        queryKey: ['publication', name],
        queryFn: async () => {
            const response = await axios.get<ApiResponse<{ publications: IPublication[] }>>('/api/profile/publication', {
                headers: { Authorization: authHeader }
            });
            return response.data.publications;
        },
        enabled: !!authUser // Only run when user is authenticated
    });

    return (
        <div className='mr-10'>
            <h1>Publikasi</h1>
            <div>
                <Publication
                    title='A global database of nitrogen and phosphorus excretion rates of aquatic animals'
                    authors={[{ name: 'Alice M. Carter' }, { name: 'efiniefef' }]}
                    type='oppp'
                    date={new Date('12 August 2023')}
                />
            </div>
        </div>
    )
}
