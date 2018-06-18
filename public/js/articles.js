function print(){
    console.log("log");
}


$('#formAdd').bootstrapValidator({
 
    fields: {
    url: {
          validators: {
                notEmpty: {
                      message: 'The url address is required and cannot be empty'
                },
                uri: {
                      message: 'The url address is not valid'
                }
          }
    },
    title: {
          validators: {
                notEmpty: {
                      message: 'The title is required and cannot be empty'
                }
          }
    },
    snippet: {
          validators: {
                notEmpty: {
                      message: 'The snippet is required and cannot be empty'
                }
          }
    },
    image: {
          validators: {
                notEmpty: {
                      message: 'The image is required and cannot be empty'
                }
          }
    }
             
}
})

$('#formUpdate').bootstrapValidator({

fields: {
url_update: {
validators: {
     notEmpty: {
           message: 'The url address is required and cannot be empty'
     },
     uri: {
           message: 'The url address is not valid'
     }
}
},
title_update: {
validators: {
     notEmpty: {
           message: 'The title is required and cannot be empty'
     }
}
},
snippet_update: {
validators: {
     notEmpty: {
           message: 'The snippet is required and cannot be empty'
     }
}
}
  
}
})

/******* ACTIONS MODAL CLOSE *********/
$("#modalUpdate").on('hidden.bs.modal', function () {
var tags = $('#categories_update').tagEditor('getTags')[0].tags;
for (i = 0; i < tags.length; i++) { $('#categories_update').tagEditor('removeTag', tags[i]); }
    $('#categories_update').tagEditor('destroy');
    console.log("Esta accion se ejecuta al cerrar el modal");
    $('#formUpdate')[0].reset();
});        

$("#modalAdd").on('hidden.bs.modal', function () {
var tags = $('#categories').tagEditor('getTags')[0].tags;
for (i = 0; i < tags.length; i++) { $('#categories').tagEditor('removeTag', tags[i]); }
    $('#categories').tagEditor('destroy');

$("#errorCategories").hide();
    //console.log("Esta accion se ejecuta al cerrar el modal");
});
/******* ACTIONS MODAL CLOSE *********/

/******* CREATE TAGS INPUT *********/
function tagsInputCreate(){
 getAll();
$('#categories').tagEditor({      

autocomplete: { 
delay: 0, // show suggestions immediately
position: { collision: 'flip' }, // automatic menu position up/down
source: resultado
}   
});   
}

function tagsInputUpdate(){
  getAll();
$('#categories_update').tagEditor({      

autocomplete: { 
delay: 0, // show suggestions immediately
position: { collision: 'flip' }, // automatic menu position up/down
source: resultado
}   
});
}
/******* CREATE TAGS INPUT *********/

//this method is called in document ready(now is not called, if is needed, just call and pass parameter)
function generateLogs(user_id, action, datos){

resulting = [];
          $.ajax({
                      headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),                                             
                                  },
                      dataType: 'json',
                      type:'POST',
                      url: "generateLogs",
                      data: {"user_id":user_id, "action":action, "datos":datos},  
                
                      success: function(data){
                            console.log(data);
                            for(var a in data){               
                      resulting.push(data[a]);                                              
                }     
                            console.log("success");
                            },
                      error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                                  console.log("error");                  
                                  console.log(JSON.stringify(jqXHR));
                                  console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                            }
                });  


}
/************* DISABLED *************/
function editModal(position, url ,title, snippet, pinnedcheck, pinned_id, startdate, expiredate, image_id, image_name, category){
var categories = "";
var numComas = 0;
$("#url_update").val(url);
$("#title_update").val(title);
$("#snippet_update").val(snippet);
$("#title_update").val(title);
$("#pinned_update").prop("checked", pinnedcheck);
$("#update_id").val(pinned_id);
$("#update_image_id").val(image_id);
$("#update_image_name").val(image_name);

//console.log(category);
tagsInputUpdate();
$('#categories_update').tagEditor('addTag', category);

$('#modalUpdate').modal('show');      

}
/************* DISABLED *************/

