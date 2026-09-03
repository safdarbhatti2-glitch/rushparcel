# TESTING.md

## Unit tests
- VAT
- pricing
- volumetric weight
- quote totals
- invoice totals
- tracking generator
- status transitions
- permission policies

## Integration tests
- registration/login
- quote persistence
- quote acceptance
- quote conversion
- shipment status history
- invoice issue
- payment
- driver assignment
- POD

## Security tests
SQL injection
XSS
CSRF
IDOR
privilege escalation
upload bypass
brute-force
session fixation
private invoice/POD access

## UI tests
Desktop/mobile
form validation
loading
empty
error
responsive tables
invoice preview
tracking timeline

## Critical E2E
Guest quote -> saved quote -> admin pricing -> quote sent -> customer accepts -> shipment created -> tracking generated -> driver assigned -> collected -> in transit -> out for delivery -> POD -> delivered -> invoice issued -> invoice downloaded -> payment recorded -> audit verified.

A visual button click alone is not acceptance. The operation must persist correctly in MySQL and enforce authorization.
