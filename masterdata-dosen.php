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
                                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahDosenModal"><i
                                        class="fas fa-fw fa-plus"></i> Tambah Data Dosen</a>
                            </div>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Dosen</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Foto Dosen</th>
            <th>Nama Dosen</th>
            <th>NIP</th>
            <th>Jurusan</th>
            <th>Prodi</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Memulai nomor urut
        $no = 1;

        // Query untuk mengambil semua data dosen
        $query = mysqli_query($conn, "SELECT * FROM dosen");

        // Looping data dosen
        while ($row = mysqli_fetch_array($query)) {
            ?>
                        <tr>
                            <!-- No Urut -->
                            <td><?php echo $no++; ?></td>

                            <!-- Foto Dosen -->
                            <td>
                                <img src="media/<?php echo $row['photo']; ?>" 
                                     alt="Foto <?php echo $row['nama_dosen']; ?>" 
                                     class="rounded" width="50" height="50">
                            </td>

                            <!-- Nama Dosen -->
                            <td><?php echo $row['nama_dosen']; ?></td>

                            <!-- NIP Dosen -->
                            <td><?php echo $row['nip']; ?></td>

                            <?php
                            // Mengambil id_prodi dari tabel dosen
                            $idprodi = $row['id_prodi'];

                            // Query untuk mengambil data prodi dan jurusan yang terkait dengan dosen
                            $query2 = mysqli_query($conn, "SELECT jurusan.jurusan_name, prodi.prodi_name 
                                               FROM prodi 
                                               INNER JOIN jurusan ON jurusan.jurusan_id = prodi.jurusan_id 
                                               WHERE prodi.id_prodi = $idprodi");

                            // Ambil data dari query di atas
                            $row2 = mysqli_fetch_array($query2);
                            ?>

                            <!-- Nama Jurusan -->
                            <td><?php echo $row2['jurusan_name']; ?></td>

                            <!-- Nama Prodi -->
                            <td><?php echo $row2['prodi_name']; ?></td>

                            <!-- Tombol Aksi -->
                            <td>
                                <a class="btn btn-warning btn-sm" 
                                   data-bs-toggle="modal" 
                                   data-bs-target="#editModal" 
                                   onclick="editDosen('<?php echo $row['nama_dosen']; ?>', 
                                          '<?php echo $row['nip']; ?>', 
                                          '<?php echo $row2['jurusan_name']; ?>', 
                                          '<?php echo $row2['prodi_name']; ?>')">
                                    <i class="fas fa-fw fa-edit"></i> Edit
                                </a>
                                <a href="#" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="confirmDelete(<?php echo $row['id_dosen']; ?>)">
                                    <i class="fas fa-fw fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                <?php
        }
        ?>
    </tbody>
