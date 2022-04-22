$('.searchform-group .btn btn-primary').on('click', function () {
    $('.products-table tbody').empty(); //もともとある要素を空にする
    $('.search-null').remove(); //検索結果が0のときのテキストを消す

    let product_name = $('#searchWord').val(); //検索ワードを取得

    if (!product_name) {
        return false;
    } //ガード節で検索ワードが空の時、ここで処理を止めて何もビューに出さない

    $.ajax({
        type: 'GET',
        url: 'searchproduct' + product_name, //web.phpのURLと同じ形にする
        data: {
            'searchproduct': product_name, //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
        },
        dataType: 'json', //json形式で受け取る

        beforeSend: function () {
            $('.loading').removeClass('display-none');
        } //通信中の処理をここで記載。今回はぐるぐるさせるためにcssでスタイルを消す。
    }).done(function (data) {
        $('.loading').addClass('display-none'); //通信中のぐるぐるを消す
        let html = '';
        $.each(data, function (_searchproduct, value) { //dataの中身からvalueを取り出す
        //ここの記述はリファクタ可能
        let id = value.id;
        let img_path = value.img_path;
        let product_name = value.product_name;
        let price = value.price;
        let stock = value.stock;
        let company_name = value.company_name;
        // 情報のビューテンプレートを作成 //${}で変数展開
        html = `
                <tr class="target-area"> 
                    <td class="col-xs-2"><img src="${img_path}" class="rounded-circle img_path"></td> 
                    <td class="col-xs-2">${product_name}</td>
                    <td class="col-xs-2">${price}</td>
                    <td class="col-xs-2">${stock}</td>
                    <td class="col-xs-2">${company_name}</td>
                    <td class="col-xs-5"><a class="btn btn-primary" href="/detail/${id}">詳細</a></td>
                </tr>
                `
        })
        $('.target-area').append(html); //できあがったテンプレートをビューに追加
    // 検索結果がなかったときの処理
        if (data.length === 0) {
            $('.target-area').after('<p class="text-center mt-5 search-null">商品が見つかりません</p>');
        }

    }).fail(function (){
        //ajax通信がエラーのときの処理
        console.log('ajax通信がエラーです');
    })
});