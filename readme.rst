===============================
Klinik LYND - Management System
===============================

**Klinik LYND** adalah sebuah klinik tumbuh kembang anak yang berlokasi di Ciledug, Banten.  
Aplikasi ini dibangun untuk membantu proses administrasi, rekam medis, serta layanan pasien secara digital, 
sehingga operasional klinik menjadi lebih efektif, efisien, dan ramah pengguna.

.. image:: https://img.shields.io/badge/Build-Passing-brightgreen
   :alt: Build Status
.. image:: https://img.shields.io/badge/Framework-CodeIgniter%203-orange
   :alt: CodeIgniter 3
.. image:: https://img.shields.io/badge/Bootstrap-4-blue
   :alt: Bootstrap 4
.. image:: https://img.shields.io/badge/Database-MySQL%208-lightgrey
   :alt: MySQL 8

-------------
Fitur Utama
-------------

* **Manajemen Pasien**
  - Pendaftaran pasien baru
  - Riwayat kunjungan & rekam medis
  - Data tumbuh kembang anak

* **Manajemen Dokter & Tenaga Medis**
  - Jadwal praktik
  - Riwayat pemeriksaan

* **Manajemen Klinik**
  - Modul obat & resep
  - Modul pembayaran & laporan keuangan
  - Modul antrian pasien

* **Dashboard Interaktif**
  - Statistik pasien
  - Grafik layanan dan laporan harian

----------------
Teknologi Dasar
----------------

* Framework: CodeIgniter 3 (modifikasi HMVC)
* Frontend: Bootstrap 4, HTML5, CSS3, JavaScript
* Database: MySQL 8
* API: cURL, JSON
* Deployment: GitHub Actions → cPanel (FTP)

-----------------------
Struktur Direktori
-----------------------

::

   application/
       modules/       # Modul-modul utama (Pasien, Dokter, Obat, dll.)
       libraries/     # Library custom
   assets/
       app_hn/        # Asset frontend khusus aplikasi (JS, CSS, gambar)
   system/            # Core CodeIgniter
   public_html/       # Root untuk deployment di cPanel

----------------
Cara Instalasi
----------------

1. **Clone Repository**
   
   .. code-block:: bash

      git clone https://github.com/username/klinik-lynd.git
      cd klinik-lynd

2. **Buat Database**
   
   - Buat database MySQL dengan nama sesuai konfigurasi.
   - Import file `database.sql` (jika tersedia).

3. **Konfigurasi**
   
   - Sesuaikan `application/config/config.php`
   - Sesuaikan `application/config/database.php`
   - Atur base_url sesuai domain/hosting Anda.

4. **Deployment (cPanel)**
   
   Deployment otomatis menggunakan *GitHub Actions* → *FTP Upload* ke `public_html/LYND/`.

----------------
Kontribusi
----------------

Kontribusi sangat terbuka! Silakan buat *issue* atau *pull request* untuk penambahan fitur maupun perbaikan bug.

----------------
Lisensi
----------------

Aplikasi ini dilisensikan di bawah **MIT License**.  
Silakan gunakan, modifikasi, dan kembangkan sesuai kebutuhan.

----------------
Tentang Klinik LYND
----------------

Klinik LYND adalah klinik tumbuh kembang anak yang berlokasi di **Ciledug, Banten**.  
Kami berkomitmen untuk memberikan pelayanan terbaik bagi anak-anak dengan kebutuhan tumbuh kembang 
melalui pendekatan multidisiplin yang profesional dan ramah keluarga.

