<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shop\Reviews\Repositories\ReviewRepositoryInterface;

class ReviewController extends Controller
{
    protected $review;

    public function __construct(ReviewRepositoryInterface $review)
    {
        $this->review = $review;
    }

    public function index()
    {
        $reviews = $this->review->getAll();
        return view('admin.reviews.list', ['reviews' => $reviews]);
    }
}