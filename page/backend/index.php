<?php
if (isset($_REQUEST['delete'])) {
    $sql = "DELETE FROM locker WHERE id = '$_GET[delete]'";
    $query = mysqli_query($conn, $sql);

    echo "<script>history.go(-1)</script>";
}
if (isset($_POST['search'])) {
    $sql = "SELECT * FROM locker WHERE id = '$_POST[search]' OR userId LIKE '%$_POST[search]%' OR address LIKE '%$_POST[search]%'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
} else {
    $sql = "SELECT * FROM locker";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
}
?>

<body>
    <?php include './template/navbar.php' ?>
    <div class="body container">
        <div class="d-flex">
            <div class="p-2 flex-fill">
                <a href="/backend/add" class="btn btn-primary">Add Locker</a>
            </div>
            <div class="p-2">
                <form class="d-flex" role="search" action="" method="POST">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Id</th>
                    <th scope="col">Status</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">&nbsp</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($result); $i++) {
                ?>
                    <tr>
                        <th scope="row"><?= $i + 1 ?></th>
                        <td><?= $result[$i]['id'] ?></td>
                        <td><?= $result[$i]['status'] == 0 ? "ว่าง" : ($result[$i]['status'] == 1 ? "ไม่ว่าง" : "ปิดปรับปรุง") ?></td>
                        <td><?= $result[$i]['name'] ?></td>
                        <td><?= $result[$i]['description'] ?></td>
                        <td>
                            <a href="/backend/edit?id=<?= $result[$i]['id'] ?>" class="btn btn-secondary"><i class="bi bi-pencil-square"></i></a>
                            <a href="?delete=<?= $result[$i]['id'] ?>" class="btn btn-danger" onclick="return confirm('คุณแน่ใจที่จะลบ')"><i class="bi bi-trash3"></i> </a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include './template/footer.php' ?>
</body>