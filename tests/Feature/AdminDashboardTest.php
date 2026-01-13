<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_dashboard()
    {
        $role = UserRole::create(['role' => 'admin']);
        $admin = User::factory()->create(['user_role_id' => $role->id]);

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
    }

    public function test_student_cannot_access_admin_dashboard()
    {
        $role = UserRole::create(['role' => 'student']);
        $student = User::factory()->create(['user_role_id' => $role->id]);

        $response = $this->actingAs($student)->get('/admin/dashboard');

        // Middleware should redirect or forbid
        $response->assertStatus(403);
    }

    public function test_admin_can_change_user_role()
    {
        $adminRole = UserRole::create(['role' => 'admin']);
        $studentRole = UserRole::create(['role' => 'student']);
        $teacherRole = UserRole::create(['role' => 'teacher']);

        $admin = User::factory()->create(['user_role_id' => $adminRole->id]);
        $student = User::factory()->create(['user_role_id' => $studentRole->id]);

        $response = $this->actingAs($admin)->patch(route('admin.students.change-role', $student), [
            'role' => 'teacher'
        ]);

        $response->assertRedirect();
        $this->assertEquals($teacherRole->id, $student->fresh()->user_role_id);
    }
}
