CREATE TABLE Customer(
	customer_id SERIAL PRIMARY KEY,
	username VARCHAR(15) NOT NULL UNIQUE,
	password VARCHAR(15) NOT NULL,
	age INTEGER NOT NULL,
	country VARCHAR(30) NOT NULL,
	gender VARCHAR(1) NOT NULL,
	last_seen Timestamp,
        lf_type VARCHAR(20),
        lf_agemin INTEGER,
        lf_agemax INTEGER,
        lf_gender VARCHAR(1)
);


CREATE TABLE Message(
	message_id SERIAL PRIMARY KEY,
	receiver INTEGER REFERENCES Customer(customer_id),
	title VARCHAR(20) NOT NULL,
	content VARCHAR(2000) NOT NULL,
	time Timestamp,
	sender INTEGER REFERENCES Customer(customer_id)
);

CREATE TABLE Page(
	page_id SERIAL PRIMARY KEY,
	title VARCHAR(20) NOT NULL,
	content VARCHAR(2000) NOT NULL,
	private boolean DEFAULT FALSE,
	customer INTEGER REFERENCES Customer
);


CREATE TABLE Access(
	page INTEGER REFERENCES Page,
	customer INTEGER REFERENCES Customer
);
