
# 📘 E-Procurement API Documentation

## 🛡️ Authentication
All protected routes use **JWT Token** (via `Authorization: Bearer <token>` header).

---

## 🔐 Auth

### POST `/api/register`
Register a new user.

**Body:**
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password"
}
```

**Response:**
```json
{
  "token": "your_jwt_token"
}
```

---

### POST `/api/login`
Log in and receive JWT token.

**Body:**
```json
{
  "email": "john@example.com",
  "password": "password"
}
```

**Response:**
```json
{
  "token": "your_jwt_token"
}
```

---

## 🏢 Vendors

### POST `/api/vendors`
Register a vendor (only 1 vendor per user).

**Headers:**
`Authorization: Bearer <token>`

**Body:**
```json
{
  "name": "PT Mitra Teknologi"
}
```

**Response:**
```json
{
  "id": 1,
  "name": "PT Mitra Teknologi",
  "user_id": 1,
  "created_at": "...",
  "updated_at": "..."
}
```

---

## 📦 Products

All product routes are **scoped to the authenticated user's vendor**.

### GET `/api/products`
List all products for the user's vendor.

**Headers:**  
`Authorization: Bearer <token>`

**Response:**
```json
[
  {
    "id": 1,
    "name": "Printer Canon",
    "description": "High-speed printer",
    "price": "120.00",
    "vendor_id": 1
  }
]
```

---

### POST `/api/products`
Add a new product.

**Body:**
```json
{
  "name": "Monitor LED",
  "description": "24 inch HD monitor",
  "price": 999.99
}
```

---

### PUT `/api/products/{id}`
Update product data.

**Body (any of):**
```json
{
  "name": "Monitor LCD",
  "price": 899.99
}
```

---

### DELETE `/api/products/{id}`
Delete a product.

**Response:**
```json
{
  "message": "Deleted"
}
```

---

### GET `/api/trashed-products/{id}`
Show deleted product (soft delete).

**Response:**
```json
[
  {
    "id": 1,
    "name": "Printer Canon",
    "description": "High-speed printer",
    "price": "120.00",
    "vendor_id": 1
  }
]
```

---

### POST `/api/restore-products/{id}`
Restore a deleted product.

**Response:**
```json
{
  "message": "Restored"
}
```

---

### POST `/api/force-delete-products/{id}`
Force delete a product.

**Response:**
```json
{
  "message": "Deleted permanently"
}
```

---

## 📁 Product Import (CSV/Excel)

### POST `/api/products/import`
Import products using CSV file.

**Headers:**
- `Authorization: Bearer <token>`
- `Content-Type: multipart/form-data`

**Form Data:**
- `file`: CSV file

**Sample CSV Format:**
```
name,description,price
Mouse Wireless,"Optical, ergonomic",150.00
Keyboard Gaming,"RGB lighting",350.00
```

**Response:**
```json
{
  "message": "Import successful"
}
```

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
