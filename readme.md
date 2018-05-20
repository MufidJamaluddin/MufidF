# HMVC Structure :
- Url structure		: http://[server]/[module]/[class_contoller]/[uri_method]
- Path controller 	: app/route/[module]/[contoller]/[uri_method]
- Path view			: app/view/[view_path].php

# Controller Method Rules :
- get_[uri_method]		: Access http://[server]/[module]/[class_contoller]/[uri_method] by GET request method
- post_[uri_method]		: Access http://[server]/[module]/[class_contoller]/[uri_method] by POST request method
- put_[uri_method]		: Access http://[server]/[module]/[class_contoller]/[uri_method] by PUT request method
- delete_[uri_method]	: Access http://[server]/[module]/[class_contoller]/[uri_method] by GET request method

# Note :
- Case-sensitive.
- Class contoller name = File contoller name (+.php extension).
- If you'll use the loadView, create view in php extension.
- loadView(view_path, $data), where app/view/[view_path].php and $data optional. $data['obj'] means $obj in view file.


# Example
- Contoller Path 	: app/route/home/first/Welcome.php
- Controller Class	: Welcome
 
- Database table 'barang' :

CREATE TABLE `barang` (
  `id_brg` int(11) NOT NULL PRIMARY KEY,
  `nama_brg` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `keterangan` text,
  `foto_brg` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `barang` (`id_brg`, `nama_brg`, `harga`, `keterangan`, `foto_brg`) VALUES
(13, 'DELL Inspiron 15 Gaming 7567', 4725000, '', 'Dell-Inspiron-15-Gaming-7567.jpg'),
(14, 'ASUS A555LB', 8320000, 'Asus seri A555 menghadirkan semua kebutuhan komputasi dengan desain yanag mewah dan kualitas terbaik. Laptop ini dilengkapi dengan semua fitur dan port yang kamu butuhkan untuk komputasi harian. Dengan ditenagai oleh processor Intel Core i5-5200U berkecepatan 2,2 sampai 2,7 GHz, kinerjanya untuk komputasi semakin lancar dan responsif.<br/>Untuk memudahkan kamu dalam proses editing foto dan video, laptop ini dibekali dengan RAM sebesar 4GB dan penyimpanan hardisk 1TB. Ukuran layar 15,6 inci Ultra HD 4K yang dibawa oleh laptop ini membuat kamu semakin bebas berkreasi. Terlebih laptop ini memiliki VGA Card GT940M sebesar 2GB dan dilengkapi dengan system operasi DOS, DVD-RW, kamera dan Bluetooth.', 'Asus_A555lb.jpg'),
(15, 'Lenovo Yoga 720', 1900000, 'Lenovo Yoga adalah seri laptop yang mengusung kemampuan hybrid sebagai fitur utamanya. Fitur hybrid memberikan kemudahan untuk mengubah perangkatnya menjadi tablet ataupun notebook. Laptop jenis ini akrab disebut dengan Laptop 2 in 1. Hebatnya lagi, Lenovo seri ini memiliki kemampuan layar yang dapat diputar hingga 360 derajat.<br/>Selain itu, produk ini juga dilengkapi prosesor yang dapat dikonfigurasi dengan Intel Core i7 pada varian paling tinggi. Pilihan RAM yang diberikan juga mendukung hingga RAM berkapasitas 16 GB untuk menambah performanya. Lenovo Yoga 720 memiliki pilihan layar 13 inci dan 15 inci. Kekuatan baterai hingga 8 jam saat digunakan, sehingga kamu bisa membawanya saat travelling.', 'Lenovo-Yoga-720.jpg'),
(16, 'Toshiba Satellite C55D', 4725000, '', 'Toshiba-Satellite-C55D.jpg'),
(17, 'Apple MacBook Air MMG2', 13125000, '', 'Apple-MacBook-Air-MMGF2.jpg'),
(18, 'ASUS X455J', 5225000, 'Walaupun dipasarkan dengan harga murah, laptop ini memiliki performa cukup baik sebagai laptop gaming dengan Intel Core i3-4005U-1.7 Ghz. Laptop ini dibekali dengan layar berukuran 14 inch beresolusi 1366 x 768 piksel. Soal desain, laptop Asus X455LJ ini cukup trendi dan stylish sehingga sangat cocok untuk kamu yang memprioritaskan desain.<br/>Pada sektor grafis laptop ini memiliki Nvidia Geforce GT920 2 GB. Secara garis besar, X455LJ ini cocok bagi kamu yang sering menjalankan aplikasi berat seperti Adobe Premier, aplikasi pemrograman, maupun games yang membutuhkan memori berkapasitas besar.', 'ASUS-X455LJ.jpg');


- get 
![alt text]()

- post
![alt text]()