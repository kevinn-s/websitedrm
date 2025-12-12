import React, { ReactHTMLElement, useEffect, useRef, useState } from 'react'
import { useForm, SubmitHandler, useFieldArray, UseFormRegisterReturn, UseFormRegister, UseFormReturn } from 'react-hook-form'
import useAuthHeader from 'react-auth-kit/hooks/useAuthHeader'
import useAuthUser from 'react-auth-kit/hooks/useAuthUser'
import { useMutation, useQuery, useQueryClient } from '@tanstack/react-query'
import axios from 'axios';
import Header from '@/components/Header'

import { Input } from '@/components/forms/Input';
import { Label } from '@/components/forms/Label';
import { AuthUserState } from '@/types'
import { ApiResponse } from '@/types/api'
import { Publication } from '@/types/publication'

export default function Publications() {
    const authHeader = useAuthHeader(), authUser = useAuthUser<AuthUserState>();
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

    const { data: publications, isLoading, isSuccess, isError, error } = useQuery({
        queryKey: ['publication', name],
        queryFn: async () => {
            const response = await axios.get<ApiResponse<{ publications: Publication[] }>>('/api/profile/publication', {
                headers: { Authorization: authHeader }
            });
            return response.data.publications;
        },
        enabled: !!authUser // Only run when user is authenticated
    });

    return (
        <div>
            <Label>Silahkan masukkan nama anda. Nama anda akan digunakan sebagai parameter untuk pencarian publikasi dari Google Scholar</Label>
            <Input
                value={name}
                onChange={(e) => setName(e.target.value)}
                disabled={!authUser}
                className={!authUser ? 'text-gray-300 select-none' : ''}
            />
            <div>
                {
                    isSuccess && (
                        <div>
                            {publications.map((publication) => (
                                <div key={publication.id}>
                                    <h3>{publication.title}</h3>
                                    <p>{publication.authors}</p>
                                </div>))}
                        </div>
                    )
                }
            </div>
        </div>
    )
}
