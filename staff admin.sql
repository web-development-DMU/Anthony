CREATE DATABASE student_course_hub;
USE student_course_hub;

CREATE TABLE staff (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    department VARCHAR(100),
    email VARCHAR(100)
);

INSERT INTO staff (name, department, email) VALUES
('Dr. John Smith', 'Computer Science', 'john.smith@university.ac.uk'),
('Prof. Emily Johnson', 'Mathematics', 'emily.johnson@university.ac.uk'),
('Dr. Michael Brown', 'Physics', 'michael.brown@university.ac.uk');
