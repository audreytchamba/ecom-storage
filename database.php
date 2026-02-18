-- Création de la base de données
CREATE DATABASE IF NOT EXISTS ecom_storage;
USE ecom_storage;

-- Table des utilisateurs
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100),
    address TEXT,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_role (role)
) ENGINE=InnoDB;

-- Table des produits
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    type ENUM('SSD', 'HDD', 'USB', 'Memory Card') NOT NULL,
    capacity VARCHAR(20),
    speed VARCHAR(50),
    interface VARCHAR(50),
    image VARCHAR(255),
    is_promotion BOOLEAN DEFAULT FALSE,
    is_new BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_type (type),
    INDEX idx_price (price),
    INDEX idx_promo (is_promotion),
    INDEX idx_new (is_new),
    FULLTEXT idx_search (name, description)
) ENGINE=InnoDB;

-- Table des commandes
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'paid', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
    shipping_address TEXT NOT NULL,
    payment_method VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE RESTRICT,
    INDEX idx_user (user_id),
    INDEX idx_status (status),
    INDEX idx_created (created_at)
) ENGINE=InnoDB;

-- Table des articles de commande
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE RESTRICT,
    INDEX idx_order (order_id),
    INDEX idx_product (product_id)
) ENGINE=InnoDB;

-- Table des avis
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    user_id INT NOT NULL,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_review (product_id, user_id),
    INDEX idx_product_rating (product_id, rating)
) ENGINE=InnoDB;

-- Insertion d'un administrateur par défaut (mot de passe: admin123)
INSERT INTO users (username, email, password, full_name, role) VALUES
('admin', 'admin@storageshop.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrateur', 'admin');

-- Insertion de produits exemple
INSERT INTO products (name, description, price, stock, type, capacity, speed, interface, is_promotion, is_new) VALUES
('Samsung SSD 870 EVO 1TB', 'SSD interne Samsung 870 EVO, vitesse de lecture 560 Mo/s, écriture 530 Mo/s', 129.99, 50, 'SSD', '1TB', '560 Mo/s', 'SATA III', TRUE, TRUE),
('WD Blue 2TB HDD', 'Disque dur interne WD Blue 2TB, 7200 tr/min', 89.99, 30, 'HDD', '2TB', '7200 tr/min', 'SATA III', FALSE, FALSE),
('SanDisk Ultra Fit 128GB', 'Clé USB 3.1 SanDisk Ultra Fit, vitesse de lecture 130 Mo/s', 24.99, 100, 'USB', '128GB', '130 Mo/s', 'USB 3.1', TRUE, TRUE),
('Samsung EVO Plus 256GB', 'Carte mémoire microSD Samsung EVO Plus, vitesse 100 Mo/s', 39.99, 75, 'Memory Card', '256GB', '100 Mo/s', 'UHS-I', FALSE, TRUE),
('Kingston A2000 500GB', 'SSD NVMe Kingston A2000, vitesse lecture 2200 Mo/s', 79.99, 40, 'SSD', '500GB', '2200 Mo/s', 'NVMe PCIe', TRUE, FALSE),
('Seagate BarraCuda 4TB', 'Disque dur interne 4TB, 5400 tr/min', 129.99, 20, 'HDD', '4TB', '5400 tr/min', 'SATA III', FALSE, FALSE),
('Sandisk Extreme Pro 64GB', 'Clé USB 3.2 SanDisk Extreme Pro, vitesse 420 Mo/s', 49.99, 60, 'USB', '64GB', '420 Mo/s', 'USB 3.2', FALSE, TRUE),
('Lexar Professional 128GB', 'Carte mémoire CFexpress Type B Lexar, vitesse 1750 Mo/s', 199.99, 15, 'Memory Card', '128GB', '1750 Mo/s', 'CFexpress', FALSE, FALSE);

-- Création d'un utilisateur test (mot de passe: test123)
INSERT INTO users (username, email, password, full_name, address) VALUES
('testuser', 'test@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Test User', '123 Rue de Test, 75001 Paris');

-- Ajout de commandes exemple
INSERT INTO orders (user_id, total, status, shipping_address, payment_method) VALUES
(2, 259.98, 'delivered', '123 Rue de Test, 75001 Paris', 'card'),
(2, 89.99, 'shipped', '123 Rue de Test, 75001 Paris', 'paypal');

-- Ajout des articles de commande
INSERT INTO order_items (order_id, product_id, quantity, price) VALUES
(1, 1, 2, 129.99),
(2, 2, 1, 89.99);

-- Ajout d'avis exemple
INSERT INTO reviews (product_id, user_id, rating, comment) VALUES
(1, 2, 5, 'Excellent SSD, très rapide !'),
(2, 2, 4, 'Bon disque dur, silencieux et fiable'),
(3, 2, 5, 'Parfait pour mon usage quotidien');