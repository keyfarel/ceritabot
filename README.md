# 🤖 Ceritabot – AI Psikolog Virtual

**Ceritabot** adalah chatbot berbasis AI yang dirancang untuk menjadi teman curhat virtual. Kamu bisa menceritakan apa pun yang kamu rasakan, dan Ceritabot akan merespons dengan empati dan perhatian — layaknya seorang teman atau pendengar yang baik.

---

## ✨ Fitur Utama

- **AI Psikolog Virtual:** Merespons secara natural dan mendukung secara emosional.
- **Tampilan Chat Interaktif:** Tampilan seperti aplikasi chat modern, memisahkan pesan user dan asisten.
- **Penanda Waktu:** Setiap pesan dilengkapi dengan timestamp yang rapi.
- **Auto Scroll:** Otomatis menggulir ke bawah saat ada pesan baru.
- **Validasi Input:** Form input memiliki validasi dan efek animasi jika ada kesalahan.

---

## 🖼️ Desain Tampilan

- Komponen utama mencakup:
  - Header dengan nama dan ikon AI.
  - Prompt ajakan untuk bercerita.
  - Riwayat chat yang menampilkan percakapan antara user dan asisten.
  - Form input untuk menulis pesan.
  - Tombol kirim dengan animasi loading.

- Pesan ditampilkan berbeda tergantung dari peran:
  - **User:** Background biru dengan teks putih dan timestamp di kanan bawah.
  - **Asisten:** Background abu-abu muda dengan teks gelap dan timestamp di kiri bawah.

---

## ⚙️ Teknologi yang Digunakan

- Laravel Livewire – Komunikasi real-time dan komponen reaktif.
- Tailwind CSS – Styling yang konsisten dan fleksibel.
- Carbon – Format waktu dengan mudah.
- JavaScript – Auto-scroll saat ada pesan baru.

---

## 🚀 Cara Menjalankan Proyek

Berikut langkah-langkah untuk menjalankan Ceritabot di lokal:

1. **Clone repository ke komputer kamu**
   ```
   git clone https://github.com/[username]/ceritabot.git
   cd ceritabot
   ```

2. **Install semua dependencies**
   ```
   composer install
   npm install
   ```

3. **Copy file environment dan generate app key**
   ```
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi file `.env` sesuai kebutuhan**, termasuk koneksi database jika diperlukan.

5. **Jalankan migrasi (jika menggunakan database)**
   ```
   php artisan migrate
   ```

6. **Jalankan development server Laravel dan Vite**
   ```
   php artisan serve
   npm run dev
   ```

7. **Buka di browser**
   ```
   http://localhost:8000
   ```

---

## 📝 Lisensi

Proyek ini dilisensikan dengan [MIT License](LICENSE).
