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
  interval: 50,


refreshApiCallback: async (param) => {
  try {
    const response = await axios.post("/refresh", param, {
      headers: { 'Authorization': `Bearer ${param.refreshToken}` }
    });
    console.log("Refreshing");
    return {
      isSuccess: true,
      newAuthToken: response.data.access_token as string,
      newAuthTokenExpireIn: 10,
      newRefreshTokenExpiresIn: 60
    };
  } catch (error) {
    console.error(error);
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
    <RAKAuthProvider store={createAuthStore({
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