//Update article
$("#divpinneds").on("click", ".editPinned", function() {         
//console.log($(".rowpinneds:nth-child($(this).attr('value')) #pinnedtitle").text());
divPreviousEdit = $(this).parent().parent().parent().prev();     

// 


idRemove = $(this).parent().parent().parent().data('id');            
divRemove = "rowpinneds";

id_article_update = $(this).parent().parent().parent().data('id');
id_image_update = $(this).parent().parent().parent().data('image');
image_name_update = $(this).parent().parent().parent().data('imagename'); 
var categories = $(this).parent().parent().parent().data('categories');

var date = $(this).parent().parent().parent().data('pos');
var timestamp = new Date(date).getTime();


console.log(id_article_update);
                
          $.ajax({
                      headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),                                             
                                  },
                      dataType: 'json',
                      type:'GET',
                      url: "article/"+id_article_update,
                
                      success: function(data){
                                  console.log(data);
                                  console.log(data.url)
                                  $("#url_update").val(data.url);
                                  $("#title_update").val(data.title);
                                  $("#snippet_update").val(data.snippet);
                                  $("#pinned_update").prop("checked", 1);
                                  $("#startdate_update").val(data.start_date);
                                  $("#expiredate_update").val(data.expire_date);
                                  $("#previewImage").show();
                                  $("#previewImage").css('background-image', 'url(/getImage/'+id_article_update+'/'+timestamp+')');
                                  tagsInputUpdate();
                                  $('#categories_update').tagEditor('addTag', categories);
                                  $('#modalUpdate').modal('show');
                            },
                      error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                                  console.log("error");                  
                                  console.log(JSON.stringify(jqXHR));
                                  console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                            }
                });  

  

});

//Update article
$("#divavailables").on("click", ".editAvailable", function() {        
//console.log($(".rowpinneds:nth-child($(this).attr('value')) #pinnedtitle").text());

idRemove = $(this).parent().parent().parent().data('id');
divRemove = "rowavailables";            

id_article_update = $(this).parent().parent().parent().data('id');
id_image_update = $(this).parent().parent().parent().data('image');
image_name_update = $(this).parent().parent().parent().data('imagename'); 
var categories = $(this).parent().parent().parent().data('categories');

var date = $(this).parent().parent().parent().data('pos');
var timestamp = new Date(date).getTime();

console.log(id_article_update);
                 
          $.ajax({
                      headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),                                             
                                  },
                      dataType: 'json',
                      type:'GET',
                      url: "article/"+id_article_update,
                
                success: function(data){
                            console.log(data);
                            console.log(data.url)
                            $("#url_update").val(data.url);
                            $("#title_update").val(data.title);
                            $("#snippet_update").val(data.snippet);
                            $("#pinned_update").prop("checked", 0);
                            $("#startdate_update").val(data.start_date);
                            $("#expiredate_update").val(data.expire_date);
                            $("#previewImage").show();
                            $("#previewImage").css('background-image', 'url(/getImage/'+id_article_update+'/'+timestamp+')');
                            tagsInputUpdate();
                            $('#categories_update').tagEditor('addTag', categories);
                            $('#modalUpdate').modal('show');
                      },
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                            console.log("error");                  
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                      }
          });  


});

//Delete article
$("#divpinneds").on("click", ".deletePinned", function(e) {  

id_article_delete = $(this).parent().parent().parent().data('id');

divRemove = "rowpinneds";

console.log(id_article_delete);

swal({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
          if (result.value) {
            
                e.preventDefault();
                            $.ajax({
                                        headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),                                             
                                                 },
                                        dataType: 'json',
                                        type:'DELETE',
                                        url: "article/"+id_article_delete,
                                  
                                  success: function(data){
                                                          if(divRemove == "rowavailables")
                                                          {
                                                                $(".rowavailables").each(function() {
                                                                      var mydata = $(this).data('id');
                                                                      if(mydata == id_article_delete){
                                                                                  console.log("entra eliminar");
                                                                                  $(this).remove();
                                                                      }                                                                  
                                                                }); 
                                                          }
                                                          else
                                                          {
                                                                $(".rowpinneds").each(function() {
                                                                      var mydata = $(this).data('id');
                                                                      if(mydata == id_article_delete){
                                                                            console.log("entra eliminar");
                                                                            $(this).remove();
                                                                      }                                                                  
                                                                }); 
                                                          }
                                                    swal(
                                                    'Deleted!',
                                                    'Your file has been deleted.',
                                                    'success'
                                                    )

                                        },
                                        error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                                              console.log("error");                  
                                              console.log(JSON.stringify(jqXHR));
                                              console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                                        }
                                  });      

          }
})
console.log("delete p");
});

