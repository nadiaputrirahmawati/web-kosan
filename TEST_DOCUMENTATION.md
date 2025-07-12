# Dokumentasi Test - RegisterUserController & Sistem Authentication

## 📋 Ringkasan Test

Test suite lengkap untuk sistem authentication dengan role-based access control yang meliputi:

- **RegisterUserController** testing
- **LoginUserController** testing  
- **CheckRole Middleware** testing
- **Request Validation** testing
- **Full System Integration** testing

## 🧪 File Test yang Dibuat

### 1. **Feature Tests**
```
tests/Feature/
├── RegisterUserControllerTest.php      # Test registrasi user dengan berbagai role
├── LoginUserControllerTest.php         # Test login dan redirect berdasarkan role
├── CheckRoleMiddlewareTest.php         # Test middleware role-based access control
└── FullSystemIntegrationTest.php      # Test integrasi system secara keseluruhan
```

### 2. **Unit Tests**
```
tests/Unit/
├── RegisterUserControllerUnitTest.php  # Test method private di controller
└── RequestValidationTest.php          # Test validation rules di request classes
```

## 🚀 Menjalankan Test

### Jalankan Semua Test
```bash
php artisan test
```

### Jalankan File Test Tertentu
```bash
php artisan test tests/Feature/RegisterUserControllerTest.php
php artisan test tests/Feature/LoginUserControllerTest.php
php artisan test tests/Feature/CheckRoleMiddlewareTest.php
```

### Jalankan Test dengan Coverage
```bash
php artisan test --coverage
```

### Jalankan Test dengan Output Detail
```bash
php artisan test --verbose
```

## 📊 Cakupan Test

### Test RegisterUserController
- ✅ **Alur Registrasi**: Registrasi Admin, Owner, User
- ✅ **Deteksi Role**: Auto-detect role dari route endpoint
- ✅ **Validasi**: Field wajib, format email, konfirmasi password
- ✅ **Keamanan**: Password hashing, regenerasi session
- ✅ **Logika Redirect**: Redirect berdasarkan role setelah registrasi
- ✅ **Penanganan Error**: Email/nama duplikat, error validasi

### Test LoginUserController  
- ✅ **Alur Login**: Login Admin, Owner, User
- ✅ **Autentikasi**: Kredensial valid/invalid
- ✅ **Rate Limiting**: Proteksi brute force
- ✅ **Remember Me**: Fungsi remember
- ✅ **Intended URL**: Redirect ke URL yang dituju
- ✅ **Manajemen Session**: Regenerasi session

### Test CheckRole Middleware
- ✅ **Kontrol Akses**: Proteksi route berdasarkan role
- ✅ **Matriks Permission**: Hierarki Admin > Owner > User
- ✅ **Logika Redirect**: Redirect untuk akses tidak berwenang
- ✅ **Cek Autentikasi**: Penanganan user yang belum login
- ✅ **Penanganan Error**: Penanganan role yang tidak dikenal

### Test Request Validation
- ✅ **RegisterUserRequest**: Semua aturan validasi
- ✅ **LoginUserRequest**: Semua aturan validasi  
- ✅ **Pesan Custom**: Pesan error dalam bahasa Indonesia
- ✅ **Requirement Field**: Validasi required, format, panjang

### Test Integration
- ✅ **Alur End-to-End**: Registrasi → Login → Kontrol Akses
- ✅ **Workflow Role**: Workflow lengkap untuk setiap role
- ✅ **Ketahanan Sistem**: Error handling, validasi, keamanan

## 🎯 Skenario Test yang Dicakup

### 1. **Skenario Registrasi**
```php
✅ Admin register via /admin/register → role: admin → redirect: admin.dashboard
✅ Owner register via /owner/register → role: owner → redirect: owner.dashboard  
✅ User register via /user/register → role: user → redirect: user.dashboard
✅ Penanganan error validasi
✅ Pencegahan duplikat (email & nama)
✅ Konfirmasi password yang cocok
✅ Auto login setelah registrasi
```

