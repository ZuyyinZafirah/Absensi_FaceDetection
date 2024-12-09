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
                                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKelasModal"><i
                                        class="fas fa-fw fa-plus"></i> Tambah Data
                                    Kelas</a>
                            </div>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Kelas</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kelas</th> <!-- nama_kelas -->
            <th>Program Studi</th> <!-- id_prodi -->
            <th>Semester</th> <!-- semester -->
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Nomor urut
        $no = 1;

        // Query untuk mendapatkan data dari tabel kelas dengan join ke tabel prodi dan dosen
        $query = mysqli_query($conn, "SELECT * FROM kelas");

        // Looping hasil query
        while ($row = mysqli_fetch_array($query)) {
            ?>
                                                                            <tr>
                                                                                <!-- No Urut -->
                                                                                <td><?php echo $no++; ?></td>
                                                              
                                                                                <!-- Nama Kelas -->
                                                                                <td><?php echo $row['nama_kelas']; ?></td>

                                                                                <?php
                                                                                $idprodi = $row['id_prodi'];
                                                                                $query2 = mysqli_query($conn, "SELECT * FROM prodi WHERE id_prodi = $idprodi");
                                                                                $row2 = mysqli_fetch_array($query2);
                                                                                ?>
                                                                            
                                                                                <td><?php echo $row2['prodi_name']; ?></td> 

                                                                                <!-- Semester -->
                                                                                <td><?php echo $row['semester']; ?></td> <!-- Semester dari tabel kelas -->

                                                                                <!-- Tombol Aksi -->
                                                                                <td>
                                                                                    <a class="btn btn-warning btn-sm" 
                                                                                       data-bs-toggle="modal" 
                                                                                       data-bs-target="#editModal" 
                                                                                       onclick="editKelas(<?php echo $row['id_kelas']; ?>)">
                                                                                        <i class="fas fa-fw fa-edit"></i> Edit
                                                                                    </a>

                                                                                    <a href="#" 
                                                                                       class="btn btn-danger btn-sm" 
                                                                                       onclick="confirmDelete(<?php echo $row['id_kelas']; ?>)">
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


                            </div>

                            <!-- Modal Tambah Kelas -->
                            <div class="modal fade" id="addKelasModal" tabindex="-1" aria-labelledby="addKelasLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addKelasLabel">Tambah Data Kelas</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="formAddKelas">
                                                <div class="row">
                                                    <!-- Kode Kelas -->
                                                    <div class="col-md-6 mb-3">
                                                        <label for="kodeKelas" class="form-label">Kode Kelas</label>
                                                        <input type="text" class="form-control" id="kodeKelas"
                                                            placeholder="Misal: KLS001">
                                                    </div>
                                                    <!-- Nama Kelas -->
                                                    <div class="col-md-6 mb-3">
                                                        <label for="namaKelas" class="form-label">Nama Kelas</label>
                                                        <input type="text" class="form-control" id="namaKelas"
                                                            placeholder="Misal: TI 5A">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- Kapasitas -->
                                                    <div class="col-md-6 mb-3">
                                                        <label for="kapasitas" class="form-label">Kapasitas</label>
                                                        <input type="number" class="form-control" id="kapasitas"
                                                            placeholder="Misal: 30">
                                                    </div>
                                                    <!-- Program Studi -->
                                                    <div class="col-md-6 mb-3">
                                                        <label for="programStudi" class="form-label">Program
                                                            Studi</label>
                                                        <input type="text" class="form-control" id="programStudi"
                                                            placeholder="Misal: Teknik Informatika">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- Semester -->
                                                    <div class="col-md-6 mb-3">
                                                        <label for="semester" class="form-label">Semester</label>
                                                        <input type="number" class="form-control" id="semester"
                                                            placeholder="Misal: 5">
                                                    </div>
                                                    <!-- Jadwal -->
                                                    <div class="col-md-6 mb-3">
                                                        <label for="jadwal" class="form-label">Jadwal</label>
                                                        <input type="text" class="form-control" id="jadwal"
                                                            placeholder="Misal: Senin, 08:00-10:00">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <!-- Dosen Wali -->
                                                    <label for="dosenWali" class="form-label">Dosen Wali</label>
                                                    <input type="text" class="form-control" id="dosenWali"
                                                        placeholder="Nama Dosen Wali">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Tambah Kelas</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Edit Kelas -->
                            <div class="modal fade" id="editKelasModal" tabindex="-1" aria-labelledby="editKelasLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editKelasLabel">Edit Data Kelas</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="formEditKelas">
                                                <input type="hidden" id="rowIndex">
                                                <!-- Index baris yang sedang diedit -->
                                                <div class="row">
                                                    <!-- Kode Kelas -->
                                                    <div class="col-md-6 mb-3">
                                                        <label for="editKodeKelas" class="form-label">Kode Kelas</label>
                                                        <input type="text" class="form-control" id="editKodeKelas">
                                                    </div>
                                                    <!-- Nama Kelas -->
                                                    <div class="col-md-6 mb-3">
                                                        <label for="editNamaKelas" class="form-label">Nama Kelas</label>
                                                        <input type="text" class="form-control" id="editNamaKelas">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- Kapasitas -->
                                                    <div class="col-md-6 mb-3">
                                                        <label for="editKapasitas" class="form-label">Kapasitas</label>
                                                        <input type="number" class="form-control" id="editKapasitas">
                                                    </div>
                                                    <!-- Program Studi -->
                                                    <div class="col-md-6 mb-3">
                                                        <label for="editProgramStudi" class="form-label">Program
                                                            Studi</label>
                                                        <input type="text" class="form-control" id="editProgramStudi">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- Semester -->
                                                    <div class="col-md-6 mb-3">
                                                        <label for="editSemester" class="form-label">Semester</label>
                                                        <input type="number" class="form-control" id="editSemester">
                                                    </div>
                                                    <!-- Jadwal -->
                                                    <div class="col-md-6 mb-3">
                                                        <label for="editJadwal" class="form-label">Jadwal</label>
                                                        <input type="text" class="form-control" id="editJadwal">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <!-- Dosen Wali -->
                                                    <label for="editDosenWali" class="form-label">Dosen Wali</label>
                                                    <input type="text" class="form-control" id="editDosenWali">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Hapus -->
                            <div class="modal fade" id="deleteKelasModal" tabindex="-1"
                                aria-labelledby="deleteKelasLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteKelasLabel">Hapus Data Kelas</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus kelas <strong
                                                id="deleteKelasName"></strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="button" class="btn btn-danger"
                                                onclick="confirmDelete()">Hapus</button>
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
        // Tambah Kelas
        document.querySelector('#formAddKelas').addEventListener('submit', function (e) {
            e.preventDefault();

            // Ambil data dari form
            const kodeKelas = document.getElementById('kodeKelas').value;
            const namaKelas = document.getElementById('namaKelas').value;
            const kapasitas = document.getElementById('kapasitas').value;
            const programStudi = document.getElementById('programStudi').value;
            const semester = document.getElementById('semester').value;
            const jadwal = document.getElementById('jadwal').value;
            const dosenWali = document.getElementById('dosenWali').value;

            // Tambahkan data ke tabel
            const tbody = document.querySelector('table tbody');
            const newRow = document.createElement('tr');

            const newContent = `
            <td>${tbody.rows.length + 1}</td>
            <td>${kodeKelas}</td>
            <td>${namaKelas}</td>
            <td>${kapasitas}</td>
            <td>${programStudi}</td>
            <td>${semester}</td>
            <td>${jadwal}</td>
            <td>${dosenWali}</td>
            <td>
                <button class="btn btn-warning btn-sm" onclick="editKelas(this)">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deleteKelas(this)">Hapus</button>
            </td>
            `;
            newRow.innerHTML = newContent;
            tbody.appendChild(newRow);

            // Reset form dan tutup modal
            document.getElementById('formAddKelas').reset();
            const addModal = bootstrap.Modal.getInstance(document.getElementById('addKelasModal'));
            addModal.hide();
        });
    </script>
    <script>
        function editKelas(button) {
            const row = button.closest('tr');
            const index = row.rowIndex - 1;
            const columns = row.querySelectorAll('td');

            // Isi modal edit dengan data
            document.getElementById('rowIndex').value = index;
            document.getElementById('editKodeKelas').value = columns[1].textContent;
            document.getElementById('editNamaKelas').value = columns[2].textContent;
            document.getElementById('editKapasitas').value = columns[3].textContent;
            document.getElementById('editProgramStudi').value = columns[4].textContent;
            document.getElementById('editSemester').value = columns[5].textContent;
            document.getElementById('editJadwal').value = columns[6].textContent;
            document.getElementById('editDosenWali').value = columns[7].textContent;

            // Tampilkan modal edit
            const editModal = new bootstrap.Modal(document.getElementById('editKelasModal'));
            editModal.show();
        }

        document.querySelector('#formEditKelas').addEventListener('submit', function (e) {
            e.preventDefault();

            // Ambil data dari modal edit
            const index = document.getElementById('rowIndex').value;
            const table = document.querySelector('table tbody');
            const row = table.rows[index];

            row.cells[1].textContent = document.getElementById('editKodeKelas').value;
            row.cells[2].textContent = document.getElementById('editNamaKelas').value;
            row.cells[3].textContent = document.getElementById('editKapasitas').value;
            row.cells[4].textContent = document.getElementById('editProgramStudi').value;
            row.cells[5].textContent = document.getElementById('editSemester').value;
            row.cells[6].textContent = document.getElementById('editJadwal').value;
            row.cells[7].textContent = document.getElementById('editDosenWali').value;

            // Tutup modal
            const editModal = bootstrap.Modal.getInstance(document.getElementById('editKelasModal'));
            editModal.hide();
        });
    </script>
    <script>
        let rowToDelete;

        function deleteKelas(button) {
            const row = button.closest('tr');
            const namaKelas = row.querySelectorAll('td')[2].textContent;

            rowToDelete = row;
            document.getElementById('deleteKelasName').textContent = namaKelas;

            const deleteModal = new bootstrap.Modal(document.getElementById('deleteKelasModal'));
            deleteModal.show();
        }

        function confirmDelete() {
            if (rowToDelete) {
                rowToDelete.remove();

                // Perbarui nomor urut
                const rows = document.querySelectorAll('table tbody tr');
                rows.forEach((row, index) => {
                    row.querySelector('td').textContent = index + 1;
                });
            }

            const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteKelasModal'));
            deleteModal.hide();
        }
    </script>
</body>

</html>