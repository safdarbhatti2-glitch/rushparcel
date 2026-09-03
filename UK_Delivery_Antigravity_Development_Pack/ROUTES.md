# ROUTES.md

## Public
GET /
GET /services
GET /services/{slug}
GET /quote
POST /quote/calculate
POST /quote
GET /quote/{quoteNumber}
GET /quote/{quoteNumber}/pdf
GET /track
GET /track/{trackingNumber}
GET /about
GET /partners
GET /drop-off
GET /faq
GET /contact
POST /contact

## Auth
GET /login
POST /login
POST /logout
GET /register
POST /register
GET /forgot-password
POST /forgot-password
GET /reset-password
POST /reset-password

## Customer
GET /dashboard
GET /dashboard/shipments
GET /dashboard/shipments/{id}
GET /dashboard/quotes
GET /dashboard/quotes/{id}
POST /dashboard/quotes/{id}/accept
GET /dashboard/invoices
GET /dashboard/invoices/{id}
GET /dashboard/invoices/{id}/pdf
GET /dashboard/profile
POST /dashboard/profile

## Admin
GET /admin
GET /admin/quotes
GET /admin/quotes/create
POST /admin/quotes
GET /admin/quotes/{id}
POST /admin/quotes/{id}/send
POST /admin/quotes/{id}/approve
POST /admin/quotes/{id}/convert

GET /admin/shipments
GET /admin/shipments/{id}
POST /admin/shipments/{id}/status
POST /admin/shipments/{id}/assign-driver

GET /admin/invoices
GET /admin/invoices/create
POST /admin/invoices
GET /admin/invoices/{id}
POST /admin/invoices/{id}/issue
POST /admin/invoices/{id}/void
POST /admin/invoices/{id}/payment

GET /admin/customers
GET /admin/customers/{id}
GET /admin/drivers
GET /admin/drivers/{id}
GET /admin/reports
GET /admin/settings
GET /admin/audit

## Driver
GET /driver
GET /driver/jobs
GET /driver/jobs/{id}
POST /driver/jobs/{id}/status
POST /driver/jobs/{id}/pod

## API-ready
GET /api/track/{tracking}
POST /api/quotes
GET /api/quotes/{id}
POST /api/quotes/{id}/accept
POST /api/shipments
GET /api/shipments/{id}
POST /api/shipments/{id}/status
POST /api/shipments/{id}/assign-driver
GET /api/invoices/{id}
