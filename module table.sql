CREATE TABLE programmes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    programme_name VARCHAR(255) NOT NULL,
    programme_leader VARCHAR(255) NOT NULL
);

CREATE TABLE modules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    module_name VARCHAR(255) NOT NULL,
    module_code VARCHAR(50) NOT NULL UNIQUE,
    lecturer VARCHAR(255),
    credits INT,
    semester ENUM('Fall', 'Spring', 'Summer'),
    programme_id INT,
    FOREIGN KEY (programme_id) REFERENCES programmes(id) ON DELETE CASCADE
);

INSERT INTO programmes (programme_name, programme_leader) VALUES
('Computer Science', 'Dr. John Smith'),
('Business Management', 'Prof. Emily Johnson');

INSERT INTO modules (module_name, module_code, lecturer, credits, semester, programme_id) VALUES
('Introduction to Programming', 'CS101', 'Dr. John Smith', 4, 'Fall', 1),
('Database Management', 'CS303', 'Dr. Michael Brown', 3, 'Fall', 1),
('Marketing Strategies', 'BM201', 'Dr. Susan Clark', 3, 'Spring', 2);
