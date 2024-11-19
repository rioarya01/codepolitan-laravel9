<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    function index() {
        echo "<h1>Hello, World!</h1>";
    }

    function world_message() {
        echo "<h1>World Message</h1>";
    }
}
