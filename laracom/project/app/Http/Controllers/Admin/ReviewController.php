<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shop\Products\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('customer')->get();
        return view('admin.reviews.list', ['reviews' => $reviews]);
    }
}