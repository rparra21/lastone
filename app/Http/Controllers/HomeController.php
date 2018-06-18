<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Article;
use App\Models\Image as Imagen;
use App\Models\Category;
use App\Models\Article_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('articles');
    }

}
