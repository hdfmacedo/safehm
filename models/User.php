<?php
class User {
    private string $username;
    private string $passwordHash;
    private const DATA_DIR = __DIR__ . '/../data/users';

    public function __construct(string $username, string $passwordHash) {
        $this->username = $username;
        $this->passwordHash = $passwordHash;
    }

    public static function load(string $username): ?self {
        $file = self::DATA_DIR . "/{$username}.json";
        if (!file_exists($file)) {
            return null;
        }
        $data = json_decode(file_get_contents($file), true);
        return new self($username, $data['password']);
    }

    public function save(): void {
        if (!is_dir(self::DATA_DIR)) {
            mkdir(self::DATA_DIR, 0777, true);
        }
        $file = self::DATA_DIR . "/{$this->username}.json";
        $data = ['username' => $this->username, 'password' => $this->passwordHash];
        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function verifyPassword(string $password): bool {
        return password_verify($password, $this->passwordHash);
    }
}
