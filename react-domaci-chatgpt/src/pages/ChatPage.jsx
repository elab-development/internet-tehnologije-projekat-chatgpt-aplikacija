import React, { useState } from "react";
import { Container, Row, Col, Card } from "react-bootstrap";
import InputForm from "../components/InputForm";

function ChatPage() {
	const [messages, setMessages] = useState([]);

	const handleSubmit = (message) => {
		setMessages((prevMessages) => [
			...prevMessages,
			{ sender: "user", text: message },
		]);
		setTimeout(() => {
			setMessages((prevMessages) => [
				...prevMessages,
				{ sender: "chatgpt", text: `Hi, how can I assist you?` },
			]);
		}, 1000);
	};

	return (
		<div className="bg-light py-5">
			<Container>
				<Row className="text-center mb-4">
					<Col>
						<h2 className="text-success fw-bold">Chat with the AI Chatbot</h2>
						<p className="lead text-muted">
							Ask anything and get instant responses. Our AI Chatbot is ready to
							help.
						</p>
					</Col>
				</Row>

				<Row className="justify-content-center">
					<Col md={8} lg={6}>
						<Card className="shadow-lg border-0 rounded-3">
							<Card.Body>
								<div className="chat-box mb-3" style={{ maxHeight: "400px" }}>
									{messages.map((msg, id) => (
										<div key={id} className={`message ${msg.sender} mb-3`}>
											<strong>
												{msg.sender === "user" ? "You" : "Chatbot"}:
											</strong>{" "}
											{msg.text}
										</div>
									))}
								</div>

								<InputForm onSubmit={handleSubmit} />
							</Card.Body>
						</Card>
					</Col>
				</Row>
			</Container>
		</div>
	);
}

export default ChatPage;