//Delete article
$("#divavailables").on("click", ".deleteAvailable", function(e) {  

id_article_delete = $(this).parent().parent().parent().data('id');
divRemove = "rowavailables";

console.log(id_article_delete);

swal({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
          if (result.value) {

                e.preventDefault();
                            $.ajax({
                                        headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),                                             
                                                 },
                                        dataType: 'json',
                                        type:'DELETE',
                                        url: "article/"+id_article_delete,
                                  
                                  success: function(data){
                                                          if(divRemove == "rowavailables")
                                                          {
                                                                $(".rowavailables").each(function() {
                                                                      var mydata = $(this).data('id');
                                                                      if(mydata == id_article_delete){
                                                                                  console.log("entra eliminar");
                                                                                  $(this).remove();
                                                                      }                                                                  
                                                                }); 
                                                          }
                                                          else
                                                          {
                                                                $(".rowpinneds").each(function() {
                                                                      var mydata = $(this).data('id');
                                                                      if(mydata == id_article_delete){
                                                                            console.log("entra eliminar");
                                                                            $(this).remove();
                                                                      }                                                                  
                                                                }); 
                                                          }
                                                    swal(
                                                    'Deleted!',
                                                    'Your file has been deleted.',
                                                    'success'
                                                    )

                                        },
                                        error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                                              console.log("error");                  
                                              console.log(JSON.stringify(jqXHR));
                                              console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                                        }
                                  });  
          }
})
console.log("delete a");
});

//***NEW START */

$("#divpinneds").on("click", ".unPinned", function(e) {  

resultUnPinned = [];
id_move_pinned = $(this).parent().parent().parent().data('id');
    $.ajax({
          headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),                                             
                                                 },
          dataType: 'json',
          type:'POST',
          url: "updateType/"+id_move_pinned+"/"+0,

          success: function(data){
                
                for(var a in data){               
                      resultUnPinned.push(data[a]);                                              
                }     
          
                      $(".rowpinneds").each(function() {
                            var mydata = $(this).data('id');
                            if(mydata == id_move_pinned){                                
                                  
                                  $(this).remove();
                                  }                                                                  
                      });                                                      
                                               
                      $("#divavailables").prepend(resultUnPinned[0]);
                      $('#headingAvailables').text("Available Articles");                                                                   
           
          },
          error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                console.log("error");  
                
                swal({
                      type: 'error',
                      title: 'The action is not valid',
                      text: 'The action is not valid',
                      })               
                //console.log(json[message]);                      
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
          }
    });

});  
/******************************* */

$("#divavailables").on("click", ".pinAvailable", function(e) {  
resultPinAvailable = [];
id_move_available = $(this).parent().parent().parent().data('id');
    $.ajax({
          headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),                                             
                                                 },
          dataType: 'json',
          type:'POST',
          url: "updateType/"+id_move_available+"/"+1,

          success: function(data){
                
                for(var a in data){               
                      resultPinAvailable.push(data[a]);                                              
                }     
  
                      $(".rowavailables").each(function() {
                            var mydata = $(this).data('id');
                            if(mydata == id_move_available){                                
                                  
                                  $(this).remove();
                                  }                                                                  
                      });                                                      
                                               
                      $("#divpinneds").prepend(resultPinAvailable[0]);
                      $('#headingPinneds').text("Pinned Articles");                                                                   
           
          },
          error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                console.log("error");  
                
                swal({
                      type: 'error',
                      title: 'The action is not valid',
                      text: 'The action is not valid',
                      })               
                                   
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
          }
    });


}); 

