<?php
namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;  // ← не забудьте импортировать класс

class UserController
{
    // Было:
    // public function show(Request $request): string
    
    // Стало:
    public function show(Request $request): Response
    {
        $id = $request->param(0);
        
        if (!$id || !is_numeric($id)) {
            return Response::html('Пользователь не найден', 404);
        }
        
        return Response::html(view('user/show', ['id' => (int) $id]));
    }
}