<?php
namespace App\Controllers;

use App\Http\Request;

class AboutController
{
    public function index(Request $request): string
    {
        return view('about', [
            'title' => 'О проекте',
            'description' => 'Минималистичный PHP-фреймворк без магии и зависимостей.',
            'features' => ['Роутер', 'Request/Response', 'Шаблонизатор', 'Автозагрузка']
        ]);
    }
}