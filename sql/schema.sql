CREATE TABLE applicant_info(
    applicantID INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR (32),
    lastName VARCHAR (32),
    age INT,
    gender VARCHAR (32),
    a_birthday DATE,
    a_email VARCHAR (64),
    contact_number VARCHAR (64),
    a_status VARCHAR (32),
    date_added DATETIME DEFAULT CURRENT_TIMESTAMP
);