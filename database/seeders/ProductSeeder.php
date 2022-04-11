<?php

namespace Database\Seeders;

use App\Models\Product;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        $this->truncate('products');

        if (app()->environment(['local', 'testing'])) {
            /*
             * Note: There is currently no UI for this feature. If you are going to build a UI, and if you are going to use a WYSIWYG editor for the message (because it supports HTML on the frontend) that you properly sanitize the input before it is stored in the database.
             */
            Product::create([
                'type' => 'Bike',
                'length' => 0,
                'height' => 0,
                'width' => 0,
                'pallets' => 'Envelope',
                'max_weight' => '10kg',
                'min_charge' => 25.00,
                'per_mile' => 0.50,
                'collection_5' => 10.00,
                'collection_weekend' => 20.00,
            ]);

            Product::create([
                'type' => 'Car',
                'length' => 0,
                'height' => 0,
                'width' => 0,
                'pallets' => 'Parcel',
                'max_weight' => '40kg',
                'min_charge' => 25.00,
                'per_mile' => 0.65,
                'collection_5' => 10.00,
                'collection_weekend' => 20.00,
            ]);

            Product::create([
                'type' => 'Small Van',
                'length' => 1.3,
                'height' => 1.0,
                'width' => 1.2,
                'pallets' => '1 Small',
                'max_weight' => '400kg',
                'min_charge' => 30.00,
                'per_mile' => 0.75,
                'collection_5' => 10.00,
                'collection_weekend' => 20.00,
            ]);

            Product::create([
                'type' => 'Short Wheelbase Van',
                'length' => 2.1,
                'height' => 1.4,
                'width' => 1.2,
                'pallets' => 'Up to 2',
                'max_weight' => '800kg',
                'min_charge' => 30.00,
                'per_mile' => 0.85,
                'collection_5' => 10.00,
                'collection_weekend' => 20.00,
            ]);

            Product::create([
                'type' => 'Long Wheelbase Van',
                'length' => 3.3,
                'height' => 1.7,
                'width' => 1.2,
                'pallets' => 'Up to 3',
                'max_weight' => '1,200kg',
                'min_charge' => 30.00,
                'per_mile' => 1.00,
                'collection_5' => 10.00,
                'collection_weekend' => 20.00,
            ]);

            Product::create([
                'type' => 'Extra Long Wheelbase Van',
                'length' => 4.00,
                'height' => 1.75,
                'width' => 1.2,
                'pallets' => 'Up to 4',
                'max_weight' => '1,200kg',
                'min_charge' => 30.00,
                'per_mile' => 1.15,
                'collection_5' => 10.00,
                'collection_weekend' => 20.00,
            ]);

            Product::create([
                'type' => 'Luton',
                'length' => 4.2,
                'height' => 2.1,
                'width' => 2.0,
                'pallets' => 'Up to 6',
                'max_weight' => '1,200kg',
                'min_charge' => 40.00,
                'per_mile' => 0,
                'collection_5' => 10.00,
                'collection_weekend' => 20.00,
            ]);

            Product::create([
                'type' => '7.5 Tonne',
                'length' => 6.0,
                'height' => 2.0,
                'width' => 2.3,
                'pallets' => 'Up to 10',
                'max_weight' => '2,700kg',
                'min_charge' => 50.00,
                'per_mile' => 0,
                'collection_5' => 10.00,
                'collection_weekend' => 20.00,
            ]);

            Product::create([
                'type' => '18 Tonne',
                'length' => 7.3,
                'height' => 2.4,
                'width' => 2.4,
                'pallets' => 'Up to 14',
                'max_weight' => '9,000kg',
                'min_charge' => 60.00,
                'per_mile' => 0,
                'collection_5' => 10.00,
                'collection_weekend' => 20.00,
            ]);

            Product::create([
                'type' => 'Artic',
                'length' => 13.6,
                'height' => 2.7,
                'width' => 2.4,
                'pallets' => 'Up to 26',
                'max_weight' => '26,000kg',
                'min_charge' => 70.00,
                'per_mile' => 0,
                'collection_5' => 10.00,
                'collection_weekend' => 20.00,
            ]);

        }

        $this->enableForeignKeys();
    }
}
