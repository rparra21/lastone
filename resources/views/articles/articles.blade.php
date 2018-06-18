@extends('layouts.master')
@section('estilos')
<link href="{{ asset('css/articles.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('jQuery-tagEditor-master/jquery.tag-editor.css')}}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


@endsection
@section('title-content','Articles')
@section('breadcrumb','Articles')
@section('content')
@include('articles.search')
@include('articles.create')
@include('articles.update')
@include('articles.prueba')

<div class="container">
<span id="spanTogle" style="font-size:20px;cursor:pointer; float:right" onclick="openNav()">&#9776;</span>

<div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div id="columnCategoriesToggle">                                         
                              @foreach($categoriesTags as $tags)  
                                                  
                                    <div class="row" data-id="{{$tags->id}}">  
                                          <button type="button" style="padding: 0.05rem 0.2rem; margin-left:15%; margin-top:2%; background-color:{{$tags->color}}; font-weight:bold;" 
                                                            class="btn btn-sm categoriesToggle disabled">{{$tags->category}}   
                                                      </button>   
                                          <div class="dropdown" style="margin-left:1%; margin-top:1%;">
                                                <button type="button" style="padding: 0.01rem 0.1rem;" 
                                                            class="dropbtn btn btn-default btn-sm"><i class="fa fa-fw fa-pencil"></i></button> 

                                                <div class="dropdown-content">
                                                      <a class="editColorsToggle" style="background-color:red;" href="#"></a>
                                                      <a class="editColorsToggle" style="background-color:blue;" href="#"></a>
                                                      <a class="editColorsToggle" style="background-color:yellow;" href="#"></a>
                                                      <a class="editColorsToggle" style="background-color:hotpink;" href="#"></a>
                                                      <a class="editColorsToggle" style="background-color:orange;" href="#"></a>
                                                      <a class="editColorsToggle" style="background-color:lime;" href="#"></a>
                                                      <a class="editColorsToggle" style="background-color:aqua;" href="#"></a>
                                                </div>
                                          </div> 
                                    </div>  
                                                                                                                                                                                                              
                              @endforeach
                        </div>
</div>
      <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10" id="colPinneds"> 
                                          <h5 id="headingPinneds">@if(count($pinneds) > 0)
                                                Pinned Articles
                                                @else
                                                      There are no articles pinned    
                                                @endif
                                          </h5> 
                        <div id="divpinneds">                                                                                       
                                          <?php $posPinned = 1 ?>
                                          @foreach($pinneds as $pinned)                           
                                                @include('articles.listpinneds')
                                          <?php $posPinned++ ?>
                                          @endforeach                                    
                              
                        </div>

                        </br>      
                        </br>

                        <div class="row mb-10">
                              <div class="col-sm-4">
                                    <h5 id="headingAvailables">@if(count($availables) > 0)
                                          Available Articles
                                    @else
                                          There are no articles available    
                                    @endif
                                    </h5>
                              </div>
                              <div class="col-sm-2">
                                    <button type="button" class="btn" onclick="prueba()">Prueba</button>
                              </div>
                              <div class="col-sm-2">
                                    <button type="button" class="btn" onclick="openModal()">Add New Article</button>
                              </div>
                              <div class="col-sm-2">
                                    <button type="button" class="btn" onclick="openModalSearch()">Search Previous Article</button>
                              </div>
                        </div>
                        </br>

                        <div id="divavailables">
                                                                        
                                          <?php $posAvailables = 1 ?>
                                          @foreach($availables as $available)

                                                @include('articles.listavailables')
                                          <?php $posAvailables++ ?>
                                          @endforeach
                              
                        </div>
            </div>

            <div class="col-xs-0 col-sm-0 col-md-0 col-lg-2" id="colAside">
                  <div class="row" id="divHeadCategories">
                              <h5 style="margin-left: 1%;">Category Tags</h5>
                  </div> 
                      
                        <div id="columnCategories">                                         
                              @foreach($categoriesTags as $tags)  
                                                  
                                    <div class="row" data-id="{{$tags->id}}">  
                                          <button type="button" style="padding: 0.05rem 0.2rem; margin-left:5%; margin-top:2%; background-color:{{$tags->color}}; font-weight:bold;" 
                                                            class="btn btn-sm categories disabled">{{$tags->category}}   
                                                      </button>   
                                          <div class="dropdown" style="margin-left:1%; margin-top:1%;">
                                                <button type="button" style="padding: 0.01rem 0.1rem;" 
                                                            class="dropbtn btn btn-default btn-sm"><i class="fa fa-fw fa-pencil"></i></button> 

                                                <div class="dropdown-content">
                                                      <a class="editColors" style="background-color:red;" href="#"></a>
                                                      <a class="editColors" style="background-color:blue;" href="#"></a>
                                                      <a class="editColors" style="background-color:yellow;" href="#"></a>
                                                      <a class="editColors" style="background-color:hotpink;" href="#"></a>
                                                      <a class="editColors" style="background-color:orange;" href="#"></a>
                                                      <a class="editColors" style="background-color:lime;" href="#"></a>
                                                      <a class="editColors" style="background-color:aqua;" href="#"></a>
                                                </div>
                                          </div> 
                                    </div>  
                                                                                                                                                                                                              
                              @endforeach
                        </div>



                  <form id="formFooter" novalidate>
                        <div class="row" style="margin-top:7%; margin-left: 1%;">
                              <h5>Footer Text</h5>
                              <textarea class="form-control" name="footerText" id="footerText" maxlength="200" rows="5" required></textarea>
                              <button style="margin-top:3%;" type="button" id="saveFooterText" class="btn btn-sm btn-info">Save</button>
                        </div>
                  </form>
            </div>
      </div>
