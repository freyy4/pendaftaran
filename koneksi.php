<?php
	$koneksi = mysqli_connect("localhost","root","@r3km4l4n9","pjtki");
	 
	if (mysqli_connect_errno()){
		echo "Koneksi database gagal : " . mysqli_connect_error();
	}
