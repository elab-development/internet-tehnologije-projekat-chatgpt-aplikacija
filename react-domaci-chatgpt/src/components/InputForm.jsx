import React, { useState } from "react";

function InputForm({ onSubmit }) {
	const [input, setInput] = useState("");

	const handleChange = (e) => setInput(e.target.value);

	const handleSubmit = (e) => {
		e.preventDefault();
		if (input.trim()) {
			onSubmit(input);
			setInput("");
		} else {
			alert("Please enter a message");
		}
	};

	return (
		<form onSubmit={handleSubmit} className="mt-3">
			<div className="input-group">
				<input
					type="text"
					className="form-control"
					placeholder="Type a message"
					value={input}
					onChange={handleChange}
				/>
				<button className="btn btn-success" type="submit">
					Send
				</button>
			</div>
		</form>
	);
}

export default InputForm;
