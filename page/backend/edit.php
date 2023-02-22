<?php
if (isset($_REQUEST['edit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql = "UPDATE locker SET name = '$name', description = '$description' WHERE id = $id";
    $query = mysqli_query($conn, $sql);

    if ($query) {
?>
        <script>
            Swal.fire({
                title: 'แก้ไขข้อมูลสำเร็จ',
                icon: 'success',
                timer: 1500,
                willClose: () => {
                    window.location.href = '/backend'
                }
            })
        </script>
    <?php
    } else {
    ?>
        <script>
            Swal.fire({
                title: 'เกิดข้อผิดพลาด',
                icon: 'error',
                timer: 1500,
                willClose: () => {
                    history.go(-1)
                }
            })
        </script>
<?php
    }
} else {
    $sql = "SELECT * FROM locker WHERE id = '$_GET[id]'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_object($query);
}
?>

<body>
    <?php include './template/navbar.php' ?>
    <div class="body container">
        <div class="d-flex justify-content-center">
            <div class="card" style="width: 25rem;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="p-2 flex-fill">
                            <h3>Edit Locker</h3>
                        </div>
                        <div class="p-2">
                            <a href="/backend" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                    <form action="?add" method="POST">
                        <input type="hidden" class="form-control" name="id" value="<?= $result->id ?>">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="<?= $result->name ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" value="<?= $result->description ?>" required>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include './template/footer.php' ?>
</body>