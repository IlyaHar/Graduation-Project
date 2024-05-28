<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'link' => ['required', 'url'],
                'title' => ['required', 'unique:links'],
                'author_id' => ''
            ]
        );

        $data['author_id'] = Auth::id();

        Link::create($data);

        return redirect()->route('home');
    }

    public function destroy(Link $link)
    {
        $link->delete();

        return redirect()->route('home');
    }
}
