import React from 'react';
import ReactDOM from 'react-dom/client';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import AuthProvider from 'react-auth-kit';
import createAuthStore from 'react-auth-kit/store/createAuthStore';
import {
  QueryClient,
  QueryClientProvider,
} from '@tanstack/react-query';
import { Login } from './pages/auth/Login';
import { Register } from './pages/auth/Register'
import { ResetPassword } from './pages/auth/ResetPassword';

import Beranda from './pages/Beranda';
import { ForgotPassword } from './pages/auth/ForgotPassword';
import Profile from './pages/Profile';

const queryClient = new QueryClient();

ReactDOM.createRoot(document.getElementById('root')!).render(
    <React.StrictMode>
        <QueryClientProvider client={queryClient}>
        <BrowserRouter>
            <AuthProvider store={createAuthStore('cookie', {
                authName: '_auth',
                cookieDomain: window.location.hostname,
                cookieSecure: window.location.protocol === 'https:',  // Only true on HTTPS
                cookieSameSite: 'lax',
            })}>
                <div className="antialised flex min-h-screen bg-gray-300 font-noto">
                    <Routes>
                        <Route path="/" element={<Beranda />} />
                        <Route path="/daftar" element={<Register />} />
                        <Route path="/masuk" element={<Login />} />
                        <Route path="/lupa-password" element={<ForgotPassword />} />
                        <Route path="/ubah-password" element={<ResetPassword />} />

                        <Route path="/profil" element={<Profile />} />



                    </Routes>
                </div>
            </AuthProvider>
        </BrowserRouter>
        </QueryClientProvider>
    </React.StrictMode>
);
