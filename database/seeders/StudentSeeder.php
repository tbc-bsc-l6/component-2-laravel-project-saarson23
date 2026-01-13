<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Get student role ID
         $studentRoleId = DB::table('user_roles')->where('role', 'student')->value('id');

         $students = [
             ['name' => 'Sumni Johnson', 'email' => 'Sumni.johnson@student.college.edu'],
             ['name' => 'Aarson Taylor', 'email' => 'Aarson.taylor@student.college.edu'],
             ['name' => 'Abinesh Taylor', 'email' => 'Abinesh.taylor@student.college.edu'],
             ['name' => 'Daniel White', 'email' => 'Daniel.white@student.college.edu'],
             ['name' => 'Elizabeth Harris', 'email' => 'Elizabeth.harris@student.college.edu'],
             ['name' => 'Matthew Martin', 'email' => 'Matthew.martin@student.college.edu'],
             ['name' => 'Patricia Thompson', 'email' => 'Patricia.thompson@student.college.edu'],
             ['name' => 'George Garcia', 'email' => 'George.garcia@student.college.edu'],
             ['name' => 'Nancy Martinez', 'email' => 'Nancy.martinez@student.college.edu'],
             ['name' => 'Kevin Robinson', 'email' => 'Kevin.robinson@student.college.edu'],
         ];
 
         foreach ($students as $student) {
             // Check if student already exists
             $exists = DB::table('users')->where('email', $student['email'])->exists();
             
             if (!$exists) {
                 DB::table('users')->insert([
                     'name' => $student['name'],
                     'email' => $student['email'],
                     'password' => Hash::make('password'),
                     'user_role_id' => $studentRoleId,
                     'created_at' => now(),
                     'updated_at' => now(),
                 ]);
             }
            }
             
    }
}
