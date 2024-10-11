<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return redirect('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
    }
}