function moveUpDown(idUp, idDown){
$.ajax({
          headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),                                             
                                                 },
          dataType: 'json',
          type:'POST',
          url: "updatePosition/"+idUp+"/"+idDown,

          success: function(data){
                
                console.log("successfull");                                                                
           
          },
          error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                console.log("error");  
 
                //console.log(json[message]);                      
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
          }
    });
}

$("#divpinneds").on("click", ".upArticlePinned", function(e) {  
var idUp = $(this).parent().parent().parent().data('id');
console.log(idUp);
var idDown = $(this).parent().parent().parent().prev().data('id');
console.log(idDown);

moveUpDown(idUp, idDown);

var previous = $(this).parent().parent().parent().prev();     
$(this).parent().parent().parent().insertBefore(previous);

}); 

$("#divpinneds").on("click", ".downArticlePinned", function(e) {  
var idDown = $(this).parent().parent().parent().data('id');
console.log(idDown);
var idUp = $(this).parent().parent().parent().next().data('id');
console.log(idUp);

moveUpDown(idUp, idDown);

var next = $(this).parent().parent().parent().next();     
$(this).parent().parent().parent().insertAfter(next);
}); 
$("#divavailables").on("click", ".upArticleAvailable", function(e) { 
var idUp = $(this).parent().parent().parent().data('id');
console.log(idUp);
var idDown = $(this).parent().parent().parent().prev().data('id');
console.log(idDown);

moveUpDown(idUp, idDown);
    
var previous = $(this).parent().parent().parent().prev();     
$(this).parent().parent().parent().insertBefore(previous);
}); 
$("#divavailables").on("click", ".downArticleAvailable", function(e) {  
var idDown = $(this).parent().parent().parent().data('id');
console.log(idDown);
var idUp = $(this).parent().parent().parent().next().data('id');
console.log(idUp);

moveUpDown(idUp, idDown);

var next = $(this).parent().parent().parent().next();     
$(this).parent().parent().parent().insertAfter(next);
}); 

//***NEW FINISHED */

function getAll(){

resultado = [];

$.ajax({
    dataType: 'json',
    url: 'getall',
}).done(function(data) {
   
          for(var a in data){
          
          resultado.push(data[a].category);                
    }     
   
});
}


function openModal(){

tagsInputCreate();
$('#modalAdd').modal('show');
}

function openModalSearch(){

$('#modalSearch').modal('show');
}

$("#columnCategories").on("click", ".categories", function() { 
console.log("entra categories");
var buttonClass = $(this).attr('class'); 
console.log(buttonClass);
if(buttonClass == "btn btn-sm categories disabled"){
    $(this).removeClass('disabled');
    $(this).addClass('active');
}
else{
    $(this).removeClass('active');
    $(this).addClass('disabled');      
}

var categories = "";
var numComas = 0;

$(".categories").each(function() {
        var classs = $(this).attr('class'); 
        console.log(classs);
        if(classs == "btn btn-sm categories active"){
                var value = $(this).text();
                if(numComas == 0){
                        categories = categories + value;
                }
                else{
                        categories = categories + "," + value;
                }
                numComas++;
        }
});

response = [];
$.ajax({
    headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),                                             
                                  },

    type:'get',
    url: 'getArticles/'+categories,

    success: function(data){               
          for(var a in data){               
                response.push(data[a]);                                              
          }    

          $('#divpinneds').empty();                 
          $('#divpinneds').html(response[0]);
          $('#divavailables').empty();
          $('#divavailables').html(response[1]);

          console.log("success");
    },
    error: function(jqXHR, textStatus, errorThrown) { 
          console.log("error");
          console.log(JSON.stringify(jqXHR));
          console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
    }

})


});

