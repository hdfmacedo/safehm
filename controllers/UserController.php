<?php
require_once __DIR__ . '/../models/User.php';
class UserController {
    public function login(string $username, string $password): bool {
        $user = User::load($username);
        if ($user && $user->verifyPassword($password)) {
            $_SESSION['user'] = $username;
            return true;
        }
        return false;
    }

    public function register(string $username, string $password): bool {
        if (User::load($username)) {
            return false;
        }
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $user = new User($username, $hash);
        $user->save();
        $_SESSION['user'] = $username;
        return true;
    }

    public function logout(): void {
        unset($_SESSION['user']);
    }
}
