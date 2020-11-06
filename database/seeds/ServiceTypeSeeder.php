<?php

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Type;
use Illuminate\Support\Facades\DB;


class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = Service::all();
        foreach ($services as $el) {
            $max_k = random_int(1, 4);
            for ($k = 1; $k < $max_k; $k++) {
                DB::table('services_types')->insert([
                    'service_id' => $el->id,
                    'type_id' => $k,
                    'created_at' => now()
                ]);
            }
        }

    }
}
