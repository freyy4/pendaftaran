<?php include "head.php"; ?>

<?php
      $id_daftar = $_SESSION['id_daftar'];
  ?>
<?php
  session_start();
  if (empty($_SESSION['login'])) {
      header("Location:index.php");
  }
  include "koneksi.php";
  $id_daftar = $_SESSION['id_daftar'];
  if (strpos($id_daftar, 'CBM-PMI-') === 0) {
      $sql = "SELECT d.id, d.id_daftar, d.nik, d.nama_lengkap, d.alamat_lengkap, d.aktif, d.terima, d.email, d.jk, d.status, d.kk, d.akte_kelahiran, d.akte_cerai, d.buku_nikah, d.foto, d.foto_ktp, d.selfie_ktp, d.pas, d.telepon, d.video, d.tempat_lahir, d.tgl_lahir, d.surat_keluarga, d.tinggi, d.berat, d.pekerjaan, d.updated_at, d.negara, p.nama AS provinsi, k.nama AS kota, kc.nama AS kecamatan, ds.nama AS desa, d.alamat_lengkap 
      FROM daftar d 
      JOIN provinsi p ON d.id_provinsi = p.id_provinsi 
      JOIN kota k ON d.id_kota = k.id_kota 
      JOIN kecamatan kc ON d.id_kecamatan = kc.id_kecamatan 
      JOIN desa ds ON d.id_desa = ds.id_desa 
      WHERE d.id_daftar=?";
      $stmt = $koneksi->prepare($sql);
      $stmt->bind_param("s", $id_daftar);
      $stmt->execute();
      $result = $stmt->get_result();
      $row1 = $result->fetch_assoc();
      $sql2 = "SELECT * FROM sekolah WHERE id_daftar=?";
      $stmt2 = $koneksi->prepare($sql2);
      $stmt2->bind_param("s", $id_daftar);
      $stmt2->execute();
      $result2 = $stmt2->get_result();
      $data_sekolah = array();
      if ($result2->num_rows > 0) {
          while ($row = $result2->fetch_assoc()) {
              $data_sekolah[] = array(
                  'id' => $row['id'],
                  'nama_sekolah' => $row['nama_sekolah'],
                  'tgl_masuk_sekolah' => $row['tgl_masuk_sekolah'],
                  'tgl_lulus_sekolah' => $row['tgl_lulus_sekolah'],
                  'ijazah_sekolah' => $row['ijazah_sekolah']
              );
          }
      }
      $sql3 = "SELECT * FROM pengalaman WHERE id_daftar=?";
      $stmt3 = $koneksi->prepare($sql3);
      $stmt3->bind_param("s", $id_daftar);
      $stmt3->execute();
      $result3 = $stmt3->get_result();
      $data_pengalaman = array(); 
      if ($result3->num_rows > 0) {
          while ($row = $result3->fetch_assoc()) {
              $data_pengalaman[] = array(
                  'id' => $row['id'],
                  'nama_perusahaan' => $row['nama_perusahaan'],
                  'tgl_masuk_perusahaan' => $row['tgl_masuk_perusahaan'],
                  'tgl_keluar_perusahaan' => $row['tgl_keluar_perusahaan'],
                  'pekerjaan' => $row['pekerjaan'],
                  'jabatan' => $row['jabatan'],
                  'keterangan' => $row['keterangan'],
                  'sertifikasi' => $row['sertifikasi']
              );
          }
      }
      $sql4 = "SELECT * FROM pelatihan WHERE id_daftar=?";
      $stmt4 = $koneksi->prepare($sql4);
      $stmt4->bind_param("s", $id_daftar);
      $stmt4->execute();
      $result4 = $stmt4->get_result();
      $data_pelatihan = array();
      if ($result4->num_rows > 0) {
          while ($row = $result4->fetch_assoc()) {
              $data_pelatihan[] = array(
                  'id' => $row['id'],
                  'instansi' => $row['instansi'],
                  'tgl_keluar_sertifikat' => $row['tgl_keluar_sertifikat'],
                  'no_sertifikat' => $row['no_sertifikat'],
                  'jenis' => $row['jenis'],
                  'uraian' => $row['uraian'],
                  'sertifikat' => $row['sertifikat']
              );
          }
      }

        $sql5 = "SELECT * FROM interview WHERE id_daftar=?";
        $stmt5 = $koneksi->prepare($sql5);
        $stmt5->bind_param("s", $id_daftar);
        $stmt5->execute();
        $result5 = $stmt5->get_result();

      $stmt->close();
      $stmt2->close();
      $stmt3->close();
      $stmt4->close();
      $koneksi->close();
  } else {
      echo "";
  }
  function checkDocument($row, $documentFieldName, $documentLabel) {
      $documentPath = $row[$documentFieldName];
  
      if ($documentFieldName === 'buku_nikah' && $row['status'] === 'Sudah Menikah') {
          if (!file_exists($documentPath)) {
              echo '
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <form action="upload_'.$documentFieldName.'.php" method="post" enctype="multipart/form-data" style="display: inline-block;">
                      <input type="file" class="hidden-input" name="uploaded_file" accept="image/*, application/pdf" required>
                      <button type="submit" class="btn btn-primary btn-sm" name="update">Upload Sekarang</button>
                  </form>
              </div>';
          }
      } elseif ($documentFieldName === 'akte_cerai' && ($row['status'] === 'Cerai Mati' || $row['status'] === 'Cerai Hidup')) {
          if (!file_exists($documentPath)) {
              echo '
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <form action="upload_'.$documentFieldName.'.php" method="post" enctype="multipart/form-data" style="display: inline-block;">
                      <input type="file" class="hidden-input" name="uploaded_file" accept="image/*, application/pdf" required>
                      <button type="submit" class="btn btn-primary btn-sm" name="update">Upload Sekarang</button>
                  </form>
              </div>';
          }
      } else {
          if (!file_exists($documentPath)) {
              echo '
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <form action="upload_'.$documentFieldName.'.php" method="post" enctype="multipart/form-data" style="display: inline-block;">
                      <input type="file" class="hidden-input" name="uploaded_file" accept="image/*, application/pdf" required>
                      <button type="submit" class="btn btn-primary btn-sm" name="update">Upload Sekarang</button>
                  </form>
              </div>';
          }
      }
  }
