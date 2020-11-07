<?php

namespace App\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class News extends Controller
{
    public function index()
    {
        return view('client.news');
    }
}