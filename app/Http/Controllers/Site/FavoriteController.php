<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {

          $favorites = auth()->user()->favorites;
        return view('site.favorite.index', compact('favorites'));
    }
}
