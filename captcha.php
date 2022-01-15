<?php 

session_start();
header("Content-type: image/png");

$sesi = '';





// membuat gambar dengan menentukan ukuran
$gbr = imagecreatefrompng('../assets/images/bg6.png');

//warna background captcha
imagecolorallocate($gbr, 69, 179, 157);

// pengaturan font captcha
$color = imagecolorallocate($gbr, 253, 252, 252);
$font = '../assets/fonts/janda.ttf';
$ukuran_font = 25;
$posisi = 37;


// membuat nomor acak dan ditampilkan pada gambar
for ($i = 0; $i <= 5; $i++) {
	// jumlah karakter
	$angka = rand(0, 9);

	$sesi .= $angka;

	$kemiringan = rand(15, 15);

	imagettftext($gbr, $ukuran_font, $kemiringan, 8 + 15 * $i, $posisi, $color, $font, $angka);

	// imagettftext($gbr, $ukuran_font, 0, $center, 14, $color, $font, $angka);
}


$_SESSION['captcha'] = $sesi; 
//untuk membuat gambar 
imagepng($gbr);
imagedestroy($gbr);

?>