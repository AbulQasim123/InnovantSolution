
### 🔗 GitHub Repository

[https://github.com/AbulQasim123](https://github.com/AbulQasim123)

### 🌐 Portfolio

[http://13.53.174.4/aboutme/](http://13.53.174.4/aboutme/)

##  Project Setup Instructions
# Product & Cart Management System (Admin Panel + APIs)

A full-stack Laravel-based admin panel (SPA with Livewire v3) and RESTful API for managing products and cart operations.

## Features Implemented

### Phase 1
- MySQL relational DB with Products and Images table (One-to-Many).
- PHP 8.2 + Laravel 11 + Livewire 3 SPA Admin Panel.
- Add, Edit, Delete, Update Product with multiple images.
- API to list products with multiple images (`GET /api/products`).

### Phase 2
- API to add product to cart (`POST /add-to-cart` with hardcoded `customer_id = 1`).
- API to update and delete cart items.
- API to get cart list with total price calculation.
- Admin panel to view cart data.
- Checkout API added (logic placeholder ready for integration).

---

## Admin Panel
---
- http://127.0.0.1:8000/admin
- username = admin@gmail.com
- password = admin
---

- Integrated login/logout system.
- Dashboard, Profile, Customers, Product Management, Cart View.
- Well-designed UI with Bootstrap 5.
- SPA navigation using Livewire v3.

---

## API Endpoints (via Postman Collection)

##  API Endpoint List

| Method       | Endpoint                 | Description                                   |
| ------------ | ------------------------ | --------------------------------------------- |
| `POST`       | `/add-customer`          | Add Customer.                                 |
| `GET`        | `/get-customer`          | Get All Customers.                            |
| `GET`        | `/get-product`           | Get All Product.                              |
| `POST`       | `/add-to-cart`           | Add to cart.                                  |
| `GET`        | `/get-cart`              | Cart items listing                            |
| `POST`       | `/update-cart`           | Update cart items.                            |
| `DELETE`     | `/delete-cart`           | Delete cart items.                            |

Postman Collection included in the repo.

---

## Tech Stack

- PHP 8.2+
- Laravel 11
- Livewire 3.5
- MySQL 8+
- Bootstrap 5 (Admin UI)

---

## Setup Instructions

1. Clone the repository.
2. Run `composer install`
3. Run `cp .env.example .env && php artisan key:generate`
4. Setup DB in `.env` and import `database.sql` (provided).
5. Storage link: `php artisan storage:link`
6. Start server: `php artisan serve`

---

## Submission Includes

- Full source code (Admin Panel + API)
- MySQL `.sql` DB file
- Postman Collection (with documentation)
- Clean exception handling in all APIs

---

## Notes

- Payment integration is skipped in testing due to PAN-Aadhaar unavailability, but code is structured for Stripe/Razorpay integration.
- All APIs are structured and tested for robustness.

# Cart API Documentation

Base URL: `http://127.0.0.1:8000/api`

All requests accept `application/json` and return JSON responses.

---

## 1. Add to Cart

**POST /add-to-cart**

Adds a product to the user's cart.

### Request Body
```json
{
  "product_id": 1,
  "quantity": 2,
  "customer_id": 1
}
```

### Response `201 Created`
```json
{
  "status": true,
  "message": "Product added to cart successfully.",
  "data": {
    "id": 1,
    "product_id": 1,
    "customer_id": 1,
    "quantity": 2
  }
}
```

---

## 2. Get Cart Items

**GET /get-cart?customer_id=1**

Returns all cart items for the given customer.

### Query Parameters

- `customer_id` (required): ID of the customer

### Response `200 OK`
```json
{
  "status": true,
  "total": 540,
  "data": [
    {
      "id": 1,
      "product": {
        "id": 1,
        "name": "Product Name",
        "price": 270,
        "images": [...]
      },
      "quantity": 2
    }
  ]
}
```

---

## 3. Update Cart Quantity

**Post /update-cart**

Updates the quantity of a cart item using plus or minus action.

### Request Body
```json
{
  "cart_id": 1,
  "action": "plus",  // or "minus"
  "quantity": 1
}
```

### Response `200 OK`
```json
{
  "status": true,
  "message": "Cart item quantity updated successfully.",
  "total": 4500,
  "data": {
    "id": 1,
    "product_id": 1,
    "quantity": 3
  }
}
```

---

## 4. Delete Cart Item

**DELETE /delete-cart?cart_id=1**

Deletes a cart item by cart ID.

### Request Body
```json
{
  "cart_id": 1
}
```

### Response `200 OK`
```json
{
  "status": true,
  "message": "Cart item deleted successfully."
}
```

---

## 5. Error Response Example

### Validation Error `422 Unprocessable Entity`
```json
{
  "status": false,
  "message": "Validation failed.",
  "errors": {
    "quantity": [
      "The quantity must be at least 1."
    ]
  }
}
```

### Unauthorized `403 Forbidden`
```json
{
  "status": false,
  "message": "Unauthorized: Invalid customer ID."
}
```
---
**All the best for reviewing!** 
---

