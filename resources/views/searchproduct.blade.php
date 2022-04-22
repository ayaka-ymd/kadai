<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    @extends('layouts.common')
      <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>商品情報一覧画面</title>
    </head>
    <body>
        @extends('layouts.app')

        @section('content')
        <main>
          <div class="container">
            <div class="searchform">
              <br>
              <h2 class="text-center">商品情報一覧画面</h2>
              <br>
              <?php //検索フォーム ?>
              <div class="row">
                <div class="searchform col-sm">
                  <form method="GET" action="{{ route('searchproduct') }}">
                    <div class="searchform-group row">
                      <label class="col-sm-2 col-form-label" value="product">商品名</label>
                      <?php //入力 ?>
                      <div class="col-sm-5">
                        <input type="text" id="serch-text" name="searchWord" value="{{ $searchWord }}">
                      </div>
                    </div>
                    <div class="searchform-group row">
                      <label class="col-sm-2 col-form-label" value="price">価格</label>
                      <div class="col-sm-10">
                        <input type="number" min="0" name="minprice" value="{{ $minprice }}" placeholder="以上" >～
                        <input type="number" name="maxprice" value="{{ $maxprice }}" placeholder="以下">
                      </div>
                    </div>
                    <div class="searchform-group row">
                      <label class="col-sm-2 col-form-label" value="stock">在庫数</label>
                      <div class="col-sm-10">
                        <input type="number" min="0" name="minstock" value="{{ $minstock }}" placeholder="以上">～
                        <input type="number" name="maxstock" value="{{ $maxstock }}" placeholder="以下">
                      </div>
                    </div>
                    <?php //プルダウンメーカー選択 ?>
                    <div class="searchform-group row">
                      <label class="col-sm-2">商品メーカー</label>
                      <div class="col-sm-3">
                          <select name="company_id" class="form-control" value="{{ $company_id }}">
                            <option value="">未選択</option>

                            @foreach($companies as $id => $company)
                            <option value="{{ $id }}">
                              {{ $company->company_name }}
                            </option>
                            @endforeach
                          </select>
                      </div>
                      <div class="col-sm-auto">
                        <button type="submit" class="btn btn-primary">検索</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <?php //検索結果テーブル 検索された時のみ表示する ?>
            @if (!empty($products))
            <div class="search-result">
              <div class="search-result__hit-num"></div>
              <div id="search-result__list"></div>
              <p>全{{ $products->count() }}件</p>
              <table class="table table-hover">
                  <thead style="background-color: #ffd900">
                    <tr>
                    <th scope="col">@sortablelink('id', 'id')</th>
                    <th scope="col">@sortablelink('img_path', '商品画像')</th>
                    <th scope="col">@sortablelink('product_name', '商品名')</th>
                    <th scope="col">@sortablelink('price', '価格')</th>
                    <th scope="col">@sortablelink('stock', '在庫数')</th>
                    <th scope="col">@sortablelink('company_name', 'メーカー名')</th>
                    <th>詳細表示</th>
                    <th>削除</th>
                    </tr> 
                  </thead>
                  @foreach($products as $product)
                  <tr class="target-area">
                    <td>{{ $product->id }}</td>
                    <td>
                      <img src="{{ $product->img_path }}" width="70" height="100">
                    </td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->price }}円</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $company->company_name }}</td>
                    <td><a href="{{ route('detail', ['id'=>$product->id]) }}" class="btn btn-primary">詳細</a></td>
                    <td>
                      <form action="{{ route('destroy', ['id'=>$product->id]) }}" method='post' onsubmit="return confirm_test()">
                        <input type="submit" class="btn btn-danger btn-dell" value="削除" onClick="delete_alert(event);return false;">
                      </form>
                      <script src="{{ asset('/js/delete.js') }}"></script>
                      <script src="{{ asset('/js/common.js') }}"></script>
                    </td>
                  </tr>
                  @endforeach
              </table>
            </div>
            @endif
          </div>
          <a href="http://localhost:8888/kadai/public/newregister" class="btn btn-primary btn-sm">商品新規登録</a>
        </main>
        @endsection
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    </body>
</html>
