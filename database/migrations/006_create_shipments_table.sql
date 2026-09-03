CREATE TABLE IF NOT EXISTS shipments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    shipment_number VARCHAR(50) NOT NULL UNIQUE,
    tracking_number VARCHAR(50) NOT NULL UNIQUE,
    customer_id INT NOT NULL,
    quote_id INT NULL,
    service_id INT NOT NULL,
    status ENUM(
        'quote_created', 'booking_confirmed', 'collection_scheduled', 'driver_assigned',
        'collected', 'at_depot', 'in_transit', 'out_for_delivery',
        'delivery_attempted', 'delivered', 'delivery_failed', 'returned', 'on_hold', 'cancelled', 'customs_clearance'
    ) NOT NULL DEFAULT 'booking_confirmed',
    scheduled_pickup_at DATETIME NULL,
    scheduled_delivery_at DATETIME NULL,
    total_amount DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    currency VARCHAR(3) NOT NULL DEFAULT 'GBP',
    declared_value DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    cod_amount DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    special_instructions TEXT NULL,
    created_by INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_shipments_number (shipment_number),
    INDEX idx_shipments_tracking (tracking_number),
    INDEX idx_shipments_customer (customer_id),
    INDEX idx_shipments_status (status),
    CONSTRAINT fk_shipments_customer FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE RESTRICT,
    CONSTRAINT fk_shipments_quote FOREIGN KEY (quote_id) REFERENCES quotes(id) ON DELETE SET NULL,
    CONSTRAINT fk_shipments_service FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE RESTRICT,
    CONSTRAINT fk_shipments_creator FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS shipment_addresses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    shipment_id INT NOT NULL,
    type ENUM('pickup', 'delivery') NOT NULL,
    name VARCHAR(150) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    postcode VARCHAR(15) NOT NULL,
    house_number VARCHAR(50) NULL,
    street VARCHAR(150) NOT NULL,
    town VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL,
    county VARCHAR(100) NULL,
    country VARCHAR(50) NOT NULL DEFAULT 'United Kingdom',
    landmark VARCHAR(150) NULL,
    latitude DECIMAL(10,8) NULL,
    longitude DECIMAL(11,8) NULL,
    INDEX idx_shipment_addresses_postcode (postcode),
    CONSTRAINT fk_shipment_addresses_shipment FOREIGN KEY (shipment_id) REFERENCES shipments(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS shipment_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    shipment_id INT NOT NULL,
    description VARCHAR(255) NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    weight_kg DECIMAL(8,2) NOT NULL DEFAULT 0.00,
    length_cm DECIMAL(8,2) NOT NULL DEFAULT 0.00,
    width_cm DECIMAL(8,2) NOT NULL DEFAULT 0.00,
    height_cm DECIMAL(8,2) NOT NULL DEFAULT 0.00,
    package_type VARCHAR(50) NOT NULL DEFAULT 'parcel',
    declared_value DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    CONSTRAINT fk_shipment_items_shipment FOREIGN KEY (shipment_id) REFERENCES shipments(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS shipment_status_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    shipment_id INT NOT NULL,
    old_status VARCHAR(50) NULL,
    new_status VARCHAR(50) NOT NULL,
    public_message VARCHAR(255) NOT NULL,
    internal_note TEXT NULL,
    location_label VARCHAR(150) NULL,
    latitude DECIMAL(10,8) NULL,
    longitude DECIMAL(11,8) NULL,
    actor_user_id INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_history_shipment_created (shipment_id, created_at),
    CONSTRAINT fk_status_history_shipment FOREIGN KEY (shipment_id) REFERENCES shipments(id) ON DELETE CASCADE,
    CONSTRAINT fk_status_history_actor FOREIGN KEY (actor_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
