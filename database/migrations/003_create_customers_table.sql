CREATE TABLE IF NOT EXISTS customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type ENUM('individual', 'business') NOT NULL DEFAULT 'individual',
    legal_name VARCHAR(150) NOT NULL,
    trade_name VARCHAR(150) NULL,
    company_number VARCHAR(50) NULL,
    vat_number VARCHAR(50) NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    credit_limit DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    payment_terms INT NOT NULL DEFAULT 0, -- days e.g. 30
    status ENUM('active', 'inactive', 'on_hold') NOT NULL DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at DATETIME NULL,
    INDEX idx_customers_status (status),
    INDEX idx_customers_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS customer_addresses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    label VARCHAR(50) NOT NULL DEFAULT 'Main',
    postcode VARCHAR(15) NOT NULL,
    house_number VARCHAR(50) NULL,
    building VARCHAR(100) NULL,
    street VARCHAR(150) NOT NULL,
    town VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL,
    county VARCHAR(100) NULL,
    country VARCHAR(50) NOT NULL DEFAULT 'United Kingdom',
    latitude DECIMAL(10,8) NULL,
    longitude DECIMAL(11,8) NULL,
    is_default TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_customer_addresses_postcode (postcode),
    CONSTRAINT fk_customer_addresses_customer FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Add foreign key back to users.customer_id now that customers exists
ALTER TABLE users
ADD CONSTRAINT fk_users_customer FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE SET NULL;
