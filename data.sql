USE festival_app;

-- users of the organization who should be able to login and manage the festival, planning, etc. 
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created DATETIME,
    modified DATETIME,
    UNIQUE KEY (email)
)  CHARSET=utf8mb4;

-- main festival characteristics 
CREATE TABLE festivals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(191) NOT NULL,
    description TEXT,
    created DATETIME,
    modified DATETIME,
    UNIQUE KEY (slug)
)  CHARSET=utf8mb4;

-- dates on which the festivals take place, incl. start &  end time
CREATE TABLE dates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    festival_id INT NOT NULL,
    slug VARCHAR(10) NOT NULL,
    starttime DATETIME NOT NULL, 
    endtime DATETIME NOT NULL,
    created DATETIME,
    modified DATETIME,
    UNIQUE KEY (slug),
    FOREIGN KEY festival_key (festival_id) REFERENCES festivals(id)
)  CHARSET=utf8mb4;

-- main band characteristics 
CREATE TABLE bands (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(191) NOT NULL,
    description TEXT,
    created DATETIME,
    modified DATETIME,
    UNIQUE KEY (slug)
)  CHARSET=utf8mb4;

-- stages available on a festival 
CREATE TABLE stages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    festival_id INT NOT NULL, 
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(191) NOT NULL,
    created DATETIME,
    modified DATETIME,
    UNIQUE KEY (slug),
    FOREIGN KEY festival_key (festival_id) REFERENCES festivals(id)
)  CHARSET=utf8mb4;

-- timetables table: links bands, festival, festival planning & stage
-- table includes start & end time
CREATE TABLE timetables (
    band_id INT NOT NULL,
    festival_id INT NOT NULL, 
    date_id INT NOT NULL,
    stage_id INT NOT NULL,
    starttime VARCHAR(5) NOT NULL,
    endtime VARCHAR(5) NOT NULL,
    created DATETIME,
    modified DATETIME,
    PRIMARY KEY (band_id, festival_id, date_id, stage_id),
    FOREIGN KEY band_key(band_id) REFERENCES bands(id),
    FOREIGN KEY festival_key(festival_id) REFERENCES festivals(id),
    FOREIGN KEY date_key(date_id) REFERENCES dates(id),
    FOREIGN KEY stage_key(stage_id) REFERENCES stages(id)
) CHARSET=utf8mb4;

-- main visitor characteristics 
CREATE TABLE visitors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    created DATETIME,
    modified DATETIME,
    UNIQUE KEY (email)
)  CHARSET=utf8mb4;

-- tickets table: links visitor, fesival & dates  
-- includes confirmed boolean to store whether the email was sent
CREATE TABLE tickets (
    festival_id INT NOT NULL, 
    date_id INT NOT NULL,
    visitor_id INT NOT NULL,
    confirmed BOOLEAN DEFAULT FALSE,
    created DATETIME,
    modified DATETIME,
    PRIMARY KEY (visitor_id, festival_id, date_id),
    FOREIGN KEY festival_key(festival_id) REFERENCES festivals(id),
    FOREIGN KEY date_key(date_id) REFERENCES dates(id),
    FOREIGN KEY visitor_key(visitor_id) REFERENCES visitors(id)
) CHARSET=utf8mb4;

INSERT INTO users (email, password, created, modified) VALUES
('cakephp@example.com', 'secret', NOW(),NOW());

INSERT INTO festivals (title, slug, description, created, modified) VALUES
('Leidsche Rijn Mahler Festival', 'leidsche-rijn-mahler-festival', 'Come and enjoy the best & only Mahler festival in the World, in the best place to live: Leidsche Rijn!', NOW(),NOW());

INSERT INTO bands (name, slug, description, created, modified) VALUES
('KCO', 'kco', 'Best orchestra of the world & Amsterdam!', NOW(),NOW()),
('RPO', 'RPO', 'Best orchestra of Rotterdam', NOW(),NOW()),
('Radio Philharmonisch Orkest', 'Radio-Philharmonisch-Orkest', 'Beautiful orchestra often performs on TV and radio live recordings.', NOW(),NOW());

INSERT INTO dates (festival_id, slug, starttime, endtime, created, modified) VALUES
(1, '2020-07-04', '2020-07-04 14:00:00', '2020-07-04 23:00:00', NOW(),NOW()),
(1, '2020-07-05', '2020-07-05 14:00:00', '2020-07-05 23:00:00', NOW(),NOW());
