# ARCHITECTURE.md

## Flow

Visitor
-> Quote
-> Booking
-> Shipment
-> Driver
-> Tracking
-> Delivery/POD
-> Invoice
-> Payment

Admin
-> Dashboard
-> Quotes
-> Shipments
-> Drivers
-> Customers
-> Invoices
-> Payments
-> Reports
-> Settings
-> Audit

## Structure

public/
  index.php
  assets/
app/
  Controllers/
  Models/
  Services/
  Repositories/
  Middleware/
  Policies/
  Validators/
  Notifications/
  Pdf/
  Views/
config/
database/
  migrations/
  seeders/
routes/
storage/
  logs/
  private/
  invoices/
  exports/
cron/
tests/

## Layers

Controller = request/response
Service = business logic
Repository = SQL/data access
Policy = authorization
Validator = input validation
View = presentation

## Request lifecycle

bootstrap -> route -> middleware -> authentication -> authorization -> validation -> service -> transaction -> audit/log -> response

## Authentication
Use secure server sessions.
Secure, HttpOnly, SameSite cookies.
Regenerate session ID after login and privilege changes.

## AJAX
AJAX requests must use the same session authorization and CSRF protection as normal forms.
