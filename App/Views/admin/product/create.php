<!DOCTYPE html>
<html>

<head>
    <?php require "App/Views/components/head.php" ?>
    <title>Wee Lee Web</title>
    <script src="/public/js/dropzone.min.js"></script>
    <script src="/public/js/Sortable.min.js"></script>
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
                <div class="col-2 gap-1 mt-1">
                    <div class="flex flex-col gap-1">
                        <div class="text-field">
                            <label class="text-field__label">Tên sản phẩm</label>
                            <input name="product_name" type="text" class="text-field__input" />
                        </div>
                        <div class="text-field">
                            <label class="text-field__label">Giá</label>
                            <input name="base_price" type="number" class="text-field__input" />
                        </div>
                        <div class="text-field">
                            <label class="text-field__label">Khuyến mãi</label>
                            <input name="discount" type="number" class="text-field__input" />
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <div class="text-field">
                            <label class="text-field__label">Số lượng</label>
                            <input name="quantity" type="number" class="text-field__input" />
                        </div>
                        <div class="text-field">
                            <label class="text-field__label">Đơn vị giá</label>
                            <select name="price_unit" class="text-field__input" >
                                <option value="VND">₫ VND</option>
                                <option value="USD">$ USD</option>
                            </select>
                        </div>
                        <div class="text-field">
                            <label class="text-field__label">Đơn vị khuyến mãi</label>
                            <select name="discount_unit" class="text-field__input" >
                                <option value="%">%</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row row--to-right py-2">
                    <button class="btn" onclick="handleSubmit()" type="button">Xác nhận</button>
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
                acceptedFiles: "image/*",
                dictRemoveFile: "Xóa",
                init: function() {
                    new Sortable(this.previewsContainer, {
                        draggable: ".dz-preview",
                        onEnd: function(e) {
                            const itemEl = e.item; 
                            const oldIndex = e.oldIndex - 1;
                            const newIndex = e.newIndex - 1;
                            const files = myDropzone.files;
                            const moveItem = files.find((e, i) => i === oldIndex);
                            const remainArr = files.filter((e, i) => i !== oldIndex);

                            const newArrFile = [
                                ...remainArr.slice(0, newIndex),
                                moveItem,
                                ...remainArr.slice(newIndex)
                            ];

                            myDropzone.files = newArrFile;
                        }
                    });
                },
            });

        function handleSubmit() {
            console.log(myDropzone.files);
        }
    </script>
</body>

</html>