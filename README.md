# obitu_search table scripts
CREATE TABLE obituaries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    date_of_birth DATE,
    date_of_death DATE,
    content TEXT,
    author VARCHAR(100),
    submission_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    slug VARCHAR(255) UNIQUE
);
