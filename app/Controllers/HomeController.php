<?php
namespace App\Controllers;

use App\Http\Request;

class HomeController
{
    public function index(Request $request): string {
        return view('home', ['title' => 'Главная', 'time' => date('Y-m-d H:i:s')]);
    }
}