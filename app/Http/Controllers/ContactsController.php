<?php

namespace App\Http\Controllers;

use App\Services\MailService;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index()
    {
        return view('contacts');
    }

    public function store(Request $request, MailService $service)
    {
        $attributes = $request->validate(
            [
                'name' => ['required', 'string', 'min:3'],
                'email' => ['required', 'email'],
                'age' => ['required', 'integer', 'between:18,100'],
                'message' => ['required', 'min:15']
            ]
        );

        $service->sendMail($attributes['email'], $attributes['name'], $attributes['age'], $attributes['message']);

        return redirect()->route('contacts.index')->with('success', 'Сообщение успешно отправлено!');
    }
}
