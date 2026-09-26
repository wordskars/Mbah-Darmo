# Folder Foto Produk — public/product-images/

Taruh foto produk menu di sini. Sistem akan **otomatis mencocokkan** file foto ke nama menu
menggunakan algoritma 3 level:

---

## 📸 Cara Penamaan File

### Level 1 — Exact Match (Paling Akurat)
Nama file = slug dari nama menu (huruf kecil, spasi & karakter spesial → tanda hubung `-`).

| Nama Menu                   | Nama File yang Harus Dipakai          |
|-----------------------------|---------------------------------------|
| Mendoan Tempe Mbah Darmo    | `mendoan-tempe-mbah-darmo.jpg`        |
| Tahu Goreng Crispy          | `tahu-goreng-crispy.jpg`              |
| Es Dawet Mbah Darmo         | `es-dawet-mbah-darmo.jpg`             |
| Mie Gepeng Batok Arang      | `mie-gepeng-batok-arang.jpg`          |
| Sate Kambing Mbah Darmo     | `sate-kambing-mbah-darmo.jpg`         |

### Level 2 — Partial Match (Fleksibel)
Nama file mengandung **semua kata kunci penting** (>3 karakter) dari nama menu.

Contoh: menu `Mendoan Tempe Mbah Darmo` → file `mendoan-tempe.jpg` ✅

### Level 3 — Any Word Match (Fallback Longgar)
Jika tidak ada yang fully match, sistem pakai file yang mengandung **setidaknya 1 kata kunci**.

---

## 📐 Spesifikasi Foto yang Disarankan

- **Format:** JPG, JPEG, PNG, atau WEBP
- **Resolusi:** Minimal 600×600px, disarankan 1000×1000px atau lebih
- **Orientasi:** Square (1:1) atau landscape — produk terlihat jelas
- **Style:** Clean background atau on-plate (food photography profesional lebih bagus)
- **Ukuran file:** Max ~5 MB per foto

---

## 🔄 Cara Kerja di Sistem

Saat kamu centang menu di halaman AI Promo Assistant dan klik Generate:

1. Sistem scan folder ini mencari file yang cocok dengan nama menu
2. File yang cocok di-encode base64 → dikirim ke **Gemini Vision**
3. Gemini mendeskripsikan tampilan visual makanan tersebut (warna, tekstur, plating, dll)
4. Deskripsi visual ini dimasukkan ke `image_prompt` yang dikirim ke **Wavespeed AI**
5. Hasilnya: poster yang merepresentasikan tampilan produk secara akurat sesuai foto asli

---

## ✅ Checklist di UI

- **Ikon kamera hijau** (📷 hijau) = ada foto yang cocok → akan dianalisis Gemini
- **Ikon kamera abu-abu** (📷 abu) = belum ada foto → AI hanya pakai deskripsi teks
