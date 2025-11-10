<?php
include 'db.php';
$id = $_GET['id'];

// Hapus file dari folder uploads
$get = mysqli_query($conn, "SELECT photo FROM students WHERE id=$id");
$row = mysqli_fetch_assoc($get);
unlink('uploads/' . $row['photo']);

// Hapus dari database
mysqli_query($conn, "DELETE FROM students WHERE id=$id");

header('Location: index.php');
?>
 