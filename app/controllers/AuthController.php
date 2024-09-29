<?php

require_once '../app/models/User.php';

class AuthController {

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = htmlspecialchars($_POST['username']);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            if (!preg_match("/^[a-zA-Z0-9_]{3,20}$/", $username)) {
                echo "Username must be 3-20 characters long and can only contain letters, numbers, and underscores.";
                return;
            }

            if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
                echo "Invalid email address!";
                return;
            }

            if (strlen($password) < 6) {
                echo "Password must be at least 6 characters long!";
                return;
            }

            $userModel = new User();
            if ($userModel->register($username, $email, $password)) {
                header("Location: index.php?action=login");
                exit;
            } else {
                echo "User already exists!";
            }
        }
        require '../app/views/register.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = htmlspecialchars($_POST['username']);
            $password = $_POST['password'];

            if (!preg_match("/^[a-zA-Z0-9_]{3,20}$/", $username)) {
                echo "Invalid username format!";
                return;
            }

            $userModel = new User();
            if ($userModel->login($username, $password)) {
                session_start();
                $_SESSION['username'] = $username;

                if (isset($_POST['remember'])) {
                    setcookie('username', $username, time() + (86400 * 7), "/");
                }

                header("Location: index.php?action=step1");
                exit;
            } else {
                echo "Invalid username or password!";
            }
        }

        $usernameCookie = isset($_COOKIE['username']) ? htmlspecialchars($_COOKIE['username']) : '';
        require '../app/views/login.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        if (isset($_COOKIE['username'])) {
            setcookie('username', '', time() - 3600, "/");
        }
        header("Location: index.php?action=login");
        exit;
    }

    public function step1() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_SESSION['full_name'] = htmlspecialchars($_POST['full_name']);
            $_SESSION['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            
            $phone = htmlspecialchars($_POST['phone']);
            if (!preg_match("/^\d{10}$/", $phone)) {
                $_SESSION['error_message'] = "Phone number must be 10 digits!";
                require '../app/views/step1.php';
                return;
            }
            
            $_SESSION['phone'] = $phone;
            header("Location: index.php?action=step2");
            exit;
        }
        require '../app/views/step1.php';
    }

    public function step2() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_SESSION['degree'] = htmlspecialchars($_POST['degree']);
            $_SESSION['field_of_study'] = htmlspecialchars($_POST['field_of_study']);
            $_SESSION['institution'] = htmlspecialchars($_POST['institution']);
            $_SESSION['graduation_year'] = htmlspecialchars($_POST['graduation_year']);
            header("Location: index.php?action=step3");
            exit;
        }
        require '../app/views/step2.php';
    }

    public function step3() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_SESSION['job_title'] = htmlspecialchars($_POST['job_title']);
            $_SESSION['company_name'] = htmlspecialchars($_POST['company_name']);
            $_SESSION['years_of_experience'] = htmlspecialchars($_POST['years_of_experience']);
            $_SESSION['key_responsibilities'] = htmlspecialchars($_POST['key_responsibilities']);
            header("Location: index.php?action=review");
            exit;
        }
        require '../app/views/step3.php';
    }

    public function review() {
        session_start();
        if (!isset($_SESSION['username'])) {
            header("Location: index.php?action=login");
            exit;
        }
        require '../app/views/review.php';
    }

    public function submit() {
        session_start();
        if (!isset($_SESSION['username'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $applicationsFile = '../data/applications.json';
        $applications = [];

        $applicationData = [
            'full_name' => $_SESSION['full_name'],
            'email' => $_SESSION['email'],
            'phone' => $_SESSION['phone'],
            'degree' => $_SESSION['degree'],
            'field_of_study' => $_SESSION['field_of_study'],
            'institution' => $_SESSION['institution'],
            'graduation_year' => $_SESSION['graduation_year'],
            'job_title' => $_SESSION['job_title'],
            'company_name' => $_SESSION['company_name'],
            'years_of_experience' => $_SESSION['years_of_experience'],
            'key_responsibilities' => $_SESSION['key_responsibilities'],
        ];

        if (file_exists($applicationsFile)) {
            $applications = json_decode(file_get_contents($applicationsFile), true);
        }

        $applications[] = $applicationData;
        file_put_contents($applicationsFile, json_encode($applications));

        $_SESSION['success_message'] = "Application submitted successfully! An email has been sent to {$_SESSION['email']}.";
        header("Location: index.php?action=review");
        exit;
    }
}
