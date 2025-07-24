# 🛒 Cart API Documentation

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

**PUT /update-cart**

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
  "total": 810,
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
