<!DOCTYPE html>
<html>
<head>
    <?php require "App/Views/components/head.php" ?>
    <title>Wee Lee Web</title>
    <script src="/public/js/dropzone.min.js"></script>
    <link rel="stylesheet" href="/public/css/dropzone.min.css" type="text/css" />
    <style>
        .dz-progress {
            display: none;
        }
    </style>
</head>
<body>
    <main>
        <?php require "App/Views/components/admin/sidemenu.php" ?>
        <div class="main-center">
            <h2>Thêm sản phẩm</h2>
            <form class="container create-form-container">
                <div id="myDropzone" class="dropzone"></div>
                <div class="col-2 gap-1">
                    <div class="flex flex-column gap-1">
                        <div class="text-field">
                            <label class="text-field__label">Tên sản phẩm</label>
                            <input type="text" class="text-field__input" />
                        </div>
                        <div class="text-field">
                            <label class="text-field__label">Tên sản phẩm</label>
                            <input type="text" class="text-field__input" />
                        </div>
                    </div>
                    <div>
                        <div class="text-field">
                            <label class="text-field__label">Tên sản phẩm</label>
                            <input type="text" class="text-field__input" />
                        </div>
                    </div>
                </div>
                <div class="row row--to-right">
                    <button class="btn">Xác nhận</button>
                </div>
            </form>
        </div>
    </main>
    <script>
        Dropzone.autoDiscover = false;
        let myDropzone = new Dropzone("#myDropzone", {
            url: "/file/upload",
            autoProcessQueue: false,
            addRemoveLinks: true,
            acceptedFiles: "image/*"
        });
    </script>
</body>

</html>