$("#columnCategoriesToggle").on("click", ".categoriesToggle", function() { 
console.log("entra categories");
var buttonClass = $(this).attr('class'); 
console.log(buttonClass);
if(buttonClass == "btn btn-sm categoriesToggle disabled"){
    $(this).removeClass('disabled');
    $(this).addClass('active');
}
else{
    $(this).removeClass('active');
    $(this).addClass('disabled');      
}

var categories = "";
var numComas = 0;

$(".categoriesToggle").each(function() {
        var classs = $(this).attr('class'); 
        console.log(classs);
        if(classs == "btn btn-sm categoriesToggle active"){
                var value = $(this).text();
                if(numComas == 0){
                        categories = categories + value;
                }
                else{
                        categories = categories + "," + value;
                }
                numComas++;
        }
});

response = [];
$.ajax({
    headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),                                             
                                  },

    type:'get',
    url: 'getArticles/'+categories,

    success: function(data){               
          for(var a in data){               
                response.push(data[a]);                                              
          }    

          $('#divpinneds').empty();                 
          $('#divpinneds').html(response[0]);
          $('#divavailables').empty();
          $('#divavailables').html(response[1]);

          console.log("success");
    },
    error: function(jqXHR, textStatus, errorThrown) { 
          console.log("error");
          console.log(JSON.stringify(jqXHR));
          console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
    }

})


});

$("#columnCategories").on("click", ".editColors", function() {
var idCategory = $(this).parent().parent().parent().data('id');
var newColor = $(this).css("background-color");
console.log(idCategory); 
console.log(newColor);
resultEditColor = [];

var categories = "";
var numComas = 0;

$(".categories").each(function() {
        var classs = $(this).attr('class'); 
        console.log(classs);
        if(classs == "btn btn-sm categories active"){
                var value = $(this).text();
                if(numComas == 0){
                        categories = categories + value;
                }
                else{
                        categories = categories + "," + value;
                }
                numComas++;
        }
});

var url = "";
if(categories == ""){
    url='updateColor/'+idCategory+'/'+newColor;
}     
else{
    url='updateColor/'+idCategory+'/'+newColor+'/'+categories;
} 
$.ajax({
          headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),                                             
                            },
          dataType: 'json',
          type:'POST',
          url: url,
        
          success: function(data){
                for(var a in data){               
                      resultEditColor.push(data[a]);                                              
                      }     
                      $('#columnCategories').empty();                 
                      $('#columnCategories').html(resultEditColor[0]);   
                      $('#divpinneds').empty();                 
                      $('#divpinneds').html(resultEditColor[1]);
                      $('#divavailables').empty();
                      $('#divavailables').html(resultEditColor[2]); 
                      $('#columnCategoriesToggle').empty();                 
                      $('#columnCategoriesToggle').html(resultEditColor[3]);                                                                                
          },
          error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                console.log("error change color");  
 
                //console.log(json[message]);                      
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
          }
    });

});

$("#columnCategoriesToggle").on("click", ".editColorsToggle", function() {
var idCategory = $(this).parent().parent().parent().data('id');
var newColor = $(this).css("background-color");
console.log(idCategory); 
console.log(newColor);
resultEditColor = [];

var categories = "";
var numComas = 0;

$(".categoriesToggle").each(function() {
        var classs = $(this).attr('class'); 
        console.log(classs);
        if(classs == "btn btn-sm categoriesToggle active"){
                var value = $(this).text();
                if(numComas == 0){
                        categories = categories + value;
                }
                else{
                        categories = categories + "," + value;
                }
                numComas++;
        }
});

var url = "";
if(categories == ""){
    url='updateColor/'+idCategory+'/'+newColor;
}     
else{
    url='updateColor/'+idCategory+'/'+newColor+'/'+categories;
} 
$.ajax({
          headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),                                             
                            },
          dataType: 'json',
          type:'POST',
          url: url,
        
          success: function(data){
                for(var a in data){               
                      resultEditColor.push(data[a]);                                              
                      }     
                      $('#columnCategories').empty();                 
                      $('#columnCategories').html(resultEditColor[0]);   
                      $('#divpinneds').empty();                 
                      $('#divpinneds').html(resultEditColor[1]);
                      $('#divavailables').empty();
                      $('#divavailables').html(resultEditColor[2]);  
                      $('#columnCategoriesToggle').empty();                 
                      $('#columnCategoriesToggle').html(resultEditColor[3]);                                                                               
          },
          error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                console.log("error change color");  
 
                //console.log(json[message]);                      
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
          }
    });

});

