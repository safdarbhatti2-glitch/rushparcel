# SKILL.md — Engineering Skill Contract

## PHP
Use strict typing where practical, typed properties, service classes, dependency injection, PSR-style organization, PDO, DateTimeImmutable and structured exceptions.

## MySQL
Use InnoDB, utf8mb4, foreign keys, indexes, DECIMAL money fields, migrations and transactions.

## Security
Apply OWASP principles, CSRF, XSS prevention, SQL injection prevention, IDOR/BOLA protection, secure sessions, brute-force controls, upload security and least privilege.

## Frontend
Use semantic HTML, responsive CSS, accessible forms, progressive enhancement, fetch/AJAX and reusable components.

## Logistics
Model:
quote -> booking -> shipment -> driver -> tracking -> delivery/POD -> invoice -> payment

Also support:
rate cards, postcode zones, failed delivery, returns and international customs data.

## Coding
- Single responsibility
- Small functions
- Explicit naming
- No SQL in templates
- No business calculations in templates
- Centralized pricing
- Centralized validation
- Centralized authorization
