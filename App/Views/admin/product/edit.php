<!DOCTYPE html>
<html>

<head>
    <?php require "App/Views/components/head.php" ?>
    <title>Wee Lee Web</title>
    <script src="/public/js/dropzone.min.js"></script>
    <script src="/public/js/Sortable.min.js"></script>
    <link rel="stylesheet" href="/public/css/dropzone.min.css" type="text/css" />
    <link rel="stylesheet" href="/public/ckeditor5/ckeditor5.css">
    <style>
        .dz-progress {
            display: none;
        }
    </style>
</head>

<body>
        <?php require "App/Views/components/admin/header.php" ?>
    <main>
        <?php require "App/Views/components/admin/sidemenu.php" ?>
        <div class="main-center">
            <h2>Cập nhật sản phẩm</h2>
            <form id="create-form" class="container create-form-container">
                <div id="myDropzone" class="dropzone"></div>
                <div class="col-2 gap-1 mt-1">
                    <div class="flex flex-col gap-1">
                        <div class="text-field">
                            <label class="text-field__label">Tên sản phẩm</label>
                            <input name="product_name" type="text" class="text-field__input" value="<?= $product->product_name ?>"/>
                        </div>
                        <div class="text-field">
                            <label class="text-field__label">Giá</label>
                            <input name="base_price" type="number" class="text-field__input" value="<?= $product->base_price ?>"/>
                        </div>
                        <div class="text-field">
                            <label class="text-field__label">Khuyến mãi</label>
                            <input name="discount" type="number" class="text-field__input" value="<?= $product->discount ?>"/>
                        </div>
                        <div class="text-field">
                            <label class="text-field__label">Số dây</label>
                            <input name="number_of_string" type="number" class="text-field__input" value="<?= $product->number_of_string ?>"/>
                        </div>
                        <div class="text-field">
                            <label class="text-field__label">Dáng đàn</label>
                            <select name="body_shape_id" class="text-field__input">
                                <?php foreach ($bodyShapes as $bodyShape): ?>
                                    <option value="<?= $bodyShape->body_shape_id ?>" <?= $bodyShape->body_shape_id == $product->body_shape_id ? "selected" : "" ?> ><?= $bodyShape->body_shape_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <div class="text-field">
                            <label class="text-field__label">Số lượng</label>
                            <input name="quantity" type="number" class="text-field__input" value="<?= $product->quantity ?>"/>
                        </div>
                        <div class="text-field">
                            <label class="text-field__label">Đơn vị giá</label>
                            <select name="price_unit" class="text-field__input">
                                <option value="VND" <?= $product->price_unit == "VND" ? "selected" : "" ?>>₫ VND</option>
                                <option value="USD" <?= $product->price_unit == "USD" ? "selected" : "" ?>>$ USD</option>
                            </select>
                        </div>
                        <div class="text-field">
                            <label class="text-field__label">Đơn vị khuyến mãi</label>
                            <select name="discount_unit" class="text-field__input">
                                <option value="%">%</option>
                            </select>
                        </div>
                        <div class="text-field">
                            <label class="text-field__label">Thương hiệu</label>
                            <select name="brand_id" class="text-field__input">
                                <?php foreach ($brands as $brand): ?>
                                    <option value="<?= $brand->brand_id ?>" <?= $brand->brand_id == $product->brand_id ? "selected" : "" ?>><?= $brand->brand_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="text-field">
                            <label class="text-field__label">Danh mục</label>
                            <select name="category_id" class="text-field__input">
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category->category_id ?>" <?= $category->category_id == $product->category_id ? "selected" : "" ?> ><?= $category->category_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="text-field mt-2">
                    <label class="text-field__label">Mô tả</label>
                    <div id="editor"></div>
                </div>

                <div class="col-2 gap-1 mt-2">
                    <div class="flex flex-col gap-1">
                        <div class="text-field">
                            <label class="text-field__label">Chất liệu thân đàn</label>
                            <input name="body_material" type="text" class="text-field__input" value="<?= $product->body_material ?>"/>
                        </div>
                        <div class="text-field">
                            <label class="text-field__label">Độ dài dây đàn</label>
                            <input name="scale_length" type="text" class="text-field__input" value="<?= $product->scale_length ?>"/>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <div class="text-field">
                            <label class="text-field__label">Chất liệu cần đàn</label>
                            <input name="fretboard_material" type="text" class="text-field__input" value="<?= $product->fretboard_material ?>"/>
                        </div>
                        <div class="text-field">
                            <label class="text-field__label">Số phím đàn</label>
                            <input name="no_of_fret" type="number" class="text-field__input" value="<?= $product->no_of_fret ?>"/>
                        </div>
                    </div>
                </div>
                <div class="row row--to-right py-2">
                    <button class="btn" onclick="handleSubmit()" type="button">Xác nhận</button>
                </div>
            </form>
        </div>
    </main>
    <div id="toast-container"></div>
    <script src="/public/js/toast.js"></script>
    <script>
        let images = [
            <?php 
                foreach ($product->images as $image)
                {
                    echo "{
                            id: {$image->product_image_id},
                            name: '{$image->product_image_name}',
                            url: '{$image->url}',
                            action: 'stay'
                        },";
                };
            ?>
        ];

        let deleteImages = [];

        Dropzone.autoDiscover = false;

        let myDropzone = new Dropzone("#myDropzone", {
            url: "/file/upload",
            autoProcessQueue: false,
            addRemoveLinks: true,
            acceptedFiles: "image/*",
            dictRemoveFile: "Xóa",
            dictDefaultMessage: "Thả hoặc nhấp vào đây để upload file",
            init: function() {

                images.forEach(e => {
                    const mockFile = {
                    name: e.name,
                    id: e.id,
                    accepted: true,
                    status: Dropzone.SUCCESS
                };
                this.files.push(mockFile);
                this.displayExistingFile(mockFile, e.url);
                });

                this.on("addedfile", file => {
                    images.push({
                        id: "",
                        name: file.name,
                        url: "",
                        action: "add"
                    })
                });

                this.on("removedfile", file => {
                    if(images.find(e => e.name == file.name && e.action == "add")) {
                        images = images.filter(e => e.name != file.name)
                    } else {
                        let id = images.findIndex(e => e.name == file.name);
                        images = images.filter(e => e.name != file.name);
                        deleteImages.push({
                                id: id,
                                name: file.name,
                                url: "",
                                action: "delete"
                        })
                    }
                });

                new Sortable(this.previewsContainer, {
                    draggable: ".dz-preview",
                    onEnd: function(e) {
                        const itemEl = e.item;
                        const oldIndex = e.oldIndex - 1;
                        const newIndex = e.newIndex - 1;
                        const files = myDropzone.files;
                        const moveItem = files.find((e, i) => i === oldIndex);
                        const moveItemInImage = images.find((e, i) => i === oldIndex);
                        const remainImage = images.filter((e, i) => i !== oldIndex);
                        const remainArr = files.filter((e, i) => i !== oldIndex);

                        images = [
                            ...remainImage.slice(0, newIndex),
                            moveItemInImage,
                            ...remainImage.slice(newIndex)
                        ];

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
            const formEl = document.getElementById("create-form");
            const formData = new FormData(formEl);
            formData.append("description", editor.getData());
            formData.append("order", JSON.stringify(images));
            formData.append("delete_images", JSON.stringify(deleteImages));
            myDropzone.files.forEach(e => {
                if (e.status === Dropzone.SUCCESS && e.upload === undefined) {
                    return;
                }
                formData.append("images[]", e, e.name);
            })
            console.log(myDropzone.files)
            fetch("/admin/products/" + <?= $product->product_id ?>, {
                method: "POST",
                body: formData
            }).then(e => e.json())
            .then(e => {
                if(e.status) {
                    window.location.href = "/admin/products";
                } else {
                    console.log(e.message)
                    showToast(`Có lỗi xảy ra: ${e.message}`, "error")
                }
            })
            
        }
    </script>
    <script type="importmap">
        {
        "imports": {
            "ckeditor5": "/public/ckeditor5/ckeditor5.js",
            "ckeditor5/": "/public/ckeditor5/"
        }
    }
    </script>
    <script type="module">
        import { setupEditor } from "/public/js/editor.js"
        setupEditor("<?= $product->description ?>");
    </script>
</body>

</html>