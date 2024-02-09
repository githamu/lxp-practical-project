<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Shop\Products\Requests\ReviewRequest;
use App\Shop\Products\Review;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  ReviewRequest $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function store(ReviewRequest $request)
    {
        $productId = $request->input('product');
        $customerId = auth()->user()->getAuthIdentifier();
        $evaluation = $request->input('evaluation');
        $review = $request->input('review');
        $data = [
            'product_id' => $productId,
            'customer_id' => $customerId,
            'evaluation' => $evaluation,
            'review' => $review
        ];
        Review::create($data);

        session()->flash('success', '評価とコメントを登録しました');
        return back();
    }
}