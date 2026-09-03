---
name: testing-qa
description: "Mandatory automated testing and QA capability for RushParcel. Execute this skill after any feature modification, bug fix, or backend change. Covers 7 automated test suites: Foundation, Public Site, Pricing Engine, Booking Engine, Admin/Auth, Invoice & POD, and Coupons/CSV Bulk Imports."
---

# Testing & QA Capability — Rush Parcel UK

Searchable local test runner for RushParcel: 7 automated test suites covering 142 assertions across Authentication, Order Workflows, Backdated Tracking, CSV Imports, Coupons, Invoices, and Admin KPIs.

## When to Apply

Apply this skill **immediately after making any code changes, bug fixes, or new feature implementations** before considering a task complete.

## How to Execute the Master Test Suite

Run the master test runner from shell/powershell:

```bash
& "C:\laragon\bin\php\php-8.3.33-Win32-vs16-x64\php.exe" "e:\rushparcel\tests\run_all_tests.php"
```

## Individual Suite Execution

- **Foundation & Core Architecture**:
  `php e:\rushparcel\tests\FoundationTest.php`
- **Public Routes & Pages**:
  `php e:\rushparcel\tests\PublicWebsiteTest.php`
- **Pricing Engine & Postcode Math**:
  `php e:\rushparcel\tests\PricingEngineTest.php`
- **Booking Engine & Status Transitions**:
  `php e:\rushparcel\tests\BookingEngineTest.php`
- **Admin Dashboard, Auth & Drivers**:
  `php e:\rushparcel\tests\AdminAndAuthTest.php`
- **Invoices, Payments & POD Proofs**:
  `php e:\rushparcel\tests\InvoiceAndPodTest.php`
- **Coupons & CSV Bulk Imports**:
  `php e:\rushparcel\tests\CouponsAndCsvImportTest.php`

## Verification Rule
Never declare a feature or fix complete without running the master test runner and verifying **100% clean passes**.

