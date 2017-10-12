<?php

use Illuminate\Database\Seeder;
use App\Employee;

class EmployeesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $index = 0;
        $faker = Faker\Factory::create();
        while ($index < 50000) {
            $options['pid'] = 0;
            $options['full_name'] = $faker->name;
            $options['position'] = 'ProjectManager';
            $options['start_date'] = date_format($faker->dateTimeInInterval($startDate = '-10 years', $interval = '+ 10 years'), 'Y-m-d');
            $options['salary'] = 1000000;
            $options['type_img'] = '';
            $pid_level1 = Employee::create($options);
            $index++;
            for ($i = 0; $i < rand(3, 5); $i++) {
                $options['pid'] = $pid_level1->id;
                $options['full_name'] = $faker->name;
                $options['position'] = 'TeamLead';
                $options['start_date'] = date_format($faker->dateTimeInInterval($startDate = '-10 years', $interval = '+ 10 years'), 'Y-m-d');
                $options['salary'] = 500000;
                $options['type_img'] = '';
                $pid_level2 = Employee::create($options);
                $index++;
                for ($f = 0; $f < rand(2, 3); $f++) {
                    $options['pid'] = $pid_level2->id;
                    $options['full_name'] = $faker->name;
                    $options['position'] = 'Senior';
                    $options['start_date'] = date_format($faker->dateTimeInInterval($startDate = '-10 years', $interval = '+ 10 years'), 'Y-m-d');
                    $options['salary'] = 250000;
                    $options['type_img'] = '';
                    $pid_level3 = Employee::create($options);
                    $index++;
                    for ($j = 0; $j < rand(3, 4); $j++) {
                        $options['pid'] = $pid_level3->id;
                        $options['full_name'] = $faker->name;
                        $options['position'] = 'Middle';
                        $options['start_date'] = date_format($faker->dateTimeInInterval($startDate = '-10 years', $interval = '+ 10 years'), 'Y-m-d');
                        $options['salary'] = 125000;
                        $options['type_img'] = '';
                        $pid_level4 = Employee::create($options);
                        $index++;
                        for ($k = 0; $k < rand(4, 6); $k++) {
                            $options['pid'] = $pid_level4->id;
                            $options['full_name'] = $faker->name;
                            $options['position'] = 'Junior';
                            $options['start_date'] = date_format($faker->dateTimeInInterval($startDate = '-10 years', $interval = '+ 10 years'), 'Y-m-d');
                            $options['salary'] = 62500;
                            $options['type_img'] = '';
                            Employee::create($options);
                            $index++;
                        }
                    }
                }
            }
        }
    }

}
