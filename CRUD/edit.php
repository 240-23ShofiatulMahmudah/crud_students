<?php
include 'db.php';
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM students WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $major = $_POST['major'];

    // jika ada foto baru
    if ($_FILES['photo']['name'] != '') {
        $photo = $_FILES['photo']['name'];
        $target = 'uploads/' . basename($photo);
        move_uploaded_file($_FILES['photo']['tmp_name'], $target);
    } else {
        $photo = $row['photo'];
    }

    $sql = "UPDATE students SET name='$name', email='$email', major='$major', photo='$photo' WHERE id=$id";
    mysqli_query($conn, $sql);
    header('Location: index.php');
}
?>

<form method="POST" enctype="multipart/form-data">
  Nama: <input type="text" name="name" value="<?= $row['name'] ?>"><br>
  Email: <input type="email" name="email" value="<?= $row['email'] ?>"><br>
  Jurusan: <input type="text" name="major" value="<?= $row['major'] ?>"><br>
  Foto: <input type="file" name="photo"><br>
  <img src="uploads/<?= $row['photo'] ?>" width="100"><br>
  <button type="submit" name="update">Update</button>
</form>
