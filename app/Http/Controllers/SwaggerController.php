<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SwaggerController extends Controller
{
    public function index()
    {
        $documentation = 'default';

        return view('vendor.l5-swagger.index', compact('documentation'));
    }
}
