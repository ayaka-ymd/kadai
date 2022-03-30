<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    @extends('layouts.common')
        <title>商品情報編集</title>
    </head>
    <body>
        @extends('layouts.app')

        @section('content')
            <main>
                <div class="page-header mt-5 text-center">
                    <h2>商品情報編集</h2>
                </div>

                <div class="row mt-5 mb-5">
                    <div class="col-sm-5 mx-auto">
                        <form method="POST" action="">
                            @csrf
                            @method('PUT')

                            <fieldset class="mb-4">
                                <div class="form-group-sm clearfix">
                                    <label for="formGroupExampleInput2" class="mt-3 mb-0">商品名</label>
                                    <div class="product-info width-control">
                                        <input type="text" name="product_name" value="{{ $product->product_name }}" class="content-half-width form-control-sm d-inline">
                                    </div>
                                </div>

                                <div class="form-group-sm clearfix">
                                    <label for="formGroupExampleInput2" class="mt-3 mb-0">メーカー</label>
                                    <div class="product-info width-control">
                                        <select class="content-half-width form-control-sm d-inline" id="changeSelect" name="company_id" onchange="entryChange2();">
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group-sm clearfix">
                                    <label for="formGroupExampleInput2" class="mt-3 mb-0">価格</label>
                                    <div class="product-info width-control">
                                        <input type="text" name="price" value="{{ $product->price }}" class="content-half-width form-control-sm d-inline">
                                    </div>
                                </div>

                                <div class="form-group-sm clearfix">
                                    <label for="formGroupExampleInput2" class="mt-3 mb-0">在庫数</label>
                                    <div class="product-info width-control">
                                        <input type="text" name="stock" value="{{ $product->stock }}" class="content-half-width form-control-sm d-inline">
                                    </div>
                                </div>

                                <div class="form-group-sm clearfix">
                                    <label for="formGroupExampleInput2" class="mt-3 mb-0">商品説明</label>
                                    <div class="product-info width-control">
                                        <textarea name="comment" class="content-width form-control-sm">{{ $product->comment }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group-sm clearfix">
                                    <form action="#" method="post" enctype="multipart/form-data">
                                        <p>商品画像
                                            <img src="{{ $product->img_path }}" width="70" height="100">
                                            <input type="file" name="filename">
                                        </p>
                                    </form>
                                </div>

                                <div class="text-center mt-5">
                                    <button type="submit" class="btn btn-primary w-50">更新</button>
                                </div>
                                <div class="text-center mt-5">
                                    <a href="http://localhost:8888/kadai/public/searchproduct" class="btn btn-primary btn-sm">戻る</a>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </main>
        @endsection
    </body>
</html>
