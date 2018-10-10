<?php

use Illuminate\Database\Seeder;

class SeatDataTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seats')->insert([
            [
                'name' => 'E4',
                'ticket_id' => 1,
            ],
            [
                'name' => 'E5',
                'ticket_id' => 1,
            ],
        ]);
    }
}
