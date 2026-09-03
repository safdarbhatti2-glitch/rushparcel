CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    description TEXT NULL,
    service_type ENUM('standard', 'express', 'sameday', 'scheduled', 'international') NOT NULL DEFAULT 'standard',
    active TINYINT(1) NOT NULL DEFAULT 1,
    sort_order INT NOT NULL DEFAULT 0,
    INDEX idx_services_slug (slug),
    INDEX idx_services_active (active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS zones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    postcode_prefix VARCHAR(255) NOT NULL, -- e.g. "EC,WC,E,N,NW,SE,SW,W" or "EH,G,FK"
    postcode_pattern VARCHAR(255) NULL,
    region VARCHAR(100) NOT NULL DEFAULT 'UK Mainland',
    active TINYINT(1) NOT NULL DEFAULT 1,
    INDEX idx_zones_prefix (postcode_prefix)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS rate_cards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    service_id INT NOT NULL,
    zone_from_id INT NOT NULL,
    zone_to_id INT NOT NULL,
    pricing_method ENUM('fixed', 'weight_based', 'zone_based', 'distance_based', 'hybrid') NOT NULL DEFAULT 'weight_based',
    base_price DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    per_kg_price DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    min_weight DECIMAL(8,2) NOT NULL DEFAULT 0.00,
    max_weight DECIMAL(8,2) NOT NULL DEFAULT 9999.99,
    effective_from DATE NOT NULL,
    effective_to DATE NULL,
    active TINYINT(1) NOT NULL DEFAULT 1,
    INDEX idx_rate_cards_service (service_id),
    CONSTRAINT fk_rate_cards_service FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE,
    CONSTRAINT fk_rate_cards_zone_from FOREIGN KEY (zone_from_id) REFERENCES zones(id) ON DELETE RESTRICT,
    CONSTRAINT fk_rate_cards_zone_to FOREIGN KEY (zone_to_id) REFERENCES zones(id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS rate_card_rules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rate_card_id INT NOT NULL,
    rule_type ENUM('surcharge', 'discount', 'tax_override', 'volumetric') NOT NULL,
    rule_key VARCHAR(100) NOT NULL, -- e.g. "fragile", "signature", "same_day", "fuel"
    rule_value VARCHAR(255) NULL,
    amount DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    percentage DECIMAL(5,2) NOT NULL DEFAULT 0.00,
    active TINYINT(1) NOT NULL DEFAULT 1,
    CONSTRAINT fk_rate_card_rules_card FOREIGN KEY (rate_card_id) REFERENCES rate_cards(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
