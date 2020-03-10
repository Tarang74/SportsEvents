CREATE TABLE loginTable (
	userID INT AUTO_INCREMENT PRIMARY KEY,
	roleID INT,
	houseID ENUM('1', '2', '3', '4'),
	firstName TEXT,
	lastName TEXT,
	gender ENUM('Male', 'Female'),
	yearLevel INT,
	userDob DATE,
	emailAddress TEXT,
	user_username TEXT,
	user_password TEXT,
	userTS TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO
	`logintable` (
		`userID`,
		`roleID`,
		`houseID`,
		`firstName`,
		`lastName`,
		`gender`,
		`yearLevel`,
		`userDob`,
		`emailAddress`,
		`user_username`,
		`user_password`,
		`userTS`
	)
VALUES
	(
		1,
		2,
		NULL,
		'Mark',
		'Smith',
		'Male',
		NULL,
		'1985-05-04',
		'marks@citipointe.qld.edu.au',
		'marks',
		'$2y$10$3ZPZN2gOltp85eBtUYfbgO.fVgwWISDPfkle/zec3D759WLGBn4B2',
		'2020-02-15 07:42:31'
	),
	(
		2,
		3,
		'3',
		'Sean',
		'Mcloughlin',
		'Male',
		12,
		'2002-02-07',
		's12345@citipointe.qld.edu.au',
		's12345',
		'$2y$10$80.Kod9xjNrRggkz.afpWuHUuOVMubxc15NN.Un74Yp0gdblUWawK',
		'2020-02-15 07:46:33'
	),
	(
		3,
		3,
		'3',
		'Kimberely',
		'Banks',
		'Female',
		10,
		'2004-10-06',
		's12346@citipointe.qld.edu.au',
		's12346',
		'$2y$10$1cMAdCRZFqla0Gr47Yi5V.r2QJLeeZLP/uezgLLVvramKvk2q7K.O',
		'2020-02-15 07:56:54'
	);

CREATE TABLE roleTable (
	roleID INT PRIMARY KEY AUTO_INCREMENT,
	roleName TEXT
);

CREATE TABLE studentTable (
	studentID INT AUTO_INCREMENT PRIMARY KEY,
	userID INT
);

CREATE TABLE teacherTable (
	teacherID INT AUTO_INCREMENT PRIMARY KEY,
	userID INT
);

INSERT INTO
	roleTable (roleID, roleName)
VALUES
	(1, 'Admin'),
	(2, 'Teacher'),
	(3, 'Student');

CREATE TABLE houseTable (
	houseID INT PRIMARY KEY AUTO_INCREMENT,
	houseName TEXT
);

INSERT INTO
	houseTable (houseID, houseName)
VALUES
	(1, 'Asher'),
	(2, 'Ephraim'),
	(3, 'Judah'),
	(4, 'Levi');

CREATE TABLE trackApplicationTable (
	trackID INT AUTO_INCREMENT PRIMARY KEY,
	userID INT,
	trackEventID INT,
	trackYear YEAR DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE trackEventTable (
	trackEventID INT AUTO_INCREMENT PRIMARY KEY,
	trackEventName TEXT,
	trackEventTime TIME
);

INSERT INTO
	trackEventTable (trackEventID, trackEventName, trackEventTime)
VALUES
	(1, '100m (Heats)', '09:00'),
	(2, '800m', '10:30'),
	(3, '200m', '11:00'),
	(4, '100m (Finals)', '11:50'),
	(5, '400m', '12:40'),
	(6, '1500m', '13:40');

CREATE TABLE trackResultTable (
	trackResultID INT AUTO_INCREMENT PRIMARY KEY,
	userID INT,
	trackID INT,
	trackTime TIME,
	trackYear YEAR DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE trackRecordTable (
	trackRecordID INT AUTO_INCREMENT PRIMARY KEY,
	userID INT,
	trackID INT,
	trackTime TIME,
	trackYear YEAR DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE fieldApplicationTable (
	fieldID INT AUTO_INCREMENT PRIMARY KEY,
	userID INT,
	fieldEventID INT,
	fieldYear YEAR DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE fieldEventTable12 (
	fieldEventID INT AUTO_INCREMENT PRIMARY KEY,
	fieldEventName TEXT,
	fieldEventTime TIME
);

INSERT INTO
	fieldEventTable12 (fieldEventID, fieldEventName, fieldEventTime)
VALUES
	(1, 'Discus', '08:50'),
	(2, 'Long Jump', '09:55'),
	(3, 'Shot Put', '11:00'),
	(4, 'Triple Jump', '12:05'),
	(5, 'Javelin', '13:10'),
	(6, 'High Jump', '14:15');

CREATE TABLE fieldEventTable13 (
	fieldEventID INT AUTO_INCREMENT PRIMARY KEY,
	fieldEventName TEXT,
	fieldEventTime TIME
);

INSERT INTO
	fieldEventTable13 (fieldEventID, fieldEventName, fieldEventTime)
VALUES
	(1, 'High Jump', '08:50'),
	(2, 'Discus', '09:55'),
	(3, 'Long Jump', '11:00'),
	(4, 'Shot Put', '12:05'),
	(5, 'Triple Jump', '13:10'),
	(6, 'Javelin', '14:15');

CREATE TABLE fieldEventTable14 (
	fieldEventID INT AUTO_INCREMENT PRIMARY KEY,
	fieldEventName TEXT,
	fieldEventTime TIME
);

INSERT INTO
	fieldEventTable14 (fieldEventID, fieldEventName, fieldEventTime)
VALUES
	(1, 'Javelin', '08:50'),
	(2, 'High Jump', '09:55'),
	(3, 'Discus', '11:00'),
	(4, 'Long Jump', '12:05'),
	(5, 'Shot Put', '13:10'),
	(6, 'Triple Jump', '14:15');

CREATE TABLE fieldEventTable15 (
	fieldEventID INT AUTO_INCREMENT PRIMARY KEY,
	fieldEventName TEXT,
	fieldEventTime TIME
);

INSERT INTO
	fieldEventTable15 (fieldEventID, fieldEventName, fieldEventTime)
VALUES
	(1, 'Triple Jump', '08:50'),
	(2, 'Javelin', '09:55'),
	(3, 'High Jump', '11:00'),
	(4, 'Discus', '12:05'),
	(5, 'Long Jump', '13:10'),
	(6, 'Shot Put', '14:15');

CREATE TABLE fieldEventTable16 (
	fieldEventID INT AUTO_INCREMENT PRIMARY KEY,
	fieldEventName TEXT,
	fieldEventTime TIME
);

INSERT INTO
	fieldEventTable16 (fieldEventID, fieldEventName, fieldEventTime)
VALUES
	(1, 'Shot Put', '08:50'),
	(2, 'Triple Jump', '09:55'),
	(3, 'Javelin', '11:00'),
	(4, 'High Jump', '12:05'),
	(5, 'Discus', '13:10'),
	(6, 'Long Jump', '14:15');

CREATE TABLE fieldEventTable17 (
	fieldEventID INT AUTO_INCREMENT PRIMARY KEY,
	fieldEventName TEXT,
	fieldEventTime TIME
);

INSERT INTO
	fieldEventTable17 (fieldEventID, fieldEventName, fieldEventTime)
VALUES
	(1, 'Long Jump', '08:50'),
	(2, 'Shot Put', '09:55'),
	(3, 'Triple Jump', '11:00'),
	(4, 'Javelin', '12:05'),
	(5, 'High Jump', '13:10'),
	(6, 'Discus', '14:15');

CREATE TABLE fieldResultTable (
	fieldResultID INT AUTO_INCREMENT PRIMARY KEY,
	userID INT,
	fieldID INT,
	fieldDistance FLOAT,
	fieldYear YEAR DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE fieldRecordTable (
	fieldRecordsID INT AUTO_INCREMENT PRIMARY KEY,
	userID INT,
	fieldID INT,
	fieldDistance FLOAT,
	fieldYear YEAR DEFAULT CURRENT_TIMESTAMP
);