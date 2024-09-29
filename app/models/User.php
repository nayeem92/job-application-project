<?php

class User {
    private $usersFile = '../data/users.json';

    // Register a new user
    public function register($username, $email, $password) {
        $users = $this->getUsers();
        
        // Check if user already exists
        foreach ($users as $user) {
            if ($user['username'] === $username) {
                return false; // User exists
            }
        }

        // Hash the password and add the new user
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $users[] = ['username' => $username, 'email' => $email, 'password' => $hashedPassword];

        // Save users back to JSON file
        file_put_contents($this->usersFile, json_encode($users));
        return true;
    }

    // Login the user
    public function login($username, $password) {
        $users = $this->getUsers();

        foreach ($users as $user) {
            if ($user['username'] === $username && password_verify($password, $user['password'])) {
                return true;
            }
        }
        return false;
    }

    // Get users from JSON file
    private function getUsers() {
        if (!file_exists($this->usersFile)) {
            return [];
        }
        return json_decode(file_get_contents($this->usersFile), true);
    }
}
