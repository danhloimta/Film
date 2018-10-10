<?php

use Illuminate\Database\Seeder;

class TicketPriceDataTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ticket_prices')->insert([
            [
                'type' => '2D',
                'image' => 'poster.medium (2).jpg',
                'price_per_ticket' => 30000,
                'theater_id' => 1,
            ],
            [
                'type' => '3D',
                'image' => 'poster.medium (3).jpg',
                'price_per_ticket' => 50000,
                'theater_id' => 1,
            ],
        ]);
    }
}
