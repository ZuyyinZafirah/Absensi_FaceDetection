<?php
include 'controller/koneksi.php';
?>
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
    
    <!-- Tombol Tambah Data -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="">
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal"><i
                    class="fas fa-fw fa-plus"></i> Tambah Data Mahasiswa</a>
                </div>
            </div>
        </div>
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto Wajah</th>
                                <th>Nama Mahasiswa</th>
                                <th>NIM</th>
                                <th>Jurusan</th>
                                <th>Prodi</th>
                                <th>Semester</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = mysqli_query($conn, "SELECT * FROM mahasiswa");
                            while ($row = mysqli_fetch_array($query)) {
                                ?>                                        
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><img src="media/<?php echo $row['photo'] ?>" alt="Foto <?php echo $row['nama'] ?>" class="rounded"
                                                width="50" height="50"></td>
                                                <td><?php echo $row['nama'] ?></td>
                                                <td><?php echo $row['nim'] ?></td>
                                                <?php
                                                $idprodi = $row['id_prodi'];
                                                $query2 = mysqli_query($conn, "SELECT jurusan.*, prodi.* FROM prodi INNER JOIN jurusan ON jurusan.jurusan_id = prodi.jurusan_id WHERE prodi.id_prodi = $idprodi;");
                                                $row2 = mysqli_fetch_array($query2);

                                                ?>
                                                <td><?php echo $row2['jurusan_name'] ?></td>
                                                <td><?php echo $row2['prodi_name'] ?></td>
                                                <td><?php echo $row['semester'] ?></td>
                                                <td>
                                                    <a class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editModal"
                                                    onclick="editMahasiswa('Tiger Nixon', '2022573010058', 'Teknik Informatika', 5)"><i
                                                    class="fas fa-fw fa-edit"></i>
                                                    Edit</a>
                                                    <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete()"><i
                                                        class="fas fa-fw fa-trash"></i>
                                                        Hapus</a>
                                                    </td>
                                                </tr>
                                        <?php } ?>
                                        
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
                            
                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Mahasiswa</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="editForm">
                                            <div class="mb-3">
                                                <label for="foto" class="form-label">Foto</label>
                                                <input type="file" class="form-control" id="foto">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="nama">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nim" class="form-label">NIM</label>
                                                <input type="text" class="form-control" id="nim">
                                            </div>
                                            <div class="mb-3">
                                                <label for="prodi" class="form-label">Prodi</label>
                                                <input type="text" class="form-control" id="prodi">
                                            </div>
                                            <div class="mb-3">
                                                <label for="semester" class="form-label">Semester</label>
                                                <input type="number" class="form-control" id="semester">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Modal Tambah Data -->
                        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg"> <!-- Tambahkan modal-lg untuk memperlebar -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="tambahModalLabel">Tambah Mahasiswa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="tambahForm">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label for="foto" class="form-label">Foto</label>
                                                <input type="file" class="form-control" id="foto" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="nama" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="nama"
                                                placeholder="Masukkan nama lengkap" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="nim" class="form-label">NIM</label>
                                                <input type="text" class="form-control" id="nim"
                                                placeholder="Masukkan NIM" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="password" class="form-label">Password (Sama dengan
                                                    NIM)</label>
                                                    <input type="password" class="form-control" id="password"
                                                    placeholder="Masukkan password" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="semester" class="form-label">Semester</label>
                                                    <input type="number" class="form-control" id="semester"
                                                    placeholder="Masukkan semester" required>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="jurusan" class="form-label">Jurusan</label>
                                                    <select class="form-select" id="jurusan" required>
                                                        <option selected disabled>Pilih Jurusan</option>
                                                        <option value="Teknik Informatika">Teknik Informatika
                                                        </option>
                                                        <option value="Sistem Informasi">Sistem Informasi</option>
                                                        <option value="Akuntansi">Akuntansi</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="prodi" class="form-label">Prodi</label>
                                                    <input type="text" class="form-control" id="prodi"
                                                    placeholder="Pilih Prodi" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
<script>
    // Fungsi untuk mengisi data modal
    function editMahasiswa(nama, nim, prodi, semester) {
        document.getElementById('nama').value = nama;
        document.getElementById('nim').value = nim;
        document.getElementById('prodi').value = prodi;
        document.getElementById('semester').value = semester;
    }
</script>
<script>
    // Tambahkan event listener untuk form
    document.getElementById('tambahForm').addEventListener('submit', function (event) {
        event.preventDefault();
        alert('Data mahasiswa berhasil ditambahkan!');
        // Anda bisa menambahkan logika untuk menyimpan data ke database di sini.
    });
</script>
</body>

</html>