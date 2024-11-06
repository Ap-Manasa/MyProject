CREATE TABLE providers
(
    id integer unsigned AUTO_INCREMENT PRIMARY KEY,
    name varchar(255) NOT NULL,
    contact varchar(20) NOT NULL,
    descr varchar(1000) NOT NULL,
    adder1 varchar(255) NOT NULL,
    adder2 varchar(255) NOT NULL,
    city varchar(50) NOT NULL,
    password varchar(255) NOT NULL,
    photo varchar(255) NOT NULL,
    profession varchar(255) NOT NULL
);

CREATE TABLE bookings
(
    id integer unsigned AUTO_INCREMENT PRIMARY KEY,
    provider_id integer unsigned NOT NULL,
    fname varchar(255) NOT NULL,
    lname varchar(255) NOT NULL,
    contact varchar(20) NOT NULL,
    adder varchar(255) NOT NULL,
    date date NOT NULL,
    payment varchar(30) NOT NULL,
    queries varchar(255) NOT NULL,
    FOREIGN KEY (provider_id) REFERENCES providers(id)
);

CREATE TABLE ratings (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    provider_id INT UNSIGNED NOT NULL,
    rating INT NOT NULL,
    comments TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (provider_id) REFERENCES providers(id)
);
ALTER TABLE providers
ADD COLUMN avg_rating DECIMAL(3, 1) DEFAULT 0;
