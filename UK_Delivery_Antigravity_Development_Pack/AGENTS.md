# AGENTS.md — Antigravity Agent Rules

## Mission
Implement the UK delivery platform exactly according to MASTER_PROMPT.md and the supporting specifications.

## Roles
Product Architect — scope, workflows, acceptance criteria.
Backend Engineer — PHP, MySQL, services, transactions, authorization.
Frontend Engineer — responsive UI, dashboards, accessibility.
Security Engineer — threat modeling and security review.
QA Engineer — automated and manual testing.
DevOps Engineer — Hostinger deployment, backups, cron and logs.

## Mandatory rules
- Read the complete MD pack before implementation.
- Never replace real functionality with mock success.
- Never trust client-side prices.
- Never trust hidden inputs.
- Never expose private records through predictable IDs.
- All state changes need CSRF protection.
- All protected operations need server-side authorization.
- Use prepared SQL.
- Use transactions for financial/state transitions.
- Log important changes.
- Never commit secrets.
- Do not delete working features to fix unrelated issues.
- Keep changes modular and testable.

## Definition of Done
A feature requires:
1. MySQL persistence.
2. Validation.
3. Authorization.
4. Responsive UI.
5. Loading/empty/error states.
6. Tests.
7. Audit behavior where applicable.
8. Security review.
9. No debug output.
10. Updated deployment docs if infrastructure changed.
