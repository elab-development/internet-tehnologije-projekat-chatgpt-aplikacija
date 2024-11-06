import React from "react";
import { Link } from "react-router-dom";
import logo from "../assets/logo.jpg";

function HomePage() {
	return (
		<div
			className="home-page d-flex justify-content-center align-items-center min-vh-100 bg-light"
			style={{
				backgroundImage: 'url("https://your-image-url-here.jpg")',
				backgroundSize: "cover",
				backgroundPosition: "center",
			}}
		>
			<div className="text-center p-5 shadow-lg rounded bg-white opacity-90">
				<img
					src={logo}
					alt="ChatGPT Logo"
					className="mb-4"
					style={{ width: "150px", height: "auto" }}
				/>

				{/* Main Heading */}
				<h1 className="display-4 text-primary mb-3">
					Welcome to the ChatGPT App
				</h1>

				{/* Subheading */}
				<p className="lead mb-4 text-muted">
					Interact with ChatGPT and get instant, intelligent responses in
					real-time.
				</p>

				{/* Main Action Button */}
				<Link to="/chat" className="btn btn-lg btn-primary shadow mb-3">
					Start Chat
				</Link>

				{/* Secondary Action Button or Text */}
				<div>
					<p className="text-muted">Need more information?</p>
					<Link to="/about" className="btn btn-outline-secondary btn-sm">
						Learn More
					</Link>
				</div>
			</div>
		</div>
	);
}

export default HomePage;
