-- INSERT INTO Customer (username, password, birthday, city, country, gender) VALUES ();
-- INSERT INTO Relationship (type, gender) VALUES ();
-- INSERT INTO LookingFor (relationship, customer) VALUES ();
-- INSERT INTO Message (receiver, title, content, customer) VALUES ();
-- INSERT INTO Page (title, content, private, customer) VALUES ();
-- INSERT INTO Invoice (amount, customer) VALUES ();
-- INSERT INTO Access (page, customer) VALUES ();

INSERT INTO Customer (username, password, birthday, country, gender) VALUES 
('jukka3', 'paavali123', '1992-06-25', 'Finland', 'm');

INSERT INTO Message (receiver, title, content) VALUES ('jukka56', 'Hello world', 'Moi. Ollaanko ystäviä?');
INSERT INTO Message (receiver, title, content) VALUES ('sada6', 'Terve', 'Olet paras.');

INSERT INTO Page (title, content, private) VALUES ('minun esittelysivu', 'plaa plaa', true);