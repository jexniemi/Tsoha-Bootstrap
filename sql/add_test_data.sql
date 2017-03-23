-- INSERT INTO Customer (username, password, birthday, city, country, gender) VALUES ();
-- INSERT INTO Relationship (type, gender) VALUES ();
-- INSERT INTO LookingFor (relationship, customer) VALUES ();
-- INSERT INTO Message (receiver, title, content, customer) VALUES ();
-- INSERT INTO Page (title, content, private, customer) VALUES ();
-- INSERT INTO Invoice (amount, customer) VALUES ();
-- INSERT INTO Access (page, customer) VALUES ();

INSERT INTO Customer (username, password, birthday, city, country, gender) VALUES 
('jukka3', 'paavali123', '1992-06-25', 'Espoo', 'Finland', 'm');

INSERT INTO Relationship (type, gender) VALUES ('beer buddies', 'm');

INSERT INTO Message (receiver, title, content) VALUES ('jukka56', 'hello world', 'heippa vaan');

INSERT INTO Page (title, content, private) VALUES ('minun esittelysivu', 'plaa plaa', true);

INSERT INTO Invoice (amount) VALUES (52.50);

