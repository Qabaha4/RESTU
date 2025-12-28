CREATE TABLE restaurant (
    id INT AUTO_INCREMENT PRIMARY KEY,
    meal VARCHAR(255) NOT NULL,
    best_restaurant VARCHAR(255) NOT NULL,
    rating FLOAT DEFAULT 0
);

INSERT INTO restaurant (meal, best_restaurant, rating) VALUES
('burger', 'Super Burger', 4.2),
('pizza', 'Italiano Pizza', 4.7),
('shawarma', 'Shawarma King', 4.3),
('sushi', 'Tokyo House', 4.8),
('burger', 'Burger House', 4.6),
('pizza', 'Italiano Pizzeria', 4.5),
('shawarma', 'Al Shawarma', 4.7),
('sushi', 'Sushi Heaven', 4.6),
('fried chicken', 'KFC', 4.1),
('pasta', 'Little Italy', 4.4);