</div>  

  

@endsection

@section('script')


<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="{{asset('jQuery-tagEditor-master/jquery.tag-editor.min.js')}}"></script>

<script src="{{asset('jQuery-tagEditor-master/jquery.caret.min.js')}}"></script>

<!-- 
<script src="{{asset('js/validator.min.js')}}"></script>

<script src="http://malsup.github.com/jquery.form.js"></script> -->

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ 
        selector:'#footerText',
        menubar:false,
        branding:false
         });</script>
 
<script>
/******* OPEN DOCUMENT READY *********/
  $(document).ready(function(){   



      $(window).on('resize', function(){
      var win = $(this); //this = window comment that I find
      if (win.width() >= 992) { 
            
            document.getElementById("mySidenav").style.width = "0";
      }

      });
     
     idRemove = "";
     divRemove = "";

     //variables to update article
     id_article_update = 0;
     id_image_update = 0;
     image_name_update = ""; 
     //***************/

     //variables to update article
     id_article_delete = 0;

     //
     divPreviousEdit = "";

      //change image when update
      $('#image_update').change(function() {
            $("#previewImage").hide();
      });

      $("#errorCategories").hide();
/*
      var colors = ["btn-primary","btn-success", "btn-danger", "btn-warning", "btn-info", "btn-default"];
      var i = 0;
            $(".categories").each(function() {
                  console.log(colors[i]);
                  //var color = randomColor();
                  //$(this).css('color', color);
                  $(this).addClass(colors[i]);                                
                              if(i == 5){
                                    i = 0;
                              }
                              else{
                                    i++;     
                              }                   
      });
*/  
//Update article
$("#formUpdate").on('submit',function(e) {
      
      if($("#startdate_update").val() != "" && $("#expiredate_update").val() != "" && $("#startdate_update").val() > $("#expiredate_update").val()){
                  swal({
                  type: 'error',
                  title: 'The given dates was invalid.',
                  text: 'The start date can not greater than expire date',
                  })   
      }
      else{
                  var id = $("#update_id").val();
                  resultupdate = [];
                  console.log("update");
                  e.preventDefault();

                  $.ajax({

                              dataType: 'json',
                              type:'POST',
                              url: "updatePost/"+id_article_update+"/"+id_image_update+"/"+image_name_update,
                              data: new FormData(this),
                              contentType: false,
                              processData: false,
                        success: function(data){
                              console.log(data);
                                                for(var a in data){               
                                                      resultupdate.push(data[a]);                                              
                                                }     
                                                console.log(resultupdate[0]);
                                                
                                                      if(divRemove == "rowavailables")
                                                      {
                                                            $(".rowavailables").each(function() {
                                                                  var mydata = $(this).data('id');
                                                                        if(mydata == id_article_update){
                                                                              console.log("entra eliminar");
                                                                              if(resultupdate[1] == 0)
                                                                              {
                                                                                    $(resultupdate[0]).insertBefore($(this)); 
                                                                                    $(this).remove();  
                                                                              }
                                                                              else{
                                                                                   $(this).remove(); 
                                                                                   $("#divpinneds").prepend(resultupdate[0]);
                                                                                   $('#headingPinneds').text("Pinned Articles"); 
                                                                              }                                                                              
                                                                        }                                                                  
                                                            }); 
                                                      }
                                                      else
                                                      {
                                                            $(".rowpinneds").each(function() {
                                                                  var mydata = $(this).data('id');
                                                                        if(mydata == id_article_update){
                                                                              console.log("entra eliminar");
                                                                              if(resultupdate[1] == 1)
                                                                              { 
                                                                                    $(resultupdate[0]).insertBefore($(this)); 
                                                                                    $(this).remove();                                                                                   
                                                                              }
                                                                              else{
                                                                                    $(this).remove();
                                                                                    $("#divavailables").prepend(resultupdate[0]);
                                                                                    $('#headingAvailables').text("Available Articles");
                                                                              }
                                                                        }                                                                  
                                                            });  
                                                            
                                                      }
                                          /*
                                                      if(resultupdate[1] == 1)
                                                      {                     
                                                            $(divPreviousEdit).insertBefore(resultupdate[0]);    
                                                            $('#headingPinneds').text("Pinned Articles"); 

                                                            $(previo)
                                                            $(this).parent().parent().parent().insertAfter(previous);
                                                      }
                                                      else{                                                
                                                            $("#divavailables").prepend(resultupdate[0]);
                                                            $('#headingAvailables').text("Available Articles"); 
                                                      }
                                          */
                                                      $('#columnCategories').empty();                 
                                                      $('#columnCategories').html(resultupdate[2]);
                                                      $('#columnCategoriesToggle').empty();                 
                                                      $('#columnCategoriesToggle').html(resultupdate[3]);
                                                
                                                swal(
                                                      'Good job!',
                                                      'Article Updated!',
                                                      'success'
                                                      )  
                                                      
                                                $('#formUpdate')[0].reset();
                                                $('#modalUpdate').modal('hide');

                              },
                              error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                                    console.log("error");  
                                    //var messageError = jqXHR["responseJSON"].errors.image[0].toString();  
                                    swal({
                                          type: 'error',
                                          title: 'The given data was invalid.',
                                          text: 'Use .jpg, .jpeg, .png extensions. The dimensions should be less than 3000 x 3000. The image may not be greater than 2 MB',
                                          })               
                                    //console.log(json[message]);                      
                                    console.log(JSON.stringify(jqXHR));
                                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                              }
                  });
      }

});

//Add article
$("#formAdd").on('submit',function(e) {

if($("#startdate").val() != "" && $("#expiredate").val() != "" && $("#startdate").val() > $("#expiredate").val()){
      swal({
      type: 'error',
      title: 'The given dates was invalid.',
      text: 'The start date can not greater than expire date',
      })   
}
else{
      var bootstrapValidator = $("#formAdd").data('bootstrapValidator');
      bootstrapValidator.validate();

   if(bootstrapValidator.isValid())
     {
      var tags = $('#categories').tagEditor('getTags')[0].tags;
      
           if(tags.length > 0){

                  $("#errorCategories").hide();
                  resulthtml = [];
                  console.log("entra");
                  e.preventDefault();
                        
                  $.ajax({
                                    dataType: 'json',
                                    type:'POST',
                                    url: "article",
                                    data: new FormData(this),
                                    contentType: false,
                                    processData: false,
                              success: function(data){
                                          console.log(data);
                                                for(var a in data){               
                                                      resulthtml.push(data[a]);                                              
                                                }     
                                          
                                                $('#formAdd')[0].reset();
                                                //$('#modalAdd').modal('show');
                                                
                                                var tags = $('#categories').tagEditor('getTags')[0].tags;
                                                for (i = 0; i < tags.length; i++) { $('#categories').tagEditor('removeTag', tags[i]); }
                                                $('#categories').tagEditor('destroy');
                                                tagsInputCreate();
                                             
                                                console.log(resulthtml[2]);
                                                
                                                if(resulthtml[1] == 1)
                                                {                     
                                                      $("#divpinneds").prepend(resulthtml[0]);    
                                                      $('#headingPinneds').text("Pinned Articles");                                  
                                                }
                                                else{
                                                      $("#divavailables").prepend(resulthtml[0]);
                                                      $('#headingAvailables').text("Available Articles"); 
                                                }
                                                //add aside categorys
                                                $('#columnCategories').empty();                 
                                                $('#columnCategories').html(resulthtml[2]);
                                                $('#columnCategoriesToggle').empty();                 
                                                $('#columnCategoriesToggle').html(resulthtml[3]);

                                                swal(
                                                      'Good job!',
                                                      'Article Created!',
                                                      'success'
                                                      )                             
                              },
                              error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                                    console.log("error");  
                                    //var messageError = jqXHR["responseJSON"].errors.image[0].toString();  
                                    swal({
                                          type: 'error',
                                          title: 'The given data was invalid.',
                                          text: 'Use .jpg, .jpeg, .png extensions. The dimensions should be less than 3000 x 3000. The image may not be greater than 2 MB',
                                          })               
                                    //console.log(json[message]);                      
                                    console.log(JSON.stringify(jqXHR));
                                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                              }
                  });
            }
            else{
                  $("#errorCategories").show();
            }
      }
     else 
     {
          console.log("validator deteniendo");
          return; 
     }
}

      
});

});

