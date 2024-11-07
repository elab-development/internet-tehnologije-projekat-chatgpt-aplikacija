import React, { useState } from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import HomePage from "./pages/HomePage";
import ChatPage from "./pages/ChatPage";
import AboutPage from "./pages/AboutPage";
import LoginPage from "./pages/LoginPage";
import Navbar from "./components/Navbar";
import ProtectedRoute from "./components/ProtectedRoute";
import Footer from "./components/Footer";
import "./index.css";

function App() {
	const [isLoggedIn, setIsLoggedIn] = useState(false);

	return (
		<Router>
			<div className="d-flex flex-column min-vh-100">
				<Navbar isLoggedIn={isLoggedIn} setIsLoggedIn={setIsLoggedIn} />
				<div className="container py-3 flex-grow-1">
					<Routes>
						<Route path="/" element={<HomePage isLoggedIn={isLoggedIn} />} />
						<Route
							path="/login"
							element={<LoginPage setIsLoggedIn={setIsLoggedIn} />}
						/>
						<Route
							path="/chat"
							element={
								<ProtectedRoute isLoggedIn={isLoggedIn} redirectTo="/login">
									<ChatPage />
								</ProtectedRoute>
							}
						/>
						<Route
							path="/about"
							element={<AboutPage isLoggedIn={isLoggedIn} />}
						/>
					</Routes>
				</div>
				<Footer />
			</div>
		</Router>
	);
}

export default App;
