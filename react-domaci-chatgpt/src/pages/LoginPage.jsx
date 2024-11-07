import React, { useState } from "react";
import { useNavigate } from "react-router-dom";

function LoginPage({ setIsLoggedIn }) {
	const [username, setUsername] = useState("");
	const [password, setPassword] = useState("");
	const [errorMessage, setErrorMessage] = useState("");
	const navigate = useNavigate();

	const validUsername = "admin";
	const validPassword = "admin";

	const handleSubmit = (e) => {
		e.preventDefault();
		if (username === validUsername && password === validPassword) {
			setIsLoggedIn(true);
			navigate("/chat");
		} else {
			setErrorMessage("Invalid username or password.");
		}
	};

	return (
		<div className="container d-flex justify-content-center align-items-center min-vh-100 bg-light">
			<div className="shadow-lg p-5 bg-white rounded">
				<h2 className="text-center mb-4 text-success">Login</h2>
				{errorMessage && (
					<div className="alert alert-danger">{errorMessage}</div>
				)}
				<form onSubmit={handleSubmit}>
					<div className="mb-3">
						<label htmlFor="username" className="form-label">
							Username
						</label>
						<input
							type="text"
							id="username"
							className="form-control"
							value={username}
							onChange={(e) => setUsername(e.target.value)}
							required
						/>
					</div>
					<div className="mb-3">
						<label htmlFor="password" className="form-label">
							Password
						</label>
						<input
							type="password"
							id="password"
							className="form-control"
							value={password}
							onChange={(e) => setPassword(e.target.value)}
							required
						/>
					</div>
					<button type="submit" className="btn btn-success w-100">
						Login
					</button>
				</form>
			</div>
		</div>
	);
}

export default LoginPage;
