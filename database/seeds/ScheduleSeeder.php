<?php

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Type;
use Illuminate\Support\Facades\DB;


class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $servicesTypes = DB::table('services_types')->get();
        foreach ($servicesTypes as $type) {
            for ($d = 0; $d < 21; $d++) { //Перебираем дни на 3 недели вперед
                for ($h = 8; $h < 18; $h++) { //Перебираем часы
                    for ($q = 0; $q < 4; $q++) { //Четверти часа
                        $make = rand(0, 50); //рулетка: вносим или не вносим запись
                        if ($make < 2) {
                            DB::table('schedules')->insert([
                                'service_id' => $type->service_id,
                                'service_type_id' => $type->type_id,
                                'work_day' => date("Y-m-d", strtotime("+" . $d . " days")),
                                'work_time' => $h + $q / 4,
                                'created_at' => now()
                            ]);
                        }
                    }
                }
            }
        }


    }
}
