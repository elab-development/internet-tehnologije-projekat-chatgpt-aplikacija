import React from "react";
import { Link } from "react-router-dom";
import logo from "../assets/logo.jpg";
import Button from "../components/Button";

function HomePage({ isLoggedIn }) {
	return (
		<div className="home-page d-flex justify-content-center align-items-center min-vh-100 bg-light">
			<div
				className="text-center p-5 shadow-lg rounded bg-white w-100"
				style={{
					maxWidth: "900px",
					minWidth: "500px",
				}}
			>
				<img
					src={logo}
					alt="Chatbot Logo"
					className="mb-4 img-fluid rounded-circle"
					style={{ maxWidth: "200px", height: "auto" }}
				/>

				<h1 className="display-4 text-success fw-bold mb-3">
					Welcome to the Chatbot
				</h1>

				<p className="lead mb-4 text-muted fs-5">
					Chat with our AI assistant and get quick, helpful answers in
					real-time. Whether you need information, advice, or just want to talk,
					our chatbot is here to help.
				</p>

				<Link to={isLoggedIn ? "/chat" : "/login"}>
					<Button
						label="Start Chat"
						className="btn-success btn-lg shadow mb-5"
					/>
				</Link>

				<div>
					<p className="text-muted fs-5">Need more information?</p>
					<Link to="/about">
						<Button
							label="Learn More"
							className="btn-outline-secondary btn-md"
						/>
					</Link>
				</div>
			</div>
		</div>
	);
}

export default HomePage;
