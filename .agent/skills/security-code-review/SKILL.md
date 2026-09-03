---
name: security-code-review
description: "Mandatory security audit and code review capability for RushParcel. Execute this skill for all backend, database, API, authentication, file upload, or security-sensitive changes. Audits SQL injection, XSS, CSRF, IDOR, RBAC authorization gates, CSV import security, sensitive credentials, and error leakage."
---

# Security & Code Review Capability — Rush Parcel UK

Searchable security audit framework for RushParcel: Audits SQL injection risks, CSRF protections, XSS escaping, RBAC route guards, file upload security, CSV import validation, and credential safety.

## When to Apply

Apply this skill **before releasing or merging any backend, API, database, authentication, or security-sensitive code changes**.

## How to Execute the Security Audit Tool

Run the security audit script from shell/powershell:

```bash
& "C:\laragon\bin\php\php-8.3.33-Win32-vs16-x64\php.exe" "e:\rushparcel\scripts\security_audit.php"
```

## Security Review Checklist

- **SQL Injection**: All database queries must use PDO prepared statements with unique named parameter bindings (`:param`).
- **XSS Prevention**: All dynamic values rendered in HTML views must pass through the `e()` escaping helper.
- **CSRF Token Validation**: Every POST/PUT/DELETE form handler must validate CSRF tokens via `$this->validateCsrf($request)`.
- **Authorization & RBAC**: Admin routes must be guarded by `RoleMiddleware::class`.
- **CSV & File Upload Security**: File extension, MIME type, size limit, and row validation must be enforced.
- **Secrets & Credentials**: Passwords must be hashed using `password_hash()`. No API keys or credentials exposed in frontend code or logs.

