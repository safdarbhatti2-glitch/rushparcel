# MASTER ANTIGRAVITY PROMPT — UK COURIER & DELIVERY PLATFORM

## ROLE

Act as the lead product architect, senior PHP/MySQL engineer, security engineer, UI/UX designer, logistics-domain architect and QA lead.

Build a production-ready UK courier and logistics platform using PHP + MySQL and deployable on Hostinger Business hosting.

Use https://dashdeliver.co.uk/ as a functional/information-architecture reference only. The reference currently presents services such as parcel delivery, business logistics, same-day delivery, international shipping, forwarding address and customs clearance; it also has quote, booking/payment, tracking, customer and support concepts. Recreate the underlying useful workflows with ORIGINAL branding, UI, content, code, assets and copy. Do not copy logos, trademarks, exact text, proprietary assets, testimonials, partner claims, addresses or source code.

## TARGET MARKET

Country: United Kingdom
Currency: GBP (£)
Timezone: Europe/London
Language: English first; architecture should be ready for additional languages.
Units: kg/cm
Date format: UK
Postcodes: UK postcode validation and normalization
Phone: UK +44 and local formats
Tax: VAT-ready and configurable. Do not hard-code a VAT rate into business logic.
Legal/privacy: UK GDPR and Data Protection Act 2018 considerations; obtain professional legal review before claiming legal compliance.

Primary use cases:
- B2C parcel delivery
- B2B recurring courier services
- Same-day delivery
- Scheduled delivery
- UK domestic delivery
- UK-to-Europe/international shipping
- Multi-parcel bookings
- Corporate accounts
- Manual quotations
- Customer self-service quotations
- Invoicing
- Shipment tracking
- Driver assignment
- Proof of delivery
- Customs/document workflows for international shipments

## HOSTING CONSTRAINT

The production application must work on Hostinger Business hosting without requiring a persistent Node.js server.

Use:
- PHP
- MySQL
- Apache/LiteSpeed-compatible .htaccess
- Cron
- SMTP
- External APIs only when configured

Do NOT make Docker, Kubernetes, Redis, Elasticsearch, RabbitMQ, WebSockets or a permanent Node service mandatory for the MVP.

## NON-NEGOTIABLE ENGINEERING PRINCIPLES

1. Security before convenience.
2. Server-side validation for every business operation.
3. PDO prepared statements everywhere.
4. CSRF protection for state-changing browser requests.
5. Output escaping to prevent XSS.
6. password_hash/password_verify.
7. Server-side RBAC and object-level authorization.
8. Never trust hidden form fields or client-side totals.
9. Database transactions for quote conversion, shipment state changes, invoice issuance and payments.
10. Immutable audit history for important actions.
11. Soft deletion where retention requires it.
12. Idempotency for booking, invoice creation/issuance and payment callbacks.
13. Use UTC timestamps in storage where practical and display Europe/London.
14. Never expose SQL errors, paths, stack traces or secrets.
15. Keep secrets outside public web root.
16. Never store raw payment-card information.
17. Rate-limit login, public tracking, guest quote, contact and password-reset endpoints.
18. Generate tracking references server-side.
19. Use DECIMAL for money, never FLOAT.
20. Historical invoices must use stored pricing/tax snapshots rather than today's rate card.

# 1. APPLICATION ARCHITECTURE

Use a clean MVC-style PHP architecture:

/app
  /Controllers
  /Models
  /Services
  /Repositories
  /Middleware
  /Policies
  /Validators
  /Helpers
  /Notifications
  /Pdf
  /Views
/config
/database
  /migrations
  /seeders
/public
  /assets
/routes
/storage
  /logs
  /private
  /invoices
  /exports
/cron
/tests

Keep public/index.php as the front controller. Private application/configuration/storage files must not be directly web-accessible.

# 2. PUBLIC WEBSITE

Create an original premium UK logistics website.

Pages:
- Home
- Services
- Parcel Delivery
- Business Logistics
- Same-Day Delivery
- International Shipping
- UK & Europe Shipping
- Forwarding Address
- Customs Clearance
- Pricing / Rate Calculator
- Track Your Parcel
- Get a Quote
- Drop-off Locations
- About
- Partners/Business
- FAQ
- Contact
- Help & Support
- Login
- Register
- Terms & Conditions
- Privacy Policy
- Cookie Policy
- Delivery Policy
- Prohibited Items
- VAT/Invoice information

