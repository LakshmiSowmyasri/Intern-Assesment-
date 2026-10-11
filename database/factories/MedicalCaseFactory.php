<?php

namespace Database\Factories;

use App\Models\MedicalCase;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MedicalCase>
 */
class MedicalCaseFactory extends Factory
{
    protected $model = MedicalCase::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $implants = [
            'Custom Titanium Hip Stem',
            'Porous Knee Femoral System',
            '3D Cervical Interbody Cage',
            'Bio-absorbable Interference Screw',
            'Patient-Specific Cranial Plate',
            'Modular Reverse Shoulder Prosthesis',
            'Spinal Lumbar Fusion Cage',
            'Custom Mandibular Reconstruction Plate',
        ];

        return [
            'case_number' => sprintf('CASE-%s-%04d', now()->format('Y'), fake()->unique()->numberBetween(1000, 9999)),
            'patient_reference' => 'PT-'.fake()->numberBetween(1000, 9999),
            'surgeon_name' => 'Dr. '.fake()->lastName(),
            'implant_type' => fake()->randomElement($implants),
            'status' => fake()->randomElement(['Draft', 'Planning', 'In Review', 'Approved', 'Completed', 'Cancelled']),
            'priority' => fake()->randomElement(['Low', 'Medium', 'High']),
            'surgery_date' => fake()->boolean(80) ? fake()->dateTimeBetween('-2 weeks', '+2 months') : null,
            'created_by' => User::factory(),
        ];
    }
}
