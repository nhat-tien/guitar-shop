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
            <h2>Đơn đặt</h2>
            <div class="container mt-2">
                <div class="row row--to-left task-bar">
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Tên khách</th>
                            <th>Ngày đặt</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?= $order->order_id ?></td>
                                <td><?= $order->customer_name ?></td>
                                <td><?= $order->create_at ?></td>
                                <td>
                                    <div class="menu-list-container">
                                        <button id="ctn-<?= $order->order_id ?>" class="action-icon" onclick="openMenu('ctn-<?= $order->order_id ?>', 'pd-<?= $order->order_id ?>')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                            </svg>
                                        </button>
                                        <ul id="pd-<?= $order->order_id ?>" class="menu-list">
                                        <li>
                                            <a class="menu-list__item" href="/admin/orders/<?= $order->order_id ?>/show">
                                                <div class="menu-list__icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                    </svg>
                                                </div>
                                                <p>Xem
                                                </p>
                                            </a>
                                        </li>
                                            <li>
                                                <a class="menu-list__item btn-update" href="/admin/orders/<?= $order->order_id ?>/edit">
                                                    <div class="menu-list__icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                        </svg>

                                                    </div>
                                                    <p>Chỉnh sửa
                                                    </p>
                                                </a>
                                            </li>
                                            <li>
                                                <button class="menu-list__item" onclick="handleDelete('<?= $order->order_id ?>')">
                                                    <div class="menu-list__icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>

                                                    </div>
                                                    <p>Xóa
                                                    </p>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="row row--to-left task-bar">
                </div>
            </div>
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
    <script>
        function handleDelete(id) {
            fetch("/admin/orders/" + id, {
                method: "DELETE",
                body: {}
            })
            .then(e => e.json())
            .then(e => {
                location.reload();
            });
        }
    </script>
</body>

</html>