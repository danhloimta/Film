<?php

use Illuminate\Database\Seeder;

class TicketDataTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tickets')->insert([
            [
                'total_price' => '60000',
                'calendar_id' => 1,
                'user_id' => 1,
            ],
        ]);
    }
}
