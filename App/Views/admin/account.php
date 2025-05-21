<!DOCTYPE html>
<html>

<head>
    <?php require "App/Views/components/head.php" ?>
    <title>Wee Lee Web</title>
</head>
<body>
        <?php require "App/Views/components/admin/header.php" ?>
    <main>
        <?php require "App/Views/components/admin/sidemenu.php" ?>
        <div class="main-center">
            <h2>Thông tin tài khoản</h2>
            <div class="container mt-2 p-2">
                <div class="flex flex-col">
                    <div class="col-2">
                        <div>
                            <div class="field">
                                <div class="field__label">Tên</div>
                                <div class="field__content"><?= $_SESSION['user']['name'] ?></div>
                            </div>
                        </div>
                        <div>
                            <div class="field">
                                <div class="field__label">Email</div>
                                <div class="field__content"><?= $_SESSION['user']['email'] ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="/public/js/dropdownMenu.js"></script>
</body>

</html>
