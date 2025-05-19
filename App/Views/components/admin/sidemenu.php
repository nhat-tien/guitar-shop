<div class="side-menu">
    <?php
    $side_menu = [
        [
            "id" => "dashboard",
            "icon" => "
                <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' class='size-6'>
                    <path stroke-linecap='round' stroke-linejoin='round' d='m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25' />
                </svg>
            ",
            "label" => "Dashboard",
            "href" => "/admin/dashboard",
        ],
        [
            "id" => "products",
            "icon" => "
                <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6'>
                    <path stroke-linecap='round' stroke-linejoin='round' d='M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z' />
                </svg>
            ",
            "label" => "Sản Phẩm",
            "href" => "/admin/products",
        ],
        [
            "id" => "brands",
            "icon" => "
                <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6'>
                    <path stroke-linecap='round' stroke-linejoin='round' d='M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z' />
                </svg>
            ",
            "label" => "Thương hiệu",
            "href" => "/admin/brands",
        ],
        [
            "id" => "body-shapes",
            "icon" => "
                <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6'>
                    <path stroke-linecap='round' stroke-linejoin='round' d='M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z' />
                </svg>
            ",
            "label" => "Dáng đàn",
            "href" => "/admin/body-shapes",
        ],
        [
            "id" => "categories",
            "icon" => "
                <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6'>
                    <path stroke-linecap='round' stroke-linejoin='round' d='M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z' />
                </svg>
            ",
            "label" => "Danh mục",
            "href" => "/admin/categories",
        ],
    ];

    $arrOfUri = explode("/", $_SERVER['REQUEST_URI']);
    $currentPage = $arrOfUri[2];

    foreach ($side_menu as $item) {
        $selected =  $item["id"] == $currentPage ? "selected" : "";
        echo "
        <a href='{$item["href"]}' class='side-menu-item {$selected}'>
            <div class='side-menu-item__icon'>
                {$item["icon"]}
            </div>
            <div class='side-menu-item__label'>
                {$item["label"]}
            </div>
        </a>
    ";
    };
    ?>
</div>