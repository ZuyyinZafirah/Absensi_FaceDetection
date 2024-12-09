<?php include 'controller/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Kehadiran Mahasiswa 3 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
       <?php include 'sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Absensi</h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Mahasiswa</th>
            <th>NIM</th>
            <th>Waktu Kehadiran</th> <!-- Kolom Waktu Kehadiran -->
            <th>Status Kehadiran</th>
            <th>Jadwal Mata Kuliah</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Nomor urut
        $no = 1;

        // Query untuk mendapatkan data dari tabel kehadiran dengan join ke mahasiswa, jadwal_mk, ruangan, dan dosen
        $query = mysqli_query($conn, "
            SELECT 
                kehadiran.id, 
                mahasiswa.nama AS nama_mahasiswa, 
                mahasiswa.nim, 
                kehadiran.waktu, 
                kehadiran.status, 
                jadwal_mk.nama_jadwal, 
                jadwal_mk.waktu_mulai, 
                jadwal_mk.waktu_selesai, 
                ruangan.nama_ruangan, 
                dosen.nama_dosen
            FROM 
                kehadiran
            INNER JOIN 
                mahasiswa ON kehadiran.id_mahasiswa = mahasiswa.id_mahasiswa
            INNER JOIN 
                jadwal_mk ON kehadiran.id_jadwal = jadwal_mk.id_jadwal
            LEFT JOIN 
                ruangan ON jadwal_mk.id_ruangan = ruangan.id_ruangan
            LEFT JOIN 
                dosen ON jadwal_mk.id_dosen = dosen.id_dosen
        ");

        // Looping hasil query
        while ($row = mysqli_fetch_array($query)) {
            ?>
                                <tr>
                                    <!-- No Urut -->
                                    <td><?php echo $no++; ?></td>

                                    <!-- Nama Mahasiswa -->
                                    <td><?php echo $row['nama_mahasiswa']; ?></td>

                                    <!-- NIM Mahasiswa -->
                                    <td><?php echo $row['nim']; ?></td>

                                    <!-- Waktu Kehadiran -->
                                    <td><?php echo date('d-m-Y H:i:s', strtotime($row['waktu'])); ?></td> <!-- Tampilkan Waktu Kehadiran -->

                                    <!-- Status Kehadiran -->
                                    <td>
                                        <?php
                                        // Menentukan warna badge sesuai status kehadiran
                                        $status = $row['status'];
                                        $badgeClass = '';
                                        switch ($status) {
                                            case 'hadir':
                                                $badgeClass = 'bg-success';
                                                break;
                                            case 'alpha':
                                                $badgeClass = 'bg-danger';
                                                break;
                                            case 'izin':
                                                $badgeClass = 'bg-warning';
                                                break;
                                            case 'sakit':
                                                $badgeClass = 'bg-info';
                                                break;
                                            case 'telat':
                                                $badgeClass = 'bg-secondary';
                                                break;
                                        }
                                        ?>
                                        <span class="badge <?php echo $badgeClass; ?>">
                                            <?php echo ucfirst($status); ?>
                                        </span>
                                    </td>

                                    <!-- Informasi Jadwal Mata Kuliah -->
                                    <td>
                                        <strong><?php echo $row['nama_jadwal']; ?></strong><br>
                                        <?php echo date('H:i', strtotime($row['waktu_mulai'])); ?> - <?php echo date('H:i', strtotime($row['waktu_selesai'])); ?><br>
                                        Ruang: <?php echo $row['nama_ruangan']; ?><br>
                                        Pengajar: <?php echo $row['nama_dosen']; ?>
                                    </td>

                                    <!-- Tombol Aksi -->
                                    <td>
                                        <a class="btn btn-warning btn-sm editBtn" 
                                           data-bs-toggle="modal" 
                                           data-bs-target="#editModal" 
                                           onclick="editKehadiran(<?php echo $row['id']; ?>)">
                                            <i class="fas fa-fw fa-edit"></i> Edit
                                        </a>

                                        <a href="#" 
                                           class="btn btn-danger btn-sm" 
                                           onclick="confirmDelete(<?php echo $row['id']; ?>)">
                                            <i class="fas fa-fw fa-trash"></i> Hapus
                                        </a>

                                        <a class="btn btn-info btn-sm" 
                                           data-bs-toggle="modal" 
                                           data-bs-target="#detailModal">
                                            <i class="fas fa-fw fa-ticket-detailed-fill"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                        <?php
        }
        ?>
    </tbody>
</table>


                                <!-- JavaScript untuk memunculkan konfirmasi -->
                                <script>
                                    function confirmDelete() {
                                        // SweetAlert2 konfirmasi hapus
                                        Swal.fire({
                                            title: 'Apakah Anda yakin?',
                                            text: "Data ini akan dihapus permanen!",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#d33',
                                            cancelButtonColor: '#3085d6',
                                            confirmButtonText: 'Hapus',
                                            cancelButtonText: 'Batal'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                // Jika tombol "Hapus" diklik, lakukan aksi penghapusan
                                                // Misalnya, kirim ke PHP atau lakukan aksi lainnya
                                                Swal.fire(
                                                    'Dihapus!',
                                                    'Data telah berhasil dihapus.',
                                                    'success'
                                                )
                                                // Lakukan penghapusan data (misalnya menggunakan AJAX atau redirect ke file PHP yang menghapus data)
                                                // window.location.href = "proses_hapus.php?id=123"; // Jika ingin menghapus berdasarkan ID
                                            }
                                        })
                                    }
                                </script>
                            </div>
