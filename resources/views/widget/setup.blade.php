
<!DOCTYPE html>
<html>
<head>
        <title>Wizard</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 <!-- Fonts -->
 <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

<!-- Styles -->
<style>
    html, body {

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

    .title {
        font-size: 84px;
    }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            
   

</style>
</head>
<body>
<div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                      <!--  <a href="{{ route('register') }}">Register</a> -->
                    @endauth
                </div>
            @endif

            <div class="content">
<div class="container">
        <div class="jumbotron" style="background-color: white; width:80%;">
                <div class="panel panel-default"style="align:center;">
                        <div class="panel-heading">Setup The Articles Widget</div>
                                <div class="panel-body">
                                        <div id="divRdgWizardArticles">
                                                <div class="row" style="margin-left:1%;">                                    
                                                        <label class="control-label">1. Select the categories of articles you want to show:</label>
                                                </div>
                                                <div class="row" style="margin-left:5%;">
                                                @if(count($categories) > 0)
                                                        @foreach($categories as $category)
                                                        
                                                                <button type="button" style="background-color:{{$category->color}}; font-weight:bold; cursor: default;" class="btn btn-sm categories disabled">{{$category->category}}</button>  
                                                                                                  
                                                @endforeach
                                                        @else                                              
                                                     <span class="label label-danger">No categories available</span>
                                                    
                                                @endif
                                                </div>
                                                
                                                <div class="row" style="margin-top:2%; margin-left:1%;">                                         
                                                        <label class="control-label">2. Do you want to show article snippets?</label>
                                                        
                                                </div>
                                                <div class="row" style="margin-left:5%;">     
                                                        <label class="radio-inline"><input type="radio" name="optionSnippet" value="snippet">Yes</label>
                                                        <label class="radio-inline"><input type="radio" name="optionSnippet" value="title" checked="checked">No</label>
                                                </div>
                                                <div class="row" style="margin-top:2%; margin-left:1%;"> 
                                                        <label class="control-label">3. Select how many articles you want to show:</label>
                                                </div>
                                                <div class="row" style="margin-left:5%;">       
                                                        <label class="radio-inline"><input type="radio" name="amountShow" value="2">2</label>
                                                        <label class="radio-inline"><input type="radio" name="amountShow" value="4">4</label>
                                                        <label class="radio-inline"><input type="radio" name="amountShow" value="6" checked="checked">6</label>
                                                        <label class="radio-inline"><input type="radio" name="amountShow" value="8">8</label>
                                                        <label class="radio-inline"><input type="radio" name="amountShow" value="10">10</label>
                                                </div>
                                                <div class="row" style="margin-top:2%; text-align:center;"> 
                                                        <button type="button" class="btn btn-info" onclick="generateWidget();">Generate Widget Code</button>
                                                </div>
                                                <div class="row" style="margin-top:2%; margin-left:5%; margin-right:5%;">  
                                                        <textarea rows="6" class="form-control" name="codeGenerated" id="codeGenerated" maxlength="200"></textarea>
                                                </div>
                                                <div class="row" style="margin-top:2%; text-align:right; margin-right:5%;"> 
                                                        <button type="button" onclick="copyClipboard();" class="btn btn-default">Copy to Clipboard</button>
                                                </div>
                                        </div>                                               
                                </div>   
                </div>
        </div>                      
    </div>

            </div>
        </div>
    
    
    <script>

        $(document).ready(function(){   

  
               

        });
        //End document.ready





 
function generateWidget(){

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

        var amount = $("input[name='amountShow']:checked").val();
  
        var snippet = $("input[name='optionSnippet']:checked").val();
       

        // Math.floor((Math.random() * 100000) + 1);
        var divRandom = Math.floor(Math.random() * 899999 + 100000);
     

        var src = "{{$protocol}}{{$host}}";

        var html = "<div id='divRdgWidgetNewsArticles-"+divRandom+"'> "+ "\n"+ 
        "</div>"+ "\n" +
        "<script data-target='divRdgWidgetNewsArticles-"+divRandom+"' data-src='"+src+"' data-categories='"+categories+"' data-amount='"+amount+"' data-snippet='"+snippet+"' data-stateRdgWidgetArticles='true'  src='"+src+"/js/widgetScript.js'> \<\/script\>";

                

        $("#codeGenerated").text(html);
        
}

//hasclass
$("#divRdgWizardArticles").on("click", ".categories", function() { 
        var buttonClass = $(this).attr('class'); 
        console.log(buttonClass);
        if(buttonClass == "btn btn-sm categories disabled"){
            $(this).removeClass('disabled');
            $(this).addClass('active');
            console.log("entra");
      }
      else{
            $(this).removeClass('active');
            $(this).addClass('disabled');      
      }
});

function copyClipboard() {
        /* Get the text field */
        var copyText = document.getElementById("codeGenerated");

        /* Select the text field */
        copyText.select();

        /* Copy the text inside the text field */
        document.execCommand("copy");
}

   </script>

    </body>
</html>