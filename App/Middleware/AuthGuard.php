<?php

class AuthGuard {

    public static $except = [
        "/admin/login",
        "/admin/register",
        "/admin/signin",
        "/admin/signup",
    ];

    public static function checkAuth($uri)
    {
        $except = [
            "/admin/login",
            "/admin/register",
            "/admin/signin",
            "/admin/signup",
        ];

        if(in_array($uri, $except)) {
            return true;
        }

        if(substr($uri,0, 6) !== "/admin") {
            return true;
        }

        if(isset($_SESSION['user'])) {

            $role = $_SESSION['user']['role'];

            return $role == "admin";
        }

        return false;
    }

}