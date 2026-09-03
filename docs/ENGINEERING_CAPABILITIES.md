# RushParcel Engineering System Capabilities Report

## System Overview

RushParcel now operates under a mandatory **3-Capability Engineering Architecture** configured for Antigravity and future developer agent sessions:

1. **UI/UX Pro Max**: Design intelligence & UI decision framework.
2. **Testing / QA**: Full automated test suite & regression testing runner.
3. **Security / Code Review**: Security auditing scanner & code-review capability.

---

## 1. Skill Capabilities Added

### A. UI/UX Pro Max Skill
- **Locations**: `.gemini/skills/ui-ux-pro-max/` & `.agent/skills/ui-ux-pro-max/`
- **Search CLI**: `python .gemini/skills/ui-ux-pro-max/scripts/search.py "<query>" --domain <domain>`
- **Capabilities**: Searchable databases for UI styles, color palettes, font pairings, UX guidelines, landing structures, chart recommendations, and icon libraries.

### B. Testing / QA Skill
- **Locations**: `.gemini/skills/testing-qa/` & `.agent/skills/testing-qa/`
- **Master Test Runner**: `php e:\rushparcel\tests\run_all_tests.php`
- **Test Suites (7 Suites, 142 Assertions)**:
  1. `FoundationTest.php` — Core App, Session, CSRF, Router, Database
  2. `PublicWebsiteTest.php` — Public Routes, Services, Track Page, Drop-off Network
  3. `PricingEngineTest.php` — Postcode Zones, Volumetric Weight, Surcharges, VAT Math
  4. `BookingEngineTest.php` — Order Creation, Backdates, Status State Machine
  5. `AdminAndAuthTest.php` — Authentication, RBAC Gates, Admin KPIs, Driver Dispatch
  6. `InvoiceAndPodTest.php` — VAT Invoices, Receipts, Payment Processing, POD Uploads
  7. `CouponsAndCsvImportTest.php` — Coupon Validation, CSV Upload Parsing, Column Mapping, Batch Commit

### C. Security / Code Review Skill
- **Locations**: `.gemini/skills/security-code-review/` & `.agent/skills/security-code-review/`
- **Security Scanner**: `php e:\rushparcel\scripts\security_audit.php`
- **Capabilities**: Automated security auditing of SQL injection risks (PDO bindings), CSRF token validation in POST handlers, XSS output sanitization, RBAC middleware gates, and credential leakage checks.

---

## 2. Configuration & Discovery Verification

- **Antigravity Rule Discovery**: System rules configured in `GEMINI.md`, `AGENTS.md`, and `.agent/rules/mandatory-workflow.md`.
- **Skill Discovery**: Skills registered in both `.gemini/skills/` and `.agent/skills/` for automatic on-demand discovery across sessions.

---

## 3. How Antigravity Invokes Each Capability

1. **UI/UX Task**:
   ```bash
   & "C:\laragon\bin\python\python-3.13\python.exe" ".gemini/skills/ui-ux-pro-max/scripts/search.py" "<query>" --domain <domain>
   ```
2. **Testing & QA Verification**:
   ```bash
   & "C:\laragon\bin\php\php-8.3.33-Win32-vs16-x64\php.exe" "e:\rushparcel\tests\run_all_tests.php"
   ```
3. **Security Audit**:
   ```bash
   & "C:\laragon\bin\php\php-8.3.33-Win32-vs16-x64\php.exe" "e:\rushparcel\scripts\security_audit.php"
   ```