$("#colAside").on("click", "#saveFooterText", function() {
console.log("saveFooter");
responseSaveFooter = [];
var contentFooter = tinyMCE.get('footerText').getContent();      
var b = "Powered By ";
var position = 3;
var output = [contentFooter.slice(0, position), b, contentFooter.slice(position)].join('');
console.log(output);
console.log(contentFooter);

    $.ajax({
                headers: {
                                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),                                             
                                              },
                //dataType: 'json',
                type:'post',
                url: 'saveFooter',
                data: {"contentFooter":output},                             
                success: function(data){               
                for(var a in data){               
                      responseSaveFooter.push(data[a]);                                              
                      }    

                      swal(
                            'Good job!',
                            responseSaveFooter[0],
                            'success'
                            )  


                      console.log("success");
                },
                error: function(jqXHR, textStatus, errorThrown) { 
                      console.log("error");
                      console.log(JSON.stringify(jqXHR));
                      console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
          
          })
});

$("#searchContent").on("click", ".setFirst", function() {
console.log("entrraaaa setFirst");
//set first this div

var idArticle = $(this).parent().parent().data('id');
console.log(idArticle);

resultSetFirst = [];

$.ajax({
    headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),                                             
                                  },

    type:'post',
    url: 'setFirst/'+idArticle,

    success: function(data){               
          for(var a in data){               
                resultSetFirst.push(data[a]);                                              
          } 

          if(resultSetFirst[1] == 1)
          {               
                $(".rowpinneds").each(function() {
                      var mydata = $(this).data('id');
                            if(mydata == idArticle){
                                  console.log("entra eliminar");

                                        $(this).remove();
                                  
                            }                                                                  
                });        
                $("#divpinneds").prepend(resultSetFirst[0]);   
                                                                        
          }
          else{                        
                $(".rowavailables").each(function() {
                      var mydata = $(this).data('id');
                            if(mydata == idArticle){
                                  console.log("entra eliminar");
                                        $(this).remove(); 
                                                                   
                            }                                                                  
                }); 
                $("#divavailables").prepend(resultSetFirst[0]);                       
          }


        
          console.log("success");
    },
    error: function(jqXHR, textStatus, errorThrown) { 
          console.log("error");
          console.log(JSON.stringify(jqXHR));
          console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
    }

})


});

$("#btnSearchText").click(function() {
console.log("searchingArticles");

var textSearch = $("#textSearch").val();

if(textSearch != ""){
    responseTextSearch = [];
$.ajax({
          headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),                                             
                                        },
    
          type:'get',
          url: 'searchArticles/'+textSearch,

          success: function(data){               
          for(var a in data){               
                responseTextSearch.push(data[a]);                                              
                }    
                if(responseTextSearch[1] == "success"){
                      $('#searchContent').empty();                 
                      $('#searchContent').html(responseTextSearch[0]);
                }
                else{
                      swal({
                      type: 'error',
                      title: 'There are no records',
                      text: responseTextSearch[0],
                      })   
                }


                console.log("success");
          },
          error: function(jqXHR, textStatus, errorThrown) { 
                console.log("error");
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
          }
    
    })
}
else{
    swal({
                type: 'error',
                title: 'Write some words',
                text: 'Write some words',
                })   
}

});

function openNav() {
//change with jQuery
document.getElementById("mySidenav").style.width = "150px";
}

function closeNav() {
//change with jQuery
document.getElementById("mySidenav").style.width = "0";
}

$("#columnCategories").on("click", ".dropdown", function() {
var display = $(this).children('div').css("display");
console.log(display);
if(display == "none")
{
  $(this).children('div').css("display", "block");  
}
else{
    $(this).children('div').css("display", "none"); 
}

});

$("#columnCategoriesToggle").on("click", ".dropdown", function() {
var display = $(this).children('div').css("display");
console.log(display);
if(display == "none")
{

  $(this).children('div').css("display", "block");  
}
else{
 
    $(this).children('div').css("display", "none"); 
}

});

