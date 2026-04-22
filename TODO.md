# TODO: Fix Backend TOTP/2FA Implementation

Status: ✅ **IN PROGRESS** - Plan approved by user

## Breakdown Steps from Approved Plan:

### 1. **Create TODO.md** (Completed ✅)
   - File ini untuk track progress.

### 2. **Fix Verify2FAController.php** (✅ Completed)
   - Constructor fixed: $verifyRepo.
   - Added: `setup2FA()`, `enable2FA()`.
   - Updated `verify()`: dual session support, clear sessions, better messages.
   - ✅

### 3. **Update Verify2FARequest.php** (✅ Completed)
   - Failed validation now uses back()->withErrors() untuk web form.
   - ✅

### 4. **Minor fixes Repository** (✅ Completed)
   - Added session cleanup di enable2FA().
   - Interface OK, no changes needed.
   - ✅

### 5. **Update routes/web.php** (✅ Completed)
   - Added `/2fa/setup` (GET), `/2fa/enable` (POST) di protected group.
   - Verify routes sudah ada (public).
   - ✅

### 6. **Integration GoogleAuthController** (✅ Completed)
   - Added 2FA check setelah Google callback approved.
   - Jika enabled → session login_user_id + redirect ke /2fa/verify.
   - ✅

### 7. **Create Views** (✅ Completed)
   - Created `auth/2fa-setup.blade.php` dengan QR display & enable form.
   - Created `auth/2fa-verify.blade.php` (tidak ada sebelumnya) dengan OTP form & error handling.
   - Bootstrap styled, responsive.
   - ✅

### 7. **Create Views** (if missing)
   - `auth/2fa-setup.blade.php`
   - Update `auth/2fa-verify.blade.php`

## All Core Backend Fixes ✅

### 8. **Testing & Verification** (Next - Manual)
   - ✅ Dependencies OK (PragmaRX\Google2FA sudah ada).
   - Run `php artisan migrate` jika belum.
   - Test flow:
     1. Login Google → jika 2FA enabled → /2fa/verify.
     2. Setup 2FA: /2fa/setup → scan QR → enable.
     3. Logout → login lagi → verify OTP.
   - Clear cache: `php artisan route:cache`, `php artisan config:cache`, `php artisan view:cache`.

### 9. **Add 2FA Menu to Sidebar** (✅ Completed)
   - Tambah link `/2fa/setup` di Pengaturan section sidebar.
   - Dynamic text: '🔐 2FA (Aktif)' atau '(Setup)' berdasarkan user status.
   - ✅

### 12. **FIX: Laravel Service Container Binding** (✅ Completed)
   - ✅ Added binding `Verify2FAInterfaces → Verify2FARepositories` di AppServiceProvider::boot().
   - Sekarang Laravel bisa resolve dependency injection otomatis.
   - **Clear cache: `php artisan config:clear && php artisan optimize:clear`**

### 10. **Optional Improvements**
   - Rate limiting OTP.
   - Backup codes.
   - 2FA disable.

### 11. **Status: READY FOR TESTING ✅**