### 2. **Skenario Login**
```php
✅ Kredensial valid → login berhasil → redirect berdasarkan role
✅ Kredensial invalid → pesan error → tetap di halaman login
✅ Rate limiting → 5 percobaan gagal → pesan throttle
✅ Remember me → token remember di-set
✅ Intended URL → redirect ke halaman yang diminta awalnya
✅ Regenerasi session → langkah keamanan
```

### 3. **Skenario Kontrol Akses**
```php
✅ Admin: Dapat mengakses SEMUA route (/admin/*, /owner/*, /user/*)
✅ Owner: Dapat mengakses route owner + user (/owner/*, /user/*)
✅ User: Hanya dapat mengakses route user (/user/*)
✅ Akses tidak berwenang → redirect ke dashboard yang sesuai
✅ Akses tanpa autentikasi → redirect ke login
```

## 🔒 Cakupan Test Keamanan

### Keamanan Password
- ✅ Password hashing dengan Hash::make()
- ✅ Validasi konfirmasi password
- ✅ Panjang password minimum/maksimum
- ✅ Password tidak tersimpan di old input

### Keamanan Session  
- ✅ Regenerasi session setelah login/register
- ✅ Session invalidation pada logout
- ✅ Regenerasi CSRF token

### Rate Limiting
- ✅ Proteksi brute force (5 percobaan)
- ✅ Rate limiter clearing pada login berhasil
- ✅ Throttling berdasarkan IP + email

### Kontrol Akses
- ✅ Proteksi middleware berdasarkan role
- ✅ Pengecekan requirement autentikasi
- ✅ Redirect yang benar untuk akses tidak berwenang

## 📈 Metrik Test

### Target Cakupan Kode
- **Controllers**: 95%+ coverage
- **Middleware**: 100% coverage  
- **Requests**: 100% coverage
- **Routes**: 90%+ coverage

### Distribusi Tipe Test
- **Feature Tests**: 70% (permintaan HTTP nyata)
- **Unit Tests**: 30% (test method terisolasi)

### Benchmark Performa
- **Registrasi**: < 200ms per permintaan
- **Login**: < 150ms per permintaan
- **Middleware**: < 50ms per pengecekan

## 🐛 Masalah Test Umum & Solusinya

### Masalah Database
```bash
# Reset database sebelum testing
php artisan migrate:fresh --env=testing
```

### Masalah Session
```bash
# Bersihkan session sebelum test
php artisan cache:clear
php artisan session:flush
```

### Masalah Route Cache
```bash
# Bersihkan route cache
php artisan route:clear
php artisan config:clear
```

## ✅ Checklist Test

Sebelum deployment, pastikan semua test cases ini PASS:

### Fungsionalitas Inti
- [ ] User dapat register dengan semua role (admin/owner/user)
- [ ] User dapat login dengan kredensial yang valid
- [ ] Role-based access control berfungsi dengan benar
- [ ] Manajemen session aman dan proper

### Keamanan  
- [ ] Password di-hash dengan benar
- [ ] Rate limiting berfungsi untuk mencegah brute force
- [ ] Regenerasi session berjalan setelah auth events
- [ ] Akses tidak berwenang di-redirect dengan proper

### Validasi
- [ ] Semua required fields tervalidasi
- [ ] Email format dan uniqueness tervalidasi  
- [ ] Konfirmasi password berfungsi
- [ ] Pesan error custom dalam Bahasa Indonesia

### Pengalaman Pengguna
- [ ] Auto login setelah registrasi
- [ ] Redirect berdasarkan role setelah login
- [ ] Redirect intended URL berfungsi
- [ ] Pesan error user-friendly

## 🚦 Menjalankan Test Sebelum Deployment

```bash
# 1. Reset environment
php artisan config:clear
php artisan route:clear
php artisan cache:clear

# 2. Jalankan test suite lengkap
php artisan test

# 3. Cek cakupan test spesifik
php artisan test --coverage-html reports/

# 4. Jalankan performance tests
php artisan test --group=performance
```
