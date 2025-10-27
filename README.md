<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

SIAFAR - Sistem Informasi Apotek dan Farmasi

Aturan Nomor antrian:

1. Jika melakukan transaksi pesanan hari ini dan belum ada sama sekali transaksi dilakukan oleh sendiri maupun orang lain maka nomor antrian di set menjadi 001 dengan status antrian "Aktif"

2. Jika melakukan transaksi pesanan hari ini dan sudah ada transaksi sebelumnya dengan status antrian "Aktif" maka antrian sebelumnya itu ditambah satu (contoh:001 berarti + 1 = 002).

3. Jika transaksi dilakukan hari ini dan kondisi si user belum mengambil obat dengan status Siap diambil, maka di hari besok atau selanjutnya, status antrian otomatis berubah menjadi Expired dan tombol Buat Antrian Baru akan muncul.

4. Jika ada transaksi yang memiliki status antrian Expired dengan nomor antrian lama sebelumnya yang sudah expired, maka akan muncul tombol Buat Antrian untuk membuat antrian hari ini selama status pesanan masih dalam status "Siap diambil", dengan itu aplikasi akan membaca urutan antrian sebelumnya yang status antriannya "Aktif" di tambah satu (contoh: antrian sebelumnya 003 yang status antriannya "aktif" + 1) => jadi 004.

5. Jika admin update status pesanan menjadi Sudah diambil, maka status antrian berubah menjadi Expired.Aturan Nomor antrian:
6. Jika melakukan transaksi pesanan hari ini dan belum ada sama sekali transaksi dilakukan oleh sendiri maupun orang lain maka nomor antrian di set menjadi 001 dengan status antrian "Aktif"

7. Jika melakukan transaksi pesanan hari ini dan sudah ada transaksi sebelumnya dengan status antrian "Aktif" maka antrian sebelumnya itu ditambah satu (contoh:001 berarti + 1 = 002).

8. Jika transaksi dilakukan hari ini dan kondisi si user belum mengambil obat dengan status Siap diambil, maka di hari besok atau selanjutnya, status antrian otomatis berubah menjadi Expired dan tombol Buat Antrian Baru akan muncul.

9. Jika ada transaksi yang memiliki status antrian Expired dengan nomor antrian lama sebelumnya yang sudah expired, maka akan muncul tombol Buat Antrian untuk membuat antrian hari ini selama status pesanan masih dalam status "Siap diambil", dengan itu aplikasi akan membaca urutan antrian sebelumnya yang status antriannya "Aktif" di tambah satu (contoh: antrian sebelumnya 003 yang status antriannya "aktif" + 1) => jadi 004.

10. Jika admin update status pesanan menjadi Sudah diambil, maka status antrian berubah menjadi Expired.
