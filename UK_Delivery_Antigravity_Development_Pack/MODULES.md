# MODULES.md

## Authentication
Registration, login, logout, password reset, secure sessions and rate limiting.

## Quotes
Guest/logged-in quote, pricing breakdown, persistence, PDF, email, acceptance, expiry, conversion and audit.

## Shipments
Booking, tracking number, labels, addresses, parcel items, pickup/delivery slots, status machine.

## Tracking
Public tracking, customer tracking, admin operational history and public-safe timeline.

## Drivers
Jobs, assignments, pickup, delivery, POD, failed delivery and vehicle information.

## Invoices
Draft, preview, issue, PDF, email, payment, overdue, void and audit.

## Pricing
Services, postcode zones, weight, dimensional weight, distance, surcharges, discounts, VAT and effective dates.

## Customer
Profile, addresses, shipments, quotes, invoices, payments and support.

## Admin
Dashboard, operations, drivers, customers, quotes, invoices, payments, pricing, reports and settings.

## International
Customs descriptions, HS codes, origin, declared value, customs documents, incoterm and customs status.

## Status machines

Quote:
draft -> submitted -> priced -> sent -> accepted/rejected/expired -> converted

Shipment:
booking_confirmed -> collection_scheduled -> driver_assigned -> collected -> at_depot -> in_transit -> out_for_delivery -> delivered

Failure paths:
out_for_delivery -> delivery_attempted -> out_for_delivery
delivery_attempted -> returned
active -> on_hold where authorized
pre-delivery -> cancelled where authorized

Invoice:
draft -> issued -> sent -> partially_paid -> paid
sent -> overdue
issued/sent/overdue -> void only with permission and audit
