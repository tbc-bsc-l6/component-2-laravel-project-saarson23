<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Module;
use App\Models\Enrollment;
use App\Models\TeacherModule;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeacherGradingTest extends TestCase
{
    use RefreshDatabase;

    public function test_teacher_can_grade_student()
    {
        $this->withoutExceptionHandling();
        // Setup Roles
        $teacherRole = UserRole::create(['role' => 'teacher']);
        $studentRole = UserRole::create(['role' => 'student']);
        
        // Setup Users
        $teacher = User::factory()->create(['user_role_id' => $teacherRole->id]);
        $student = User::factory()->create(['user_role_id' => $studentRole->id]);
        
        // Setup Module
        $module = Module::create([
            'module' => 'Advanced Programming', 
            'slug' => 'advanced-programming',
            'is_available' => true
        ]);
        
        // Assign Teacher to Module
        TeacherModule::create([
            'user_id' => $teacher->id,
            'module_id' => $module->id
        ]);
        
        // Enroll Student
        $enrollment = Enrollment::create([
            'user_id' => $student->id,
            'module_id' => $module->id,
            'status' => 'enrolled',
            'enrolled_at' => now(),
        ]);

        // Perform Grading Action
        $response = $this->actingAs($teacher)
                         ->patch(route('teacher.grades.update', [$module, $enrollment]), [
                             'status' => 'pass'
                         ]);

        $response->assertRedirect();
        $this->assertEquals('pass', $enrollment->fresh()->status);
        $this->assertNotNull($enrollment->fresh()->completed_at);
    }

    public function test_teacher_cannot_grade_unassigned_module()
    {
        $teacherRole = UserRole::create(['role' => 'teacher']);
        $studentRole = UserRole::create(['role' => 'student']);
        
        $teacher = User::factory()->create(['user_role_id' => $teacherRole->id]);
        $student = User::factory()->create(['user_role_id' => $studentRole->id]);
        
        $module = Module::create(['module' => 'Math', 'slug' => 'math', 'is_available' => true]);
        
        // Teacher NOT assigned to module
        
        $enrollment = Enrollment::create([
            'user_id' => $student->id,
            'module_id' => $module->id,
            'status' => 'enrolled',
            'enrolled_at' => now(),
        ]);

        $response = $this->actingAs($teacher)
                         ->patch(route('teacher.grades.update', [$module, $enrollment]), [
                             'status' => 'pass'
                         ]);

        $response->assertStatus(403);
    }
}
