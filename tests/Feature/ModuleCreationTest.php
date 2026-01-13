<?php

namespace Tests\Feature;

use App\Models\Module;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModuleCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_module_and_slug_is_generated()
    {
        // Setup: Create an admin user
        $adminRole = UserRole::create(['role' => 'admin']);
        $admin = User::factory()->create(['user_role_id' => $adminRole->id]);

        $moduleName = 'Music Theory';

        $response = $this->actingAs($admin)
            ->post(route('admin.modules.store'), [
                'module' => $moduleName,
            ]);

        $response->assertRedirect(route('admin.modules.index'));
        $response->assertSessionHas('success', 'Module created successfully!');

        $this->assertDatabaseHas('modules', [
            'module' => $moduleName,
            'slug' => 'music-theory',
        ]);
    }
}
