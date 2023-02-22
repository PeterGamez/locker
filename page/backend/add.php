<?php
if (isset($_REQUEST['add'])) {
    $password = $_POST['address'];

    $sql = "INSERT INTO locker (address) VALUES ('$address')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
?>
        <script>
            Swal.fire({
                title: 'เพิ่มข้อมูลสำเร็จ',
                icon: 'success',
                timer: 1500,
                willClose: () => {
                    window.location.href = '/locker'
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
                            <h3>Add Locker</h3>
                        </div>
                        <div class="p-2">
                            <a href="/backend" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                    <form action="?add" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" required>
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