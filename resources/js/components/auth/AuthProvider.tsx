import RAKAuthProvider from 'react-auth-kit';
import createAuthStore from 'react-auth-kit/createStore';
import createRefresh from 'react-auth-kit/createRefresh';
import useAuthHeader from 'react-auth-kit/hooks/useAuthHeader'
import useIsAuthenticated from 'react-auth-kit/hooks/useIsAuthenticated';
import axios from 'axios'

type Props = {
    children: React.ReactNode;
};

export function AuthProvider({ children }: Props) {

    const refresh = createRefresh({
        interval: 9, // Refresh 1 minute before the 10-minute token expiry
        refreshApiCallback: async (param) => {
            try {
                const response = await axios.post("/api/auth/refresh", {}, {
                    headers: { 'Authorization': `Bearer ${param.authToken}` }
                });
                return {
                    isSuccess: true,
                    newAuthToken: response.data.access_token as string,
                    newAuthTokenExpireIn: 10, // 10 minutes
                    newRefreshTokenExpiresIn: 60 // 60 minutes for refresh window
                };
            } catch (error) {
                console.error("Refresh failed", error);
                return {
                    isSuccess: false,
                    newAuthToken: "",
                    newAuthTokenExpireIn: 0,
                    newRefreshTokenExpiresIn: 0
                };
            }
        }
    })

    return (
        <RAKAuthProvider store={
            createAuthStore({
                authName: '_auth',
                cookieDomain: window.location.hostname,
                cookieSecure: window.location.protocol === 'https:',  // Only true on HTTPS
                authType: 'cookie',
                refresh: refresh
            })}>
            {children}
        </RAKAuthProvider>
    );
}

export default AuthProvider;
