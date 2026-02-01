-- Database of establishments for Explore 360
CREATE DATABASE IF NOT EXISTS establishments_db;

-- Switch to the created database
USE establishments_db;

-- Create the establishment table (4 fields + primary key ID)
CREATE TABLE IF NOT EXISTS establishment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    establishment_name VARCHAR(100) NOT NULL,
    establishment_address VARCHAR(75) NOT NULL,
    rating DECIMAL(2, 1) NOT NULL,
    category VARCHAR(50) NOT NULL,
    UNIQUE (establishment_name) --make unique to use as foreign key in review table
);

CREATE USER IF NOT EXISTS 'establishments_user'@'localhost' IDENTIFIED BY 'passw0rd';
GRANT SELECT, INSERT, UPDATE, DELETE, FILE ON *.* TO 'establishments_user'@'localhost';

-- Insert establishment data into the establishment table
INSERT INTO establishment (establishment_name, rating, establishment_address, category) VALUES
-- HOTELS
('River Valley Guest Cottage', 4.6, '24 Gaspereau River Branch Rd, B4P 2R3', 'Hotel'),
('Micro Boutique Living Wolfville', 4.1, '336 Main St, B4P 1C4', 'Hotel'),
('Raven Hills Vineyards', 4.1, '11140 Nova Scotia Trunk 1, B4P 2R1', 'Hotel'),
('Old Orchard Inn', 4.1, '153 Greenwich Rd S, B4P 2R2', 'Hotel'),
('Tattingstone Inn', 4.6, '620 Main St, B4P 1E8', 'Hotel'),
('Blomidon Inn', 4.6, '195 Main St, B4P 1C3', 'Hotel'),

-- RESTAURANTS
('Troy Restaurant & Grill', 4.4, '12 Elm Avenue B4P 1Z9', 'Restaurant'),
('Jeju Restaurant - Korean & Sushi', 4.7, '8 Elm Avenue B4P 2S2', 'Restaurant'),
('Paddys Brewpub & Rosies Restaurant', 4.2, '460 Main Street B4P 1E2', 'Restaurant'),
('King Arms Commons', 4.2, '430 Main Street B4P 1E2', 'Restaurant'),
('Joes Food Emporium', 4.2, '434 Main Street B4P 1E2', 'Restaurant'),
('Tim Hortons', 3.8, '370 Main Street B4N 1K6', 'Restaurant'),
('Subway', 4.0, '471 Main Street B4P 1E3', 'Restaurant'),
('Charts Cafe', 4.5, '16 Elm Avenue B4P 2S2', 'Restaurant'),
('Juniper Food + Wine', 4.7, '389 Main Street B4P 1E1', 'Restaurant'),
('The Church Brewing Co', 4.2, '329 Main Street BAP 1C4', 'Restaurant'),
('The Library Pub and Merchant Wine Tavern', 4.4, '472 Main Street B4P 1E2', 'Restaurant'),

-- SHOPPING
('Muddys Convenience Store', 4.4, '446 Main Street B4P 1E2', 'Shopping'),
('Janes Again Store', 4.4, '390 Main Street B4P 1C9', 'Shopping'),
('Supplement King Wolfville', 4.5, '465 Main Street B4P 1A1', 'Shopping'),
('The Market - Groove Merchants', 4.8, '466 Main Street B4P 1E2', 'Shopping'),
('Rainbows End Books & Discs', 4.2, '395 Main Street B4P 1E1', 'Shopping'),
('Shoppers Drug Mart', 4.0, '433 Main Street B4P 1E1', 'Shopping'),
('Independent Grocer', 4.2, '396 Main Street B4P 1C9', 'Shopping'),
('The Wooln Tart', 4.7, '458 Main Street B4P 1E2', 'Shopping'),
('Annapolis Cider Company', 4.8, '338 Main Street B4P 1E1', 'Shopping'),
('Applewicks Craft Shoppe', 5.0, '341 Main Street B4P 2C2', 'Shopping'),

-- Things To Do
('Acadia University', 4.8, '15 University Avenue B4P 2R6', 'Things To Do'),
('Benjamin Bridge', 4.5, '966 White Rock Road Gaspereau Valley B4P 2R1','Things to Do'),
('Randall House Museum', 4.6, '259 Main Street B4P 1C6', 'Things to Do'),
('Art Exhibition', 4.7, '10 Highland Avenue B4P 2R6', 'Things to Do'),
('Wolfville Memorial Library', 4.5, '21 Elm Avenue B4P 2A1', 'Things to Do'),
('Wolfville Waterfront Park ', 4.8, ' Wolfville, NS', 'Things to Do'),
('Tangled Garden: A Sensory Escape', 5.0, 'Tangled Garden 11827 Trunk 1 Grand Pré B0P 1M0', 'Things to Do'),
('Front Street Community Oven Society', 4.9, '160 Front Street B4P 1A5', 'Things to Do'),
('Annapolis Valley Adventures', 4.6, 'Main Street', 'Things to Do'),
('Al Whittle Theatre', 4.7, '450 Main Street B4P 1E2', 'Things to Do');

-- Display the table structure
DESCRIBE establishment;
