
### 🔗 GitHub Repository

[https://github.com/AbulQasim123](https://github.com/AbulQasim123)

### 🌐 Portfolio

[http://13.53.174.4/aboutme/](http://13.53.174.4/aboutme/)

#### 
I think in the previous repo the assets were not getting rendered in the login page and admin panel. I made a big mistake. At that time I was doing 2 assignments and the assets folder was replaced by another one.
---
Task Title: Cart-to-Checkout API with Stock Control & Payment Integration

📋 Scope of Work

1. Product Management (CRUD)                                                              ✔
   - Implement product creation, listing, updating, and deletion                          ✔
   - Include and maintain accurate stock quantities                                       ✔
   - Ensure stock deduction upon successful purchase                                      ✔

2. Cart Operations                                                                        ✔
   - Add items to cart with quantity support                                              ✔
   - Update or remove cart items                                                          ✔
   - Retrieve cart details with subtotal and total calculations                           ✔

3. Stock Validation
   - Check stock availability during cart updates and checkout                            ✔
   - Prevent order placement for out-of-stock items                                       ✔

4. Checkout Process
   - Collect and validate shipping details (name, address, phone)                         ✔
   - Validate cart contents and stock before order placement                              ✔
   - Generate Order and OrderItems with frozen price snapshots                            ✔
   - Implement payment logic using a dummy or sandbox-integrated service class            ✔

5. Payment Gateway Integration
   - Integrate a sandbox/mock payment service                                             ✔
   - Handle and document both success and failure cases                                   ✔
   - Ensure abstraction via a service class                                               ✔

6. Order Statistics API
   - Build an admin-facing endpoint to return dashboard stats                             ✔
   - Include total order count, total revenue, and breakdown by status                    ✔

7. Order Management UI                                                                    ✔
   - Create a basic order listing page for admin users                                    ✔
   - Display customer details, order items, payment status                                ✔
   - Include pagination and filtering capabilities                                        ✔

8. API Development Standards                                                              ✔
   - Use RESTful conventions and Laravel Resource classes for responses                   ✔
   - Apply FormRequest validation for all incoming data                                   ✔ 
   - Ensure APIs are production-grade: clean, secure, and complete                        ✔

9. Required Deliverables                                                                  ✔
   - Git repository with full setup instructions                                          ✔
   - .env.example file including payment gateway sandbox credentials                      ✔
   - Authentication configured (Laravel Sanctum preferred)                                ✔
   - Seeder and migration scripts                                                         ✔
   - Postman collection covering all API endpoints                                        ✔
   - database.sql included, you can directly import                                       ✔
   - Orders Management Page (Blade template or frontend UI)                               ✔
   - README detailing architecture, design decisions, and test instructions               ✔

---

##  Project Setup Instructions
# Product & Cart Management System (Admin Panel + APIs)

A full-stack Laravel-based admin panel (SPA with Livewire v3) and RESTful API for managing products and cart operations.

## Features Implemented

### Phase 1
- MySQL relational DB with Products and Images table (One-to-Many).
- PHP 8.2 + Laravel 11 + Livewire 3 SPA Admin Panel.
- Add, Edit, Delete, Update Product with multiple images.
- API to list products with multiple images (`GET /api/products`).
---

## Admin Panel
---
- http://127.0.0.1:8000/admin
- username = admin@gmail.com
- password = admin
---

- Integrated login/logout system.
- Dashboard, Profile, Customers, Product Management, Cart View Order view listing.
- Well-designed UI with Bootstrap 5.
- SPA navigation using Livewire v3.

---

## API Endpoints (via Postman Collection)

##  API Endpoint List

| Method       | Endpoint                 | Description                                   |
| ------------ | ------------------------ | --------------------------------------------- |
| `POST`       | `/register-customer`     | Register Customer.                            |
| `POST`       | `/send-otp`              | Send OTP                                      |
| `GET`        | `/login`                 | Login                                         |
| `GET`        | `/profile`               | Profile                                       |
| `GET`        | `/update-profile`        | Update Profile                                |
| `GET`        | `/logout`                | Logout                                        |
| `GET`        | `/delete-account`        | Delete Account                                |
| `GET`        | `/get-product`           | Get All Product.                              |
| `POST`       | `/add-to-cart`           | Add to cart.                                  |
| `GET`        | `/get-cart`              | Cart items listing                            |
| `POST`       | `/update-cart`           | Update cart items.                            |
| `DELETE`     | `/delete-cart`           | Delete cart items.                            |
| `DELETE`     | `/checkout`              | Checkout                                      |
| `DELETE`     | `/pay-now`               | Pay Now                                       |
| `DELETE`     | `/verify-payment`        | Verify Payment                                |

Postman Collection included in the repo with documentation.

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
4. Dont run `php artisan migrate` cmd, because table structure modified directly. not done by migration.
5. Storage link: `php artisan storage:link`
6. Start server: `php artisan serve`

---

## Submission Includes

- Full source code (Admin Panel + API)
- MySQL `.sql` DB file
- Postman Collection (with documentation)
- Clean exception handling in all APIs

---
# Customer Authentication API Documentation

> This documentation describes the endpoints for customer registration, authentication, OTP verification, profile management, and account deletion.

---

##  Base URL

```
http://127.0.0.1:8000/api
```

---

##  1. Register Customer

**Endpoint:** `POST /register`

```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "mobile": "9876543210",
  "address": "123 Main Street"
}
```

 **Success Response**:

```json
{
  "status": true,
  "message": "Customer added successfully.",
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "mobile": "9876543210",
    "address": "123 Main Street"
  }
}
```

---

##  2. Send OTP

**Endpoint:** `POST /send-otp`

```json
{
  "mobile_no": "9876543210"
}
```

**Success Response**:

```json
{
  "status": true,
  "message": "We’ve sent an OTP to your mobile number.",
  "otp": 1234
}
```

---

##  3. Login (With OTP)

**Endpoint:** `POST /login`

```json
{
  "mobile_no": "9876543210",
  "otp": "1234",
  "fcm_token": "optional-token"
}
```

**Success Response**:

```json
{
  "status": true,
  "message": "Login successful",
  "token_type": "Bearer",
  "token": "your-token",
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "mobile": "9876543210",
    "address": "123 Main Street"
  }
}
```

---

## 👤 4. Get Profile

**Endpoint:** `GET /profile`

**Headers:**

```
Authorization: Bearer your-token
```

 **Success Response**:

```json
{
  "status": true,
  "message": "Profile fetched successfully",
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "mobile": "9876543210",
    "address": "123 Main Street"
  }
}
```

---

## 5. Update Profile

**Endpoint:** `POST /update-profile`

**Headers:**

```
Authorization: Bearer your-token
```

```json
{
  "name": "Updated Name",
  "email": "updated@example.com",
  "mobile": "9876543210",
  "address": "Updated Address"
}
```

 **Success Response**:

```json
{
  "status": true,
  "message": "Profile updated successfully.",
  "data": {
    "id": 1,
    "name": "Updated Name",
    "email": "updated@example.com",
    "mobile": "9876543210",
    "address": "Updated Address"
  }
}
```

---

##  6. Logout

**Endpoint:** `POST /logout`

**Headers:**

```
Authorization: Bearer your-token
```

**Success Response**:

```json
{
  "status": true,
  "message": "Logged out successfully"
}
```

---

## 7. Delete Account

**Endpoint:** `DELETE /delete-account`

**Headers:**

```
Authorization: Bearer your-token
```

**Success Response**:

```json
{
  "status": true,
  "message": "Account Deleted successfully"
}
```

---

>  All error responses follow this format:

```json
{
  "status": false,
  "message": "Error description here",
  "error": "Exception message if available"
}
```

---

## Testing Notes

* OTP expires in 10 minutes.
* All endpoints require `Accept: application/json` in headers.
* For authenticated requests, always pass Bearer token in header.


### Get Products API

**Endpoint:** `GET /api/get-product`  
**Auth:** Not Required  
**Description:** Active products fetch karta hai. Agar `product_id` diya ho, toh sirf wahi product milega. Nahi diya ho toh sab active products milenge.

**Query Parameters:**

| Name         | Type    | Required | Description                      |
|--------------|---------|----------|----------------------------------|
| product_id   | Integer |  No     | Specific product ko fetch karne ke liye use karein |

---

**Success Response (All Products):**
```json
{
  "status": true,
  "message": "Products fetched successfully.",
  "data": [
    {
      "id": 1,
      "name": "Product A",
      "slug": "product-a",
      "price": 2500,
      "description": "Product A description",
      "status": 1,
      "images": [
        {
          "id": 101,
          "product_id": 1,
          "images": "product-a.jpg"
        }
      ]
    },
    ...
  ]
}
```

**Success Response (Single Product):**
```json
{
  "status": true,
  "message": "Products fetched successfully.",
  "data": [
    {
      "id": 1,
      "name": "Product A",
      "slug": "product-a",
      "price": 2500,
      "description": "Product A description",
      "status": 1,
      "images": [
        {
          "id": 101,
          "product_id": 1,
          "images": "product-a.jpg"
        }
      ]
    }
  ]
}
```

**Error - No Products Found:**
```json
{
  "status": false,
  "message": "No products found."
}
```

**Error - Server Exception:**
```json
{
  "status": false,
  "message": "An unexpected error occurred while fetching products.",
  "error": "Exception message here"
}
```



### Cart & Order API Documentation (Laravel Sanctum, Razorpay)

---

### 1. **Add to Cart**

**POST** `/api/add-to-cart`

#### Request (JSON):

```json
{
  "product_id": 1,
  "quantity": 2
}
```

#### Response (Success):

```json
{
  "status": true,
  "message": "Product added to cart successfully.",
  "data": {
    "id": 5,
    "customer_id": 1,
    "product_id": 1,
    "quantity": 2
  }
}
```

---

### 2. **Get Cart Items**

**GET** `/api/get-cart`

#### Response:

```json
{
  "status": true,
  "total": 560000,
  "data": [
    {
      "id": 1,
      "product": {
        "id": 1,
        "name": "Sample Product",
        "price": 280000,
        "images": [...]
      },
      "quantity": 2
    }
  ]
}
```

---

### 3. **Update Cart Item**

**PUT** `/api/update-cart`

#### Request (JSON):

```json
{
  "cart_id": 1,
  "action": "plus",
  "quantity": 1
}
```

#### Response:

```json
{
  "status": true,
  "message": "Cart item quantity updated successfully.",
  "total": 840000,
  "data": {
    "id": 1,
    "quantity": 3
  }
}
```

---

### 4. **Delete Cart Item**

**DELETE** `/api/delete-cart`

#### Request (JSON):

```json
{
  "cart_id": 1
}
```

#### Response:

```json
{
  "status": true,
  "message": "Cart item deleted successfully."
}
```

---

### 5. **Checkout**

**POST** `/api/checkout`

#### Response:

```json
{
  "status": true,
  "message": "Order placed successfully.",
  "data": {
    "id": 2,
    "order_number": "ORD-64DFCE5A2E9AA",
    "total_amount": 560000,
    "status": "pending",
    "items": [
      {
        "product": {
          "id": 1,
          "name": "Sample Product",
          "price": 280000
        },
        "quantity": 2
      }
    ]
  }
}
```

---

### 6. **Pay Now (Create Razorpay Order)**

**POST** `/api/pay-now`

#### Request (JSON):

```json
{
  "order_id": 2
}
```

#### Response:

```json
{
  "status": true,
  "message": "Razorpay order created.",
  "data": {
    "order_id": 2,
    "razorpay_order_id": "order_Qz0bFIWXYC6aQG",
    "razorpay_key": "rzp_test_P5unVoUaHbdLV4",
    "amount": 560000,
    "currency": "INR",
    "name": "Irfan",
    "email": "irfan@gmail.com",
    "mobile": "9999999999"
  }
}
```

---

### 7. **Verify Payment** (Client-side Signature Verification)

**POST** `/api/verify-payment`

#### Request (JSON):

```json
{
  "order_id": 2,
  "razorpay_order_id": "order_Qz0bFIWXYC6aQG",
  "razorpay_payment_id": "pay_Qz0h3vZNyxg0qO",
  "razorpay_signature": "fakesignature=="
}
```
> I've commented Signature part of code, you can hit this api and udpate the transaction status without calling frontend
> Signature must be verified on **frontend** before calling this endpoint.

#### Response:

```json
{
  "status": true,
  "message": "Payment verified and order marked as paid."
}
```

---

### Note:

* All endpoints are protected using **Laravel Sanctum**.
* Razorpay test key is used (`rzp_test_...`), so payment is simulated.
* Call `/pay-now` after order is placed, then use Razorpay JS SDK to complete payment and send verified details to `/verify-payment`.
