<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;

class PageController extends BaseController
{
    public function about(Request $request): Response
    {
        return $this->render('public.about', [
            'title' => 'About Us — Rush Parcel Architecture',
            'active_page' => 'about',
        ]);
    }

    public function partners(Request $request): Response
    {
        return $this->render('public.partners', [
            'title' => 'Business Partners & Corporate Accounts — UK Delivery',
            'active_page' => 'partners',
        ]);
    }

    public function dropOff(Request $request): Response
    {
        return $this->render('public.drop_off', [
            'title' => 'Parcel Drop-off Locations — UK Delivery',
            'active_page' => 'drop-off',
        ]);
    }

    public function faq(Request $request): Response
    {
        return $this->render('public.faq', [
            'title' => 'Frequently Asked Questions & Support — UK Delivery',
            'active_page' => 'faq',
        ]);
    }

    public function terms(Request $request): Response
    {
        return $this->render('public.legal', [
            'title' => 'Terms & Conditions — Rush Parcel',
            'document_title' => 'Terms & Conditions of Carriage',
            'active_page' => 'terms',
            'content_type' => 'terms',
        ]);
    }

    public function privacy(Request $request): Response
    {
        return $this->render('public.legal', [
            'title' => 'Privacy Policy & UK GDPR — Rush Parcel',
            'document_title' => 'Privacy Policy & UK Data Protection Act 2018 Notice',
            'active_page' => 'privacy',
            'content_type' => 'privacy',
        ]);
    }

    public function cookies(Request $request): Response
    {
        return $this->render('public.legal', [
            'title' => 'Cookie Policy — Rush Parcel',
            'document_title' => 'Cookie & Local Storage Policy',
            'active_page' => 'cookies',
            'content_type' => 'cookies',
        ]);
    }

    public function deliveryPolicy(Request $request): Response
    {
        return $this->render('public.legal', [
            'title' => 'Delivery & Claims Policy — Rush Parcel',
            'document_title' => 'Delivery Service Terms, Failed Delivery & Claims Policy',
            'active_page' => 'delivery-policy',
            'content_type' => 'delivery_policy',
        ]);
    }

    public function prohibitedItems(Request $request): Response
    {
        return $this->render('public.legal', [
            'title' => 'Prohibited & Restricted Items — Rush Parcel',
            'document_title' => 'Prohibited & Dangerous Goods Carrier List',
            'active_page' => 'prohibited-items',
            'content_type' => 'prohibited_items',
        ]);
    }

    public function vatInfo(Request $request): Response
    {
        return $this->render('public.legal', [
            'title' => 'VAT & Invoice Information — Rush Parcel',
            'document_title' => 'UK Value Added Tax (VAT) & Invoice Billing Guide',
            'active_page' => 'vat-info',
            'content_type' => 'vat_info',
        ]);
    }
}