Homepage:
1. Announcement/contact bar
2. Responsive navbar
3. Hero
4. Instant tracking box
5. Get-a-Quote CTA
6. Services
7. Business logistics
8. How it works
9. UK coverage/service zones
10. Tracking feature
11. Why choose us
12. FAQ
13. CTA
14. Footer

Do not invent insurance amounts, client logos, government approvals, delivery volumes or partner relationships. Make these configurable or placeholders until the owner provides verified information.

# 3. FRONT-END QUOTATION SYSTEM

Build a real quote wizard backed by MySQL.

### Step 1 — Route
- Collection postcode
- Collection address
- Collection country
- Destination postcode
- Destination address
- Destination country
- Optional map pins
- Collection date/time
- Delivery date/time
- Residential/business toggle

### Step 2 — Parcel
- Parcel count
- Package type
- Weight
- Length
- Width
- Height
- Declared value
- Fragile
- Signature required
- COD where supported
- Notes

### Step 3 — Service
- Standard
- Express
- Same-day
- Scheduled
- International
- Pallet/freight if enabled

### Step 4 — Pricing
Calculate server-side:
- Base price
- Zone/postcode charge
- Weight surcharge
- Volumetric weight surcharge
- Distance surcharge
- Service surcharge
- Same-day surcharge
- Weekend/bank-holiday surcharge if configured
- Fuel surcharge if configured
- Remote-area surcharge if configured
- Fragile/handling fee
- Signature fee
- Insurance fee where configured
- Customs/document fee for international
- Discount
- VAT
- Grand total

Show a transparent line-by-line breakdown.

Persist:
- quote number
- customer or guest details
- route snapshot
- parcel snapshot
- service
- pricing snapshot
- subtotal
- discount
- VAT
- total
- currency
- valid-until
- status

Quote statuses:
draft, submitted, priced, sent, accepted, rejected, expired, converted, cancelled.

Admin price overrides require:
- reason
- old value
- new value
- actor
- timestamp
- audit record

Support:
- quote PDF
- email quote
- customer acceptance
- quote-to-shipment conversion
- quote-to-invoice where business rules permit

# 4. BOOKING SYSTEM

After quote acceptance:
1. Confirm customer
2. Confirm addresses
3. Confirm parcel details
4. Confirm service
5. Select collection slot
6. Select delivery slot
7. Confirm final price
8. Accept terms
9. Create shipment

Generate:
- booking number
- shipment number
- tracking number
- shipping label
- customer confirmation

Prevent duplicate submissions using idempotency keys/tokens.

# 5. TRACKING SYSTEM

Public tracking:
- tracking number
- shipment status
- origin
- destination region/postcode-safe display
- estimated delivery
- milestone timeline
- last update
- customer-safe location label
- support CTA

Do not expose:
- driver personal phone
- internal notes
- exact private customer address
- sensitive GPS coordinates
- operational/security information

Statuses:
1. Quote Created
2. Booking Confirmed
3. Collection Scheduled
4. Driver Assigned
5. Collected
6. At Depot
7. In Transit
8. Out for Delivery
9. Delivery Attempted
10. Delivered
11. Delivery Failed
12. Returned
13. On Hold
14. Cancelled
15. Customs Clearance where international

Every status update creates history:
- old status
- new status
- timestamp
- actor
- public message
- internal note
- location label
- optional coordinates

# 6. ADMIN TRACKING MANAGEMENT

Admin/operations can:
- search shipments
- filter by status/date/customer/driver/service/postcode region
- open shipment
- update status
- add internal notes
- add public notes
- assign/reassign driver
- modify collection/delivery slots
- view history
- view quote
- view invoice
- upload POD
- mark delivered
- record failed attempt
- return shipment
- place shipment on hold
- trigger notification

Critical status changes require permission.

# 7. DRIVER MODULE

