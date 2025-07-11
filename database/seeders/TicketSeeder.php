<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ticket::create([
          'name' => 'Neha',
        'subject' => 'illegal parking',
        'status' => 'in progress',
        'raised_by' => 'juhi',
        'priority' => 'Medium'
        
        ]);
    }
}




    




