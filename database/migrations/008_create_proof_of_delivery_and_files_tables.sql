CREATE TABLE IF NOT EXISTS files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    owner_type VARCHAR(50) NOT NULL, -- e.g. 'pod_signature', 'pod_photo', 'invoice_pdf', 'quote_pdf'
    owner_id INT NOT NULL,
    storage_path VARCHAR(255) NOT NULL,
    original_name VARCHAR(255) NOT NULL,
    mime_type VARCHAR(100) NOT NULL,
    size_bytes INT NOT NULL,
    checksum VARCHAR(64) NOT NULL,
    created_by INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_files_owner (owner_type, owner_id),
    CONSTRAINT fk_files_creator FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS proof_of_delivery (
    id INT AUTO_INCREMENT PRIMARY KEY,
    shipment_id INT NOT NULL UNIQUE,
    recipient_name VARCHAR(150) NULL,
    signature_file_id INT NULL,
    photo_file_id INT NULL,
    delivered_latitude DECIMAL(10,8) NULL,
    delivered_longitude DECIMAL(11,8) NULL,
    delivered_at DATETIME NOT NULL,
    driver_id INT NOT NULL,
    failure_reason VARCHAR(255) NULL,
    CONSTRAINT fk_pod_shipment FOREIGN KEY (shipment_id) REFERENCES shipments(id) ON DELETE CASCADE,
    CONSTRAINT fk_pod_driver FOREIGN KEY (driver_id) REFERENCES drivers(id) ON DELETE RESTRICT,
    CONSTRAINT fk_pod_sig_file FOREIGN KEY (signature_file_id) REFERENCES files(id) ON DELETE SET NULL,
    CONSTRAINT fk_pod_photo_file FOREIGN KEY (photo_file_id) REFERENCES files(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
