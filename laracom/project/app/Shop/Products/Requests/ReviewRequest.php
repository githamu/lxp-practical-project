<?php

namespace App\Shop\Products\Requests;

use App\Shop\Base\BaseFormRequest;

class ReviewRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product' => ['required', 'integer'],
            'evaluation' => ['required', 'integer', 'between:1,5'],
            'review' => ['required', 'string', 'max:100']
        ];
    }
}