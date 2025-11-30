import React from 'react';
import useIsAuthenticated from 'react-auth-kit/hooks/useIsAuthenticated';

interface AuthProps {
    children: React.ReactNode;
}

export const Authenticated = ({ children }: AuthProps) => {
    const isAuthenticated = useIsAuthenticated();
    return isAuthenticated ? <>{children}</> : null;
};
