<?php

namespace Database\Seeders;

use App\Core\Database;
use PDO;

class DatabaseSeeder
{
    protected PDO $pdo;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? Database::getConnection();
    }

    public function run(): void
    {
        echo "Seeding database reference data...\n";

        $this->seedRolesAndPermissions();
        $this->seedServices();
        $this->seedZones();
        $this->seedRateCardsAndRules();

        echo "Seeding completed successfully.\n";
    }

    protected function seedRolesAndPermissions(): void
    {
        echo "  - Seeding Roles and Permissions...\n";

        $roles = [
            'super_admin' => 'Super Admin with full access',
            'admin' => 'Administrator',
            'operations' => 'Operations Manager',
            'dispatcher' => 'Fleet Dispatcher',
            'finance' => 'Finance & Invoicing Manager',
            'support' => 'Customer Support Representative',
            'driver' => 'Delivery Driver',
            'business_customer' => 'Business Corporate Account',
            'customer' => 'Standard Individual Customer',
        ];

        foreach ($roles as $name => $desc) {
            $stmt = $this->pdo->prepare("INSERT INTO roles (name, description) VALUES (:name, :desc) ON DUPLICATE KEY UPDATE description = VALUES(description)");
            $stmt->execute([':name' => $name, ':desc' => $desc]);
        }

        $permissions = [
            'shipment.view' => 'View shipment details and status',
            'shipment.create' => 'Create new shipment bookings',
            'shipment.update_status' => 'Update shipment tracking status',
            'shipment.assign_driver' => 'Assign drivers to shipments',
            'quote.create' => 'Create freight quotes',
            'quote.approve' => 'Approve or override quote prices',
            'quote.send' => 'Send quotes to customers',
            'invoice.create' => 'Create draft invoices',
            'invoice.issue' => 'Issue official VAT invoices',
            'invoice.void' => 'Void or adjust issued invoices',
            'payment.record' => 'Record customer payments',
            'customer.view' => 'View customer profiles',
            'customer.edit' => 'Edit customer accounts and credit limits',
            'driver.manage' => 'Manage driver profiles and vehicles',
            'report.view' => 'View operational & revenue reports',
            'settings.manage' => 'Manage platform system settings',
            'audit.view' => 'View immutable audit logs',
        ];

        foreach ($permissions as $key => $desc) {
            $stmt = $this->pdo->prepare("INSERT INTO permissions (`key`, description) VALUES (:key, :desc) ON DUPLICATE KEY UPDATE description = VALUES(description)");
            $stmt->execute([':key' => $key, ':desc' => $desc]);
        }
    }

    protected function seedServices(): void
    {
        echo "  - Seeding Delivery Services...\n";

        $services = [
            [
                'name' => 'Standard Parcel 48h',
                'slug' => 'standard',
                'description' => 'Economy door-to-door nationwide delivery within 48 hours.',
                'service_type' => 'standard',
                'sort_order' => 1,
            ],
            [
                'name' => 'Express Next-Day 24h',
                'slug' => 'express',
                'description' => 'Guaranteed next-day delivery across the UK mainland.',
                'service_type' => 'express',
                'sort_order' => 2,
            ],
            [
                'name' => 'Same-Day Direct Courier',
                'slug' => 'sameday',
                'description' => 'Urgent direct courier dispatch within 60 minutes.',
                'service_type' => 'sameday',
                'sort_order' => 3,
            ],
            [
                'name' => 'Scheduled Delivery Slot',
                'slug' => 'scheduled',
                'description' => 'Delivery on your specific chosen date and time window.',
                'service_type' => 'scheduled',
                'sort_order' => 4,
            ],
            [
                'name' => 'Worldwide International Express',
                'slug' => 'international',
                'description' => 'Air freight & courier shipping to global destinations.',
                'service_type' => 'international',
                'sort_order' => 5,
            ],
        ];

        foreach ($services as $srv) {
            $stmt = $this->pdo->prepare(
                "INSERT INTO services (name, slug, description, service_type, active, sort_order)
                 VALUES (:name, :slug, :desc, :type, 1, :sort)
                 ON DUPLICATE KEY UPDATE name = VALUES(name), description = VALUES(description), sort_order = VALUES(sort_order)"
            );
            $stmt->execute([
                ':name' => $srv['name'],
                ':slug' => $srv['slug'],
                ':desc' => $srv['description'],
                ':type' => $srv['service_type'],
                ':sort' => $srv['sort_order'],
            ]);
        }
    }

    protected function seedZones(): void
    {
        echo "  - Seeding UK Postcode Zones...\n";

        $zones = [
            [
                'name' => 'London & Inner M25',
                'postcode_prefix' => 'EC,WC,E,N,NW,SE,SW,W,BR,CR,DA,EN,HA,IG,KT,RM,SM,TN,TW,UB',
                'region' => 'London',
            ],
            [
                'name' => 'UK Mainland South & Midlands',
                'postcode_prefix' => 'AL,B,BA,BH,BN,BS,CB,CF,CM,CO,CV,DE,DN,DT,EX,GL,GU,HP,IP,LE,LN,LU,ME,MK,NG,NN,NR,OX,PE,PO,RG,RH,SL,SN,SO,SP,SS,ST,TQ,TR,WD,WR,WS,WV',
                'region' => 'UK Mainland South',
            ],
            [
                'name' => 'UK Mainland North & Wales',
                'postcode_prefix' => 'BB,BD,BL,CA,CH,CW,DH,DL,FY,HD,HG,HU,HX,L,LA,LS,M,NE,OL,PR,SR,TS,WA,WF,WN,YO,LL,SA,SY',
                'region' => 'UK Mainland North',
            ],
            [
                'name' => 'Scotland Lowlands',
                'postcode_prefix' => 'DD,DG,EH,FK,G,KA,KY,ML,PA,TD',
                'region' => 'Scotland Lowlands',
            ],
            [
                'name' => 'Scottish Highlands & Islands',
                'postcode_prefix' => 'AB,HS,IV,KW,PH,ZE',
                'region' => 'Scottish Highlands',
            ],
            [
                'name' => 'Northern Ireland',
                'postcode_prefix' => 'BT',
                'region' => 'Northern Ireland',
            ],
        ];

        foreach ($zones as $zone) {
            $stmt = $this->pdo->prepare(
                "INSERT INTO zones (name, postcode_prefix, region, active)
                 VALUES (:name, :prefix, :region, 1)
                 ON DUPLICATE KEY UPDATE postcode_prefix = VALUES(postcode_prefix), region = VALUES(region)"
            );
            $stmt->execute([
                ':name' => $zone['name'],
                ':prefix' => $zone['postcode_prefix'],
                ':region' => $zone['region'],
            ]);
        }
    }

    protected function seedRateCardsAndRules(): void
    {
        echo "  - Seeding Rate Cards & Surcharge Rules...\n";

        // Fetch Service IDs
        $services = $this->pdo->query("SELECT id, slug FROM services")->fetchAll(PDO::FETCH_KEY_PAIR);
        $zones = $this->pdo->query("SELECT id, region FROM zones")->fetchAll(PDO::FETCH_KEY_PAIR);

        if (empty($services) || empty($zones)) {
            return;
        }

        // Basic Pricing Matrices per service
        $pricing = [
            'standard' => ['base' => 6.50, 'per_kg' => 0.50],
            'express' => ['base' => 11.50, 'per_kg' => 0.85],
            'sameday' => ['base' => 35.00, 'per_kg' => 1.50],
            'scheduled' => ['base' => 14.00, 'per_kg' => 0.75],
            'international' => ['base' => 28.00, 'per_kg' => 3.50],
        ];

        $today = date('Y-m-d');

        foreach ($services as $srvId => $slug) {
            $cardPrice = $pricing[$slug] ?? ['base' => 10.00, 'per_kg' => 1.00];

            foreach ($zones as $zoneFromId => $regionFrom) {
                foreach ($zones as $zoneToId => $regionTo) {
                    $multiplier = ($zoneFromId === $zoneToId) ? 1.0 : 1.25;

                    $stmt = $this->pdo->prepare(
                        "INSERT INTO rate_cards (service_id, zone_from_id, zone_to_id, pricing_method, base_price, per_kg_price, min_weight, max_weight, effective_from, active)
                         VALUES (:service_id, :from, :to, 'weight_based', :base, :per_kg, 0.00, 1000.00, :effective, 1)"
                    );
                    $stmt->execute([
                        ':service_id' => $srvId,
                        ':from' => $zoneFromId,
                        ':to' => $zoneToId,
                        ':base' => number_format($cardPrice['base'] * $multiplier, 2, '.', ''),
                        ':per_kg' => number_format($cardPrice['per_kg'] * $multiplier, 2, '.', ''),
                        ':effective' => $today,
                    ]);

                    $rateCardId = $this->pdo->lastInsertId();

                    // Seed rules for this rate card
                    if ($rateCardId) {
                        $rules = [
                            ['type' => 'surcharge', 'key' => 'fragile', 'amount' => 5.00, 'pct' => 0.00],
                            ['type' => 'surcharge', 'key' => 'signature', 'amount' => 2.50, 'pct' => 0.00],
                            ['type' => 'surcharge', 'key' => 'fuel', 'amount' => 0.00, 'pct' => 5.00],
                        ];

                        foreach ($rules as $rule) {
                            $rStmt = $this->pdo->prepare(
                                "INSERT INTO rate_card_rules (rate_card_id, rule_type, rule_key, amount, percentage, active)
                                 VALUES (:card_id, :type, :key, :amount, :pct, 1)"
                            );
                            $rStmt->execute([
                                ':card_id' => $rateCardId,
                                ':type' => $rule['type'],
                                ':key' => $rule['key'],
                                ':amount' => $rule['amount'],
                                ':pct' => $rule['pct'],
                            ]);
                        }
                    }
                }
            }
        }
    }
}
