# DATABASE.md — MySQL Specification

Use InnoDB, utf8mb4, foreign keys and DECIMAL(12,2) for financial values.

## Core tables

users:
id, role_id, customer_id, name, email, phone, password_hash, status, last_login_at, created_at, updated_at

roles:
id, name, description

permissions:
id, key, description

role_permissions:
role_id, permission_id

customers:
id, type, legal_name, trade_name, company_number, vat_number, email, phone, credit_limit, payment_terms, status, created_at, updated_at, deleted_at

customer_addresses:
id, customer_id, label, postcode, house_number, building, street, town, city, county, country, latitude, longitude, is_default, created_at, updated_at

services:
id, name, slug, description, service_type, active, sort_order

zones:
id, name, postcode_prefix, postcode_pattern, region, active

rate_cards:
id, service_id, zone_from_id, zone_to_id, pricing_method, base_price, per_kg_price, min_weight, max_weight, effective_from, effective_to, active

rate_card_rules:
id, rate_card_id, rule_type, rule_key, rule_value, amount, percentage, active

quotes:
id, quote_number, customer_id, guest_email, service_id, pickup_snapshot_json, delivery_snapshot_json, subtotal, discount, vat_rate, vat_amount, total, currency, status, valid_until, pricing_snapshot_json, accepted_at, created_by, created_at, updated_at

quote_items:
id, quote_id, description, quantity, unit_price, line_total, metadata_json

shipments:
id, shipment_number, tracking_number, customer_id, quote_id, service_id, status, scheduled_pickup_at, scheduled_delivery_at, total_amount, currency, declared_value, cod_amount, special_instructions, created_by, created_at, updated_at

shipment_addresses:
id, shipment_id, type, name, phone, postcode, house_number, street, town, city, county, country, landmark, latitude, longitude

shipment_items:
id, shipment_id, description, quantity, weight_kg, length_cm, width_cm, height_cm, package_type, declared_value

shipment_status_history:
id, shipment_id, old_status, new_status, public_message, internal_note, location_label, latitude, longitude, actor_user_id, created_at

drivers:
id, user_id, employee_ref, phone, service_zones_json, status, created_at, updated_at

vehicles:
id, driver_id, type, plate_number, make, model, active

driver_assignments:
id, shipment_id, driver_id, assigned_by, assigned_at, unassigned_at, status

proof_of_delivery:
id, shipment_id, recipient_name, signature_file_id, photo_file_id, delivered_latitude, delivered_longitude, delivered_at, driver_id, failure_reason

invoices:
id, invoice_number, customer_id, shipment_id, quote_id, issue_date, due_date, supplier_name, supplier_address, supplier_vat_number, customer_name, customer_address, customer_vat_number, subtotal, discount, vat_rate, vat_amount, total, currency, status, issued_at, created_by, created_at, updated_at, voided_at

invoice_items:
id, invoice_id, description, quantity, unit_price, discount, vat_rate, vat_amount, line_total, reference_type, reference_id

payments:
id, invoice_id, amount, payment_method, transaction_reference, paid_at, recorded_by, notes

notifications:
id, user_id, customer_id, type, channel, subject, body, status, sent_at, created_at

notification_templates:
id, event_key, channel, subject_template, body_template, active

audit_logs:
id, actor_user_id, action, entity_type, entity_id, old_values_json, new_values_json, ip_address, user_agent, created_at

files:
id, owner_type, owner_id, storage_path, original_name, mime_type, size_bytes, checksum, created_by, created_at

settings:
id, setting_key, setting_value, is_secret, updated_by, updated_at

support_tickets:
id, customer_id, user_id, subject, priority, status, assigned_to, created_at, updated_at

## Required unique indexes
users.email
quotes.quote_number
shipments.shipment_number
shipments.tracking_number
invoices.invoice_number

## Important indexes
status
created_at
customer_id
driver_id
tracking_number
postcode
shipment_id + created_at
invoice customer_id + status
audit entity_type + entity_id

## Integrity
Store immutable pricing snapshots.
Use transactions for quote conversion, invoice issue, payment recording, shipment delivery and void workflows.
Never derive historical invoice values from current rate cards.
