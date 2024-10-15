CREATE DATABASE postEvents;
USE postEvents

Create TABLE user(
	id_user INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(72) NOT NULL,
    nicke_name VARCHAR(72) NOT NULL,
    email VARCHAR(72) NOT NULL,
    _password VARCHAR(72)NOT NULL,
    role CHAR(1) NOT NULL
    baneado BOOLEAN
);

CREATE TABLE post(
	id_publication INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    info_events TEXT NOT NULL,
    address VARCHAR(256) NOT NULL,
    dateTime_envets DATETIME NOT NULL,
    confirmed INT NOT NULL,
    capacity INT NOT NULL,
    url VARCHAR(256) NOT NULL,
    state_publication ENUM('ACTIVATED' , 'REFUSED', 'EARRING','BAN'),
    FOREIGN KEY (id_user) REFERENCES user(id_user) ON DELETE CASCADE
);

CREATE TABLE img (
	id_img  INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_publication INT NOT NULL,
    url TEXT,
    FOREIGN KEY (id_publication) REFERENCES publication (id_publication) ON DELETE CASCADE
);

CREATE TABLE  category(
	id_category INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(72) NOT NULL
);

CREATE TABLE tyep_category(
	id_type_category INT  NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_publication INT NOT NULL,
    id_category INT NOT NULL,
    FOREIGN KEY (id_publication) REFERENCES publication(id_publication) ON DELETE CASCADE,
    FOREIGN KEY (id_category) REFERENCES category (id_category) on DELETE CASCADE
);

CREATE TABLE publishe(
	id_publishe INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Id_user INT NOT NULL,
    COUNT INT NOT NULL,
    state boolean,
    FOREIGN KEY (id_user) REFERENCES user(id_user) ON DELETE CASCADE
);

CREATE TABLE publication_verification(
	id_verifation INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_publication INT NOT NULL,
    id_admin INT NOT NULL,
    id_publishe INT NOT NULL,
    date_verification DATE NOT NULL,
    state  BOOLEAN,
    FOREIGN KEY (id_publication) REFERENCES publication(id_publication) ON DELETE CASCADE,
    FOREIGN KEY (id_admin) REFERENCES user(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_publishe) REFERENCES publishe (id_publishe) ON DELETE CASCADE
);

CREATE TABLE events_assistance(
	id_event INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_publication INT NOT NULL,
    days INT NOT NULL,
    term DATE,
    FOREIGN KEY (id_user) REFERENCES user(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_publication) REFERENCES publication(id_publication) ON DELETE CASCADE
);



CREATE TABLE publication_baneada(
	id_publication_baneada INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_publication JSON,
    id_publishe INT NOT NULL,
    no_report INT NOT NULL,
    baneada boolean,
    FOREIGN KEY (id_publishe) REFERENCES publishe(id_publishe) ON DELETE CASCADE
);


CREATE TABLE report_publication(
	id_report INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_publication INT NOT NULL,
    id_user_report INT NOT NULL,
    id_admin INT NOT NULL,
    cause TEXT NOT NULL,
    state_publication ENUM('APPROVED' , 'REFUSED', 'EARRING'),
    FOREIGN KEY (id_publication) REFERENCES publication(id_publication) ON DELETE CASCADE,
    FOREIGN KEY (id_user_report) REFERENCES user(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_admin) REFERENCES user(id_user) ON DELETE CASCADE
);