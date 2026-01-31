# 📦 Backend API – Vendor, Item & Order Management System

## 📌 Deskripsi Project

Project ini merupakan **Backend REST API** yang dibangun menggunakan **Laravel** dan **MySQL** untuk mendukung sistem manajemen vendor, item, order, serta laporan (report) sesuai dengan **case study** yang diberikan.

Sistem ini dilengkapi dengan:

- Autentikasi menggunakan **JWT**
- CRUD Vendor, Item, Order, Vendor Item
- 3 jenis laporan (report) sebagai **key value system**

---

## 🛠️ Teknologi yang Digunakan

- **PHP** >= 8.x
- **Laravel** >= 10
- **MySQL**
- **JWT Authentication**
- **REST API**

---

## 🔐 Autentikasi

Sistem menggunakan **JWT (JSON Web Token)** untuk keamanan API.

### Endpoint Auth

| Method | Endpoint      | Keterangan     |
| ------ | ------------- | -------------- |
| POST   | `/api/login`  | Login user     |
| GET    | `/api/me`     | Cek user login |
| POST   | `/api/logout` | Logout         |

Semua endpoint CRUD dan report **wajib menggunakan Bearer Token**.

---

## 📁 Struktur Tabel Database

### 1. Tabel `vendor`

| Kolom       |
| ----------- |
| id_vendor   |
| kode_vendor |
| nama_vendor |
| created_at  |
| updated_at  |

---

### 2. Tabel `item`

| Kolom      |
| ---------- |
| id_item    |
| kode_item  |
| nama_item  |
| created_at |
| updated_at |

---

### 3. Tabel `vendor_item`

| Kolom          |
| -------------- |
| id_vendor_item |
| id_vendor      |
| id_item        |
| harga_sebelum  |
| harga_sekarang |
| created_at     |
| updated_at     |

---

### 4. Tabel `order`

| Kolom         |
| ------------- |
| id_order      |
| tanggal_order |
| no_order      |
| id_vendor     |
| id_item       |
| created_at    |
| updated_at    |

> Catatan:
> Satu order dapat memiliki lebih dari satu item dengan cara menyimpan beberapa baris data dengan `no_order` yang sama.

---

## 🔄 CRUD API

### Vendor

| Method | Endpoint            |
| ------ | ------------------- |
| GET    | `/api/vendors`      |
| POST   | `/api/vendors`      |
| GET    | `/api/vendors/{id}` |
| PUT    | `/api/vendors/{id}` |
| DELETE | `/api/vendors/{id}` |

---

### Item

| Method | Endpoint          |
| ------ | ----------------- |
| GET    | `/api/items`      |
| POST   | `/api/items`      |
| GET    | `/api/items/{id}` |
| PUT    | `/api/items/{id}` |
| DELETE | `/api/items/{id}` |

---

### Vendor Item

| Method | Endpoint                 |
| ------ | ------------------------ |
| GET    | `/api/vendor-items`      |
| POST   | `/api/vendor-items`      |
| GET    | `/api/vendor-items/{id}` |
| PUT    | `/api/vendor-items/{id}` |
| DELETE | `/api/vendor-items/{id}` |

---

### Order

| Method | Endpoint                 |
| ------ | ------------------------ |
| GET    | `/api/orders`            |
| POST   | `/api/orders`            |
| GET    | `/api/orders/{no_order}` |
| DELETE | `/api/orders/{no_order}` |

---

## 📊 REPORT API

### 1️⃣ Report Item per Vendor

Menampilkan daftar item yang disediakan oleh masing-masing vendor.

**Endpoint**

```
GET /api/reports/vendor-items
```

**Output**

- Vendor
- List item yang dimiliki vendor

---

### 2️⃣ Report Ranking Vendor Berdasarkan Transaksi

Menampilkan vendor berdasarkan jumlah transaksi terbanyak.

**Endpoint**

```
GET /api/reports/vendor-ranking
```

**Output**

- Vendor
- Jumlah transaksi
- Urutan berdasarkan transaksi terbanyak

---

### 3️⃣ Report Rate Harga Item Vendor

Menampilkan naik/turunnya harga item tiap vendor.

**Perhitungan**

- Selisih = harga_sekarang − harga_sebelum
- Rate = (selisih / harga_sebelum) × 100
- Status:
    - `up` → harga naik
    - `down` → harga turun
    - `stable` → harga tetap

**Endpoint**

```
GET /api/reports/vendor-item-price-rate
```

---

## 🧪 Testing API

Testing API dilakukan menggunakan:

- **REST Client**
- **Postman**
- **Thunder Client**

Seluruh request menggunakan:

```
Authorization: Bearer {token}
```

---

## 🚀 Cara Menjalankan Project

```bash
git clone <repository-url>
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Akses API:

```
http://127.0.0.1:8000/api
```

---
