<?php

require 'connect.php';

// (1) Mulai session
session_start();
//

// (2) Ambil nilai input dari form registrasi

    // a. Ambil nilai input email
    $Email = $_POST['email'];
    // b. Ambil nilai input name
    $Nama = $_POST['name'];
    // c. Ambil nilai input username
    $Username = $_POST['username'];
    // d. Ambil nilai input password
    $Password = $_POST['password'];
    // e. Ubah nilai input password menjadi hash menggunakan fungsi password_hash()
    $Password = password_hash($_POST['password'], PASSWORD_DEFAULT);

//

// (3) Buat dan lakukan query untuk mencari data dengan email yang sama dari nilai input email
$query = "SELECT * FROM users WHERE username = '$Username'";
$hasil = mysqli_query($database, $query);
//

// (4) Buatlah perkondisian ketika tidak ada data email yang sama ( gunakan mysqli_num_rows == 0 )
if(mysqli_num_rows($hasil) == 0) {

    // a. Buatlah query untuk melakukan insert data ke dalam database

    $query2 = "INSERT INTO users (email, name, username, password) VALUES ('$Email', '$Nama', '$Username', '$Password')";
    $insertdata = mysqli_query($database, $query2);

    // b. Buat lagi perkondisian atau percabangan ketika query insert berhasil dilakukan
    //    Buat di dalamnya variabel session dengan key message untuk menampilkan pesan penadftaran berhasil

    if($insertdata) {
        $_SESSION['message'] = 'Pendaftaran berhasil, silahkan login';
        $_SESSION['color'] = 'success';
        header('Location: ../views/login.php');
    }else{
        $_SESSION['message'] = 'Pendaftaran gagal';
    }
}
// 

// (5) Buat juga kondisi else
//     Buat di dalamnya variabel session dengan key message untuk menampilkan pesan error karena data email sudah terdaftar
else{
    $_SESSION['message'] = 'Username sudah terdaftar';
    header('Location: ../views/register.php');
}
//

?>