// ProtectedRoute.tsx
import { Navigate, Outlet } from 'react-router-dom';
import useAuthHeader from 'react-auth-kit/hooks/useAuthHeader';

const ProtectedRoute = () => {
  const authHeader = useAuthHeader(); // ✅ Hook called at top level
  if (authHeader === "" || authHeader === null) {
    return <Navigate to='/login' replace />;
  }

  return <Outlet />;
};

export default ProtectedRoute;
