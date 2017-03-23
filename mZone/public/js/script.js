

$('button#search_btn').on('click', function(){
    var search = $('input#search_input').val();
    if($.trim(search) != "") {
//        alert(search);
        $.post('/product/search', {name: search}, function(data){
     var parseData=JSON.parse(data);
           var htmlStr = "\\n\
              <div class='col-sm-4 col-md-4'>\
                   <div class='thumbnail'>\
                      <img src=" + parseData[0].image + " class='img-circle'>\
                       <div class='caption'>\
                           <h3>" + parseData[0].name + "</h3>\
                           <p><center><a href='#' class='btn btn-primary'\\n\
                            role='button'>View Category Products</a></center></p>\
                       </div>\
                   </div>\
               </div>"
           $('div#searchResult').html(htmlStr);
            
 
            
            
            

        });
    }

});
