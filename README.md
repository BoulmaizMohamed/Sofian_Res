# 🏖️ Beach Reservation API

A RESTful backend API for a beach reservation system built with **Laravel 12**, **MySQL**, and **JWT authentication**.

---

## 📁 Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   └── Api/
│   │       ├── ReservationController.php      # Public: create reservation
│   │       ├── AvailabilityController.php     # Public: check availability
│   │       └── Admin/
│   │           ├── AuthController.php         # Admin JWT login/logout
│   │           ├── ReservationController.php  # Admin: manage reservations
│   │           └── ScheduleController.php     # Admin: monthly schedule
│   ├── Middleware/
│   │   └── AdminAuthenticated.php             # JWT guard middleware
│   └── Requests/
│       ├── StoreReservationRequest.php
│       ├── UpdateReservationStatusRequest.php
│       └── AdminLoginRequest.php
├── Models/
│   ├── Bed.php
│   ├── Reservation.php
│   └── Admin.php
└── Services/
    ├── ReservationService.php
    ├── AvailabilityService.php
    └── ScheduleService.php
database/
├── migrations/
│   ├── ..._create_beds_table.php
│   ├── ..._create_admins_table.php
│   └── ..._create_reservations_table.php
└── seeders/
    ├── BedSeeder.php     # 20 beds
    └── AdminSeeder.php   # 1 default admin
routes/
└── api.php
```

---

## ⚙️ Setup Instructions

### 1. Clone & Install Dependencies

```bash
git clone <your-repo>
cd reservation_sofian
composer install
```

### 2. Configure Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env`:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=reservation_sofian
DB_USERNAME=root
DB_PASSWORD=your_password

ADMIN_EMAIL=admin@beach.com
ADMIN_PASSWORD=password
```

### 3. Generate JWT Secret

```bash
php artisan jwt:secret
```

### 4. Run Migrations & Seed

```bash
php artisan migrate --seed
```

This creates the `beds`, `admins`, and `reservations` tables and seeds 20 beds + 1 admin.

### 5. Start the Server

```bash
php artisan serve
```

API is available at: `http://localhost:8000/api`

---

## 📡 API Endpoints

### Base URL: `http://localhost:8000/api`

---

### 🌐 Public Endpoints

#### `POST /reservations` — Create a Reservation

**Body (JSON):**
```json
{
  "full_name": "John Doe",
  "phone_number": "0555000111",
  "reservation_type": "single",
  "bed_number": 5,
  "duration": 3,
  "date": "2026-05-01"
}
```

**Fields:**
| Field | Type | Rules |
|---|---|---|
| `full_name` | string | required, max 255 |
| `phone_number` | string | required, max 20 |
| `reservation_type` | enum | `single`, `group`, `organisation` |
| `bed_number` | integer | required, must exist in beds table |
| `duration` | integer | required, min 1 |
| `date` | date | required, `YYYY-MM-DD`, today or future |

**Response `201`:**
```json
{
  "message": "Reservation created successfully.",
  "reservation": {
    "id": 1,
    "full_name": "John Doe",
    "phone_number": "0555000111",
    "reservation_type": "single",
    "bed_number": 5,
    "duration": 3,
    "date": "2026-05-01",
    "status": "pending",
    "created_at": "2026-04-18T10:00:00Z"
  }
}
```

**Errors:**
- `422` — Validation errors or bed already reserved on that date

---

#### `GET /availability?date=YYYY-MM-DD` — Check Bed Availability

**Example:** `GET /api/availability?date=2026-05-01`

**Response `200`:**
```json
{
  "date": "2026-05-01",
  "total_beds": 20,
  "available_count": 19,
  "reserved_count": 1,
  "beds": [
    { "bed_number": 1, "status": "available" },
    { "bed_number": 5, "status": "reserved" },
    ...
  ]
}
```

---

### 🔐 Admin Endpoints (JWT Required)

#### `POST /admin/login` — Admin Login

**Body:**
```json
{
  "email": "admin@beach.com",
  "password": "password"
}
```

**Response `200`:**
```json
{
  "message": "Login successful.",
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
  "type": "bearer",
  "admin": { "id": 1, "name": "Beach Admin", "email": "admin@beach.com" }
}
```

> Use the token in the `Authorization` header as: `Bearer <token>`

---

#### `POST /admin/logout` *(Protected)*

**Headers:** `Authorization: Bearer <token>`

**Response `200`:**
```json
{ "message": "Logged out successfully." }
```

---

#### `GET /admin/me` *(Protected)* — Current Admin Info

**Response `200`:**
```json
{ "id": 1, "name": "Beach Admin", "email": "admin@beach.com" }
```

---

#### `GET /admin/reservations` *(Protected)* — List All Reservations

**Response `200`:**
```json
{
  "total": 3,
  "reservations": [ ... ]
}
```

---

#### `PATCH /admin/reservations/{id}` *(Protected)* — Update Status

**Body:**
```json
{ "status": "confirmed" }
```

Valid values: `pending`, `confirmed`, `cancelled`

**Response `200`:**
```json
{
  "message": "Reservation status updated.",
  "reservation": { ... }
}
```

---

#### `GET /admin/schedule?month=MM&year=YYYY` *(Protected)* — Monthly Schedule

**Example:** `GET /api/admin/schedule?month=5&year=2026`

**Response `200`:**
```json
{
  "month": 5,
  "year": 2026,
  "schedule": {
    "2026-05-01": [
      {
        "id": 1,
        "full_name": "John Doe",
        "bed_number": 5,
        "reservation_type": "single",
        "duration": 3,
        "status": "pending"
      }
    ]
  }
}
```

---

## 🛡️ Double-Booking Prevention

- **Application-level check**: `ReservationService` checks if `(bed_number, date)` already has a `pending` or `confirmed` reservation before inserting.
- **Database-level constraint**: A `UNIQUE` index on `(bed_number, date)` in the `reservations` table guarantees integrity at the DB level.

---

## 🗄️ Database Schema

```
beds
  id            BIGINT PK
  number        INT UNIQUE
  created_at
  updated_at

admins
  id            BIGINT PK
  name          VARCHAR
  email         VARCHAR UNIQUE
  password      VARCHAR
  created_at
  updated_at

reservations
  id            BIGINT PK
  full_name     VARCHAR
  phone_number  VARCHAR
  reservation_type  ENUM(single, group, organisation)
  bed_number    INT FK → beds.number
  duration      INT
  date          DATE
  status        ENUM(pending, confirmed, cancelled)  DEFAULT pending
  created_at
  updated_at
  UNIQUE KEY (bed_number, date)
```

---

## 📦 Default Seed Data

| Resource | Value |
|---|---|
| Beds | 20 beds (numbers 1–20) |
| Admin email | `admin@beach.com` (override via `ADMIN_EMAIL`) |
| Admin password | `password` (override via `ADMIN_PASSWORD`) |

---

## 🔧 Tech Stack

- **Runtime:** PHP 8.2+
- **Framework:** Laravel 12
- **Database:** MySQL
- **Auth:** `tymon/jwt-auth` v2.3 (JWT)
- **Architecture:** Controllers → Services → Models