?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <?php include "navbar.php"; ?>
        <?php include "sidebar.php"; ?>
        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <?php
                        if (empty($row1)) {
                            echo '<div class="card text-center mx-auto">
                            <div class="card-body">
                                <img src="bg.png" width="300px">
                                <p>
                                    Yaaaah... Anda Belum Terdaftar, Silahkan Mendaftar dulu 🙏 .
                                </p>
                                <a href="daftar.php" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Daftar Sekarang</a>
                            </div>
                        </div>';
                        } else {
                        ?>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active text-success text-bold" aria-current="page">Data Diri
                                </li>
                                <li class="breadcrumb-item active text-success text-bold" aria-current="page">Riwayat
                                    Pendidikan
                                </li>
                                <li class="breadcrumb-item active text-success text-bold" aria-current="page">Pengalaman
                                    Bekerja
                                </li>
                                <li class="breadcrumb-item active text-success text-bold" aria-current="page">Pelatihan
                                </li>
                                <li class="breadcrumb-item active text-bold" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Biodata Diri</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="image_pre">
                                        <img src="<?php echo $row1['pas']; ?>" width="150" height="170">
                                    </div>
                                    <div class="col-lg-10">
                                        <dl class="row">
                                            <div class="col-md-9">
                                                <strong class="text-primary"><?php echo $row1['id_daftar']; ?></strong>
                                                <h1><?php echo $row1['nama_lengkap']; ?></h1>
                                                <span class="text-primary">
                                                    <i class="fa fa-check-circle fa-fw mr-2"></i>&nbsp;
                                                    <?php echo $row1['jk']; ?>
                                                    &nbsp;
                                                    <i class="fa fa-check-circle fa-fw mr-2"></i>&nbsp;
                                                    <?php 
                                                        $tgl_lahir = new DateTime($row1['tgl_lahir']);
                                                        $today = new DateTime();
                                                        $umur = $today->diff($tgl_lahir);
                                                        if ($umur->y > 0) {
                                                            echo $umur->y . ' Tahun';
                                                        } elseif ($umur->m > 0) {
                                                            echo $umur->m . ' Bulan';
                                                        } elseif ($umur->d > 0) {
                                                            echo $umur->d . ' Hari';
                                                        } else {
                                                            $time_difference = $today->getTimestamp() - $tgl_lahir->getTimestamp();
                                                            $hours_difference = round($time_difference / 3600);

                                                            if ($hours_difference < 24) {
                                                                echo 'Baru lahir';
                                                            } else {
                                                                echo 'Age not calculated';
                                                            }
                                                        }
                                                    ?>

                                                </span> <br>
                                                <span>
                                                    <i class="fas fa-mobile-alt fa-fw mr-2"></i>&nbsp;
                                                    <?php echo $row1['telepon']; ?>
                                                    &nbsp;
                                                    <i class="far fa-envelope fa-fw mr-2"></i>&nbsp;
                                                    <?php echo $row1['email']; ?> &nbsp;
                                                    <i class="fa fa-address-book fa-fw mr-2"></i>&nbsp;
                                                    <?php echo $row1['tempat_lahir']; ?>,
                                                    <?php
                                                        $tanggal_input = $row1['tgl_lahir'];
                                                        setlocale(LC_TIME, 'id_ID');
                                                        $tanggal_output = strftime("%e %B %Y", strtotime($tanggal_input));
                                                        echo $tanggal_output;
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="col-md-3">
                                                <a href="edit.php?id=<?php echo $row1['id']; ?>"
                                                    class="btn btn-dark btn-sm" onclick="return yakin(event)">
                                                    <i class="fa fa-pen"></i> Ubah Data Diri
                                                </a>
                                                <a href="generate.php?id_daftar=<?php echo $row1['id_daftar']; ?>"
                                                    class="btn btn-danger btn-sm" target="_blank">
                                                    <i class="fa fa-download"></i> Unduh Formulir Pendaftaran
                                                </a>
                                                <?php
                                                if ($result5->num_rows == 0) {
                                                ?>
                                                <a href="pertanyaan.php?id_daftar=<?php echo $id_daftar; ?>"
                                                    class="btn btn-success btn-sm">Interview</a>
                                                <?php
                                            }
                                            $stmt5->close();
                                            ?>
                                            </div>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <dt>Detail Penerimaan dan Aktivasi</dt><br>
                                        <div class="timeline">
                                            <div class="time-label">
                                                <span class="bg-primary">Penerimaan</span>
                                            </div>
                                            <div>
                                                <?php 
                                                    if ($row1['terima'] == 'terima') {
                                                        echo '<i class="fas fa-check bg-success"></i>
                                                        <div class="timeline-item">
                                                            <h2 class="timeline-header">'. $row1['updated_at'] .'</h2>
                                                            <p class="timeline-body">Halo, Dengan ini kami sampaikan dari pihak HRD PT. Crystal Biru Meuligo bahwa Berdasarkan Kelengkapan berkas dan Hasil Interview, kami nyatakan Anda diterima, maka dari itu, kami ingin mengundang saudara agar turut hadir dalam tes wawancara. Tes wawancara ini akan diadakan pada: <br> <br>
                                                            Pukul   :      09.00 WIB - 17.00 WIB <br>
                                                            Lokasi  :      Jalan Bunga No. 88, RT 09, RW 04, Kelurahan Jatibening Baru, Kecamatan Pondok Gede, Bekasi 17412 <br> <br>
                                                            Catatan: <br>
                                                            Saudara diminta membawa dokumen yang diperlukan (Sesuai dengan yang diupload online). <br>
                                                            </p>
                                                        </div>';
                                                    } else {
                                                        echo '<i class="fas bg-danger"></i>
                                                        <div class="timeline-item">
                                                            <h2 class="timeline-header">'. $row1['updated_at'] .'</h2>
                                                            <p class="timeline-body">Halo <br><br>Dengan ini kami memberitahukan bahwa setelah melalui proses seleksi, kami menyampaikan bahwa Anda belum berhasil lolos untuk mengikuti tes wawancara di PT. Crystal Biru Meuligo. <br>Terima kasih atas partisipasi Anda dalam proses seleksi. Kami menghargai waktu dan usaha yang telah Anda berikan. Semoga Anda tetap semangat dan sukses dalam kesempatan lainnya.</p>
                                                        </div>';
                                                    }
                                                ?>
                                            </div>
                                            <div class="time-label">
                                                <span class="bg-primary">Aktivasi</span>
                                            </div>
                                            <div>
                                                <?php 
                                                    if ($row1['aktif'] == 'aktif') {
                                                        echo '<i class="fas fa-check bg-success"></i>
                                                        <div class="timeline-item">
                                                            <h2 class="timeline-header">'. $row1['updated_at'] .'</h2>
                                                            <p class="timeline-body">Anda telah Aktif di Sistem Kami.</p>
                                                        </div>';
                                                    } else {
                                                        echo '<i class="fas bg-danger"></i>
                                                        <div class="timeline-item">
                                                            <h2 class="timeline-header">'. $row1['updated_at'] .'</h2>
                                                            <p class="timeline-body">NONAKTIF</p>
                                                        </div>';
                                                    }
                                                ?>
                                            </div>
                                            <div class="time-label">
                                                <i class="fas fa-clock bg-dark"></i>
                                            </div>
                                        </div>
                                        <hr>
                                        <dt>Nomor Pendaftaran:</dt>
                                        <dd><?php echo $row1['id_daftar']; ?></dd>
                                        <hr>
                                        <h4>Detail Data Diri</h4>
                                        <dl class="definition-list">
                                            <dt>Nama Lengkap</dt>
                                            <dd><?php echo $row1['nama_lengkap']; ?></dd>

                                            <dt>Nomor Induk Kependudukan</dt>
                                            <dd><?php echo $row1['nik']; ?></dd>

                                            <dt>Tempat/Tanggal Lahir</dt>
                                            <dd><?php echo $row1['tempat_lahir']; ?>, <?php
                                                        $tanggal_input = $row1['tgl_lahir'];
                                                        setlocale(LC_TIME, 'id_ID'); // Atur lokal menjadi Bahasa Indonesia
                                                        $tanggal_output = strftime("%e %B %Y", strtotime($tanggal_input));
                                                        echo $tanggal_output;
                                                    ?>
                                            </dd>

                                            <dt>Jenis Kelamin</dt>
                                            <dd><?php echo $row1['jk']; ?></dd>

                                            <dt>Status Perkawinan</dt>
                                            <dd><?php echo $row1['status']; ?></dd>

                                            <dt>Tinggi Badan</dt>
                                            <dd><?php echo $row1['tinggi']; ?> cm</dd>

                                            <dt>Berat Badan</dt>
                                            <dd><?php echo $row1['berat']; ?> kg</dd>

                                            <dt>Provinsi</dt>
                                            <dd><?php echo $row1['provinsi']; ?></dd>

                                            <dt>Kabupaten/Kota</dt>
                                            <dd><?php echo $row1['kota']; ?></dd>

                                            <dt>Kecamatan</dt>
                                            <dd><?php echo $row1['kecamatan']; ?></dd>

                                            <dt>Desa/Kelurahan</dt>
                                            <dd><?php echo $row1['desa']; ?></dd>

                                            <dt>Alamat Lengkap</dt>
                                            <dd><?php echo $row1['alamat_lengkap']; ?></dd>

                                            <dt>Nomor Telepon</dt>
                                            <dd><?php echo $row1['telepon']; ?></dd>

                                            <dt>Keahlian Utama</dt>
                                            <dd><?php echo $row1['pekerjaan']; ?></dd>

                                            <dt>Negara yang dipilih</dt>
                                            <dd><?php echo $row1['negara']; ?></dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-3">
                                        <h4>Kelengkapan Dokumen Persyaratan</h4>
                                        <dl class="definition-list">
                                            <dt>Kartu Tanda Penduduk</dt>
                                            <dd>
                                                <?php 
                                                    if (file_exists($row1['foto_ktp'])) {
                                                        echo '<a href="'. $row1['foto_ktp']. '" download class="fa fa-download"></a>';
                                                    } else {
                                                        checkDocument($row1, 'foto_ktp', 'Foto Kartu Tanda Penduduk (KTP)');
                                                    }
                                                ?>
                                            </dd>
                                            <dt>Foto Selfie dengan Kartu Tanda Penduduk (KTP)</dt>
                                            <dd>
                                                <?php 
                                                    if (file_exists($row1['selfie_ktp'])) {
                                                        echo '<a href="'. $row1['selfie_ktp']. '" download class="fa fa-download"></a>';
                                                    } else {
                                                        checkDocument($row1, 'selfie_ktp', 'Selfie dengan Kartu Tanda Penduduk (KTP)');
                                                    }
                                                ?>
                                            </dd>
                                            <dt>Scan/Foto Kartu Keluarga</dt>
                                            <dd>
                                                <?php 
                                                    if (file_exists($row1['kk'])) {
                                                        echo '<a href="'. $row1['kk']. '" download class="fa fa-download"></a>';
                                                    } else {
                                                        checkDocument($row1, 'kk', 'Foto Kartu Keluarga (KK)');
                                                    }
                                                ?>
                                            </dd>
                                            <dt>Pas Foto</dt>
                                            <dd>
                                                <?php 
                                                    if (file_exists($row1['pas'])) {
                                                        echo '<a href="'. $row1['pas']. '" download class="fa fa-download"></a>';
                                                    } else {
                                                        checkDocument($row1, 'pas', 'Foto Pas');
                                                    }
                                                ?>
                                            </dd>
                                            <dt>Scan/Foto Akte Kelahiran</dt>
                                            <dd>
                                                <?php 
                                                    if (file_exists($row1['akte_kelahiran'])) {
                                                        echo '<a href="'. $row1['akte_kelahiran']. '" download class="fa fa-download"></a>';
                                                    } else {
                                                        checkDocument($row1, 'akte_kelahiran', 'Foto Akte Kelahiran');
                                                    }
                                                ?>
                                            </dd>
                                            <dt>Scan/Foto Surat Keluarga</dt>
                                            <dd>
                                                <?php 
                                                    if (file_exists($row1['surat_keluarga'])) {
                                                        echo '<a href="'. $row1['surat_keluarga']. '" download class="fa fa-download"></a>';
                                                    } else {
                                                        echo '<a href="SURAT IZIN DAN PERNYATAAN KELUARGA CPMI (1).doc" class="btn-sm btn btn-primary">Download Surat Izin Keluarga dan Pernyataan</a>';
                                                        checkDocument($row1, 'surat_keluarga', 'Foto Surat Keluarga');
                                                    }
                                                ?>
                                            </dd>
                                            <dt>Foto Keseluruhan Badan</dt>
                                            <dd>
                                                <?php 
                                                    if (file_exists($row1['foto'])) {
                                                        echo '<a href="'. $row1['foto']. '" download class="fa fa-download"></a>';
                                                    } else {
                                                        checkDocument($row1, 'foto', 'Foto Keseluruhan Badan');
                                                    }
                                                ?>
                                            </dd>
                                            <?php 
                                                $status = $row1['status'];
                                                if ($status == "Sudah Menikah") {
                                                    echo "<dt>Scan/Foto Buku Nikah</dt>
                                                    <dd>";
                                                            if (file_exists($row1['buku_nikah'])) {
                                                                echo '<a href="'. $row1['buku_nikah']. '" download class="fa fa-download"></a>';
                                                            } else {
                                                                checkDocument($row1, 'buku_nikah', 'Buku Nikah');
                                                            }
                                                    echo "</dd>";
                                                } elseif ($status == "Cerai Mati " || $status == "Cerai Hidup") {
                                                    echo "<dt>Scan/Foto Akte Cerai</dt>
                                                    <dd>";
                                                            if (file_exists($row1['akte_cerai'])) {
                                                                echo '<a href="'. $row1['akte_cerai']. '" download class="fa fa-download"></a>';
                                                            } else {
                                                                checkDocument($row1, 'akte_cerai', 'Akte Cerai');
                                                            }
                                                    echo "</dd>";
                                                }
                                            ?>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                        }
                        if (empty($data_sekolah)) {
                            echo '';
                        } else {
                    ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sekolah</h3>
                        <div class="card-tools">
                            <a href="daftar2_2.php" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                                Tambah Sekolah</a>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Nama Sekolah</th>
                                    <th>Tanggal Masuk Sekolah</th>
                                    <th>Tanggal Lulus Sekolah</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_sekolah as $sekolah) : ?>
                                <tr>
                                    <td><?php echo $sekolah['nama_sekolah']; ?></td>
                                    <td><?php echo $sekolah['tgl_masuk_sekolah']; ?></td>
                                    <td><?php echo $sekolah['tgl_lulus_sekolah']; ?></td>
                                    <td>
                                        <a href="<?php echo $sekolah['ijazah_sekolah']; ?>" target="_blank"
                                            class="btn btn-success btn-sm" download><i class="fa fa-download"></i>
                                            Download</a>
                                        <a href="edit_sekolah.php?id=<?php echo $sekolah['id']; ?>"
                                            class="btn btn-warning btn-sm"><i class="fa fa-pen"></i> Ubah
                                            Sekolah</a>
                                        <a href="hapus_sekolah.php?id=<?php echo $sekolah['id']; ?>"
                                            class="btn btn-danger btn-sm" onclick="return hapus1(event)"><i
                                                class="fa fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <?php
                            }
                            if (empty($data_pengalaman)) {
                                echo '';
                            } else {
                            ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pengalaman Kerja</h3>
                        <div class="card-tools">
                            <a href="daftar3_2.php" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                                Tambah Pengalaman
                                Kerja</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Nama Perusahaan</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Tanggal Keluar</th>
                                    <th>Pekerjaan</th>
                                    <th>Jabatan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_pengalaman as $pengalaman) : ?>
                                <tr>
                                    <td><?php echo $pengalaman['nama_perusahaan']; ?></td>
                                    <td><?php echo $pengalaman['tgl_masuk_perusahaan']; ?></td>
                                    <td><?php echo $pengalaman['tgl_keluar_perusahaan']; ?></td>
                                    <td><?php echo $pengalaman['pekerjaan']; ?></td>
                                    <td><?php echo $pengalaman['jabatan']; ?></td>
                                    <td>
                                        <a href="<?php echo $pengalaman['sertifikasi']; ?>" target="_blank"
                                            class="btn btn-success btn-sm" download><i class="fa fa-download"></i>
                                            Download</a>
                                        <a href="edit_pengalaman.php?id=<?php echo $pengalaman['id']; ?>"
                                            class="btn btn-warning btn-sm"><i class="fa fa-pen"></i> Ubah
                                            Pengalaman</a>
                                        <a href="hapus_pengalaman.php?id=<?php echo $pengalaman['id']; ?>"
                                            class="btn btn-danger btn-sm" onclick="return hapus2(event)"><i
                                                class="fa fa-trash"></i>
                                            Hapus</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <?php } 
                        if (empty($data_pelatihan)) {
                            echo '';
                        } else {
                        ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pelatihan</h3>
                        <div class="card-tools">
                            <a href="daftar4_2.php" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                                Tambah Pelatihan</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Instansi</th>
                                    <th>Tanggal Keluar Sertifikat</th>
                                    <th>Jenis Sertifikat</th>
                                    <th>Uraian Sertifikat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_pelatihan as $pelatihan) : ?>
                                <tr>
                                    <td><?php echo $pelatihan['no_sertifikat']; ?></td>
                                    <td><?php echo $pelatihan['instansi']; ?></td>
                                    <td><?php echo $pelatihan['tgl_keluar_sertifikat']; ?></td>
                                    <td><?php echo $pelatihan['jenis']; ?></td>
                                    <td><?php echo $pelatihan['uraian']; ?></td>
                                    <td>
                                        <a href="../<?php echo $pelatihan['sertifikat']; ?>" target="_blank"
                                            class="btn btn-success btn-sm" download><i class="fa fa-download"></i>
                                            Download</a>
                                        <a href="edit_pelatihan.php?id=<?php echo $pelatihan['id']; ?>"
                                            class="btn btn-warning btn-sm"><i class="fa fa-pen"></i> Ubah
                                            Pelatihan</a>
                                        <a href="hapus_pelatihan.php?id=<?php echo $pelatihan['id']; ?>"
                                            class="btn btn-danger btn-sm" onclick="return hapus3(event)"><i
                                                class="fa fa-trash"></i>
                                            Hapus</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } ?>
        </div>
    </div>
    </div>
    </section>
</body>
<?php include "foot.php"; ?>

</html>