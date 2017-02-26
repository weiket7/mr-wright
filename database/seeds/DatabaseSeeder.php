<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->call(CompanySeeder::class);
      $this->call(OfficeSeeder::class);
      $this->call(RequesterSeeder::class);
      $this->call(TicketSeeder::class);
      $this->call(UserSeeder::class);
      $this->call(StaffSeeder::class);
      $this->call(SkillSeeder::class);
      $this->call(TicketImageSeeder::class);
      $this->call(TicketPreferredDateTimeSeeder::class);
      $this->call(StaffAssignmentSeeder::class);

    }
}