</table>

                            </div>

                            <!-- Modal Tambah Dosen -->
                            <div class="modal fade" id="tambahDosenModal" tabindex="-1"
                                aria-labelledby="tambahDosenLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tambahDosenLabel">Tambah Data Dosen</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="formTambahDosen">
                                                <!-- Input Foto -->
                                                <div class="mb-3">
                                                    <label for="fotoDosen" class="form-label">Foto Dosen</label>
                                                    <input type="file" class="form-control" id="fotoDosen"
                                                        accept="image/*">
                                                </div>

                                                <!-- Input NIDN -->
                                                <div class="mb-3">
                                                    <label for="nidnDosen" class="form-label">NIDN</label>
                                                    <input type="text" class="form-control" id="nidnDosen"
                                                        placeholder="Masukkan NIDN" required>
                                                </div>

                                                <!-- Input Nama Dosen -->
                                                <div class="mb-3">
                                                    <label for="namaDosen" class="form-label">Nama Dosen</label>
                                                    <input type="text" class="form-control" id="namaDosen"
                                                        placeholder="Masukkan Nama Dosen" required>
                                                </div>

                                                <!-- Input Program Studi -->
                                                <div class="mb-3">
                                                    <label for="programStudiDosen" class="form-label">Program
                                                        Studi</label>
                                                    <input type="text" class="form-control" id="programStudiDosen"
                                                        placeholder="Masukkan Program Studi" required>
                                                </div>

                                                <!-- Input Jabatan Akademik -->
                                                <div class="mb-3">
                                                    <label for="jabatanAkademikDosen" class="form-label">Jabatan
                                                        Akademik</label>
                                                    <input type="text" class="form-control" id="jabatanAkademikDosen"
                                                        placeholder="Masukkan Jabatan Akademik" required>
                                                </div>

                                                <!-- Input Mata Kuliah -->
                                                <div class="mb-3">
                                                    <label for="mataKuliahDosen" class="form-label">Mata Kuliah</label>
                                                    <input type="text" class="form-control" id="mataKuliahDosen"
                                                        placeholder="Masukkan Mata Kuliah" required>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary"
                                                id="submitDosen">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Edit Data Dosen -->
                            <div class="modal fade" id="editDosenModal" tabindex="-1" aria-labelledby="editDosenLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editDosenLabel">Edit Data Dosen</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="formEditDosen">
                                                <input type="hidden" id="rowIndex">
                                                <!-- Index baris yang sedang diedit -->
                                                <div class="row">
                                                    <!-- Foto Dosen -->
                                                    <div class="col-md-6 mb-3">
                                                        <label for="editFotoDosen" class="form-label">Foto</label>
                                                        <input type="file" class="form-control" id="editFotoDosen"
                                                            accept="image/*">
                                                        <img id="editFotoPreview" src="" class="img-thumbnail mt-2"
                                                            style="max-width: 150px; display: none;">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- NIDN -->
                                                    <div class="col-md-6 mb-3">
                                                        <label for="editNidnDosen" class="form-label">NIDN</label>
                                                        <input type="text" class="form-control" id="editNidnDosen">
                                                    </div>
                                                    <!-- Nama Dosen -->
                                                    <div class="col-md-6 mb-3">
                                                        <label for="editNamaDosen" class="form-label">Nama Dosen</label>
                                                        <input type="text" class="form-control" id="editNamaDosen">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- Program Studi -->
                                                    <div class="col-md-6 mb-3">
                                                        <label for="editProgramStudi" class="form-label">Program
                                                            Studi</label>
                                                        <input type="text" class="form-control" id="editProgramStudi">
                                                    </div>
                                                    <!-- Jabatan Akademik -->
                                                    <div class="col-md-6 mb-3">
                                                        <label for="editJabatanAkademik" class="form-label">Jabatan
                                                            Akademik</label>
                                                        <input type="text" class="form-control"
                                                            id="editJabatanAkademik">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- Mata Kuliah -->
                                                    <div class="col-md-6 mb-3">
                                                        <label for="editMataKuliah" class="form-label">Mata
                                                            Kuliah</label>
                                                        <input type="text" class="form-control" id="editMataKuliah">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="btnSaveChanges">Simpan
                                                Perubahan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Hapus Data Dosen -->
                            <div class="modal fade" id="hapusDosenModal" tabindex="-1" aria-labelledby="hapusDosenLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="hapusDosenLabel">Hapus Data Dosen</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data dosen <strong
                                                id="hapusNamaDosen"></strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="button" class="btn btn-danger"
                                                id="btnHapusDosen">Hapus</button>
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
        document.getElementById('submitDosen').addEventListener('click', function () {
            // Ambil data dari form
            var foto = document.getElementById('fotoDosen').files[0];
            var nidn = document.getElementById('nidnDosen').value;
            var nama = document.getElementById('namaDosen').value;
            var programStudi = document.getElementById('programStudiDosen').value;
            var jabatan = document.getElementById('jabatanAkademikDosen').value;
            var mataKuliah = document.getElementById('mataKuliahDosen').value;

            // Jika semua field sudah terisi
            if (nidn && nama && programStudi && jabatan && mataKuliah) {
                var formData = new FormData();
                if (foto) {
                    formData.append('foto', foto);
                }
                formData.append('nidn', nidn);
                formData.append('nama', nama);
                formData.append('programStudi', programStudi);
                formData.append('jabatan', jabatan);
                formData.append('mataKuliah', mataKuliah);

                // Kirim data ke server (ganti URL dengan endpoint yang sesuai)
                fetch('/path/to/your/api/endpoint', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        alert('Data dosen berhasil ditambahkan!');
                        // Setelah berhasil, Anda bisa menutup modal dan me-refresh tabel
                        $('#tambahDosenModal').modal('hide');
                    })
                    .catch(error => {
                        alert('Terjadi kesalahan: ' + error.message);
                    });
            } else {
                alert('Mohon lengkapi semua field!');
            }
        });
    </script>
    <script>
        // Fungsi untuk mengisi modal Edit dengan data dari tabel
        function editDosen(button) {
            const row = button.closest('tr'); // Mendapatkan baris data
            const nidn = row.cells[2].textContent; // Mengambil NIDN dari kolom ketiga
            const nama = row.cells[3].textContent; // Mengambil Nama Dosen dari kolom keempat
            const prodi = row.cells[4].textContent; // Mengambil Program Studi dari kolom kelima
            const jabatan = row.cells[5].textContent; // Mengambil Jabatan Akademik dari kolom keenam
            const mataKuliah = row.cells[6].textContent; // Mengambil Mata Kuliah dari kolom ketujuh
            const foto = row.cells[1].querySelector('img').src; // Mengambil src foto dari kolom kedua

            // Mengisi data ke modal
            document.getElementById('editNidnDosen').value = nidn;
            document.getElementById('editNamaDosen').value = nama;
            document.getElementById('editProgramStudi').value = prodi;
            document.getElementById('editJabatanAkademik').value = jabatan;
            document.getElementById('editMataKuliah').value = mataKuliah;
            document.getElementById('editFotoPreview').src = foto;
            document.getElementById('editFotoPreview').style.display = 'block';

            // Menyimpan index baris untuk update nanti
            document.getElementById('rowIndex').value = row.rowIndex - 1; // Karena baris pertama adalah header

            // Menampilkan modal
            new bootstrap.Modal(document.getElementById('editDosenModal')).show();
        }

        // Fungsi untuk menyimpan perubahan data dosen yang telah diedit
        document.getElementById('btnSaveChanges').addEventListener('click', function () {
            const nidn = document.getElementById('editNidnDosen').value;
            const nama = document.getElementById('editNamaDosen').value;
            const prodi = document.getElementById('editProgramStudi').value;
            const jabatan = document.getElementById('editJabatanAkademik').value;
            const mataKuliah = document.getElementById('editMataKuliah').value;
            const fotoFile = document.getElementById('editFotoDosen').files[0];
            const fotoPreview = document.getElementById('editFotoPreview').src;

            // Update data pada baris yang sesuai (menggunakan index baris)
            const rowIndex = document.getElementById('rowIndex').value;
            const row = document.querySelector('table tbody').rows[rowIndex];

            row.cells[2].textContent = nidn;
            row.cells[3].textContent = nama;
            row.cells[4].textContent = prodi;
            row.cells[5].textContent = jabatan;
            row.cells[6].textContent = mataKuliah;

            // Menyimpan gambar baru (jika ada file baru)
            if (fotoFile) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    row.cells[1].querySelector('img').src = e.target.result;
                };
                reader.readAsDataURL(fotoFile);
            }

            // Menutup modal
            bootstrap.Modal.getInstance(document.getElementById('editDosenModal')).hide();
        });

        // Fungsi untuk konfirmasi hapus
    </script>
    <script>
        // Fungsi untuk konfirmasi hapus data dosen
        function hapusDosen(button) {
            const row = button.closest('tr'); // Mendapatkan baris data
            const namaDosen = row.cells[3].textContent; // Mengambil Nama Dosen dari kolom keempat
            document.getElementById('hapusNamaDosen').textContent = namaDosen;

            // Menyimpan index baris untuk dihapus
            document.getElementById('btnHapusDosen').onclick = function () {
                row.remove(); // Menghapus baris dari tabel
                // Menutup modal setelah hapus
                bootstrap.Modal.getInstance(document.getElementById('hapusDosenModal')).hide();
            };

            // Menampilkan modal
            new bootstrap.Modal(document.getElementById('hapusDosenModal')).show();
        }
    </script>
</body>

</html>