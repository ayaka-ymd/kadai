<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    @extends('layouts.common')
        <title>商品情報詳細</title>
    </head>
    <body>
        @extends('layouts.app')

        @section('content')
            <main>
                <div class="page-header mt-5 text-center">
                    <h2>商品情報詳細</h2>
                </div>

                <table class="table table-striped">
                    <thead>
                       <tr>
                            <th>商品情報ID</th>
                            <th>商品画像</th>
                            <th>商品名</th>
                            <th>価格</th>
                            <th>在庫数</th>
                            <th>メーカー名</th>
                            <th>コメント</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td><img src="{{ $product->img_path }}" width="70" height="100"></td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->company_id }}</td>
                            <td>{{ $product->comment }}</td>
                       </tr>
                    </tbody>
                </table>
                <div class="text-center mt-5">
                <button type="submit" class="btn btn-primary btn-sm">編集</button>
                </div>
                <div class="text-center mt-5">
                    <a href="http://localhost:8888/kadai/public/searchproduct" class="btn btn-primary btn-sm">戻る</a>
                </div>
            </main>
        @endsection
    </body>
</html>
