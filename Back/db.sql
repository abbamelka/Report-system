CREATE DATABASE reportdb;
USE reportdb;
CREATE TABLE userTable (
    id INT AUTO_INCREMENT unique,  -- Auto-incrementing ID
    uname VARCHAR(255) NOT NULL,        -- Username, unique, not null
    usertype VARCHAR(50) NOT NULL,
    Userpassword VARCHAR(255) NOT NULL,     -- Password for user
    Creationdate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Date of creation, default is current timestamp
    CONSTRAINT uname PRIMARY KEY (uname)   -- uname is the primary key
);

CREATE TABLE report (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- Auto-incrementing ID
    Reporttype VARCHAR(255),                  -- Type of the report (varchar)
    area VARCHAR(255),                  -- Area related to the report (varchar)
    Reportsubject VARCHAR(255),               -- Subject/title of the report (varchar)
    detail TEXT,                        -- Detailed text of the report
    uname VARCHAR(255),                 -- Username related to the report (foreign key)
    Creationdate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Date of creation of the report
    CONSTRAINT fk_user FOREIGN KEY (uname) REFERENCES userTable(uname)   -- Foreign key constraint
);

INSERT INTO userTable (uname,usertype, Userpassword)
VALUES ('Administrator', 'admin','Dragona-99' );
