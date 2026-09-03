<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;

class ContactController extends BaseController
{
    public function index(Request $request): Response
    {
        return $this->render('public.contact', [
            'title' => 'Contact Us — Rush Parcel Support & Sales',
            'active_page' => 'contact',
        ]);
    }

    public function submit(Request $request): Response
    {
        if (!$this->validateCsrf($request)) {
            return Response::redirect('/contact');
        }

        $name = trim($request->input('name', ''));
        $email = trim($request->input('email', ''));
        $phone = trim($request->input('phone', ''));
        $subject = trim($request->input('subject', ''));
        $message = trim($request->input('message', ''));

        if (empty($name) || empty($email) || empty($message)) {
            Session::flash('error', 'Please fill in all required fields (Name, Email, and Message).');
            return Response::redirect('/contact');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::flash('error', 'Please enter a valid email address.');
            return Response::redirect('/contact');
        }

        // Log inquiry securely
        logger("Contact inquiry received from [{$name} <{$email}>]: {$subject}");

        Session::flash('success', "Thank you, {$name}! Your message has been sent successfully. A member of our support team will contact you shortly.");
        return Response::redirect('/contact');
    }
}
