<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array(
                'menu_name' => 'Manage Users',
                'menu_url' => 'user'
               ),
            array(
                'menu_name' => 'Parking Management',
                'menu_url' => 'manage-parking'
                )
                ,
            array(
                'menu_name' => 'Parking Report',
                'menu_url' => 'report-parking'
                )
            );
        \App\Models\Admin\MenuModel::insert($data);
    }
}
