<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Enrollment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EnrollmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_is_active_returns_true_when_status_is_enrolled()
    {
        $enrollment = new Enrollment(['status' => 'enrolled']);
        $this->assertTrue($enrollment->isActive());
    }

    public function test_is_active_returns_false_when_status_is_not_enrolled()
    {
        $enrollment = new Enrollment(['status' => 'pass']);
        $this->assertFalse($enrollment->isActive());
    }

    public function test_is_completed_returns_true_for_pass_or_fail()
    {
        $passed = new Enrollment(['status' => 'pass']);
        $failed = new Enrollment(['status' => 'fail']);
        $enrolled = new Enrollment(['status' => 'enrolled']);

        $this->assertTrue($passed->isCompleted());
        $this->assertTrue($failed->isCompleted());
        $this->assertFalse($enrolled->isCompleted());
    }
}
