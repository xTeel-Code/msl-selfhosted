USE myapp;

CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(30) UNIQUE NOT NULL,
    password VARCHAR(10) NOT NULL,
    role VARCHAR(5) NOT NULL
);

CREATE TABLE IF NOT EXISTS series (
    id SERIAL PRIMARY KEY,
    series_name INT NOT NULL,
    current_status VARCHAR(40) NOT NULL
);
