<?php 
session_start();
include ('connect.php');

// error_reporting(0);

if (isset($_POST['submit'])) {
	
	$email = addslashes(trim($_POST['email']));
	$password = addslashes(trim($_POST['password']));


	$query_cek = mysqli_query($con, "SELECT * FROM login where email = '$email' AND password = '$password'");

	$assoc = mysqli_fetch_assoc($query_cek);
	$assoc_num = mysqli_num_rows($query_cek);

	if (isset($_POST['captcha'])) {

		$captcha = addslashes(trim($_POST['captcha']));

		if ($captcha == $_SESSION['captcha']) {


			if ($assoc_num > 0) {

				$token = md5($email);
				

				$_SESSION['id'] = $assoc['id'];
				$_SESSION['nama'] = $assoc['nama'];
				$_SESSION['email'] = $assoc['email'];
				$_SESSION['password'] = $assoc['password'];
				// $_SESSION['token'] = $assoc['token'];
				$_SESSION['status'] = $assoc['status'];

				$response = '';


				$response .= '

				<script>
					toastr.options.fadeOut = 9000;
					toastr.success("Berhasil Login Tunggu <span';

					$response .= " id='waktu'";


					$response .= '>5</span> Detik")

				</script>

				
				<script type="text/javascript">

					$(document).ready(function(){

						window.setInterval(function () {
							var sisawaktu = $("#waktu").html();
							sisawaktu = eval(sisawaktu);
							if (sisawaktu == 0) {
								location.href = "index.php";
							} else {
								$("#waktu").html(sisawaktu - 1);
							}
						}, 1000);
				
					});

		 
				  
				</script>
				';
			} else {

				$response = '
				<script type="text/javascript">
				  toastr.error("Gagal Login!! Pastikan Username dan Password Kamu Udah Benar Yah:)")
				</script>
				';

			}
		} else {

			$response = '
				<script type="text/javascript">
				  toastr.error("Gagal Login!! Pastikan Captcha Kamu Udah Benar Yah:)")
				</script>
				';
		}
	} else {

		$response = '
				<script type="text/javascript">
				  toastr.error("Gagal Login!! Pastikan Captcha Kamu Udah Benar Yah:)")
				</script>
				';
	}

	

	$msg = [

		'data' => $response
	];

	echo json_encode($msg);

	

	

	

}

?>