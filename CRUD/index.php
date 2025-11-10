<?php
include 'db.php';

// Search
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Pagination
$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Hitung total data
$countSql = "SELECT COUNT(*) AS total FROM students WHERE name LIKE '%$search%'";
$countResult = mysqli_query($conn, $countSql);
$total = mysqli_fetch_assoc($countResult)['total'];
$pages = ceil($total / $limit);

// Ambil data
$sql = "SELECT * FROM students WHERE name LIKE '%$search%' LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);
?>

<form method="GET">
  <input type="text" name="search" placeholder="Cari nama..." value="<?php echo $search; ?>">
  <button type="submit">Search</button>
</form>

<a href="add.php">+ Tambah Data</a>

<table border="1" cellpadding="10">
  <tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Email</th>
    <th>Jurusan</th>
    <th>Foto</th>
    <th>Aksi</th>
  </tr>

  <?php while ($row = mysqli_fetch_assoc($result)) { ?>
  <tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['major'] ?></td>
    <td><img src="uploads/<?= $row['photo'] ?>" width="80"></td>
    <td>
      <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
      <a href="delete.php?id=<?= $row['id'] ?>">Hapus</a>
    </td>
  </tr>
  <?php } ?>
</table>

<?php for ($i = 1; $i <= $pages; $i++) { ?>
  <a href="?page=<?= $i ?>&search=<?= $search ?>"><?= $i ?></a>
<?php } ?>
