<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $query = "UPDATE kehadiran SET status = :status, updated_at = NOW() WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':status', $status);
    $statement->bindParam(':id', $id);

    if ($statement->execute()) {
        header("Location: ../masterdata-absensi.php?pesan=Data berhasil diperbarui");
    } else {
        header("Location: ../masterdata-absensi.php?pesan=Terjadi kesalahan saat memperbarui data");
    }
}
?>