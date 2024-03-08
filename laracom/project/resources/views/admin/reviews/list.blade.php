@extends('layouts.admin.app')
@section('content')
    <section class="content">
    @include('layouts.errors-and-messages')
        @if($reviews)
            <div class="box">
                <div class="box-body">
                    <h2>レビュー</h2>
                    @include('layouts.search', ['route' => route('admin.orders.index')])
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="col-md-3">日時</td>
                                <td class="col-md-3">商品ID</td>
                                <td class="col-md-2">ユーザー(ID)</td>
                                <td class="col-md-2">評価</td>
                                <td class="col-md-2">レビュー</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($reviews as $review)
                        <tr>
                                <td>{{$review->created_at->format('Y年m月d日')}}</td>
                                <td><a title="Show customer" href="{{ route('admin.products.show', $review->product_id) }}">{{ $review->product_id }}</a></td>
                                <td>{{ $review->customer->name }}(<a title="Show customer" href="{{ route('admin.customers.show', $review->customer_id) }}">{{ $review->customer_id }}</a>)</td>
                                <td>{{ $review->evaluation }}</td>
                                <td><p class="text-center">{{ $review->review }}</p></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </section>
@endsection