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

                    <!-- Tombol Tambah Data Mata Kuliah -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="">
                                <a class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#addMataKuliahModal"><i class="fas fa-fw fa-plus"></i> Tambah Data
                                    Mata Kuliah</a>
                            </div>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Mata Kuliah</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Mata Kuliah</th>
            <th>SKS</th>
            <th>Kelas</th> <!-- Ini merepresentasikan id_kelas -->
            <th>Semester</th>
            <th>Dosen Pengampu</th> <!-- Ini merepresentasikan id_dosen -->
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Nomor urut
        $no = 1;

        // Query untuk mendapatkan data dari tabel mata_kuliah dengan join ke tabel dosen dan kelas
        $query = mysqli_query($conn, "
            SELECT 
                mata_kuliah.id_mk, 
                mata_kuliah.nama_mk, 
                mata_kuliah.sks, 
                mata_kuliah.semester, 
                dosen.nama_dosen, 
                kelas.nama_kelas 
            FROM 
                mata_kuliah
            INNER JOIN 
                dosen ON mata_kuliah.id_dosen = dosen.id_dosen
            INNER JOIN 
                kelas ON mata_kuliah.id_kelas = kelas.id_kelas
        ");

        // Looping hasil query
        while ($row = mysqli_fetch_array($query)) {
            ?>
                        <tr>
                            <!-- No Urut -->
                            <td><?php echo $no++; ?></td>

                            <!-- Nama Mata Kuliah -->
                            <td><?php echo $row['nama_mk']; ?></td>

                            <!-- SKS -->
                            <td><?php echo $row['sks']; ?></td>

                            <!-- Nama Kelas -->
                            <td><?php echo $row['nama_kelas']; ?></td> <!-- Merepresentasikan id_kelas -->

                            <!-- Semester -->
                            <td><?php echo $row['semester']; ?></td>

                            <!-- Nama Dosen Pengampu -->
                            <td><?php echo $row['nama_dosen']; ?></td> <!-- Merepresentasikan id_dosen -->

                            <!-- Tombol Aksi -->
                            <td>
                                <a class="btn btn-warning btn-sm" 
                                   data-bs-toggle="modal" 
                                   data-bs-target="#editModal" 
                                   onclick="editMataKuliah(<?php echo $row['id_mk']; ?>)">
                                    <i class="fas fa-fw fa-edit"></i> Edit
                                </a>

                                <a href="#" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="confirmDelete(<?php echo $row['id_mk']; ?>)">
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


                                <!-- Modal Tambah Mata Kuliah -->
                                <div class="modal fade" id="addMataKuliahModal" tabindex="-1"
                                    aria-labelledby="addMataKuliahLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addMataKuliahLabel">Tambah Mata Kuliah</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="kodeMataKuliah" class="form-label">Kode Mata
                                                                Kuliah</label>
                                                            <input type="text" class="form-control" id="kodeMataKuliah">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="namaMataKuliah" class="form-label">Nama Mata
                                                                Kuliah</label>
                                                            <input type="text" class="form-control" id="namaMataKuliah">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="sks" class="form-label">SKS</label>
                                                            <input type="number" class="form-control" id="sks">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="programStudi" class="form-label">Program
                                                                Studi</label>
                                                            <input type="text" class="form-control" id="programStudi">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="semester" class="form-label">Semester</label>
                                                            <input type="number" class="form-control" id="semester">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="dosenPengampu" class="form-label">Dosen
                                                                Pengampu</label>
                                                            <input type="text" class="form-control" id="dosenPengampu">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Edit Mata Kuliah -->
                                <div class="modal fade" id="editMataKuliahModal" tabindex="-1"
                                    aria-labelledby="editMataKuliahLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editMataKuliahLabel">Edit Data Mata Kuliah
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="formEditMataKuliah">
                                                    <div class="row">
                                                        <!-- Kode Mata Kuliah -->
                                                        <div class="col-md-6 mb-3">
                                                            <label for="editKodeMataKuliah" class="form-label">Kode Mata
                                                                Kuliah</label>
                                                            <input type="text" class="form-control"
                                                                id="editKodeMataKuliah" readonly>
                                                        </div>
                                                        <!-- Nama Mata Kuliah -->
                                                        <div class="col-md-6 mb-3">
                                                            <label for="editNamaMataKuliah" class="form-label">Nama Mata
                                                                Kuliah</label>
                                                            <input type="text" class="form-control"
                                                                id="editNamaMataKuliah">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <!-- SKS -->
                                                        <div class="col-md-6 mb-3">
                                                            <label for="editSKS" class="form-label">SKS</label>
                                                            <input type="number" class="form-control" id="editSKS">
                                                        </div>
                                                        <!-- Program Studi -->
                                                        <div class="col-md-6 mb-3">
                                                            <label for="editProgramStudi" class="form-label">Program
                                                                Studi</label>
                                                            <input type="text" class="form-control"
                                                                id="editProgramStudi">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <!-- Semester -->
                                                        <div class="col-md-6 mb-3">
                                                            <label for="editSemester"
                                                                class="form-label">Semester</label>
                                                            <input type="number" class="form-control" id="editSemester">
                                                        </div>
                                                        <!-- Dosen Pengampu -->
                                                        <div class="col-md-6 mb-3">
                                                            <label for="editDosenPengampu" class="form-label">Dosen
                                                                Pengampu</label>
                                                            <input type="text" class="form-control"
                                                                id="editDosenPengampu">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary"
                                                    id="saveEditMataKuliah">Simpan Perubahan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Hapus Mata Kuliah -->
                                <div class="modal fade" id="deleteMataKuliahModal" tabindex="-1"
                                    aria-labelledby="deleteMataKuliahLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteMataKuliahLabel">Konfirmasi Hapus Data
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus data mata kuliah <strong
                                                        id="deleteNamaMataKuliah"></strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="button" class="btn btn-danger"
                                                    id="confirmDeleteMataKuliah">Hapus</button>
                                            </div>
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
        // Tambah Mata Kuliah
        document.querySelector('#addMataKuliahModal .btn-primary').addEventListener('click', function () {
            // Ambil nilai input dari modal
            const kode = document.getElementById('kodeMataKuliah').value;
            const nama = document.getElementById('namaMataKuliah').value;
            const sks = document.getElementById('sks').value;
            const programStudi = document.getElementById('programStudi').value;
            const semester = document.getElementById('semester').value;
            const dosen = document.getElementById('dosenPengampu').value;

            if (!kode || !nama || !sks || !programStudi || !semester || !dosen) {
                alert('Harap isi semua data!');
                return;
            }

            // Tambahkan data ke tabel
            const tableBody = document.querySelector('table tbody');
            const rowCount = tableBody.rows.length + 1;
            const row = `
            <tr>
                <td>${rowCount}</td>
                <td>${kode}</td>
                <td>${nama}</td>
                <td>${sks}</td>
                <td>${programStudi}</td>
                <td>${semester}</td>
                <td>${dosen}</td>
                <td>
                <button class="btn btn-warning btn-sm" onclick="editMataKuliah(this)">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deleteMataKuliah(this)">Hapus</button>
                </td>
            </tr>
            `;
            tableBody.insertAdjacentHTML('beforeend', row);

            // Reset form dan tutup modal
            document.querySelector('#addMataKuliahModal form').reset();
            bootstrap.Modal.getInstance(document.getElementById('addMataKuliahModal')).hide();
        });
    </script>
    <script>
        let currentEditRow = null; // Menyimpan baris yang sedang diedit
        let currentDeleteRow = null; // Menyimpan baris yang sedang dihapus

        // Edit Mata Kuliah
        function editMataKuliah(button) {
            currentEditRow = button.closest('tr');

            // Ambil data dari tabel
            const columns = currentEditRow.querySelectorAll('td');
            document.getElementById('editKodeMataKuliah').value = columns[1].textContent;
            document.getElementById('editNamaMataKuliah').value = columns[2].textContent;
            document.getElementById('editSKS').value = columns[3].textContent;
            document.getElementById('editProgramStudi').value = columns[4].textContent;
            document.getElementById('editSemester').value = columns[5].textContent;
            document.getElementById('editDosenPengampu').value = columns[6].textContent;

            // Tampilkan modal edit
            const editModal = new bootstrap.Modal(document.getElementById('editMataKuliahModal'));
            editModal.show();
        }

        // Simpan Perubahan Edit
        document.getElementById('saveEditMataKuliah').addEventListener('click', function () {
            if (currentEditRow) {
                const columns = currentEditRow.querySelectorAll('td');
                columns[2].textContent = document.getElementById('editNamaMataKuliah').value;
                columns[3].textContent = document.getElementById('editSKS').value;
                columns[4].textContent = document.getElementById('editProgramStudi').value;
                columns[5].textContent = document.getElementById('editSemester').value;
                columns[6].textContent = document.getElementById('editDosenPengampu').value;

                // Tutup modal
                bootstrap.Modal.getInstance(document.getElementById('editMataKuliahModal')).hide();
                currentEditRow = null;
            }
        });

        // Hapus Mata Kuliah
        function deleteMataKuliah(button) {
            currentDeleteRow = button.closest('tr');

            // Ambil nama mata kuliah untuk konfirmasi
            const nama = currentDeleteRow.querySelectorAll('td')[2].textContent;
            document.getElementById('deleteNamaMataKuliah').textContent = nama;

            // Tampilkan modal hapus
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteMataKuliahModal'));
            deleteModal.show();
        }

        // Konfirmasi Hapus
        document.getElementById('confirmDeleteMataKuliah').addEventListener('click', function () {
            if (currentDeleteRow) {
                currentDeleteRow.remove();

                // Tutup modal
                bootstrap.Modal.getInstance(document.getElementById('deleteMataKuliahModal')).hide();
                currentDeleteRow = null;

                // Perbarui nomor urut
                const rows = document.querySelectorAll('table tbody tr');
                rows.forEach((row, index) => {
                    row.querySelector('td').textContent = index + 1;
                });
            }
        });
    </script>
</body>

</html>