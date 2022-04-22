$(document).ready(function(){
    $( "" ).keyup(  );
  } );
  
  // Ajax でサーバに検索を要求し、検索結果を表示する
  function ajaxSearch( query ){
    $.ajax( {
      type: "GET",
      url: "searchproduct",
      data: query,
      dataType: "html",
      success: function( html ){
        $( "#resultDiv" ).html( html );
      }
    } );
  }
