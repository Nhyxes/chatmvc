-- Table pour les utilisateurs
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(50) NOT NULL,
    user_email VARCHAR(100) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Table pour les salons de discussion
CREATE TABLE rooms (
    room_id INT AUTO_INCREMENT PRIMARY KEY,
    room_name VARCHAR(100) NOT NULL
);
-- Table pour les messages
CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    msg_text TEXT NOT NULL,
    user_id INT NOT NULL,
    room_id INT NOT NULL,
    msg_color VARCHAR(8) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (room_id) REFERENCES rooms(room_id)
);
INSERT INTO rooms (room_name) VALUES
('Salle 1'),
('Salle 2'),
('Salle 3'),
('Salle 4');

-- ALTER TABLE rooms AUTO_INCREMENT = 1; remmetre le compteur a zero