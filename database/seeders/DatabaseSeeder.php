<?php

namespace Database\Seeders;

use App\Models\MedicalCase;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed 1 Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@jajalmedical.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // 2. Seed 1 Viewer User
        $viewer = User::firstOrCreate(
            ['email' => 'viewer@jajalmedical.com'],
            [
                'name' => 'Viewer User',
                'password' => Hash::make('password123'),
                'role' => 'viewer',
            ]
        );

        // 3. Seed at least 20 dummy cases
        $casesData = [
            ['case_number' => 'CASE-2026-0001', 'patient_reference' => 'PT-1001', 'surgeon_name' => 'Dr. Robert Chen', 'implant_type' => 'Custom Titanium Hip Stem', 'status' => 'Planning', 'priority' => 'High', 'surgery_date' => now()->addDays(5)],
            ['case_number' => 'CASE-2026-0002', 'patient_reference' => 'PT-1002', 'surgeon_name' => 'Dr. Sarah Jenkins', 'implant_type' => 'Porous Knee Femoral System', 'status' => 'In Review', 'priority' => 'Medium', 'surgery_date' => now()->addDays(12)],
            ['case_number' => 'CASE-2026-0003', 'patient_reference' => 'PT-1003', 'surgeon_name' => 'Dr. Michael Taylor', 'implant_type' => '3D Cervical Interbody Cage', 'status' => 'Approved', 'priority' => 'High', 'surgery_date' => now()->addDays(3)],
            ['case_number' => 'CASE-2026-0004', 'patient_reference' => 'PT-1004', 'surgeon_name' => 'Dr. Emily Vance', 'implant_type' => 'Patient-Specific Cranial Plate', 'status' => 'Completed', 'priority' => 'Low', 'surgery_date' => now()->subDays(10)],
            ['case_number' => 'CASE-2026-0005', 'patient_reference' => 'PT-1005', 'surgeon_name' => 'Dr. Robert Chen', 'implant_type' => 'Modular Reverse Shoulder Prosthesis', 'status' => 'Draft', 'priority' => 'Medium', 'surgery_date' => null],
            ['case_number' => 'CASE-2026-0006', 'patient_reference' => 'PT-1006', 'surgeon_name' => 'Dr. David Kim', 'implant_type' => 'Spinal Lumbar Fusion Cage', 'status' => 'Planning', 'priority' => 'High', 'surgery_date' => now()->addDays(8)],
            ['case_number' => 'CASE-2026-0007', 'patient_reference' => 'PT-1007', 'surgeon_name' => 'Dr. Sarah Jenkins', 'implant_type' => 'Custom Mandibular Reconstruction Plate', 'status' => 'In Review', 'priority' => 'Medium', 'surgery_date' => now()->addDays(15)],
            ['case_number' => 'CASE-2026-0008', 'patient_reference' => 'PT-1008', 'surgeon_name' => 'Dr. Angela Rossi', 'implant_type' => 'Bio-absorbable Interference Screw', 'status' => 'Approved', 'priority' => 'Low', 'surgery_date' => now()->addDays(20)],
            ['case_number' => 'CASE-2026-0009', 'patient_reference' => 'PT-1009', 'surgeon_name' => 'Dr. Michael Taylor', 'implant_type' => 'Custom Titanium Hip Stem', 'status' => 'Completed', 'priority' => 'High', 'surgery_date' => now()->subDays(4)],
            ['case_number' => 'CASE-2026-0010', 'patient_reference' => 'PT-1010', 'surgeon_name' => 'Dr. Emily Vance', 'implant_type' => 'Porous Knee Femoral System', 'status' => 'Cancelled', 'priority' => 'Low', 'surgery_date' => null],
            ['case_number' => 'CASE-2026-0011', 'patient_reference' => 'PT-1011', 'surgeon_name' => 'Dr. David Kim', 'implant_type' => '3D Cervical Interbody Cage', 'status' => 'Planning', 'priority' => 'Medium', 'surgery_date' => now()->addDays(9)],
            ['case_number' => 'CASE-2026-0012', 'patient_reference' => 'PT-1012', 'surgeon_name' => 'Dr. Angela Rossi', 'implant_type' => 'Spinal Lumbar Fusion Cage', 'status' => 'In Review', 'priority' => 'High', 'surgery_date' => now()->addDays(6)],
            ['case_number' => 'CASE-2026-0013', 'patient_reference' => 'PT-1013', 'surgeon_name' => 'Dr. Robert Chen', 'implant_type' => 'Custom Mandibular Reconstruction Plate', 'status' => 'Approved', 'priority' => 'Medium', 'surgery_date' => now()->addDays(22)],
            ['case_number' => 'CASE-2026-0014', 'patient_reference' => 'PT-1014', 'surgeon_name' => 'Dr. Sarah Jenkins', 'implant_type' => 'Modular Reverse Shoulder Prosthesis', 'status' => 'Completed', 'priority' => 'Low', 'surgery_date' => now()->subDays(14)],
            ['case_number' => 'CASE-2026-0015', 'patient_reference' => 'PT-1015', 'surgeon_name' => 'Dr. Michael Taylor', 'implant_type' => 'Patient-Specific Cranial Plate', 'status' => 'Draft', 'priority' => 'High', 'surgery_date' => null],
            ['case_number' => 'CASE-2026-0016', 'patient_reference' => 'PT-1016', 'surgeon_name' => 'Dr. David Kim', 'implant_type' => 'Custom Titanium Hip Stem', 'status' => 'Planning', 'priority' => 'Medium', 'surgery_date' => now()->addDays(11)],
            ['case_number' => 'CASE-2026-0017', 'patient_reference' => 'PT-1017', 'surgeon_name' => 'Dr. Angela Rossi', 'implant_type' => 'Porous Knee Femoral System', 'status' => 'In Review', 'priority' => 'Low', 'surgery_date' => now()->addDays(18)],
            ['case_number' => 'CASE-2026-0018', 'patient_reference' => 'PT-1018', 'surgeon_name' => 'Dr. Emily Vance', 'implant_type' => '3D Cervical Interbody Cage', 'status' => 'Approved', 'priority' => 'High', 'surgery_date' => now()->addDays(7)],
            ['case_number' => 'CASE-2026-0019', 'patient_reference' => 'PT-1019', 'surgeon_name' => 'Dr. Robert Chen', 'implant_type' => 'Bio-absorbable Interference Screw', 'status' => 'Completed', 'priority' => 'Medium', 'surgery_date' => now()->subDays(2)],
            ['case_number' => 'CASE-2026-0020', 'patient_reference' => 'PT-1020', 'surgeon_name' => 'Dr. Sarah Jenkins', 'implant_type' => 'Spinal Lumbar Fusion Cage', 'status' => 'Planning', 'priority' => 'High', 'surgery_date' => now()->addDays(14)],
            ['case_number' => 'CASE-2026-0021', 'patient_reference' => 'PT-1021', 'surgeon_name' => 'Dr. David Kim', 'implant_type' => 'Custom Titanium Hip Stem', 'status' => 'In Review', 'priority' => 'Medium', 'surgery_date' => now()->addDays(25)],
        ];

        foreach ($casesData as $data) {
            MedicalCase::firstOrCreate(
                ['case_number' => $data['case_number']],
                [
                    ...$data,
                    'created_by' => $admin->id,
                ]
            );
        }
    }
}
