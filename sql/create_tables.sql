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
	relationship_id SERIAL PRIMARY KEY,
	type VARCHAR(20) NOT NULL UNIQUE,
	gender CHAR(1)
);

CREATE TABLE LookingFor(
	relationship INTEGER REFERENCES Relationship,
	customer INTEGER REFERENCES Customer
);


CREATE TABLE Message(
	message_id SERIAL PRIMARY KEY,
	receiver VARCHAR(15) NOT NULL,
	title VARCHAR(20) NOT NULL,
	content VARCHAR(2000) NOT NULL,
	time Timestamp NOT NULL,
	customer INTEGER REFERENCES Customer
);

CREATE TABLE Page(
	page_id SERIAL PRIMARY KEY,
	title VARCHAR(20) NOT NULL,
	content VARCHAR(2000) NOT NULL,
	private boolean DEFAULT FALSE,
	customer INTEGER REFERENCES Customer
);

CREATE TABLE Invoice(
	invoice_id SERIAL PRIMARY KEY,
	customer SERIAL,
	amount FLOAT NOT NULL,
	time Timestamp NOT NULL,
	customer INTEGER REFERENCES Customer
);

CREATE TABLE Access(
	page INTEGER REFERENCES Page,
	customer INTEGER REFERENCES Customer
);
