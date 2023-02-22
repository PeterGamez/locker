<?php
if ($agent_request[2]) {
    $sql = "SELECT * FROM locker WHERE id = '$agent_request[2]'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_object($query);

    if (!$result) {
?>
        <script>
            Swal.fire({
                title: 'ไม่พบตู้ล็อคเกอร์',
                icon: 'error',
                timer: 1500,
                willClose: () => {
                    window.location.href = '/'
                }
            })
        </script>
    <?php
        exit();
    } else if ($result->status == 2) {
    ?>
        <script>
            Swal.fire({
                title: 'ตู้ล็อคเกอร์นี้ไม่พร้อมใช้งาน',
                icon: 'error',
                timer: 1500,
                willClose: () => {
                    window.location.href = '/'
                }
            })
        </script>
    <?php
        exit();
    }
} else {
    ?>
    <script>
        Swal.fire({
            title: 'ไม่พบตู้ล็อคเกอร์',
            icon: 'error',
            timer: 1500,
            willClose: () => {
                window.location.href = '/'
            }
        })
    </script>
<?php
    exit();
}
?>

<body>
    <?php include './template/navbar.php' ?>
    <div class="body container d-flex justify-content-center text-center">
        <div class="card" style="width: 30rem;">
            <div class="card-body">
                <h5 class="card-title">Locker <?= $result->id ?></h5>
                <p class="card-text">Locker Status : <?= $result->status == 0 ? "ว่าง" : "ล็อค" ?></p>
                <a href="/lock/<?= $result->id ?>" class="btn btn-primary"><?= $result->status == 0 ? "Lock" : "Unlock" ?></a>
            </div>
        </div>
    </div>
    <?php include './template/footer.php' ?>
</body>