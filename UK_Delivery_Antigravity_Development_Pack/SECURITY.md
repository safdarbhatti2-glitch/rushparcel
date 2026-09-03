# SECURITY.md

## Authentication
password_hash/password_verify
session_regenerate_id(true)
Secure/HttpOnly/SameSite cookies
rate limiting
single-use expiring password reset tokens

## Authorization
Every protected action checks permission and record ownership/relationship.
Prevent IDOR/BOLA.

## SQL
PDO prepared statements only.
Allow-list dynamic sort/filter columns.

## XSS
Escape output.
Only sanitize explicitly permitted rich text.

## CSRF
All browser state-changing actions require CSRF.

## Uploads
Allow-list types.
Validate actual file content.
Limit size.
Random filename.
Private storage.
Disable script execution in upload directories.

## Headers
Where supported:
Content-Security-Policy
X-Content-Type-Options
Referrer-Policy
Permissions-Policy
HSTS after HTTPS stability

## Rate limits
Login, tracking, quote, contact and password reset.

## Secrets
No secrets in source code, public JS or Git.
Use environment/configuration outside public web root.

## Financial
Server-side totals, transactions, immutable issued invoice snapshot and audit logs.
Never store raw card data.

## Privacy
Minimize personal data.
Use role-limited access.
Avoid exposing full addresses publicly.
Provide retention/deletion workflows where legally appropriate.
Do not claim UK GDPR compliance without professional review.

## Production
HTTPS
debug off
least-privilege database user
backups
protected cron
secure file permissions
