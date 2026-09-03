# DEPLOYMENT.md — Hostinger Business

## Deployment goal
Run the application on standard PHP/MySQL hosting without a persistent Node server.

## Setup
1. Create MySQL database and user.
2. Confirm PHP version.
3. Enable HTTPS.
4. Upload application.
5. Prefer public/ as document root if Hostinger configuration permits.
6. Protect app/config/database/storage.
7. Configure environment values.
8. Run migrations.
9. Create first admin.
10. Configure SMTP.
11. Configure cron.
12. Disable debug.
13. Test backups and restore.

## Example configuration

APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.co.uk
APP_TIMEZONE=Europe/London

DB_HOST=
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=

## .htaccess
Route application URLs to public/index.php.
Block access to app/, config/, database/, storage/, .env and private documents.
Disable script execution in uploads.

## Cron
Optional:
- notification queue
- quote expiry
- overdue invoice processing
- scheduled reports
- temporary-file cleanup

## Backups
Daily database backup.
Periodic file/POD/invoice backup.
Retention policy.
Test restoration.

## Production checklist
[ ] HTTPS
[ ] debug off
[ ] DB credentials
[ ] secure sessions
[ ] CSRF
[ ] rate limits
[ ] private files
[ ] indexes
[ ] SMTP
[ ] PDFs
[ ] invoice numbering
[ ] VAT settings
[ ] admin security
[ ] backups
[ ] restore test
