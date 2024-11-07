import React from "react";
import { Col, Card } from "react-bootstrap";

const AboutCard = ({ pic, name, text }) => {
	return (
		<Col md={6} className="mb-4">
			<Card className="shadow-lg border-0 rounded-3 text-center">
				<Card.Img
					variant="top"
					src={pic}
					alt={name}
					className="img-fluid rounded-circle w-50 mx-auto mt-3"
					style={{ height: "200px", objectFit: "cover" }}
				/>
				<Card.Body>
					<Card.Title className="text-success">{name}</Card.Title>
					<Card.Text className="text-muted">{text}</Card.Text>
				</Card.Body>
			</Card>
		</Col>
	);
};

export default AboutCard;
