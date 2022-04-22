$(function() {
  //検索ボタンがクリックされたら処理が走る
  $('.searchform-group .btn btn-primary').on('click', function() {
    //HTMLから受け取るデータ
    var data = {request : $('#request').val()};

    $.ajax({
      type: "POST",
      url: "searchproduct",
      data: {
        serchword: seachword,
        company_id: company_id,
        minprice: minprice,
        maxprice: maxprice,
        minstock: minstock,
        maxstock: maxstock
      },
      dataType: 'json', //データをjson形式で飛ばす
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    }).done(function(data) {
      const productList = $('#product-list');
      console.log('通信成功');

    }).fail(function() {
      alert('error');
    });

    //submitによる画面リロードを防ぐ
    return false;
  });
});