Driver:
- name
- phone
- email
- employee/reference ID
- vehicle
- plate
- service areas
- active status
- availability

Driver dashboard:
- assigned jobs
- collection queue
- delivery queue
- job details
- navigation/map link
- customer-safe contact action
- status updates
- POD upload
- signature
- delivery photo
- failed delivery reason

Driver must only see assigned/permitted jobs.

# 8. PROOF OF DELIVERY

Support:
- recipient name
- signature
- photo
- timestamp
- approximate delivery location
- driver
- failure reason

Validate uploads by:
- MIME/content
- extension allow-list
- file size
- random server filename
- private storage
- authorization-controlled downloads

# 9. INVOICE SYSTEM — FRONT END

Customer invoice page:
- invoice number
- issue date
- due date
- customer/company
- billing address
- VAT registration number where applicable
- shipment references
- line items
- subtotal
- discount
- VAT
- total
- payment status
- payment method
- View
- Print
- Download PDF

Invoice list:
- invoice number
- date
- due date
- amount
- status
- download
- view

Issued invoices cannot be edited by customers.

# 10. INVOICE SYSTEM — BACK END

Admin invoice builder:
1. Select customer
2. Select shipment(s)/quote(s) or manual lines
3. Load immutable pricing snapshot
4. Add authorized line items
5. Apply discount
6. Calculate VAT
7. Calculate total
8. Generate unique invoice number
9. Set issue/due dates
10. Save draft
11. Preview
12. Issue
13. Email
14. Record payment

Invoice statuses:
draft, issued, sent, partially_paid, paid, overdue, void, cancelled.

After issue:
- do not silently change financial totals
- use credit-note/adjustment/revision workflow
- retain complete audit trail

Example configurable numbering:
INV-2026-000001

UK VAT-ready fields:
- supplier legal name
- supplier address
- supplier VAT number
- customer legal name
- customer address
- customer VAT number where applicable
- tax category
- VAT rate
- VAT amount
- currency GBP

Do not claim HMRC compliance without appropriate professional validation. Keep VAT rules configurable.

# 11. INVOICE PDF

Generate professional A4 invoice PDFs.
Use a maintained PHP PDF library if dependencies can be safely installed; otherwise provide print-optimized HTML as fallback.

Include:
- logo
- supplier details
- invoice number
- dates
- customer details
- VAT information
- shipment references
- line-item table
- subtotal
- discount
- VAT
- grand total
- payment status
- bank/payment instructions
- terms

Invoice files must not be publicly accessible without authorization.

# 12. QUOTATION MANAGEMENT — ADMIN

Dashboard:
- quote number
- customer
- service
- origin
- destination
- value
- status
- created
- expiry
- assigned staff

Actions:
- create
- duplicate
- edit draft
- price
- override with reason
- send
- accept
- reject
- expire
- convert
- export
- PDF
- audit

Quotation PDFs must clearly say QUOTATION and must never be confused with VAT invoices.

# 13. CUSTOMER MANAGEMENT

Types:
- Individual
- Business

Business:
- legal name
- trading name
- company number
- VAT number
- billing address
- contact
- email
- phone
- payment terms
- credit limit
- status

Customer portal:
- dashboard
- shipments
- tracking
- quotes
- invoices
- payments
- addresses
- profile
- support

# 14. ADMIN DASHBOARD

KPIs:
- today's shipments
- collections pending
- out for delivery
- delivered today
- failed deliveries
- revenue
- outstanding invoices
- pending quotes
- active drivers

Tables:
- search
- filters
- pagination
- sorting
- authorized export

# 15. RBAC

Roles:
- Super Admin
- Admin
- Operations Manager
- Dispatcher
- Finance
- Customer Support
- Driver
- Business Customer
- Customer

Permissions:
shipment.view
shipment.create
shipment.update_status
shipment.assign_driver
quote.create
quote.approve
quote.send
invoice.create
invoice.issue
invoice.void
payment.record
customer.view
customer.edit
driver.manage
report.view
settings.manage
audit.view

Never rely on hiding UI controls alone.

# 16. PRICING ENGINE

Entities:
- services
- postcode/zone rules
- weight brackets
- dimensional rules
- distance rules
- surcharges
- discounts
- tax rules
- effective dates