/******* CLOSE DOCUMENT READY *********/

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

$('#formPrueba').bootstrapValidator({
 
 fields: {
 psone: {
       validators: {
            notEmpty: {
                   message: 'The url address is required and cannot be empty'
             }
       }
 },
 pstwo: {
       validators: {
            identical: {
                        field: 'psone',
                        message: 'The password and its confirm are not the same'
                    }
       }
 }
          
}
})

$("#btnpruebaad").click(function() {

       var bootstrapValidator = $("#formPrueba").data('bootstrapValidator');
      bootstrapValidator.validate();

   if(bootstrapValidator.isValid())
     {
      console.log("entra");
     }
     else{
      console.log("mal"); 
     }
});

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
  
/*
      var url = $("#divpinneds .rowpinneds:nth-child("+position+")  #pinned_url").val();     
      var title = $("#divpinneds .rowpinneds:nth-child("+position+") #pinned_title").text(); 
      var snippet = $("#divpinneds .rowpinneds:nth-child("+position+") #pinned_snippet").text();
      var pinnedcheck = 1;            
      var startdate = $("#divpinneds .rowpinneds:nth-child("+position+") #pinned_startdate").text();
      var expiredate = $("#divpinneds .rowpinneds:nth-child("+position+") #pinned_expiredate").text();      
      var pinned_id = $("#divpinneds .rowpinneds:nth-child("+position+") #pinned_id").val();
      var pinned_image_id = $("#divpinneds .rowpinneds:nth-child("+position+") #pinned_image_id").val();
      var pinned_image_name = $("#divpinneds .rowpinneds:nth-child("+position+") #pinned_image_name").val();
      var pinned_category = $("#divpinneds .rowpinneds:nth-child("+position+") #pinned_category").val();

      //var categories = $(".rowpinneds:nth-child("+position+") #pinned_category").val();
     
      //console.log(url + " " + title + " " + pinned_id + " " +startdate + " " + expiredate + " " + snippet);
      editModal(position, url, title, snippet, pinnedcheck, pinned_id, startdate, expiredate, pinned_image_id, pinned_image_name, pinned_category);
   */   

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

