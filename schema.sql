-- Database schema for ICAPO Website

-- Create Database
CREATE DATABASE IF NOT EXISTS icapo_db;
USE icapo_db;

-- 1. Registration Table
CREATE TABLE IF NOT EXISTS registration (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reg_id VARCHAR(20) NOT NULL UNIQUE,
    college_name VARCHAR(255) NOT NULL,
    staff_name VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL DEFAULT '',
    debugging INT DEFAULT 0,
    quiz INT DEFAULT 0,
    web_design INT DEFAULT 0,
    paper_present INT DEFAULT 0,
    best_manager INT DEFAULT 0,
    connection_game INT DEFAULT 0,
    short_film INT DEFAULT 0,
    veg INT DEFAULT 0,
    nonveg INT DEFAULT 0,
    total INT DEFAULT 0,
    amount INT DEFAULT 0,
    payment_status VARCHAR(20) DEFAULT 'PENDING',
    payment_date TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Schedule Table
CREATE TABLE IF NOT EXISTS schedule (
    id INT AUTO_INCREMENT PRIMARY KEY,
    time_slot VARCHAR(100) NOT NULL,
    event_name VARCHAR(255) NOT NULL,
    venue VARCHAR(255) DEFAULT '-',
    order_index INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert Initial Schedule Data
INSERT INTO schedule (time_slot, event_name, venue, order_index) VALUES
('08.30 AM - 09.30 AM', 'Registration', 'Loyola Hall', 1),
('09.30 AM - 10.00 AM', 'Inaugural Function', 'Loyola Hall', 2),
('10.15 AM - 11.30 AM', 'Script Clash', 'Loyola Hall', 3),
('10.15 AM - 10.30 AM', 'BugBusters (Prelims)', 'Fr. T.N. Siqueira Computer Centre', 4),
('10.15 AM - 10.30 AM', 'Design Hack (Prelims)', 'Fr. T.N. Siqueira Computer Centre', 5),
('10.30 AM - 11.30 AM', 'Trash to Treasure', 'Fr. T.N. Siqueira Computer Centre', 6),
('11.15 AM - 11.30 AM', 'Tea Break', '-', 7),
('11.30 AM - 11.45 AM', 'Think a Thon (Prelims)', 'Loyola Hall', 8),
('11.30 AM - 11.45 AM', 'Promoware (Prelims)', 'MCA Seminar Hall', 9),
('11.45 AM - 12.45 PM', 'BugBusters', 'Fr. T.N. Siqueira Computer Centre', 10),
('11.45 AM - 12.45 PM', 'Design Hack', 'Loyola Hall', 11),
('01.00 PM - 02.00 PM', 'Lunch', '-', 12),
('02.00 PM - 03.30 PM', 'Think a Thon', 'Loyola Hall', 13),
('02.00 PM - 03.30 PM', 'Promoware', 'MCA Seminar Hall', 14),
('03.30 PM - 04.00 PM', 'Tea Break', '-', 15),
('04.00 PM - 05.00 PM', 'Valedictory Function', '-', 16);

-- 3. Contacts Table (for messages)
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    status VARCHAR(20) DEFAULT 'UNREAD', -- UNREAD, READ, REPLIED
    admin_reply TEXT NULL,
    replied_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. Settings Table
CREATE TABLE IF NOT EXISTS settings (
    config_key VARCHAR(50) PRIMARY KEY,
    config_value TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert Default Settings
INSERT IGNORE INTO settings (config_key, config_value) VALUES 
('reg_status', 'open'),
('admin_email', 'admin@icapo.com'),
('portal_name', 'ICAPO Admin Portal');

-- 5. Participants Table (name per event for certificates)
CREATE TABLE IF NOT EXISTS participants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reg_id VARCHAR(20) NOT NULL,
    event_name VARCHAR(100) NOT NULL,
    participant_name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (reg_id) REFERENCES registration(reg_id) ON DELETE CASCADE
);

