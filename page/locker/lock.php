<?php
if ($agent_request[2]) {
    $sql = "SELECT * FROM locker WHERE id = '$agent_request[2]'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_object($query);
    if (!$result) {
?>
        <script>
            Swal.fire({
                title: 'ไม่พบตู้ล็อคเกอร์ !',
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
}
if (isset($_REQUEST['open'])) {
    $sql = "UPDATE locker SET open = '0' WHERE id = '$result->id'";
    $query = mysqli_query($conn, $sql);

    sleep(3);

    $sql = "UPDATE locker SET open = '1' WHERE id = '$result->id'";
    $query = mysqli_query($conn, $sql);
    ?>
    <script>
        Swal.fire({
            title: 'เปิดตู้ล็อคเกอร์สำเร็จ',
            icon: 'success',
            timer: 1500,
            willClose: () => {
                window.location.href = '/lock/<?= $result->id ?>'
            }
        })
    </script>
    <?php
    exit();
} else if (isset($_REQUEST['lock'])) {
    $lockerId = $_POST['lockerId'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM locker WHERE id = '$lockerId'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_object($query);

    if ($result) {
        if ($result->status == 1) {
    ?>
            <script>
                Swal.fire({
                    title: 'ตู้ล็อคเกอร์ถูกใช้งานอยู่',
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

        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE locker SET status = '1', open = '0' WHERE id = '$lockerId'";
        $query = mysqli_query($conn, $sql);

        $sql = "INSERT INTO locker_log (lockerId, password) VALUES ('$lockerId', '$password')";
        $query = mysqli_query($conn, $sql);

        ?>
        <script>
            Swal.fire({
                title: 'ล็อคตู้ล็อคเกอร์สำเร็จ',
                icon: 'success',
                timer: 1500,
                willClose: () => {
                    window.location.href = '/'
                }
            })
        </script>
    <?php
        exit();
    } else {
    ?>
        <script>
            Swal.fire({
                title: 'ไม่พบตู้ล็อคเกอร์ !!',
                icon: 'error',
                timer: 1500,
                willClose: () => {
                    window.location.href = '/'
                }
            })
        </script>
        <?php
    }
    exit();
} else if (isset($_REQUEST['unlock'])) {
    $lockerId = $_POST['lockerId'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM locker WHERE id = '$lockerId'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_object($query);

    if ($result) {
        if ($result->status == 0) {
        ?>
            <script>
                Swal.fire({
                    title: 'ตู้ล็อคเกอร์ว่างอยู่',
                    icon: 'warning',
                    timer: 1500,
                    willClose: () => {
                        window.location.href = '/'
                    }
                })
            </script>
            <?php
            exit();
        }

        $sql = "SELECT * FROM locker_log WHERE lockerId = '$lockerId' ORDER BY id DESC";
        $query = mysqli_query($conn, $sql);
        $locker = mysqli_fetch_object($query);

        if ($locker) {
            if (password_verify($password, $locker->password) == false) {
            ?>
                <script>
                    Swal.fire({
                        title: 'รหัสผ่านไม่ถูกต้อง',
                        icon: 'warning',
                        timer: 1500,
                        willClose: () => {
                            history.go(-1)
                        }
                    })
                </script>
            <?php
                exit();
            }
            $sql = "UPDATE locker SET status = '0', open = '1' WHERE id = '$lockerId'";
            $query = mysqli_query($conn, $sql);

            $sql = "UPDATE locker_log SET withdraw_date = NOW() WHERE id = '$locker->id'";
            $query = mysqli_query($conn, $sql);

            ?>
            <script>
                Swal.fire({
                    title: 'ปลดล็อคตู้ล็อคเกอร์สำเร็จ',
                    icon: 'success',
                    timer: 1500,
                    willClose: () => {
                        window.location.href = '/'
                    }
                })
            </script>
        <?php
            exit();
        } else {
        ?>
            <script>
                Swal.fire({
                    title: 'ไม่พบตู้ล็อคเกอร์ !!!',
                    icon: 'error',
                    timer: 1500,
                    willClose: () => {
                        window.location.href = '/'
                    }
                })
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            Swal.fire({
                title: 'ไม่พบตู้ล็อคเกอร์ !!',
                icon: 'error',
                timer: 1500,
                willClose: () => {
                    window.location.href = '/'
                }
            })
        </script>
<?php
    }
    exit();
}

?>

<body>
    <?php include './template/navbar.php' ?>
    <div class="body container d-flex justify-content-center text-center">
        <div class="card" style="width: 30rem;">
            <div class="card-body">
                <h5 class="card-title">Locker <?= $result->id ?></h5>
                <?php
                if ($result->status == 0) {
                ?>
                    <form action="?lock" method="POST">
                        <label>ตั้งรหัสผ่าน</label>
                        <input type="text" name="password" pattern="[0-9]{4,}" title="รหัสผ่านเป็นตัวเลขอย่างน้อย 4 อักษร" class="form-control mb-4 shadow rounded-1" required>
                        <input type="hidden" name="lockerId" value="<?= $result->id ?>">
                        <a href="?open" class="btn btn-primary">Open</a>
                        <button type="submit" class="btn btn-primary">Lock</button>
                    </form>
                <?php
                } else if ($result->status == 1 and $result->userId == $_SESSION['user_id']) {
                ?>
                    <form action="?unlockown" method="POST">
                        <input type="hidden" name="lockerId" value="<?= $result->id ?>">
                        <button type="submit" class="btn btn-primary">Unlock</button>
                    </form>
                <?php
                } else if ($result->status == 1) {
                ?>
                    <form action="?unlock" method="POST">
                        <label>รหัสผ่าน</label>
                        <input type="text" name="password" pattern="[0-9]{4,}" title="รหัสผ่านเป็นตัวเลขอย่างน้อย 4 อักษร" class="form-control mb-4 shadow rounded-1" required>
                        <input type="hidden" name="lockerId" value="<?= $result->id ?>">
                        <button type="submit" class="btn btn-primary">Unlock</button>
                    </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php include './template/footer.php' ?>
</body>