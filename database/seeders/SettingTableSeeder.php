<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    DB::table('settings')->insert([
      'key' => "site_name",
      'value' => config('app.name'),
      'created_at' => \Carbon\Carbon::now(),
      'updated_at' => \Carbon\Carbon::now()
    ]);
    DB::table('settings')->insert([
      'key' => "site_url",
      'value' => config('app.url'),
      'created_at' => \Carbon\Carbon::now(),
      'updated_at' => \Carbon\Carbon::now()
    ]);
    DB::table('settings')->insert([
      'key' => "tagline",
      'value' => "Awesome tabline for your panel",
      'created_at' => \Carbon\Carbon::now(),
      'updated_at' => \Carbon\Carbon::now()
    ]);
    DB::table('settings')->insert([
      'key' => "front_title",
      'value' => "",
      'created_at' => \Carbon\Carbon::now(),
      'updated_at' => \Carbon\Carbon::now()
    ]);

    DB::table('settings')->insert([
      'key' => "front_color_card_header",
      'value' => "",
      'created_at' => \Carbon\Carbon::now(),
      'updated_at' => \Carbon\Carbon::now()
    ]);


    DB::table('settings')->insert([
      'key' => "front_color_background",
      'value' => "",
      'created_at' => \Carbon\Carbon::now(),
      'updated_at' => \Carbon\Carbon::now()
    ]);

    DB::table('settings')->insert([
      'key' => "front_image",
      'value' => "",
      'created_at' => \Carbon\Carbon::now(),
      'updated_at' => \Carbon\Carbon::now()
    ]);
  }
}