Methods:
- fixed
- weight-based
- zone-based
- distance-based
- hybrid

Return a detailed pricing result and save an immutable snapshot with quote/booking/invoice.

Never calculate an old invoice from current rates.

# 17. UK ADDRESS & MAP

Use:
- UK postcode
- house/building
- street
- town/city
- county where required
- country
- landmark
- optional map pin

Use Leaflet + OpenStreetMap for an MVP.

For postcode geocoding/address lookup, design an adapter so providers such as Postcodes.io or a paid geocoding provider can be configured later. Never make a paid API mandatory.

# 18. INTERNATIONAL SHIPPING

Where enabled:
- origin country
- destination country
- customs description
- HS code
- declared value
- country of origin
- package count
- customs documents
- incoterm
- VAT/duty disclaimer
- customs status

Do not provide legal customs advice. Make document fields configurable.

# 19. NOTIFICATIONS

Channels:
- email
- SMS adapter
- WhatsApp adapter
- in-app

Events:
- quote created
- quote sent
- quote accepted
- booking confirmed
- driver assigned
- collected
- in transit
- out for delivery
- delivered
- failed delivery
- invoice issued
- invoice overdue

Templates configurable by admin.

# 20. REPORTING

Reports:
- shipments by date
- shipments by service
- postcode/region
- delivery success
- failed deliveries
- revenue
- VAT
- invoices
- outstanding balances
- driver performance
- customer volume
- international shipments
- customs status

Use indexed SQL and server-side pagination.

# 21. API-READY DESIGN

Potential endpoints:
POST /api/auth/login
GET /api/track/{tracking}
POST /api/quotes
GET /api/quotes/{id}
POST /api/quotes/{id}/accept
POST /api/shipments
GET /api/shipments/{id}
POST /api/shipments/{id}/status
POST /api/shipments/{id}/assign-driver
GET /api/invoices/{id}

Use expiring/scoped authentication if APIs are exposed.

# 22. PERFORMANCE

- optimized SQL
- indexes
- pagination
- no N+1 queries
- optimized images
- cache safe reference data
- avoid huge PHP memory loads
- avoid constant polling
- use reasonable tracking refresh intervals
- no persistent worker required

# 23. SEO & ACCESSIBILITY

SEO:
- semantic HTML
- metadata
- Open Graph
- canonical URLs
- sitemap
- robots
- breadcrumbs
- Service/Organization schema
- clean URLs

Accessibility:
- WCAG 2.2 AA-oriented
- keyboard support
- labels
- focus
- accessible errors
- sufficient contrast
- alt text
- no status conveyed by color alone

# 24. DELIVERABLES

Build:
1. Public frontend
2. Customer portal
3. Admin portal
4. Driver portal
5. Quote engine
6. Booking engine
7. Tracking engine
8. Invoice engine
9. Payment recording
10. Pricing engine
11. Notifications
12. RBAC
13. Audit logs
14. Reports
15. PDF generation
16. Database migrations/schema
17. Seed data
18. Automated tests
19. Hostinger deployment guide
20. Security checklist
21. Admin setup guide

# 25. IMPLEMENTATION PHASES

Phase 1 foundation/auth/RBAC/database
Phase 2 public website
Phase 3 pricing/quotes
Phase 4 booking/shipments
Phase 5 tracking
Phase 6 admin operations
Phase 7 invoice/payment
Phase 8 driver/POD
Phase 9 notifications/reports
Phase 10 security/performance/QA/deployment

After every phase:
- syntax checks
- tests
- migration verification
- permission testing
- responsive testing
- error-state testing
- fix failures before continuing

# 26. CRITICAL ACCEPTANCE CRITERIA

The system is NOT complete if:
- buttons are static
- preview pages are blank
- forms only show fake success
- invoices calculate only in JavaScript
- tracking is hard-coded
- permissions exist only in UI
- SQL is concatenated
- CSRF is absent
- issued invoices can be silently edited
- uploads are executable
- private tracking data is exposed
- migrations are missing
- deployment cannot run on Hostinger

Build real end-to-end MySQL-backed workflows.
