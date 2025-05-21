<!DOCTYPE html>
<html>

<head>
    <?php require "App/Views/components/head.php" ?>
    <title>Wee Lee Web</title>
</head>

<body>
    <main>
        <div class="main-center flex justify-center items-center">
            <form id="login-form" class="login-form" >
                <img src="/public/img/logo.svg" alt="Logo">
                <h2>Đăng nhập</h2>
                <div class="text-field my-1">
                    <label class="text-field__label">Email</label>
                    <input name="email" type="text" class="text-field__input" />
                </div>
                <div class="text-field">
                    <label class="text-field__label">Mật khẩu</label>
                    <div class="password-field">
                        <input name="password" type="password" class="password-field__input" />
                        <button type="button" class="password-field__icon password-field__icon--eye-open" onclick="togglePassword('.password-field', 'show', '.password-field__input')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                        <button type="button" class="password-field__icon password-field__icon--eye-close" onclick="togglePassword('.password-field', 'show', '.password-field__input')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                </div>
                <button type="button" class="full-width-btn mt-2" onclick="handleSubmit()">Xác nhận
                </button>
                <a href="/admin/register" class="mt-1">Chưa có tài khoản, đăng kí</a>
            </form>
        </div>
    </main>
    <div id="toast-container"></div>
    <script src="/public/js/toast.js"></script>
    <script src="/public/js/togglePassword.js"></script>
    <script>
        function handleSubmit() {
            const formEl = document.getElementById("login-form");
            const formData = new FormData(formEl);
            fetch("/admin/signin" , {
                method: "POST",
                body: formData
            }).then(e => e.json())
            .then(e => {
                if(e.status) {
                    window.location.href = "/admin/dashboard";
                } else {
                    console.log(e.message)
                    showToast(`${e.message}`, "error")
                }
            })
            
        }
    </script>
</body>

</html>