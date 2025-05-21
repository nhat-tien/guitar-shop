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
        </div>
    </main>
    <div id="toast-container"></div>
    <?php if (isset($_SESSION['response'])): ?>
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                showToast("<?= $_SESSION['response']["message"] ?>", "<?= $_SESSION['response']["status"] ? "success" : "error" ?>");
            });
        </script>
        <?php unset($_SESSION['response']); ?>
    <?php endif; ?>
    <script src="/public/js/dropdownMenu.js"></script>
    <script src="/public/js/toast.js"></script>
</body>

</html>