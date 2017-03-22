CREATE TABLE Customer(
	customer_id SERIAL PRIMARY KEY,
	username VARCHAR(15) NOT NULL UNIQUE,
	password VARCHAR(15) NOT NULL,
	birthday date NOT NULL,
	city VARCHAR(30) NOT NULL,
	country VARCHAR(30) NOT NULL,
	gender VARCHAR(1) NOT NULL,
	last_seen Timestamp NOT NULL
);

CREATE TABLE Relationship(
	type_id SERIAL PRIMARY KEY,
	type VARCHAR(20) NOT NULL UNIQUE,
	gender CHAR(1)
);

CREATE TABLE LookingFor(
	FOREIGN KEY(relationship) REFERENCES Relationship(relationship_id),
	FOREIGN KEY(customer) REFERENCES Customer(customer_id)
);	


CREATE TABLE Message(
	message_id SERIAL PRIMARY KEY,
	receiver VARCHAR(15) NOT ǸULL,
	title VARCHAR(20) NOT NULL,
	content VARCHAR(2000) NOT NULL,
	time Timestamp NOT NULL,
	FOREIGN KEY(customer) REFERENCES Customer(customer_id)
);

CREATE TABLE Page(
	page_id SERIAL PRIMARY KEY,
	title VARCHAR(20) NOT NULL,
	content VARCHAR(2000) NOT NULL,
	private boolean DEFAULT FALSE,
	FOREIGN KEY(customer) REFERENCES Customer(customer_id)
);

CREATE TABLE Invoice(
	invoice_id SERIAL PRIMARY KEY,
	amount FLOAT NOT NULL,
	time Timestamp NOT NULL,
	FOREIGN KEY(customer) REFERENCES Customer(customer_id)
);

CREATE TABLE Access(
	FOREIGN KEY(page) REFERENCES Page(page_id),
	FOREIGN KEY(customer) REFERENCES Customer(customer_id)
);
