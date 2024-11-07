import React, { useState } from "react";
import { Container, Row, Col } from "react-bootstrap";
import { FaExchangeAlt } from "react-icons/fa";
import { Link } from "react-router-dom";
import mihajloPic from "../assets/mihajlo_pic.jpg";
import bogdanPic from "../assets/bogdan_pic.jpg";
import Button from "../components/Button";
import DevInfoCard from "../components/DevInfoCard";

function AboutPage({ isLoggedIn }) {
	let mihajloObj = {
		name: "Mihajlo",
		text: "Mihajlo is passionate about Machine Learning and the vast potential AI has in changing the world. With a background in data science and machine learning, he’s constantly exploring new ways to improve AI-based applications.",
	};

	let bogdanObj = {
		name: "Bogdan",
		text: "Bogdan is a developer who specializes in .NET but is always excited to explore new technologies. With a keen interest in software architecture and building scalable applications, he is a problem solver who loves tackling new challenges.",
	};

	const [isSwapped, setIsSwapped] = useState(false);

	const toggleCards = () => {
		setIsSwapped((prevState) => !prevState);
	};

	return (
		<Container className="my-5">
			<Row>
				<Col md={12}>
					<h2 className="text-center mb-4 text-success">About the Chatbot</h2>
					<p className="lead text-center mb-5 text-muted">
						Welcome to our custom-built chatbot! This app is built using React
						and Bootstrap to showcase a simple and interactive conversational
						chatbot. The chatbot is designed to provide responses based on your
						inputs, demonstrating the power of AI in today's world.
					</p>
				</Col>
			</Row>

			<Row className="mb-5">
				<Col md={12}>
					<h3 className="text-center mb-4 text-success">Meet the Developers</h3>
				</Col>

				{!isSwapped ? (
					<>
						<DevInfoCard
							name={mihajloObj.name}
							pic={mihajloPic}
							text={mihajloObj.text}
						/>
						<DevInfoCard
							name={bogdanObj.name}
							pic={bogdanPic}
							text={bogdanObj.text}
						/>
					</>
				) : (
					<>
						<DevInfoCard
							name={bogdanObj.name}
							pic={bogdanPic}
							text={bogdanObj.text}
						/>
						<DevInfoCard
							name={mihajloObj.name}
							pic={mihajloPic}
							text={mihajloObj.text}
						/>
					</>
				)}
			</Row>

			<Row className="text-center mb-4">
				<Col>
					<FaExchangeAlt
						onClick={toggleCards}
						style={{
							cursor: "pointer",
							fontSize: "2rem",
							color: "#28a745",
						}}
					/>
				</Col>
			</Row>

			<Row className="text-center mt-5">
				<Col>
					<Link to={isLoggedIn ? "/chat" : "/login"}>
						<Button
							label="Start Chatting Now!"
							className="cta-button px-4 py-2 btn-success"
						/>
					</Link>
				</Col>
			</Row>
		</Container>
	);
}

export default AboutPage;
