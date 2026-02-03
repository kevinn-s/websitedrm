
import Header from '@/components/Header';
import React, { useEffect } from 'react';
import { useNavigation, useLocation } from 'react-router-dom'
import Information from '@/pages/profile/Information';
import Publications from '@/pages/profile/Publications';
import Articles from '@/pages/profile/Articles';
import Activites from '@/pages/profile/Activites';

export default function Index () {
    const location = useLocation();

    const onSidebar = () => {
        switch (location.pathname) {
            case '/profil':
                return (<Information />);
                break;
            case '/profil/karya-ilmiah':
                return (<Publications />);
                break;
            case '/profil/artikel':
                return (<Articles />);
                break;
            case '/profil/karya-ilmiah':
                return (<Activites />);
                break;
            default:
                break;
        }
    }
    return (
        <div className='w-full min-h-screen bg-gray-50'>
            <Header />

            <div className="grid grid-cols-2 col-span-2">
                <div>
                    w
                </div>
                <div>
                    {onSidebar()}
                </div>
            </div>

        </div>

    )
}
