<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_is_admin_returns_true_for_admin_role()
    {
        $role = UserRole::create(['role' => 'admin']);
        $user = User::factory()->create(['user_role_id' => $role->id]);

        $this->assertTrue($user->isAdmin());
        $this->assertFalse($user->isTeacher());
        $this->assertFalse($user->isStudent());
    }

    public function test_is_teacher_returns_true_for_teacher_role()
    {
        $role = UserRole::create(['role' => 'teacher']);
        $user = User::factory()->create(['user_role_id' => $role->id]);

        $this->assertTrue($user->isTeacher());
        $this->assertFalse($user->isAdmin());
    }

    public function test_is_student_returns_true_for_student_role()
    {
        $role = UserRole::create(['role' => 'student']);
        $user = User::factory()->create(['user_role_id' => $role->id]);

        $this->assertTrue($user->isStudent());
    }

    public function test_is_old_student_returns_true_for_old_student_role()
    {
        $role = UserRole::create(['role' => 'old_student']);
        $user = User::factory()->create(['user_role_id' => $role->id]);

        $this->assertTrue($user->isOldStudent());
        $this->assertFalse($user->isStudent());
    }
}
