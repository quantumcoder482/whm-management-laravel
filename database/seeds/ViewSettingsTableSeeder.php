<?php

use Illuminate\Database\Seeder;

class ViewSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('view_settings')->insert([
            'setting' => 'org_name',
            'value' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('view_settings')->insert([
            'setting' => 'domain',
            'value' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('view_settings')->insert([
            'setting' => 'subdomain',
            'value' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('view_settings')->insert([
            'setting' => 'super_user',
            'value' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('view_settings')->insert([
            'setting' => 'super_password',
            'value' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('view_settings')->insert([
            'setting' => 'admin_user',
            'value' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('view_settings')->insert([
            'setting' => 'admin_password',
            'value' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('view_settings')->insert([
            'setting' => 'db_name',
            'value' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('view_settings')->insert([
            'setting' => 'db_user',
            'value' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('view_settings')->insert([
            'setting' => 'db_password',
            'value' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('view_settings')->insert([
            'setting' => 'created_by',
            'value' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('view_settings')->insert([
            'setting' => 'owner_name',
            'value' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('view_settings')->insert([
            'setting' => 'sale_type',
            'value' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('view_settings')->insert([
            'setting' => 'email',
            'value' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('view_settings')->insert([
            'setting' => 'created_at',
            'value' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
