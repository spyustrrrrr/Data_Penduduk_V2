# Sistem Manajemen Penduduk – Role Based Access Control

## Ringkasan

Sistem Manajemen Penduduk ini menerapkan **Role-Based Access Control (RBAC)** untuk membatasi hak akses pengguna berdasarkan peran.  
Terdapat dua jenis peran, yaitu **Super Admin** dan **Admin**.

Fitur pendaftaran pengguna (register) telah dihapus. Pembuatan akun Admin hanya dapat dilakukan oleh Super Admin guna meningkatkan keamanan dan kontrol sistem.

---

## Perubahan Utama

### 1. Perubahan Database

Pada tabel `users` ditambahkan dua kolom baru:

-   **role**  
    Menentukan jenis pengguna dengan nilai:

    -   `super_admin`
    -   `admin`  
        Default: `admin`

-   **can_edit**  
    Bertipe boolean untuk menentukan apakah Admin memiliki izin mengedit data.  
    Default: `false`

---

### 2. Perubahan pada User Model

Pada file `app/Models/User.php` ditambahkan beberapa helper method:

-   `isSuperAdmin()` → Mengecek apakah user adalah Super Admin
-   `isAdmin()` → Mengecek apakah user adalah Admin
-   `canEdit()` → Mengecek apakah user memiliki izin edit  
    (Super Admin selalu memiliki izin edit)

---

### 3. Penghapusan Fitur Registrasi

-   Route registrasi dihapus
-   Endpoint register tidak dapat diakses
-   Link pendaftaran tidak ditampilkan pada halaman login
-   Akun Admin hanya dapat dibuat oleh Super Admin

---

### 4. Sistem Manajemen Admin

Super Admin memiliki fitur khusus untuk mengelola akun Admin melalui `AdminController`, meliputi:

-   Melihat daftar Admin
-   Menambahkan Admin baru
-   Mengedit data Admin
-   Menghapus Admin
-   Memberikan atau mencabut izin edit (`can_edit`)

#### Tampilan (Views)

-   `admins/index.blade.php` → Daftar Admin
-   `admins/create.blade.php` → Form tambah Admin
-   `admins/edit.blade.php` → Form edit Admin

---

### 5. Middleware

Untuk mengatur akses pengguna, digunakan dua middleware:

-   **SuperAdminMiddleware**  
    Membatasi akses manajemen Admin hanya untuk Super Admin.

-   **CanEditMiddleware**  
    Memastikan user memiliki izin edit sebelum melakukan operasi tambah, ubah, atau hapus data.

---

### 6. Kontrol Akses pada Controller

Pada `ResidentController` dan `KKController`, pembatasan akses diterapkan pada method:

-   `create`
-   `store`
-   `edit`
-   `update`
-   `destroy`

User tanpa izin edit tidak dapat melakukan perubahan data.

---

### 7. Perubahan Navigasi

Menu **Manajemen Admin** hanya ditampilkan dan dapat diakses oleh Super Admin.  
Admin biasa tidak dapat melihat menu tersebut.

---

## Struktur Role dan Hak Akses

### Super Admin

Hak akses:

-   Mengelola akun Admin
-   Mengatur password Admin
-   Memberikan atau mencabut izin edit Admin
-   Mengelola seluruh data Penduduk dan Kartu Keluarga
-   Mengakses Manajemen Admin

---

### Admin

#### Admin tanpa izin edit (`can_edit = false`)

-   Dapat melihat data Penduduk dan Kartu Keluarga
-   Tidak dapat menambah, mengubah, atau menghapus data
-   Tidak dapat mengakses Manajemen Admin

#### Admin dengan izin edit (`can_edit = true`)

-   Dapat menambah, mengubah, dan menghapus data Penduduk dan Kartu Keluarga
-   Tetap tidak dapat mengakses Manajemen Admin

---

## Daftar Route Manajemen Admin

-   `GET /admins` → Daftar Admin
-   `GET /admins/create` → Form tambah Admin
-   `POST /admins` → Simpan Admin
-   `GET /admins/{admin}/edit` → Form edit Admin
-   `PUT /admins/{admin}` → Update Admin
-   `DELETE /admins/{admin}` → Hapus Admin
-   `PATCH /admins/{admin}/toggle-edit` → Toggle izin edit Admin

---

## Seeder Data Awal

Seeder `UserSeeder` menyediakan data awal:

-   1 akun Super Admin
-   1 akun Admin
