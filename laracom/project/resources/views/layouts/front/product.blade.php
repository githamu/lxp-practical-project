<div class="row">
    <div class="col-md-6">
        @if (!empty($product->cover))
            <ul id="thumbnails" class="col-md-4 list-unstyled">
                <li>
                    <a href="javascript: void(0)">
                        <img class="img-responsive img-thumbnail" src="{{ $product->cover }}" alt="{{ $product->name }}" />
                    </a>
                </li>
                @if (isset($images) && !$images->isEmpty())
                    @foreach ($images as $image)
                        <li>
                            <a href="javascript: void(0)">
                                <img class="img-responsive img-thumbnail" src="{{ asset("storage/$image->src") }}"
                                    alt="{{ $product->name }}" />
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
            <figure class="text-center product-cover-wrap col-md-8">
                <img id="main-image" class="product-cover img-responsive" src="{{ $product->cover }}?w=400"
                    data-zoom="{{ $product->cover }}?w=1200">
            </figure>
        @else
            <figure>
                <img src="{{ asset('images/NoData.png') }}" alt="{{ $product->name }}"
                    class="img-bordered img-responsive">
            </figure>
        @endif
    </div>
    <div class="col-md-6">
        <div class="product-description">

            <h1>
                {{ $product->name }}
                <small><span class="product-price">{{ $product->price * 140 }}</span><span
                        class="product-symbol">{{ config('cart.currency_symbol') }}</span> +
                    送料980{{ config('cart.currency_symbol') }}</small>
            </h1>
            <h3>SKU: {{ $product->sku }}</h3>
            <div class="description">
                {!! $product->description !!}
            </div>

            <hr>
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.errors-and-messages')
                    <form action="{{ route('cart.store') }}" class="form-inline" method="post">
                        {{ csrf_field() }}
                        @if (isset($productAttributes) && !$productAttributes->isEmpty())
                            <div class="form-group">
                                <label for="productAttribute">Choose Combination</label> <br />
                                <select name="productAttribute" id="productAttribute" class="form-control select2">
                                    @foreach ($productAttributes as $productAttribute)
                                        <option value="{{ $productAttribute->id }}">
                                            @foreach ($productAttribute->attributesValues as $value)
                                                {{ $value->attribute->name }} : {{ ucwords($value->value) }}
                                            @endforeach
                                            @if (!is_null($productAttribute->sale_price))
                                                ({{ config('cart.currency_symbol') }}
                                                {{ $productAttribute->sale_price }})
                                            @elseif(!is_null($productAttribute->price))
                                                ( {{ config('cart.currency_symbol') }} {{ $productAttribute->price }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <hr>
                        @endif
                        <div class="form-group">
                            <label for="quantity">数量</label> <br />
                            <input type="text" class="form-control" name="quantity" id="quantity"
                                placeholder="Quantity" value="{{ old('quantity') }}" />
                            <input type="hidden" name="product" value="{{ $product->id }}" />
                            <button type="submit" class="btn btn-warning add-cart form-control"><i
                                    class="fa fa-cart-plus"></i> カートに追加</button>
                        </div>
                    </form>

                    <div class="evaluat">
                        <div id="evaluations">
                            @if (isset($evaluation))
                                @foreach ($evaluation as $evaluat)
                                    <div>
                                        <h1>{!! $evaluat->evaluationStar !!}</h1>
                                        <p class="reviews">{{ $evaluat->review }}</p>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        @if (auth()->check())
                            @if (session('success'))
                                <p>評価とコメントを登録しました</p>
                            @else
                                <form action="{{ route('evaluation.store') }}" class="form-inline" id="evaluation_submit"
                                    method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="product" value="{{ $product->id }}" />
                                    <div>
                                        <label for="evaluation_value">評価</label>
                                        <br>
                                        <input type="number" name="evaluation" id="evaluation_value" min="1"
                                            max="5" value="5">
                                    </div>
                                    <div id="review_request_text_div">
                                        <label for="review_text">レビュー</label>
                                        <br>
                                        <input type="text" name="review" id="review_text"
                                            placeholder="レビューを入力してください">
                                    </div>
                                    <div>
                                        <br>
                                        <button type="submit" class="btn btn-warning" id="review_button"
                                            disabled>登録</button>
                                    </div>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            var productPane = document.querySelector('.product-cover');
            var paneContainer = document.querySelector('.product-cover-wrap');

            const MIN_EVALUATION_VALUE = 1;
            const MAX_EVALUATION_VALUE = 5;

            const MIN_REVIEW_LENGTH = 1;
            const MAX_REVIEW_LENGTH = 100;

            new Drift(productPane, {
                paneContainer: paneContainer,
                inlinePane: false
            });

            $("#evaluation_value").on("input", valuatChangeEvent);
            $("#review_text").on("input", valuatChangeEvent);

            function valuatChangeEvent(e) {
                $("#review_button").prop("disabled", !(checkEvaluatValue() && checkReviewLength()));
            }

            function checkEvaluatValue() {
                const evaluatValue = $("#evaluation_value").val();
                return evaluatValue && evaluatValue >= MIN_EVALUATION_VALUE && evaluatValue <= MAX_EVALUATION_VALUE;
            }

            function checkReviewLength() {
                const review = $("#review_text").val();
                return review.length >= MIN_REVIEW_LENGTH && review.length <= MAX_REVIEW_LENGTH;
            }
        });
    </script>
@endsection
