<?php

namespace App\Shop\Reviews\Repositories;

use App\Shop\Products\Review;

class ReviewRepository implements ReviewRepositoryInterface
{
    public function getAll()
    {
        return Review::with('customer')->get();
    }
}