<?php

use App\Entities\Invoice;
use App\Entities\Seller;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sellerA = factory(Seller::class)->create();
        $sellerB = factory(Seller::class)->create();
        $sellerC = factory(Seller::class)->create();

        collect(\App\Constants\Statuses::toArray())->each(function ($status) use ($sellerA, $sellerB, $sellerC) {
            factory(Invoice::class, random_int(20, 30))
                ->create(['seller_id' => $sellerA->id, 'status' => $status]);
            factory(Invoice::class, random_int(20, 30))
                ->create(['seller_id' => $sellerB->id, 'status' => $status]);
            factory(Invoice::class, random_int(20, 30))
                ->create(['seller_id' => $sellerC->id, 'status' => $status]);
        });
    }
}
