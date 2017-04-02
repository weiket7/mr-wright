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
      $this->call(AccessSeeder::class);
      $this->call(CompanySeeder::class);
      $this->call(OfficeSeeder::class);
      $this->call(RequesterSeeder::class);
      $this->call(TicketSeeder::class);
      $this->call(UserSeeder::class);
      $this->call(SettingSeeder::class);
      $this->call(StaffSeeder::class);
      $this->call(SkillSeeder::class);
      $this->call(StaffSkillSeeder::class);
      $this->call(TicketIssueSeeder::class);
      $this->call(TicketPreferredSlotSeeder::class);
      $this->call(TicketSkillSeeder::class);
      $this->call(StaffAssignmentSeeder::class);
      $this->call(CategoryForTicketSeeder::class);
      $this->call(RoleAccessSeeder::class);
      $this->call(WorkingDayTimeSeeder::class);
      $this->call(WorkingDateBlockedSeeder::class);
      $this->call(WorkingDateTimeBlockedSeeder::class);

    }
}
