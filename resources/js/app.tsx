import React from 'react';
import ReactDOM from 'react-dom/client';
import { BrowserRouter, Routes, Route, Outlet, Navigate } from 'react-router-dom';
import AuthProvider from '@/components/auth/AuthProvider';


import {
  QueryClient,
  QueryClientProvider,
} from '@tanstack/react-query';
import { lazy, Suspense } from 'react';
import ProtectedRoute from '@/Hooks/ProtectedRoute';

const Login = lazy(() => import('@/pages/auth/Login'));
const Register = lazy(() => import('@/pages/auth/Register'));
const ResetPassword = lazy(() => import('@/pages/auth/ResetPassword'));
const ForgotPassword = lazy(() => import('@/pages/auth/ForgotPassword'));

const Beranda = lazy(() => import('@/pages/Beranda'));
const EventDetail = lazy(() => import('@/pages/EventDetail'));

const Index = lazy(() => import('@/pages/profile/Index'));

const queryClient = new QueryClient();
ReactDOM.createRoot(document.getElementById('root')!).render(
    <React.StrictMode>
        <QueryClientProvider client={queryClient}>
        <BrowserRouter>
            <AuthProvider>
                <div className="antialised flex min-h-screen bg-gray-300 font-noto">
                    <Suspense fallback={<div>Loading...</div>}>
                    <Routes>
                        <Route path="/" element={<Beranda />} />
                        <Route path="/register" element={<Register />} />
                        <Route path="/login" element={<Login />} />
                        <Route path="/lupa-password" element={<ForgotPassword />} />
                        <Route path="/ubah-password" element={<ResetPassword />} />
                        <Route element={<ProtectedRoute />}>
                            <Route path="/profil/*" element={<Index />} />
                        </Route>
                    </Routes>
                    </Suspense>
                </div>
            </AuthProvider>
        </BrowserRouter>
        </QueryClientProvider>
    </React.StrictMode>
);
