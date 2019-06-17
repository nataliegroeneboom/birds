
CREATE TABLE sightings (
id INT NOT NULL AUTO_INCREMENT,
body TEXT,
userId INT,
birdId INT,
place VARCHAR(60),
latitude DECIMAL(8,6),
longitude DECIMAL(9,6),
postDate TIMESTAMP DEFAULT NOW(),

PRIMARY KEY (id),
FOREIGN KEY (userId) REFERENCES users(id),
FOREIGN KEY (birdId) REFERENCES birds(id)
);

CREATE TABLE images (
id INT NOT NULL AUTO_INCREMENT,
fileName VARCHAR(500),
sightingId INT,
PRIMARY KEY (id),
FOREIGN KEY (sightingId) REFERENCES sightings(id)
ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE user_bird (
user_id int NOT NULL,
bird_id int NOT NULL,
FOREIGN KEY (user_id) REFERENCES user(id),
FOREIGN KEY (bird_id) REFERENCES birds(id)
 );


-- Here I am referencing the user_bird reference table to get which users have posted siting about birds
SELECT USERS.name, birdname 
FROM users USERS 
JOIN user_bird UB on UB.user_id=USERS.id
JOIN birds BD on UB.bird_id = BD.id;




SELECT name, SIGHTING.place, postDate, fileName
FROM sightings SIGHTING
JOIN users USER ON USER.id = userId
JOIN images IMAGE on IMAGE.sightingId = SIGHTING.id
WHERE SIGHTING.birdId = 43;