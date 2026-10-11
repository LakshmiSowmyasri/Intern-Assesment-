# Medical Software Requirement Traceability Matrix

**Project:** Medical Case Manager  
**Standard Practice:** Medical Device Quality Management (Software Lifecycle Traceability)  
**Company:** @Jajal Medical  

Traceability links customer/clinical input requirements directly to their concrete implementation units and corresponding verification test suites.

| ID | Requirement (input) | Implementation (output) | Verification |
| :--- | :--- | :--- | :--- |
| **REQ-001** | Admin shall be able to create a case | `CaseController@store` + `create.blade.php` / `_form.blade.php` + `CaseApiController@store` | Feature test: `admin_can_create_a_case` (`tests/Feature/MedicalCaseTest.php`) |
| **REQ-002** | Case Number shall be unique | Unique DB index on `cases.case_number` + `StoreCaseRequest` / `UpdateCaseRequest` | Feature test: `creating_a_case_with_a_duplicate_case_number_fails` (`tests/Feature/MedicalCaseTest.php`) |
| **REQ-003** | Only Admin shall delete cases | `CasePolicy@delete` + `CaseController@destroy` + `CaseApiController@destroy` | Feature test: `viewer_cannot_delete_a_case` (`tests/Feature/MedicalCaseTest.php`) |

---

## Traceability Verification Summary

- **REQ-001 (Case Creation)**:
  - Input: System user with `admin` role inputs required case clinical details.
  - Implementation: Validated by `StoreCaseRequest`, handled in `CaseController@store` and `CaseApiController@store`, persisted to `cases` table.
  - Verification: Automated feature test confirms HTTP 302/201 response and existence in database.

- **REQ-002 (Uniqueness)**:
  - Input: Medical device tracking requires non-overlapping identifiers.
  - Implementation: `case_number` column has unique constraint in migration `2026_10_08_000001_create_cases_table.php` and Form Request validation rule `'unique:cases,case_number'`.
  - Verification: Automated feature test attempts inserting duplicate case number and verifies HTTP 422 with validation errors.

- **REQ-003 (Role Authorization)**:
  - Input: Read-only viewer accounts must be barred from modifying or deleting clinical records.
  - Implementation: `CasePolicy@delete` checks `$user->role === 'admin'`. Server-side Gate authorization blocks unauthorized attempts.
  - Verification: Automated feature test authenticates as a `viewer` user, sends DELETE request, and verifies HTTP 403 Forbidden.
