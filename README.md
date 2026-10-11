# Medical Case Manager

A Medical Case Management web application and REST API built with **Laravel 12**, **MySQL**, **Blade**, and **Laravel Sanctum**. Developed for the **@Jajal Medical** Software Developer Practical Assignment.

---

## 1. Project Overview & Tech Stack

This application tracks patient-specific implant cases from draft creation through surgical planning, review, approval, and completion. It enforces role-based access control (Admin vs. Viewer) across both Web and REST API interfaces.

- **Backend Framework:** Laravel 12 (PHP 8.3)
- **Database:** MySQL (production/local), SQLite in-memory (automated testing)
- **Authentication:** Laravel Breeze (Session/Cookie for Web UI), Laravel Sanctum (Bearer Token for REST API)
- **Frontend:** Laravel Blade with Tailwind CSS & Alpine.js
- **Testing:** PHPUnit / Pest Feature Test Suite (100% compliant with assignment specifications)
- **Code Style:** Laravel Pint PSR-12 formatting

---

## 2. User Roles & Permissions

| Role | View Cases | Create / Edit Cases | Change Status | Delete Cases |
|---|:---:|:---:|:---:|:---:|
| **Admin** | ✅ Yes | ✅ Yes | ✅ Yes | ✅ Yes |
| **Viewer** | ✅ Yes | ❌ No | ❌ No | ❌ No |

*Authorization is enforced server-side via Laravel Gate / Policy (`CasePolicy`). Non-admin users are barred with HTTP 403 Forbidden on write and delete actions.*

---

## 3. Test Login Credentials (Dummy Data)

Pre-seeded accounts available immediately after database migration and seeding:

| Role | Email | Password |
|---|---|---|
| **Admin** | `admin@jajalmedical.com` | `password123` |
| **Viewer** | `viewer@jajalmedical.com` | `password123` |

> *No real patient or medical information is used in this repository. All seeded cases and patient references (`PT-XXXX`) are purely synthetic dummy data.*

---

## 4. Setup Steps

Follow these steps to set up and run the application locally:

### Prerequisites
- PHP 8.3 or higher (with `pdo_mysql`, `openssl`, `mbstring`, `curl`)
- Composer 2.x
- MySQL 8.x or 9.x
- Node.js 18+ and npm

### Installation

```bash
# 1. Clone the repository
git clone <your-repository-url>
cd jajal

# 2. Install PHP and Composer dependencies
composer install

# 3. Environment configuration
cp .env.example .env
php artisan key:generate

# 4. Configure Database in .env
# Edit DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD to match your MySQL setup.
# Example:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=medical_cases
# DB_USERNAME=root
# DB_PASSWORD=root

# 5. Run Database Migrations and Seeders
php artisan migrate --seed

# 6. Install Frontend Assets
npm install
npm run build

# 7. Start the local development server
php artisan serve
```

Access the Web application at: **[http://localhost:8000](http://localhost:8000)**

---

## 5. REST API Documentation

All protected API endpoints require a `Bearer <token>` in the `Authorization` header, obtained via `/api/login`.

All API responses follow a uniform JSON structure:
```json
{
  "success": true,
  "data": { ... },
  "message": "Operation completed successfully."
}
```

### Endpoints Overview

| Method | Endpoint | Purpose | Access Control |
|---|---|---|---|
| `POST` | `/api/login` | Authenticate and obtain Sanctum Bearer token | Public (Anyone) |
| `POST` | `/api/logout` | Revoke current API token | Logged-in users (`auth:sanctum`) |
| `GET` | `/api/cases` | List medical cases (paginated, 10 per page) | Admin, Viewer |
| `POST` | `/api/cases` | Create a new medical case | Admin only (403 for Viewer) |
| `GET` | `/api/cases/{id}` | Retrieve case details | Admin, Viewer |
| `PUT` | `/api/cases/{id}` | Update existing case details | Admin only (403 for Viewer) |
| `DELETE` | `/api/cases/{id}` | Delete a case | Admin only (403 for Viewer) |

### HTTP Status Codes
- `200 OK`: Successful retrieval, update, or deletion.
- `201 Created`: Successful case creation.
- `401 Unauthorized`: Missing or invalid Bearer token / credentials.
- `403 Forbidden`: User lacks necessary permission (e.g. Viewer attempting modification or deletion).
- `404 Not Found`: Case record does not exist.
- `422 Unprocessable Entity`: Field-level validation failure (returns `{ "success": false, "message": "...", "errors": { ... } }`).

> A ready-to-import Postman collection is included in [`docs/postman_collection.json`](docs/postman_collection.json).

---

## 6. How to Run Tests

The test suite runs using in-memory SQLite without requiring a live MySQL database:

```bash
php artisan test
```

Or target the medical case feature test suite directly:

```bash
php artisan test --filter=MedicalCaseTest
```

### Verified Test Cases:
1. `test_valid_login_succeeds`: Verifies authenticated session on valid credentials.
2. `test_invalid_login_is_rejected`: Verifies guest status and session error on bad credentials.
3. `test_guest_cannot_open_case_pages_or_apis`: Verifies HTTP redirect for web and HTTP 401 for API.
4. `test_admin_can_create_a_case`: Verifies Admin creates cases via web and API.
5. `test_creating_a_case_with_a_duplicate_case_number_fails`: Verifies duplicate case numbers trigger HTTP 422 with field-level errors.
6. `test_viewer_cannot_delete_a_case`: Verifies server-side HTTP 403 Forbidden for Viewer role attempting deletion.

---

## 7. Assumptions & Known Limitations

1. **Patient Data Anonymization:** In adherence to HIPAA / GDPR medical privacy standards, real patient names are excluded; only synthetic alphanumeric references (`patient_reference`) are allowed.
2. **Sequential Case Numbers:** Default case numbers follow the clinical convention `CASE-YYYY-XXXX`, with uniqueness strictly enforced at both database index and form request layers.
3. **Session & Token Coexistence:** Web users utilize encrypted session cookies protected by CSRF tokens; API consumers utilize stateless Bearer tokens managed by Laravel Sanctum.
4. **Cascade Deletion:** In this initial version, deleting a user record cascades to their created cases. In high-compliance enterprise production, soft-deletes (`SoftDeletes`) and audit event logs (`audits`) would be recommended.

---

## 8. Documentation References

- Database Schema & Architecture: [`docs/database.md`](docs/database.md)
- Software Requirement Traceability Matrix: [`docs/traceability.md`](docs/traceability.md)
- Postman API Collection: [`docs/postman_collection.json`](docs/postman_collection.json)
