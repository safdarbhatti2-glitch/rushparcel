# Mandatory 3-Capability Engineering System — Rush Parcel UK

This project enforces a mandatory 3-pillar engineering workflow built around:
1. **UI/UX Pro Max** — Mandatory design system & UX intelligence
2. **Testing / QA** — Mandatory automated testing & regression test runner
3. **Security / Code Review** — Mandatory security audit & code review

---

## 1. UI/UX Pro Max (MANDATORY FOR DESIGN)
- **Skill Path**: `.gemini/skills/ui-ux-pro-max/` and `.agent/skills/ui-ux-pro-max/`
- **Execution**: `python .gemini/skills/ui-ux-pro-max/scripts/search.py "<query>" --domain <domain>`
- **Rule**: For EVERY UI/UX task (pages, dashboards, forms, tables, cards, navigation, modals, responsive layouts, colors, typography), invoke UI/UX Pro Max before implementing.
- Inspect current UI, determine design system direction, check Desktop/Tablet/Mobile responsiveness, and refine.

---

## 2. Testing / QA (MANDATORY FOR FEATURES)
- **Skill Path**: `.gemini/skills/testing-qa/` and `.agent/skills/testing-qa/`
- **Execution**: `& "C:\laragon\bin\php\php-8.3.33-Win32-vs16-x64\php.exe" "e:\rushparcel\tests\run_all_tests.php"`
- **Rule**: Covers 7 automated test suites (Foundation, Public Site, Pricing Engine, Booking Engine, Admin/Auth, Invoice & POD, Coupons & CSV Bulk Imports). Run tests after every feature change or bug fix. Fix actual root causes.

---

## 3. Security / Code Review (MANDATORY FOR BACKEND/APIS)
- **Skill Path**: `.gemini/skills/security-code-review/` and `.agent/skills/security-code-review/`
- **Execution**: `& "C:\laragon\bin\php\php-8.3.33-Win32-vs16-x64\php.exe" "e:\rushparcel\scripts\security_audit.php"`
- **Rule**: Perform security audit for every backend, database, API, authentication, file upload, or security-sensitive change. Verify PDO parameter binding, CSRF validation, XSS escaping, RBAC route guards, and credential safety.

---

## Mandatory Task Workflows

### DESIGN CHANGE
? UI/UX Pro Max MUST be used
? Inspect existing UI
? Implement
? Review visually (Desktop, Tablet, Mobile)
? Refine

### FEATURE CHANGE
? Implement feature
? Run relevant tests (`run_all_tests.php`)
? Run regression tests
? Fix failures
? Confirm completion

### BACKEND / API / DATABASE CHANGE
? Implement
? Security review (`security_audit.php`)
? Validate permissions & RBAC gates
? Test API/database behavior
? Run regression tests

### SECURITY-SENSITIVE CHANGE
? Security review MUST be performed
? Test authorization and input validation
? Check for data exposure, CSRF, XSS, and SQL injection

### BEFORE PRODUCTION / FINAL COMPLETION
? UI/UX review
? Automated testing (`run_all_tests.php`)
? Security review (`security_audit.php`)
? Responsive review (Desktop, Tablet, Mobile)
? Accessibility review
? Final build verification

