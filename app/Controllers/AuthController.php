<?php

namespace App\Controllers;

use App\Core\Database;
use App\Core\Request;
use App\Core\Response;
use App\Core\Session;

class AuthController extends BaseController
{
    public function login(Request $request): Response
    {
        if (Session::has('user_id')) {
            return Response::redirect(Session::get('user_role') === 'admin' ? '/admin' : '/dashboard');
        }

        return $this->render('public.login', [
            'title' => 'Account Login — Rush Parcel',
            'active_page' => 'login',
        ]);
    }

    public function authenticate(Request $request): Response
    {
        if (!$this->validateCsrf($request)) {
            Session::flash('error', 'Security token expired. Please refresh the page and try again.');
            return Response::redirect('/login');
        }

        $email = trim(strtolower($request->input('email', '')));
        $password = trim($request->input('password', ''));

        if (empty($email) || empty($password)) {
            Session::flash('error', 'Please enter your email address and password.');
            return Response::redirect('/login');
        }

        $user = Database::fetch(
            "SELECT u.*, r.name as role_name
             FROM users u
             JOIN roles r ON u.role_id = r.id
             WHERE u.email = :email AND u.status = 'active' LIMIT 1",
            [':email' => $email]
        );

        if (!$user || !password_verify($password, $user['password_hash'])) {
            Session::flash('error', 'Invalid email address or password.');
            return Response::redirect('/login');
        }

        // Regenerate Session ID securely
        Session::regenerate(true);
        Session::set('user_id', (int)$user['id']);
        Session::set('customer_id', $user['customer_id'] ? (int)$user['customer_id'] : null);
        Session::set('user_name', $user['name']);
        Session::set('user_email', $user['email']);
        Session::set('user_role', $user['role_name']);
        Session::set('user', $user);

        // Update last login timestamp
        Database::query("UPDATE users SET last_login_at = CURRENT_TIMESTAMP WHERE id = :id", [':id' => $user['id']]);

        Session::flash('success', "Welcome back, {$user['name']}!");

        if (in_array($user['role_name'], ['admin', 'super_admin', 'operations', 'dispatcher'])) {
            return Response::redirect('/admin');
        }

        return Response::redirect('/dashboard');
    }

    public function register(Request $request): Response
    {
        if (Session::has('user_id')) {
            return Response::redirect('/dashboard');
        }

        return $this->render('public.register', [
            'title' => 'Register Account — Rush Parcel',
            'active_page' => 'register',
        ]);
    }

    public function storeUser(Request $request): Response
    {
        if (!$this->validateCsrf($request)) {
            return Response::redirect('/register');
        }

        $name = trim($request->input('name', ''));
        $email = trim(strtolower($request->input('email', '')));
        $phone = trim($request->input('phone', ''));
        $password = $request->input('password', '');
        $type = trim($request->input('type', 'individual'));
        $companyName = trim($request->input('company_name', ''));

        if (empty($name) || empty($email) || empty($password)) {
            Session::flash('error', 'Please fill in all required fields.');
            return Response::redirect('/register');
        }

        if (strlen($password) < 8) {
            Session::flash('error', 'Password must be at least 8 characters long.');
            return Response::redirect('/register');
        }

        $existing = Database::fetch("SELECT id FROM users WHERE email = :email LIMIT 1", [':email' => $email]);
        if ($existing) {
            Session::flash('error', 'An account with this email address already exists. Please login.');
            return Response::redirect('/register');
        }

        // Determine Role
        $roleName = ($type === 'business') ? 'business_customer' : 'customer';
        $role = Database::fetch("SELECT id FROM roles WHERE name = :name LIMIT 1", [':name' => $roleName]);
        $roleId = $role ? (int)$role['id'] : 9; // Fallback to customer

        // Create Customer record
        $legalName = ($type === 'business' && !empty($companyName)) ? $companyName : $name;
        Database::query(
            "INSERT INTO customers (type, legal_name, email, phone, status) VALUES (:type, :name, :email, :phone, 'active')",
            [':type' => $type, ':name' => $legalName, ':email' => $email, ':phone' => $phone]
        );
        $customerId = (int)Database::lastInsertId();

        // Create User record
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        Database::query(
            "INSERT INTO users (role_id, customer_id, name, email, phone, password_hash, status)
             VALUES (:role_id, :customer_id, :name, :email, :phone, :hash, 'active')",
            [
                ':role_id' => $roleId,
                ':customer_id' => $customerId,
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':hash' => $passwordHash,
            ]
        );

        Session::flash('success', 'Account registered successfully! Please login with your credentials.');
        return Response::redirect('/login');
    }

    public function logout(Request $request): Response
    {
        Session::destroy();
        Session::start();
        Session::flash('success', 'You have been logged out successfully.');
        return Response::redirect('/login');
    }
}
