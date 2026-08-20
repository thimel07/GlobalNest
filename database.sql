CREATE DATABASE IF NOT EXISTS globalnest;

USE globalnest;


CREATE TABLE users (

    id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(100) NOT NULL,

    email VARCHAR(150) NOT NULL UNIQUE,

    password VARCHAR(255) NOT NULL,

    country VARCHAR(100),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);


CREATE TABLE countries (

    id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(100) NOT NULL,

    description TEXT,

    image VARCHAR(255)

);


CREATE TABLE universities (

    id INT AUTO_INCREMENT PRIMARY KEY,

    country_id INT,

    name VARCHAR(200) NOT NULL,

    city VARCHAR(100),

    description TEXT,

    website VARCHAR(255),

    FOREIGN KEY (country_id)
    REFERENCES countries(id)
    ON DELETE CASCADE

);


CREATE TABLE properties (

    id INT AUTO_INCREMENT PRIMARY KEY,

    title VARCHAR(200) NOT NULL,

    country VARCHAR(100),

    city VARCHAR(100),

    property_type VARCHAR(50),

    price DECIMAL(10,2),

    university VARCHAR(200),

    university_distance VARCHAR(50),

    workplace_distance VARCHAR(50),

    safety VARCHAR(50),

    rooms INT,

    description TEXT,

    image VARCHAR(255),

    user_id INT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id)
    REFERENCES users(id)
    ON DELETE SET NULL

);


CREATE TABLE roommates (

    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT,

    age INT,

    country VARCHAR(100),

    budget DECIMAL(10,2),

    cleanliness VARCHAR(50),

    smoking VARCHAR(20),

    study_style VARCHAR(50),

    description TEXT,

    image VARCHAR(255),

    FOREIGN KEY (user_id)
    REFERENCES users(id)
    ON DELETE CASCADE

);


CREATE TABLE bookings (

    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT,

    property_id INT,

    booking_date DATE,

    message TEXT,

    status VARCHAR(30) DEFAULT 'Pending',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id)
    REFERENCES users(id)
    ON DELETE CASCADE,

    FOREIGN KEY (property_id)
    REFERENCES properties(id)
    ON DELETE CASCADE

);


INSERT INTO countries
(name, description, image)
VALUES

(
'United Kingdom',
'Study in historic cities such as London, Manchester and Birmingham.',
'https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?auto=format&fit=crop&w=800&q=80'
),

(
'Canada',
'Explore Toronto, Vancouver and Montreal.',
'https://images.unsplash.com/photo-1517935706615-2717063c2225?auto=format&fit=crop&w=800&q=80'
),

(
'Australia',
'Discover Sydney, Melbourne and Brisbane.',
'https://images.unsplash.com/photo-1506973035872-a4ec16b8e8d1?auto=format&fit=crop&w=800&q=80'
),

(
'Germany',
'Explore Berlin, Munich and Hamburg.',
'https://images.unsplash.com/photo-1467269204594-9661b134dd2b?auto=format&fit=crop&w=800&q=80'
),

(
'United States',
'Explore major study destinations across the United States.',
'https://images.unsplash.com/photo-1496588152823-86ff7695e68f?auto=format&fit=crop&w=800&q=80'
),

(
'Bangladesh',
'Explore Dhaka, Chittagong and Sylhet.',
'https://images.unsplash.com/photo-1521292270410-a8c4d716d518?auto=format&fit=crop&w=800&q=80'
);


INSERT INTO universities
(country_id, name, city, description)
VALUES

(
1,
'University of London',
'London',
'A major university destination for international students.',
'https://www.london.ac.uk/'
),

(
1,
'University of Manchester',
'Manchester',
'Popular destination for international students.',
'https://www.manchester.ac.uk/'
),

(
2,
'University of Toronto',
'Toronto',
'One of the major universities in Canada.',
'https://www.utoronto.ca/'
),

(
3,
'University of Melbourne',
'Melbourne',
'Popular Australian university.',
'https://www.unimelb.edu.au/'
),

(
4,
'Technical University of Berlin',
'Berlin',
'Popular technical university in Germany.',
'https://www.tu.berlin/'
);


INSERT INTO properties
(
title,
country,
city,
property_type,
price,
university,
university_distance,
workplace_distance,
safety,
rooms,
description,
image
)
VALUES

(
'Modern Student Apartment',
'United Kingdom',
'London',
'Apartment',
850,
'University of London',
'1.5 km',
'4.2 km',
'Excellent',
2,
'Modern apartment close to university and public transport.',
'https://images.unsplash.com/photo-1554995207-c18c203602cb?auto=format&fit=crop&w=900&q=80'
),

(
'Toronto Shared Home',
'Canada',
'Toronto',
'House',
700,
'University of Toronto',
'2.1 km',
'5 km',
'Good',
3,
'Affordable shared house suitable for international students.',
'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=900&q=80'
),

(
'Melbourne Student Room',
'Australia',
'Melbourne',
'Room',
620,
'University of Melbourne',
'1.8 km',
'3.5 km',
'Excellent',
1,
'Comfortable student room near campus.',
'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80'
),

(
'Berlin Student Dorm',
'Germany',
'Berlin',
'Dorm',
550,
'Technical University of Berlin',
'1.2 km',
'4 km',
'Good',
1,
'Affordable dorm for students.',
'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=900&q=80'
);