<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $major = $_POST['major'];
    $photo = $_FILES['photo']['name'];
    $target = 'uploads/' . basename($photo);

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
        $sql = "INSERT INTO students (name, email, major, photo)
                VALUES ('$name', '$email', '$major', '$photo')";
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php');
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    } else {
        echo 'Upload gagal!';
    }
}
?>

<form method="POST" enctype="multipart/form-data">
  Nama: <input type="text" name="name" required><br>
  Email: <input type="email" name="email" required><br>
  Jurusan: <input type="text" name="major" required><br>
  Foto: <input type="file" name="photo" required><br>
  <button type="submit" name="submit">Simpan</button>
</form>