<!-- Modal Edit Data Absensi -->
<div class="modal fade" id="editAbsensiModal" tabindex="-1" aria-labelledby="editAbsensiLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAbsensiLabel">Edit Data Absensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <!-- Nama Mahasiswa -->
                        <div class="col-md-6 mb-3">
                            <label for="namaMahasiswa" class="form-label">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="namaMahasiswa" readonly>
                        </div>

                        <!-- NIM -->
                        <div class="col-md-6 mb-3">
                            <label for="nimMahasiswa" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="nimMahasiswa" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Status Kehadiran -->
                        <div class="col-md-6 mb-3">
                            <label for="statusKehadiran" class="form-label">Status Kehadiran</label>
                            <select id="statusKehadiran" class="form-select">
                                <option value="hadir">Hadir</option>
                                <option value="izin">Izin</option>
                                <option value="alpha">Alpha</option>
                                <option value="sakit">Sakit</option>
                                <option value="telat">Telat</option>
                            </select>
                        </div>

                        <!-- Waktu Kehadiran -->
                        <div class="col-md-6 mb-3">
                            <label for="waktuAbsensi" class="form-label">Waktu Kehadiran</label>
                            <input type="text" class="form-control" id="waktuAbsensi" readonly>
                        </div>

                        <!-- Mata Kuliah -->
                        <div class="col-md-12 mb-3">
                            <label for="mataKuliah" class="form-label">Mata Kuliah</label>
                            <input type="text" class="form-control" id="mataKuliah" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Data Absensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <!-- Nama Mahasiswa -->
                        <div class="col-md-6 mb-3">
                            <label for="detailNama" class="form-label">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="detailNama" readonly>
                        </div>

                        <!-- NIM -->
                        <div class="col-md-6 mb-3">
                            <label for="detailNIM" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="detailNIM" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Status Kehadiran -->
                        <div class="col-md-6 mb-3">
                            <label for="detailStatus" class="form-label">Status Kehadiran</label>
                            <input type="text" class="form-control" id="detailStatus" readonly>
                        </div>

                        <!-- Waktu Kehadiran -->
                        <div class="col-md-6 mb-3">
                            <label for="detailWaktu" class="form-label">Waktu Kehadiran</label>
                            <input type="text" class="form-control" id="detailWaktu" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Mata Kuliah -->
                        <div class="col-md-12 mb-3">
                            <label for="detailMataKuliah" class="form-label">Mata Kuliah</label>
                            <input type="text" class="form-control" id="detailMataKuliah" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Script untuk mengisi modal edit
    document.querySelectorAll('.editBtn').forEach(button => {
        button.addEventListener('click', function () {
            let row = button.closest('tr');
            let namaMahasiswa = row.cells[1].textContent.trim();
            let nim = row.cells[2].textContent.trim();
            let waktu = row.cells[3].textContent.trim();
            let status = row.cells[4].textContent.trim();
            let mataKuliah = row.cells[5].querySelector('strong').textContent.trim();

            document.getElementById('namaMahasiswa').value = namaMahasiswa;
            document.getElementById('nimMahasiswa').value = nim;
            document.getElementById('waktuAbsensi').value = waktu;
            document.getElementById('statusKehadiran').value = status.toLowerCase();
            document.getElementById('mataKuliah').value = mataKuliah;

            let modal = new bootstrap.Modal(document.getElementById('editAbsensiModal'));
            modal.show();
        });
    });

    // Script untuk mengisi modal detail
    document.querySelectorAll('.btn-info').forEach(button => {
        button.addEventListener('click', function () {
            let row = button.closest('tr');
            let namaMahasiswa = row.cells[1].textContent.trim();
            let nim = row.cells[2].textContent.trim();
            let waktu = row.cells[3].textContent.trim();
            let status = row.cells[4].textContent.trim();
            let mataKuliah = row.cells[5].querySelector('strong').textContent.trim();

            document.getElementById('detailNama').value = namaMahasiswa;
            document.getElementById('detailNIM').value = nim;
            document.getElementById('detailWaktu').value = waktu;
            document.getElementById('detailStatus').value = status;
            document.getElementById('detailMataKuliah').value = mataKuliah;

            let modal = new bootstrap.Modal(document.getElementById('detailModal'));
            modal.show();
        });
    });
</script>

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Trio Website 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#dataTable');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
   
</body>

</html>