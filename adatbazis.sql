-- A kiválasztott üres adatbázisban futtatandó.
-- Helyben: hexamarket. Nincsenek FOREIGN KEY kapcsolatok.
-- A GitHub README password_hash mezője helyett itt password szerepel,
-- mert ez a tanórai változat egyszerű jelszó-összehasonlítást használ.
SET NAMES utf8mb4;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(40) NOT NULL UNIQUE,
    email VARCHAR(190) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    balance DECIMAL(18,6) NOT NULL DEFAULT 1000,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE markets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT NOT NULL,
    yes_price DECIMAL(5,2) NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'open',
    outcome VARCHAR(3),
    end_date DATETIME NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX (category_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE positions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    market_id INT NOT NULL,
    side VARCHAR(3) NOT NULL,
    shares DECIMAL(18,4) NOT NULL DEFAULT 0,
    UNIQUE (user_id, market_id, side),
    INDEX (market_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    market_id INT NOT NULL,
    type VARCHAR(20) NOT NULL,
    side VARCHAR(3) NOT NULL,
    shares DECIMAL(18,4) NOT NULL,
    price DECIMAL(12,6) NOT NULL,
    total DECIMAL(18,6) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX (user_id), INDEX (market_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE price_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    market_id INT NOT NULL,
    yes_price DECIMAL(5,2) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX (market_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
