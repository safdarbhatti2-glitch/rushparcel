# UK Courier & Logistics Platform — Hostinger Business Hosting Deployment Guide

## Production Architecture Overview
This application is engineered specifically for **Hostinger Business Hosting** (and compatible cPanel / LiteSpeed / Apache shared or VPS hosting environments). It requires pure **PHP 8.2+ or PHP 8.3+** and **MySQL 8.0+** with no external server dependencies (such as Node.js, WebSockets, or Docker).

---

## 1. Prerequisites & Server Environment Setup
- **PHP Version**: `8.2.x` or `8.3.x`
- **PHP Extensions Required**:
  - `pdo_mysql`
  - `mbstring`
  - `openssl`
  - `fileinfo` (for MIME-type validation of POD signature & photo uploads)
  - `json`
  - `ctype`
- **MySQL Database**: MySQL 8.0+ / MariaDB 10.6+

---

## 2. Deployment Steps on Hostinger hPanel

### Step 1: Upload Project Files
1. Log into your **Hostinger hPanel**.
2. Open **File Manager** and navigate to your domain's root folder (e.g. `public_html/`).
3. Upload all project files into `public_html/`.
4. Ensure the `.htaccess` files in both root `public_html/` and `public_html/public/` are present (enable "Show Hidden Files" in File Manager).

### Step 2: Configure Environment Variables (`.env`)
1. Copy `.env.example` to `.env` in the root directory.
2. Configure your live Hostinger database credentials:
   ```ini
   APP_NAME="UK Delivery Platform"
   APP_ENV=production
   APP_DEBUG=false
   APP_URL="https://yourdomain.co.uk"
   APP_KEY="your-secure-64-character-hex-key"

   DB_HOST="localhost"
   DB_PORT=3306
   DB_NAME="u123456789_rushparcel"
   DB_USER="u123456789_admin"
   DB_PASS="YourSecureDatabasePassword123!"

   VAT_RATE=20.0
   DEFAULT_CURRENCY=GBP
   ```

### Step 3: Run Database Migrations & Seeders
Execute database setup via SSH CLI or phpMyAdmin:
```bash
# Via Hostinger SSH:
php database/migrate.php
php database/seed.php
```
Or import `database/migrations/*.sql` and seed data via phpMyAdmin.

### Step 4: Folder Permissions
Set directory permissions:
- `storage/` -> `0755` (recursive)
- `storage/logs/` -> `0755`
- `storage/private/pod/` -> `0755`
- `public/` -> `0755`

---

## 3. Security Verification Checklist
- [x] Debug mode disabled (`APP_DEBUG=false`).
- [x] HTTP headers `X-Content-Type-Options`, `X-Frame-Options`, `X-XSS-Protection` enforced in `.htaccess`.
- [x] Direct browser access to `.env`, `app/`, `config/`, `database/`, `storage/`, and `tests/` blocked via `.htaccess`.
- [x] File uploads validated via finfo MIME-type checking and stored in `/storage/private/pod/` with randomized filenames.
- [x] CSRF protection enabled on all POST/PUT/DELETE forms.
- [x] Rate limiting active on Login (5 attempts / 5 mins) and Quotation endpoints.

---

## 4. Automated Verification Test Suite
To verify deployment integrity on your server, run:
```bash
php tests/FoundationTest.php
php tests/PublicWebsiteTest.php
php tests/PricingEngineTest.php
php tests/BookingEngineTest.php
php tests/AdminAndAuthTest.php
php tests/InvoiceAndPodTest.php
```
Expected result: **119 Assertions Passed, 0 Failures**.
