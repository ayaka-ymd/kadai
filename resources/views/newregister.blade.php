<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>商品新規登録</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        @extends('layouts.app')

        @section('content')
            <main>
                <div class="page-header mt-5 text-center">
                    <h2>商品新規登録</h2>
                </div>

                <div class="row mt-5 mb-5">
                    <div class="col-sm-5 mx-auto">
                        <form method="POST" action="{{ route('newregister') }}">
                            @csrf
                            <div class="form-group-sm clearfix">
                                <label for="formGroupExampleInput2" class="mt-3 mb-0">商品名</label>
                                <div class="product-info width-control">
                                    <input type="text" name="product_name" class="content-half-width form-control-sm d-inline">
                                </div>
                            </div>

                            <div class="form-group-sm clearfix">
                                <label for="formGroupExampleInput2" class="mt-3 mb-0">メーカー</label>
                                <div class="product-info width-control">
                                    <select class="content-half-width form-control-sm d-inline" id="changeSelect" name="company_id" onchange="entryChange2();">
                                        <option value="">未選択</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group-sm clearfix">
                                <label for="formGroupExampleInput2" class="mt-3 mb-0">価格</label>
                                <div class="product-info width-control">
                                    <input type="text" name="price" class="content-half-width form-control-sm d-inline">
                                </div>
                            </div>

                            <div class="form-group-sm clearfix">
                                <label for="formGroupExampleInput2" class="mt-3 mb-0">在庫数</label>
                                <div class="product-info width-control">
                                    <input type="text" name="stock" class="content-half-width form-control-sm d-inline">
                                </div>
                            </div>

                            <div class="form-group-sm clearfix">
                                <label for="formGroupExampleInput2" class="mt-3 mb-0">商品説明</label>
                                <div class="product-info width-control">
                                    <textarea name="description" class="content-width form-control-sm"></textarea>
                                </div>
                            </div>

                            <div class="form-group-sm clearfix">
                                <form action="#" method="post" enctype="multipart/form-data">
                                    <p>商品画像
                                        <input type="file" name="filename">
                                    </p>
                                </form>
                            </div>

                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary w-50">登録</button>
                            </div>
                            <div class="text-center mt-5">
                                <a href="http://localhost:8888/kadai/public/searchproduct" class="btn btn-primary btn-sm">戻る</a>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        @endsection
    </body>
</html>
