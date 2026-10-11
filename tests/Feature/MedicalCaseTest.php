<?php

namespace Tests\Feature;

use App\Models\MedicalCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MedicalCaseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test 1: Valid login succeeds.
     */
    public function test_valid_login_succeeds(): void
    {
        $user = User::factory()->create([
            'email' => 'doctor@example.com',
            'password' => 'secret123',
        ]);

        $response = $this->post('/login', [
            'email' => 'doctor@example.com',
            'password' => 'secret123',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect('/dashboard');
    }

    /**
     * Test 2: Invalid login is rejected.
     */
    public function test_invalid_login_is_rejected(): void
    {
        $user = User::factory()->create([
            'email' => 'doctor@example.com',
            'password' => 'secret123',
        ]);

        $response = $this->post('/login', [
            'email' => 'doctor@example.com',
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
    }

    /**
     * Test 3: A guest cannot open case pages or APIs (401 / redirect).
     */
    public function test_guest_cannot_open_case_pages_or_apis(): void
    {
        // Web: Guests are redirected to login
        $webResponse = $this->get('/cases');
        $webResponse->assertRedirect('/login');

        // API: Guests receive 401 Unauthenticated
        $apiResponse = $this->getJson('/api/cases');
        $apiResponse->assertStatus(401);
    }

    /**
     * Test 4: Admin can create a case.
     */
    public function test_admin_can_create_a_case(): void
    {
        $admin = User::factory()->admin()->create();

        $casePayload = [
            'case_number' => 'CASE-2026-8801',
            'patient_reference' => 'PT-5001',
            'surgeon_name' => 'Dr. Eleanor Vance',
            'implant_type' => 'Custom Titanium Hip Stem',
            'status' => 'Planning',
            'priority' => 'High',
            'surgery_date' => now()->addDays(10)->format('Y-m-d'),
        ];

        // Web store
        $response = $this->actingAs($admin)->post('/cases', $casePayload);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('cases', [
            'case_number' => 'CASE-2026-8801',
            'patient_reference' => 'PT-5001',
            'created_by' => $admin->id,
        ]);

        // API store
        $apiPayload = [
            'case_number' => 'CASE-2026-8802',
            'patient_reference' => 'PT-5002',
            'surgeon_name' => 'Dr. Robert Chen',
            'implant_type' => 'Spinal Lumbar Fusion Cage',
            'status' => 'In Review',
            'priority' => 'Medium',
        ];

        $apiResponse = $this->actingAs($admin, 'sanctum')->postJson('/api/cases', $apiPayload);
        $apiResponse->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.case_number', 'CASE-2026-8802');

        $this->assertDatabaseHas('cases', [
            'case_number' => 'CASE-2026-8802',
        ]);
    }

    /**
     * Test 5: Creating a case with a duplicate Case Number fails (422).
     */
    public function test_creating_a_case_with_a_duplicate_case_number_fails(): void
    {
        $admin = User::factory()->admin()->create();

        // Seed existing case
        MedicalCase::factory()->create([
            'case_number' => 'CASE-2026-DUPLICATE',
            'created_by' => $admin->id,
        ]);

        $duplicatePayload = [
            'case_number' => 'CASE-2026-DUPLICATE',
            'patient_reference' => 'PT-9999',
            'surgeon_name' => 'Dr. Duplicate Tester',
            'implant_type' => 'Bio-absorbable Interference Screw',
            'status' => 'Draft',
            'priority' => 'Low',
        ];

        // Web validation returns session errors
        $webResponse = $this->actingAs($admin)->post('/cases', $duplicatePayload);
        $webResponse->assertSessionHasErrors('case_number');

        // API validation returns 422 Unprocessable Entity
        $apiResponse = $this->actingAs($admin, 'sanctum')->postJson('/api/cases', $duplicatePayload);
        $apiResponse->assertStatus(422)
            ->assertJsonValidationErrors(['case_number'])
            ->assertJsonPath('success', false);
    }

    /**
     * Test 6: Viewer cannot delete a case (403).
     */
    public function test_viewer_cannot_delete_a_case(): void
    {
        $admin = User::factory()->admin()->create();
        $viewer = User::factory()->viewer()->create();

        $case = MedicalCase::factory()->create([
            'case_number' => 'CASE-2026-SECURE',
            'created_by' => $admin->id,
        ]);

        // Web: Viewer attempting to DELETE is forbidden (403)
        $webResponse = $this->actingAs($viewer)->delete("/cases/{$case->id}");
        $webResponse->assertStatus(403);

        // API: Viewer attempting to DELETE is forbidden (403)
        $apiResponse = $this->actingAs($viewer, 'sanctum')->deleteJson("/api/cases/{$case->id}");
        $apiResponse->assertStatus(403)
            ->assertJsonPath('success', false);

        // Case must still exist in database
        $this->assertDatabaseHas('cases', [
            'id' => $case->id,
            'case_number' => 'CASE-2026-SECURE',
        ]);
    }
}
