import { useNavigate } from "react-router-dom";

function ProtectedRoute({ isLoggedIn, children, redirectTo }) {
	const navigate = useNavigate();
	if (!isLoggedIn) {
		navigate(redirectTo);
		return null;
	}
	return children;
}

export default ProtectedRoute;
