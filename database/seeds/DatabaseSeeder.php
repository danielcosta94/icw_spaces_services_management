<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CurrencyTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(UserTypeTableSeeder::class);
        $this->call(BusinessVerticalTableSeeder::class);
        $this->call(PaymentPlanTypeTableSeeder::class);
        $this->call(UserTableSeeder::class);

        $this->call(SpaceExtraGenericTableSeeder::class);
        $this->call(SpaceTypeTableSeeder::class);
        $this->call(SpaceTableSeeder::class);
        $this->call(SpaceAvailabilityTableSeeder::class);
        $this->call(SpaceExtraTableSeeder::class);
        $this->call(SpacePhotoTableSeeder::class);
        $this->call(SpacePricePlanTableSeeder::class);

    }
}
