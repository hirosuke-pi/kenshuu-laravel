<?php

namespace App\Http\Controllers;

use App\Domains\Contracts\Repositories\NewsRepository;
use App\View\Components\Pages\Home;

use Illuminate\Http\Request;


class HomeController extends Controller
{
    public static function index()
    {
        return (new Home())->render();
    }
}
