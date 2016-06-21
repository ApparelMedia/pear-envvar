<?php

use Illuminate\Database\Seeder;

class ConnectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('connections')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        DB::table('connections')->insert([
            'project_id' => 1,
            'is_local' => true,
            'project_path' => '/home/vagrant/www/envvar',
            'host' => 'localhost',
        ]);
    }
}