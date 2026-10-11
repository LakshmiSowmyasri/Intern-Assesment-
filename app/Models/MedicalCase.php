<?php

namespace App\Models;

use Database\Factories\MedicalCaseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalCase extends Model
{
    /** @use HasFactory<MedicalCaseFactory> */
    use HasFactory;

    protected $table = 'cases';

    protected $fillable = [
        'case_number',
        'patient_reference',
        'surgeon_name',
        'implant_type',
        'status',
        'priority',
        'surgery_date',
        'created_by',
    ];

    protected $casts = [
        'surgery_date' => 'date',
    ];

    // --- Relationships ---

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // --- Scopes ---

    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByPriority($query, string $priority)
    {
        return $query->where('priority', $priority);
    }

    // --- Helpers ---

    public static function generateCaseNumber(): string
    {
        $year = now()->format('Y');
        $count = static::whereYear('created_at', $year)->count() + 1;

        return sprintf('CASE-%s-%04d', $year, $count);
    }

    public static function statuses(): array
    {
        return ['Draft', 'Planning', 'In Review', 'Approved', 'Completed', 'Cancelled'];
    }

    public static function priorities(): array
    {
        return ['Low', 'Medium', 'High'];
    }
}
