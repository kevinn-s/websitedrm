import React from 'react'
import useAuthUser from 'react-auth-kit/hooks/useAuthUser';
import useSignOut from 'react-auth-kit/hooks/useSignOut';
import { Guest } from './auth/Guest';
import { Authenticated } from './auth/Authenticated';
import { useNavigate } from 'react-router-dom';
import { Link } from 'react-router-dom';

interface User {
    name: string;
    email: string;
    status: string;
}

export default function Header() {
    const user = useAuthUser<User>();
    const signOut = useSignOut();
    const navigate = useNavigate();

    const [isMenuOpen, setIsMenuOpen] = React.useState(false);
    const [isMobileMenuOpen, setIsMobileMenuOpen] = React.useState(false);

    React.useEffect(() => {
        const handleClickOutside = (event: MouseEvent) => {
            const target = event.target as HTMLElement;
            if (!target.closest('.mega-menu-container') && !target.closest('.mega-menu-trigger')) {
                setIsMenuOpen(false);
            }
        };

        document.addEventListener('click', handleClickOutside);
        return () => document.removeEventListener('click', handleClickOutside);
    }, []);

    React.useEffect(() => {
        setIsMobileMenuOpen(false);
        setIsMenuOpen(false);
    }, [navigate]);

    return (
        <div className="border-b border-slate-200 sticky top-0 z-50 w-full">
            <div className="hidden lg:block bg-primary-green-500 text-white">
                <div className="mx-auto flex max-w-5xl justify-end px-4">
                    <div className="flex flex-wrap items-center gap-2 py-1 text-sm">
                        <Guest>
                            <Link to="/login" className="border border-white/40 px-3 py-1 font-semibold tracking-tight hover:bg-white hover:text-primary-green-700 transition">
                                Masuk
                            </Link>
                            <Link to="/register" className="bg-primary-gold px-3 py-1 font-semibold tracking-tight text-primary-green-900 hover:bg-amber-300 transition">
                                Daftar
                            </Link>
                        </Guest>
                        <Authenticated>
                            <button onClick={() => navigate('/profil')} type="button" className="inline-flex items-center gap-1 bg-white/10 px-3 py-1 text-sm font-semibold tracking-tight hover:bg-white/20 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" className="h-4 w-4" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M12 2a5 5 0 1 1-5 5a5 5 0 0 1 5-5Zm0 12c3.69 0 7 1.38 7 3.75V20a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-2.25C5 15.38 8.31 14 12 14Z" />
                                </svg>
                                <span className="hidden sm:inline">Profil</span>
                            </button>
                            <button onClick={() => { signOut(); navigate('/'); }} type="button" className="inline-flex items-center gap-1 border border-white/40 px-3 py-1 text-sm font-semibold tracking-tight hover:bg-white hover:text-primary-green-700 transition">
                                Keluar
                            </button>
                        </Authenticated>
                    </div>
                </div>
            </div>

            <div className="bg-white border-t-primary-green-500 border-t-8 md:border-t-0">
                <div className="mx-auto relative max-w-5xl px-4">
                    <div className="w-full relative">
                        <div className='flex justify-between'>
                            {/* Logo */}
                            <Link to="/" className="flex items-center gap-4 py-2">
                                <img src="/images/drm.webp" alt="Logo DRM" className="h-10 md:h-14 w-auto" />
                                <div className="flex flex-col leading-tight font-medium text-primary-green-900">
                                    <span className="text-[11px] md:text-xs uppercase leading-tight md:leading-normal tracking-[0.13em] text-primary-green-700">ASOSIASI ALUMNI DRM</span>
                                    <span className="text-xs uppercase leading-tight md:leading-normal tracking-[0.13em] text-primary-green-700">BINUS UNIVERSITY</span>
                                </div>
                            </Link>

                            {/* Mobile menu button */}
                            <button
                                onClick={() => setIsMobileMenuOpen(!isMobileMenuOpen)}
                                className="lg:hidden p-2 rounded-md hover:bg-gray-100 transition"
                                aria-label="Toggle menu"
                            >
                                {isMobileMenuOpen ? (
                                    <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                ) : (
                                    <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                )}
                            </button>

                            {/* Desktop navigation */}
                            <nav className="hidden lg:flex items-end text-smp font-semibold tracking-tight text-primary-green-900">
                                <Link to="/kegiatan" className='inline-flex items-center border-b-4 px-6 pt-4 pb-5 border-transparent leading-5 text-black hover:text-primary-green-800 focus:outline-none transition duration-150 ease-in-out box-border'>
                                    Kegiatan
                                </Link>
                                {user && user.status === 'VERIFIED' && (
                                    <Link to='/alumni' className='inline-flex items-center border-b-4 px-6 pt-4 pb-5 border-transparent leading-5 text-black hover:text-primary-green-800 focus:outline-none transition duration-150 ease-in-out box-border'>
                                        Alumni
                                    </Link>
                                )}
                                <button
                                    onClick={() => setIsMenuOpen(!isMenuOpen)}
                                    className='mega-menu-trigger inline-flex gap-2 items-center border-b-4 px-6 pt-4 pb-5 border-transparent leading-5 text-black hover:text-primary-green-800 focus:outline-none transition duration-150 ease-in-out box-border'
                                >
                                    Tentang kami
                                    <svg xmlns="http://www.w3.org/2000/svg" className={`h-3 w-3 transition-transform ${isMenuOpen ? 'rotate-180' : ''}`} viewBox="0 0 20 20" fill="currentColor">
                                        <path fillRule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.104l3.71-3.874a.75.75 0 0 1 1.08 1.04l-4.24 4.43a.75.75 0 0 1-1.08 0l-4.24-4.43a.75.75 0 0 1 .02-1.06Z" clipRule="evenodd" />
                                    </svg>
                                </button>
                                <Link to="/kontak" className='inline-flex items-center border-b-4 px-6 pt-4 pb-5 border-transparent leading-5 text-black hover:text-primary-green-800 focus:outline-none transition duration-150 ease-in-out box-border'>
                                    Kontak kami
                                </Link>
                                <Link to="/rekening" className='inline-flex items-center border-b-4 px-6 pt-4 pb-5 border-transparent leading-5 text-black hover:text-primary-green-800 focus:outline-none transition duration-150 ease-in-out box-border'>
                                    Rekening
                                </Link>
                            </nav>
                        </div>
                    </div>

                    {/* Desktop Mega Menu */}
                    {isMenuOpen && (
                        <div className='mega-menu-container hidden lg:flex absolute left-0 right-0 bg-white shadow-lg border-t border-gray-200 z-50'>
                            <div className="w-1/3 text-sm p-4 border-r border-slate-200">
                                <div className="text-smp font-semibold text-green-900 mb-3">Tentang Kami</div>
                                <ul className="list-disc flex flex-col gap-2 pl-4">
                                    <li><Link to='/visi-misi' className="hover:text-primary-green-600">Visi Misi</Link></li>
                                    <li><Link to="/tujuan" className="hover:text-primary-green-600">Tujuan</Link></li>
                                </ul>
                            </div>
                            <div className="w-1/3 text-sm p-4 border-r border-slate-200">
                                <div className="text-smp font-semibold text-green-900 mb-3">Dokumen Legalitas</div>
                                <ul className="list-disc flex flex-col gap-2 pl-4">
                                    <li><Link to="/akta-asosiasi-alumni" className="hover:text-primary-green-600">Akta Asosiasi Alumni</Link></li>
                                    <li><Link to="/ad-art-asosiasi-alumni" className="hover:text-primary-green-600">AD/ART Asosiasi Alumni</Link></li>
                                </ul>
                            </div>
                            <div className="w-1/3 text-sm p-4">
                                <div className="text-smp font-semibold text-green-900 mb-3">Struktur Organisasi</div>
                                <ul className="list-disc flex flex-col gap-2 pl-4">
                                    <li><Link to="/struktur-asosiasi-alumni" className="hover:text-primary-green-600">Struktur Asosiasi</Link></li>
                                </ul>
                            </div>
                        </div>
                    )}
                </div>

                {/* Mobile Navigation */}
                {isMobileMenuOpen && (
                    <div className="lg:hidden border-t border-gray-200 bg-white">
                        <nav className="flex flex-col px-4 py-2">
                            <Link to="/kegiatan" className='py-3 border-b border-gray-100 text-sm font-semibold text-primary-green-900 hover:text-primary-green-600'>
                                Kegiatan
                            </Link>
                            {user && user.status === 'VERIFIED' && (
                                <Link to='/alumni' className='py-3 border-b border-gray-100 text-sm font-semibold text-primary-green-900 hover:text-primary-green-600'>
                                    Alumni
                                </Link>
                            )}

                            {/* Mobile Tentang Kami Accordion */}
                            <div className="border-b border-gray-100">
                                <button
                                    onClick={() => setIsMenuOpen(!isMenuOpen)}
                                    className='w-full py-3 flex items-center justify-between text-sm font-semibold text-primary-green-900 hover:text-primary-green-600'
                                >
                                    Tentang kami
                                    <svg xmlns="http://www.w3.org/2000/svg" className={`h-4 w-4 transition-transform ${isMenuOpen ? 'rotate-180' : ''}`} viewBox="0 0 20 20" fill="currentColor">
                                        <path fillRule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.104l3.71-3.874a.75.75 0 0 1 1.08 1.04l-4.24 4.43a.75.75 0 0 1-1.08 0l-4.24-4.43a.75.75 0 0 1 .02-1.06Z" clipRule="evenodd" />
                                    </svg>
                                </button>
                                {isMenuOpen && (
                                    <div className="pl-4 pb-3 space-y-3">
                                        <div>
                                            <div className="text-xs font-semibold text-gray-500 uppercase mb-2">Tentang Kami</div>
                                            <ul className="space-y-2 pl-2 text-sm">
                                                <li><Link to='/visi-misi' className="text-gray-700 hover:text-primary-green-600">Visi Misi</Link></li>
                                                <li><Link to="/tujuan" className="text-gray-700 hover:text-primary-green-600">Tujuan</Link></li>
                                            </ul>
                                        </div>
                                        <div>
                                            <div className="text-xs font-semibold text-gray-500 uppercase mb-2">Dokumen Legalitas</div>
                                            <ul className="space-y-2 pl-2 text-sm">
                                                <li><Link to="/akta-asosiasi-alumni" className="text-gray-700 hover:text-primary-green-600">Akta Asosiasi Alumni</Link></li>
                                                <li><Link to="/ad-art-asosiasi-alumni" className="text-gray-700 hover:text-primary-green-600">AD/ART Asosiasi Alumni</Link></li>
                                            </ul>
                                        </div>
                                        <div>
                                            <div className="text-xs font-semibold text-gray-500 uppercase mb-2">Struktur Organisasi</div>
                                            <ul className="space-y-2 pl-2 text-sm">
                                                <li><Link to="/struktur-asosiasi-alumni" className="text-gray-700 hover:text-primary-green-600">Struktur Asosiasi</Link></li>
                                            </ul>
                                        </div>
                                    </div>
                                )}
                            </div>

                            <Link to="/kontak" className='py-3 border-b border-gray-100 text-sm font-semibold text-primary-green-900 hover:text-primary-green-600'>
                                Kontak kami
                            </Link>
                            <Link to="/rekening" className='py-3 text-sm font-semibold text-primary-green-900 hover:text-primary-green-600'>
                                Rekening
                            </Link>
                        </nav>
                    </div>
                )}
            </div>
        </div>
    )
}
