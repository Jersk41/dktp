# Digital-KTP

## Apa itu Digital-KTP

Digital-KTP (D-KTP atau DKTP) adalah perangkat lunak atau sistem yang di gunakan untuk melakukan pembuatan KTP masyarakat berbasis online.

Fungsi utama sistem D-KTP adalah sebagai sistem untuk masyarakat membuat data diri resmi penduduk dari suatu daerah. KTP sendiri berisikan data diri, mulai dari nama hingga alamat. D-KTP dibuat untuk memudahkan pembuatan KTP dan mutasi masyarakat. Perangkat lunak atau sistem ini dibuat dengan menggunakan sebuah framework php codeigniter4 dengan user interface yang simpel agar memudahkan admin serta user dalam mengakses perangkat lunak atau sistem D-KTP.

## Fitur-fitur DKTP
**Ada 3 Hak Akses**
- Superadmin
- Admin (Petugas/Operator daerah)
- User (Penduduk/Pembuat ktp)

**Superadmin:**
1. Login/logout
2. Melihat Profil
3. Mengelola Petugas
    - Melihat 
    - Menambah
    - Mengubah
    - Menghapus
4. Melihat Laporan Approval (termasuk mendownload)

**Admin:**
1. Login/logout
2. Melihat Profil
3. Mengelola Approval
    - Melihat (Detail)
    - Mengubah (Status **Meng-approve/menolak** beserta tanggapannya)
    - Menghapus
4. Melihat 'Setting'-an wilayah admin tersebut
5. Mengubah 'setting' (data wilayah admin tersebut)

**User:**
1. Login/logout
2. Registrasi Akun
3. Melihat Profil
4. Membuat KTP (membuat approval)
5. Melihat Status Approval
6. Mutasi **(Belum Dikembangkan)**

## Dibangun menggunakan
- Codeigniter 4
- Bootstrap 5 dengan Template  [Nice Admin](https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/)
- Library Javascript
    - JQuery 
    - DataTables

## Persyaratan Sistem
1. Code Editor = VSCode (sublime text/vim/dll)
2. Web Server = Apache (Apache termasuk ke dalam paket XAMPP)
3. Web Browser = Chrome/Firefox/Safari
4. Dependency Manager = Composer
5. PHP Versi 7.4 atau lebih, dengan beberapa ekstensi yang telah terpasang, yaitu:
    - [intl](http://php.net/manual/en/intl.requirements.php)
    - [libcurl](http://php.net/manual/en/curl.requirements.php) jika ingin menggunakan library HTTP\CURLRequest

    **Catatan**, Pastikan Ekstensi PHP berikut sudah di aktifkan:
    - json (aktif secara otomatis, jangan dimantikan!)
    - xml (aktif secara otomatis, jangan dimantikan!)
    - [mbstring](http://php.net/manual/en/mbstring.installation.php)
    - [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)


## Instalasi

Clone repositori ini dengan perintah `git clone https://github.com/Jersk41/dktp.git`, pastikan komputer telah terinstall git atau bisa dengan mendownload zip.

Masuk ke folder dktp, lalu jalankan perintah `composer install` untuk mendownload _dependency_ yang dibutuhkan.

Sebelum menjalankan aplikasi, jalankan perintah `php builds development` kemudian `composer update` agar _dependency_ sesuai dengan proses pengembangan (_development_).

Salin dan rename file `env` menjadi `.env` lalu konfigurasikan web sesuai dengan environment masing-masing, terutama pada bagian baseUrl dan peraturan database.

Buat database pada MySQL dengan nama **dktp**. kemudian kembali ke folder project tersebut dan jalankan perintah `php spark migrate`, pastikan nama database yang dibuat sama dengan nama database pada file `.env`.

Jalankan perintah `php spark db:seed User` untuk membuat 1 akun _default_ di tiap hak akses.

Terakhir, jalankan perintah `php spark serve` untuk membuka aplikasi lewat browser.

## Cara Penggunaan 

## Kontribusi
DKTP Dev Team:
- Miftahul Akbar
- Muhammad Fadhilatur Ramadhan
- Japar Sidik
- Noviyanti
- Nazwa Arraudhah
Dan terima kasih kepada semua yang ikut berkonstribusi di dalam DKTP.
## Bugs, Perbaikan & Kerentanan Sistem
Jika menemukan bug atau kerentanan sistem didalam DKTP, harap laporkan kepada kami pada bagian kontak dibawah ini. Semua permintaan akan segera kami tangani.

## Kontak
- akbarmiftahul569@gmail.com
- rdmfr59@gmail.com
- japarssidik820@gmail.com