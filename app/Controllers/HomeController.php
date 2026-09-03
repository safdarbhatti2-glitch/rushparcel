<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;

class HomeController extends BaseController
{
    public function index(Request $request): Response
    {
        return $this->render('public.home', [
            'title' => 'Rush Parcel — Premium Nationwide Courier & Parcel Delivery',
            'active_page' => 'home',
        ]);
    }
}
