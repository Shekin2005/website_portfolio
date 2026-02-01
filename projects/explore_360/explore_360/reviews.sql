-- refer to establishments_db
USE establishments_db;


-- Create the reviews table (3 fields + primary key ID)
-- First field is a reference from first table ID, second field for reviews, 3rd for Star Rating
CREATE TABLE IF NOT EXISTS review(
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    establishment_name VARCHAR(100), -- Foreign Key to link review table with establishment table
    FOREIGN KEY(establishment_name) REFERENCES establishment(establishment_name),
    reviews TEXT, -- use TEXT data type to store large strings for reviews
    star_rating VARCHAR (5) -- hold up to 5 stars
);

-- INSERT INTO review (establishment_name, reviews, star_rating) VALUES
-- Sample data
-- ('Acadia University', 'sample review', '★★★★★');

-- Display the table structure
DESCRIBE review;