CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    quantity INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO products (product_name, description, price, quantity) VALUES
('Aster notebook', 'A soft-cover notebook for daily notes and ideas.', 8.50, 24),
('Orbit bottle', 'A reusable stainless steel bottle with a matte finish.', 18.00, 12),
('Lumen desk lamp', 'A compact warm-light lamp for focused work.', 32.75, 8);