/*
      var url = $("#divavailables .rowavailables:nth-child("+position+") #available_url").val();     
      var title = $("#divavailables .rowavailables:nth-child("+position+") #available_title").text(); 
      var snippet = $("#divavailables .rowavailables:nth-child("+position+") #available_snippet ").text();
      var pinnedcheck = 0;            
      var startdate = $("#divavailables .rowavailables:nth-child("+position+") #available_startdate").text();
      var expiredate = $("#divavailables .rowavailables:nth-child("+position+") #available_expiredate").text();      
      var available_id = $("#divavailables .rowavailables:nth-child("+position+") #available_id").val();
      var available_image_id = $("#divavailables .rowavailables:nth-child("+position+") #available_image_id").val();
      var available_image_name = $("#divavailables .rowavailables:nth-child("+position+") #available_image_name").val();
      var available_category = $("#divavailables .rowavailables:nth-child("+position+") #available_category").val();
     

      console.log(url + " " + title + " " + available_id + " " +startdate + " " + expiredate + " " + snippet);
      editModal(position, url, title, snippet, pinnedcheck, available_id, startdate, expiredate, available_image_id, available_image_name, available_category);
*/
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

function prueba(){
$('#modalPrueba').modal('show');
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
            //accesing to children with jQuery
          $(this).children('div').css("display", "block");  
      }
      else{
            //accesing to children with jQuery
            $(this).children('div').css("display", "none"); 
      }

});


/*
$("#columnCategories").on({
    mouseenter: function () {
      $(this).parent().next().children('.collapse').collapse('show');
      console.log("entra hover");
    },
    mouseleave: function () {
     // var color = $(this).children().children().val();
      //console.log(color);
      $(this).parent().next().children('.collapse').collapse('hide');
      console.log("sale hovver");
    }
}, ".editColors");
*/

/*
$("#columnCategories .categories").hover(function() { 
      console.log("entra hovver");

      }
);*/
</script>

@endsection
