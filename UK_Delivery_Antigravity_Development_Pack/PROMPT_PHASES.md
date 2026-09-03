# PROMPT_PHASES.md

Use these as separate Antigravity prompts if the full master prompt is too large.

## Phase 1 — Foundation
Read MASTER_PROMPT.md, AGENTS.md, SKILL.md, ARCHITECTURE.md, DATABASE.md and SECURITY.md.
Inspect repository.
Build PHP MVC foundation, routing, configuration, database connection, migrations, secure sessions, authentication, RBAC and error handling.
No fake UI.

## Phase 2 — Public Website
Read UI_UX.md.
Build original UK logistics public site with responsive navigation, services, tracking, quote entry, contact and legal-information pages.
Use original copy and assets.

## Phase 3 — Pricing + Quotes
Build services, UK postcode zones, rate cards, pricing engine, quote wizard, persistence, quote PDF, email and admin quote management.
All calculations server-side.

## Phase 4 — Booking + Shipment
Build quote acceptance, booking, tracking number, shipment, parcel items, addresses, pickup/delivery slots and status machine.

## Phase 5 — Tracking
Build public tracking, customer tracking, admin tracking management and status timeline.
Protect private operational data.

## Phase 6 — Admin
Build dashboard, filters, pagination, customers, drivers, assignments, operational controls and granular permissions.

## Phase 7 — Invoice + Payment
Build invoice drafts, preview, issue, VAT, invoice numbering, PDF, email, payments, overdue and void workflow.
Issued invoices cannot be silently modified.

## Phase 8 — Driver + POD
Build driver portal, job assignments, pickup/delivery states, POD photo, signature and failed delivery workflow.
Secure uploads.

## Phase 9 — International + Notifications + Reports
Add customs data/document workflow, notification templates, email adapters, reports and authorized CSV exports.

## Phase 10 — Security + QA + Deployment
Run security review, performance review, SQL/index review, full tests and Hostinger deployment validation.
Remove debug code.
Document backups and restore.
