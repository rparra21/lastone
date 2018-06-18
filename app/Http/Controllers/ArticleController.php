<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Image as Imagen;
use App\Models\Category;
use App\Models\Article_Category;
use App\Models\Footer;
use App\Models\Log;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\DB;
use DateTime;


class ArticleController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function index($categories = "")
    {
        $now = new DateTime();
        $categoriesTags = Category::orderBy('category','asc')->get();

        $pinneds = Article::with('categories')
                    ->where('pinned',1)
                    ->orderBy('order', 'desc')
                    ->take(10)
                    ->get();

        $availables = Article::with('categories')
                    ->where('pinned',0)
                    ->orderBy('order', 'desc')
                    ->take(10)
                    ->get();

        //Pinneds with dates filter
                /*  $firstPinned = Article::with('categories')
                                    ->where('pinned',1)
                                    ->where([['start_date', '<=' , $now], ['expire_date', '>=', $now]])->orWhere(function ($q) {
                                        $q->whereNull('start_date')->whereNull('expire_date')->where('pinned', 1);
                                        });

                  $secondPinned = Article::with('categories')
                                    ->where('pinned',1)  
                                    ->where([['start_date', '<=' , $now], ['expire_date', '>=', $now]])->orWhere(function ($q) use($now){
                                        $q->whereNull('start_date')->where('expire_date', '>=', $now)->where('pinned', 1);
                                        });    
                                    
                  $thirdPinned = Article::with('categories')
                                    ->where('pinned',1) 
                                    ->where([['start_date', '<=' , $now], ['expire_date', '>=', $now]])->orWhere(function ($q) use($now){
                                        $q->whereNull('expire_date')->where('start_date', '<=', $now)->where('pinned', 1);
                                        }); 

                  $pinneds = $firstPinned->union($secondPinned)->union($thirdPinned)
                                    ->orderBy('order', 'desc')
                                    ->take(10)
                                    ->get();
                */
                
        //Availables with dates filter
                /*  $firstAvailable = Article::with('categories')
                                    ->where('pinned',0)
                                    ->where([['start_date', '<=' , $now], ['expire_date', '>=', $now]])->orWhere(function ($q) {
                                        $q->whereNull('start_date')->whereNull('expire_date')->where('pinned', 0);
                                        });

                  $secondAvailable = Article::with('categories')
                                    ->where('pinned',0)  
                                    ->where([['start_date', '<=' , $now], ['expire_date', '>=', $now]])->orWhere(function ($q) use($now){
                                        $q->whereNull('start_date')->where('expire_date', '>=', $now)->where('pinned', 0);
                                        });    
                                    
                  $thirdAvailable = Article::with('categories')
                                    ->where('pinned',0) 
                                    ->where([['start_date', '<=' , $now], ['expire_date', '>=', $now]])->orWhere(function ($q) use($now){
                                        $q->whereNull('expire_date')->where('start_date', '<=', $now)->where('pinned', 0);
                                        }); 

                  $availables = $firstAvailable->union($secondAvailable)->union($thirdAvailable)
                                    ->orderBy('order', 'desc')
                                    ->take(10)
                                    ->get();
                */                   

//ready



                return view("articles/articles")
                                ->with('pinneds', $pinneds)
                                ->with('availables', $availables)
                                ->with('categoriesTags', $categoriesTags);

        
    }

    public function getall()
    {
        $list =  Category::all();

        $logs = new Log();
        $logs->user_id = 1;
        $logs->action = "getAll";
        $logs->data = "la data que viene para getAll";
        $logs->save();

        return $list;
    }

    public function getArticlesFilter($categories = "")
    {
        $now = new DateTime();
        if($categories == ""){

                $pinneds = Article::with('categories')
                            ->where('pinned',1)
                            ->orderBy('order', 'desc')
                            ->take(10)
                            ->get();

                $availables = Article::with('categories')
                            ->where('pinned',0)
                            ->orderBy('order', 'desc')
                            ->take(10)
                            ->get();

        //Pinneds with dates filter
            /*    $firstPinned = Article::with('categories')
                                ->where('pinned',1)
                                ->where([['start_date', '<=' , $now], ['expire_date', '>=', $now]])->orWhere(function ($q) {
                                        $q->whereNull('start_date')->whereNull('expire_date')->where('pinned', 1);
                                        });

                $secondPinned = Article::with('categories')
                                ->where('pinned',1)  
                                ->where([['start_date', '<=' , $now], ['expire_date', '>=', $now]])->orWhere(function ($q) use($now){
                                    $q->whereNull('start_date')->where('expire_date', '>=', $now)->where('pinned', 1);
                                    });    
                                
                $thirdPinned = Article::with('categories')
                                ->where('pinned',1) 
                                ->where([['start_date', '<=' , $now], ['expire_date', '>=', $now]])->orWhere(function ($q) use($now){
                                    $q->whereNull('expire_date')->where('start_date', '<=', $now)->where('pinned', 1);
                                    }); 

                $pinneds = $firstPinned->union($secondPinned)->union($thirdPinned)
                                ->orderBy('order', 'desc')
                                ->take(10)
                                ->get();
            */

        //Availables with dates filter
            /*    $firstAvailable = Article::with('categories')
                    ->where('pinned',0)
                    ->where([['start_date', '<=' , $now], ['expire_date', '>=', $now]])->orWhere(function ($q) {
                        $q->whereNull('start_date')->whereNull('expire_date')->where('pinned', 0);
                        });

                $secondAvailable = Article::with('categories')
                                ->where('pinned',0)  
                                ->where([['start_date', '<=' , $now], ['expire_date', '>=', $now]])->orWhere(function ($q) use($now){
                                    $q->whereNull('start_date')->where('expire_date', '>=', $now)->where('pinned', 0);
                                    });    
                                
                $thirdAvailable = Article::with('categories')
                                ->where('pinned',0) 
                                ->where([['start_date', '<=' , $now], ['expire_date', '>=', $now]])->orWhere(function ($q) use($now){
                                    $q->whereNull('expire_date')->where('start_date', '<=', $now)->where('pinned', 0);
                                    }); 

                $availables = $firstAvailable->union($secondAvailable)->union($thirdAvailable)
                                ->orderBy('order', 'desc')
                                ->take(10)
                                ->get();
            */
           
        }

        else{                                
                header("Access-Control-Allow-Origin: *");
                $categoriesTags = Category::all();

                $categorys = explode(",", $categories);
                for($i = 0; $i < count($categorys); ++$i){
                    $categoriesSelected[$i] = $categorys[$i];
                }

            //Pinneds with dates filter
                /*    $firstPinned = Article::whereHas('categories', function($q) use ($categoriesSelected)
                    {
                            $q->whereIn('category', $categoriesSelected);
                    })->where([['start_date', '<=' , $now], ['expire_date', '>=', $now]])
                        ->where('pinned',1);

                    $secondPinned = Article::whereHas('categories', function($q) use ($categoriesSelected)
                    {
                        $q->whereIn('category', $categoriesSelected);
                    })->whereNull('start_date')->whereNull('expire_date')
                    ->where('pinned',1);  
                
                    $thirdPinned = Article::whereHas('categories', function($q) use ($categoriesSelected)
                            {
                                $q->whereIn('category', $categoriesSelected);
                            })->whereNull('start_date')->where('expire_date', '>=', $now)
                            ->where('pinned',1); 
                    
                    $fourthPinned = Article::whereHas('categories', function($q) use ($categoriesSelected)
                            {
                                $q->whereIn('category', $categoriesSelected);
                            })->whereNull('expire_date')->where('start_date', '<=', $now)
                            ->where('pinned',1);  

                    $pinneds = $firstPinned->union($secondPinned)->union($thirdPinned)->union($fourthPinned)
                    ->orderBy('order', 'desc')
                    ->take(10)->get(); 
                */

            //Availables with dates filter
                /*    $firstAvailable = Article::whereHas('categories', function($q) use ($categoriesSelected)
                    {
                            $q->whereIn('category', $categoriesSelected);
                    })->where([['start_date', '<=' , $now], ['expire_date', '>=', $now]])
                        ->where('pinned',0);

                    $secondAvailable = Article::whereHas('categories', function($q) use ($categoriesSelected)
                    {
                        $q->whereIn('category', $categoriesSelected);
                    })->whereNull('start_date')->whereNull('expire_date')
                    ->where('pinned',0);  
                
                    $thirdAvailable = Article::whereHas('categories', function($q) use ($categoriesSelected)
                            {
                                $q->whereIn('category', $categoriesSelected);
                            })->whereNull('start_date')->where('expire_date', '>=', $now)
                            ->where('pinned',0); 
                    
                    $fourthAvailable = Article::whereHas('categories', function($q) use ($categoriesSelected)
                            {
                                $q->whereIn('category', $categoriesSelected);
                            })->whereNull('expire_date')->where('start_date', '<=', $now)
                            ->where('pinned',0);  

                    $availables = $firstAvailable->union($secondAvailable)->union($thirdAvailable)->union($fourthAvailable)
                    ->orderBy('order', 'desc')
                    ->take(10)->get(); 
                */               
                  
                $pinneds = Article::whereHas('categories', function($q) use ($categoriesSelected)
                                {
                                        $q->whereIn('category', $categoriesSelected);
                                })->where('pinned',1)
                                ->orderBy('order', 'desc')
                                ->take(10)
                                ->get();

                    $availables = Article::whereHas('categories', function($q) use ($categoriesSelected)
                                {
                                        $q->whereIn('category', $categoriesSelected);
                                })->where('pinned',0)
                                ->orderBy('order', 'desc')
                                ->take(10)
                                ->get(); 
            }

                                            
            $htmlPinneds = "";
            $htmlAvailables = ""; 

            foreach($pinneds as $pinned){
                $updated_timestamp_p = $pinned->updated_at->getTimestamp();
             
                $varCategoriesP =  "";
                $numComasP = 0;                
                $buttonsCategoriesP = "";
                     foreach($pinned->categories as $categorys) {   
                            
                            if($numComasP == 0){
                                $varCategoriesP = $varCategoriesP . "$categorys->category";
                                
                            }
                            else{
                                $varCategoriesP = $varCategoriesP. "," . "$categorys->category";
                            }
                            $numComasP++;   

                            $buttonsCategoriesP = $buttonsCategoriesP . "<button type='button' style='padding: 0.05rem 0.2rem; background-color:$categorys->color; font-weight:bold; margin-left:1%;' class='btn btn-sm'>$categorys->category</button>";                                                                                                          
                        }

                $image_idP = $pinned->image->id;
                $image_nameP = $pinned->image->name;

                $from = "";
                $to = "";                
                if($pinned->start_date != ""){
                    $from = "<small>From </small> <small>$pinned->start_date</small>";
                }     
                if($pinned->expire_date != ""){
                    $to = "<small> to </small> <small>$pinned->expire_date</small>";
                }   

                $htmlPinneds = $htmlPinneds . "<div class='row putBorder rowpinneds' data-id='$pinned->id' data-pos='$updated_timestamp_p' data-categories='$varCategoriesP' data-image='$image_idP' data-imagename='$image_nameP'>                                                                                   
                        <div class='col-xs-6 col-sm-6 col-md-6 col-lg-7'>
                        <div style='float:left; margin-right: 4%;'>
                                <div style='background-image: url(getImage/$image_idP/$updated_timestamp_p);' class='imageStyle'></div>
                        </div>                          
                            <b>$pinned->title</b> 
                            $from
                            $to
                            <p>$pinned->snippet</p>
                        </div>
                    <div class='col-xs-6 col-sm-6 col-md-6 col-lg-5' style='margin-top:1%; text-align:right;'>
                        $buttonsCategoriesP
                        <div class='btn-group' style='margin-top: 2%; margin-left:2%;'>
                                <button type='button' class='btn btn-default btn-sm unPinned'><span class='icon-pushpin'></span></i>Unpin</button>         
                                <button type='button' class='btn btn-default btn-sm editPinned'><i class='fa fa-fw fa-pencil'></i>Edit</button>
                                <button type='button' class='btn btn-default btn-sm deletePinned'><i class='fa fa-fw fa-times-circle'></i>Delete</button>
                        </div>                    

                        <div class='btn-group-vertical' style='float:right; margin-top:1%; margin-bottom:1%; margin-left:1%;'>
                                <button type='button' class='btn upArticlePinned'><i class='fa fa-fw fa-caret-up'></i></button>
                                <button type='button' class='btn downArticlePinned'><i class='fa fa-fw fa-caret-down'></i></button>
                        </div>
                    </div>                                 
            </div>"; 
            }
            foreach($availables as $available){
                $updated_timestamp_a = $available->updated_at->getTimestamp();

                $varCategoriesA =  "";
                $numComasA = 0;
                $buttonsCategoriesA = "";

                     foreach($available->categories as $categorys) {   
                
                            if($numComasA == 0){
                                $varCategoriesA = $varCategoriesA . "$categorys->category";
                            }
                            else{
                                $varCategoriesA = $varCategoriesA. "," . "$categorys->category";
                            }
                            $numComasA++; 

                            $buttonsCategoriesA = $buttonsCategoriesA . "<button type='button' style='padding: 0.05rem 0.2rem; background-color:$categorys->color; font-weight:bold; margin-left:1%;' class='btn btn-sm'>$categorys->category</button> "; 
                        }

                $image_idA = $available->image->id;
                $image_nameA = $available->image->name;

                $from = "";
                $to = "";                
                if($available->start_date != ""){
                    $from = "<small>From </small> <small>$available->start_date</small>";
                }     
                if($available->expire_date != ""){
                    $to = "<small> to </small> <small>$available->expire_date</small>";
                }                      

                $htmlAvailables = $htmlAvailables . "<div class='row putBorder rowavailables' data-id='$available->id' data-pos='$updated_timestamp_a' data-categories='$varCategoriesA' data-image='$image_idA' data-imagename='$image_nameA'>                                                                                   
                        <div class='col-xs-6 col-sm-6 col-md-6 col-lg-7'>
                        <div style='float:left; margin-right: 4%;'>
                                <div style='background-image: url(getImage/$image_idA/$updated_timestamp_a);' class='imageStyle'></div>
                        </div>                          
                            <b>$available->title</b> 
                            $from 
                            $to
                            <p>$available->snippet</p>
                        </div>
                    <div class='col-xs-6 col-sm-6 col-md-6 col-lg-5' style='margin-top:1%; text-align:right;'>
                        $buttonsCategoriesA
                        <div class='btn-group' style='margin-top: 2%; margin-left:2%;'>
                                <button type='button' class='btn btn-default btn-sm pinAvailable'><span class='icon-pushpin'></span></i>Unpin</button>         
                                <button type='button' class='btn btn-default btn-sm editAvailable'><i class='fa fa-fw fa-pencil'></i>Edit</button>
                                <button type='button' class='btn btn-default btn-sm deleteAvailable'><i class='fa fa-fw fa-times-circle'></i>Delete</button>
                        </div>   

                        <div class='btn-group-vertical' style='float:right; margin-top:1%; margin-bottom:1%; margin-left:1%;'>
                                <button type='button' class='btn upArticleAvailable'><i class='fa fa-fw fa-caret-up'></i></button>
                                <button type='button' class='btn downArticleAvailable'><i class='fa fa-fw fa-caret-down'></i></button>
                        </div>
                    </div>                                 
            </div>"; 
            }
 
            $logs = new Log();
            $logs->user_id = 1;
            $logs->action = "getARticlesFilter";
            $logs->data = "la data que viene para getArticlesFilter";
            //hay que tener cuidado con el save
            $logs->save();

         return Response::json(array('pinneds' => $htmlPinneds, 'availables' => $htmlAvailables));

            //return response()->view("articles/articles", ['pinneds' => $pinneds, 'availables' => $availables, 'categoriesTags' => $categoriesTags]);
              
    }

    public function getImage($id)
    {   
        header("Access-Control-Allow-Origin: *");
        $imagen = Imagen::find($id);
        $article = Article::find($id);

        $pic = Image::make($imagen->image);
        $response = Response::make($pic->encode('jpeg'));
        $response->header('Content-Type','image/jpeg');

 

        return $response;      
    }

    public function getCategories($article_id)
    {
       // $article = Article::
//
       $logs = new Log();
       $logs->user_id = 1;
       $logs->action = "getCategories";
       $logs->data = "la data que viene para getCategories";
       $logs->save();
    }

    /**
     * Store a newly created resource in storage.  /* 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $validatedData = $request->validate([
            'image' => 'required|mimes:jpg,png,jpeg|dimensions:max_width=3000,max_height=3000|max:2000'
        ]);

        if ($request->hasFile('image')){
        
        //Add Article    
        $article = new Article();   
        $article->url = $request->url;
        $article->title = $request->title;
        $article->snippet = $request->snippet;     
        $claseDiv = "";
        $claseEdit = "";
        $claseDelete = "";
        $clasePinnear = "";
        $claseUp = "";
        $claseDown = "";
        $pinOrUnpin = "";
        $count = 0; 
        $constante = "";    
          
            if ($request->has("pinned")){
                $article->pinned = 1;
                $claseDiv = "rowpinneds";
                $claseEdit = "editPinned";
                $claseDelete = "deletePinned";
                $clasePinnear = "unPinned";
                $claseUp = "upArticlePinned";
                $claseDown = "downArticlePinned";
                $pinOrUnpin = "Unpin";
                $count = Article::where('pinned',1)->count() + 1;    
                $constante = "pinned";                    
            }  
            else{
                $article->pinned = 0;
                $claseDiv = "rowavailables";
                $claseEdit = "editAvailable";
                $claseDelete = "deleteAvailable";
                $clasePinnear = "pinAvailable";
                $claseUp = "upArticleAvailable";
                $claseDown = "downArticleAvailable";
                $pinOrUnpin = "Pin";
                $count = Article::where('pinned',0)->count() + 1;  
                $constante = "available";              
            }    

        $article->start_date = $request->startdate;
        $article->expire_date = $request->expiredate;
        $now = new DateTime();
        $article->order = $now;
        $article->save();
        $position = $article->id;
        $updated_timestamp = $article->updated_at->getTimestamp();

        //Add Image
        $file = $request->file('image');
        $img = Image::make($file);
        Response::make($img->encode('jpeg'));
        
        $imagenSave = new Imagen();  
        $imagenSave->article_id = $article->id;  
        $imagenSave->name = $file->getClientOriginalName();
        $imagenSave->unique_identifier = uniqid();
        $imagenSave->image = $img;
        $imagenSave->save();              


        $categories = explode(",", $request->categories);
            for($i = 0; $i < count($categories); ++$i)
            { 
                //random color
                $color = 'rgb('.rand(100,255).', '.rand(100,255).', '.rand(100,255).')';
                       
                        /*$color = "";
                        $generate = substr(uniqid(),-6);
                        $color = "#".$generate;*/

                        //Add Category
                        $category = new Category();
                        //first parametere search if exists the model with that parameters and second parameter are the values in case the model not exists
                        $category = Category::firstOrCreate([ 'category' => $categories[$i], 'description' => $categories[$i]], 
                                        ['category' => $categories[$i], 'description' => $categories[$i], 'color' => $color]); 

 
                        $category->save();
                        
                        //Add Article Category
                        $articlecategory = new Article_Category();
                        $articlecategory->article_id = $article->id;
                        $articlecategory->category_id = $category->id;
                        $articlecategory->save();
            }
        }
         
        $from = "";
        $to = "";
        
        if($article->start_date != ""){
            $from = "<small>From </small> <small id='$constante"."_startdate'>$article->start_date</small>";
        }     
        if($article->expire_date != ""){
            $to = "<small> to </small> <small id='$constante"."_expiredate'>$article->expire_date</small>";
        }   

        $buttonsCategories = "";        
        foreach($article->categories as $categorys) {   
                $buttonsCategories = $buttonsCategories . "<button type='button' style='padding: 0.05rem 0.2rem; background-color:$categorys->color; font-weight:bold; margin-left:1%;' class='btn btn-sm' >$categorys->category</button>"; 
            }

        $html = "<div class='row putBorder $claseDiv' data-id='$article->id' data-pos='$updated_timestamp' data-categories='$request->categories' data-image='$imagenSave->id' data-imagename='$imagenSave->name'>                                                                                   
                     <div class='col-xs-6 col-sm-6 col-md-6 col-lg-7'>
                        <div style='float:left; margin-right: 4%;'>
                                <div style='background-image: url(getImage/$imagenSave->id/$updated_timestamp);' class='imageStyle'></div>
                        </div>                          
                        <b id='$constante"."_title'>$article->title</b> 
                            $from
                            $to
                        <p id='$constante"."_snippet'>$article->snippet</p>
                     </div>
                    <div class='col-xs-6 col-sm-6 col-md-6 col-lg-5' style='margin-top: 1%; text-align:right;'>
                        $buttonsCategories
                        <div class='btn-group' style='margin-top: 2%; margin-left:2%;'>
                                <button type='button' class='btn btn-default btn-sm $clasePinnear'><span class='icon-pushpin'></span></i>$pinOrUnpin</button>         
                                <button type='button' data-id=1 class='btn btn-default btn-sm $claseEdit'><i class='fa fa-fw fa-pencil'></i>Edit</button>
                                <button type='button' data-id=1 class='btn btn-default btn-sm $claseDelete'><i class='fa fa-fw fa-times-circle'></i>Delete</button>
                        </div>                    

                        <div class='btn-group-vertical' style='float:right; margin-top:1%; margin-bottom:1%; margin-left:1%;'>
                                <button type='button' class='btn $claseUp'><i class='fa fa-fw fa-caret-up'></i></button>
                                <button type='button' class='btn $claseDown'><i class='fa fa-fw fa-caret-down'></i></button>
                        </div>
                    </div>                                 
        </div>";

        $htmlCategories = "";
        $htmlCategoriesToggle = "";

        $listCategories = Category::orderBy('category','asc')->get();
        foreach($listCategories as $itemCategory){

            $htmlCategories = $htmlCategories . "<div class='row' data-id='$itemCategory->id'>
                                                    <button type='button' style='padding: 0.05rem 0.2rem; margin-left:5%; margin-top:2%; background-color:$itemCategory->color; font-weight:bold;' 
                                                class='btn btn-sm categories disabled'>$itemCategory->category</button>
                                            
                                                <div class='dropdown' style='margin-left:1%; margin-top:1%;'> 
                                                    <button type='button' style='padding: 0.01rem 0.1rem;' 
                                                    class='dropbtn btn btn-default btn-sm'><i class='fa fa-fw fa-pencil'></i></button> 
                                                    
                                                    <div class='dropdown-content'>
                                                        <a class='editColors' style='background-color:red;' href='#'></a>
                                                        <a class='editColors' style='background-color:blue;' href='#'></a>
                                                        <a class='editColors' style='background-color:yellow;' href='#'></a>
                                                        <a class='editColors' style='background-color:hotpink;' href='#'></a>
                                                        <a class='editColors' style='background-color:orange;' href='#'></a>
                                                        <a class='editColors' style='background-color:lime;' href='#'></a>
                                                        <a class='editColors' style='background-color:aqua;' href='#'></a>
                                                    </div>
                                                </div>
                                            </div>";

            $htmlCategoriesToggle = $htmlCategoriesToggle . "<div class='row' data-id='$itemCategory->id'>
                                                <button type='button' style='padding: 0.05rem 0.2rem; margin-left:15%; margin-top:2%; background-color:$itemCategory->color; font-weight:bold;' 
                                                class='btn btn-sm categoriesToggle disabled'>$itemCategory->category</button>

                                                <div class='dropdown' style='margin-left:1%; margin-top:1%;'> 
                                                    <button type='button' style='padding: 0.01rem 0.1rem;' 
                                                    class='dropbtn btn btn-default btn-sm'><i class='fa fa-fw fa-pencil'></i></button> 
                                                    
                                                    <div class='dropdown-content'>
                                                        <a class='editColorsToggle' style='background-color:red;' href='#'></a>
                                                        <a class='editColorsToggle' style='background-color:blue;' href='#'></a>
                                                        <a class='editColorsToggle' style='background-color:yellow;' href='#'></a>
                                                        <a class='editColorsToggle' style='background-color:hotpink;' href='#'></a>
                                                        <a class='editColorsToggle' style='background-color:orange;' href='#'></a>
                                                        <a class='editColorsToggle' style='background-color:lime;' href='#'></a>
                                                        <a class='editColorsToggle' style='background-color:aqua;' href='#'></a>
                                                    </div>
                                                </div>
                                            </div>";

            }//end foreach


    
        return Response::json(array('html' => $html, 'type' => $article->pinned, 'htmlCategories' => $htmlCategories, 'htmlCategoriesToggle' => $htmlCategoriesToggle));       

        $logs = new Log();
        $logs->user_id = 1;
        $logs->action = "Store";
        $logs->data = "aqui va el request";
        $logs->save();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {    
        $article = Article::find($id); 

        $logs = new Log();
        $logs->user_id = 1;
        $logs->action = "Show";
        $logs->data = "la data que viene para show";
        $logs->save();  

        return $article;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //this method is not working
        $logs = new Log();
        $logs->user_id = 1;
        $logs->action = "Edit";
        $logs->data = "la data que viene para edit";
        $logs->save();
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePost(Request $request, $id, $id_image, $name_image)
    {
       
           if ($request->hasFile('image_update')){

                $validatedData = $request->validate([
                    'image_update' => 'required|mimes:jpg,png,jpeg|dimensions:max_width=3000,max_height=3000|max:2000'
                ]);
            }
     
                //update
                //$article = Article::find($request->update_id); 
                $article = Article::find($id); 
   
                $article->url = $request->url_update;
                $article->title = $request->title_update;
                $article->snippet = $request->snippet_update;     
                $claseDiv = "";
                $claseEdit = "";
                $claseDelete = "";
                $clasePinnear = "";
                $claseUp = "";
                $claseDown = "";
                $pinOrUnpin = "";
                $count = 0; 
                $constante = "";  

                    if ($request->has("pinned_update")){
                        $article->pinned = 1;
                        $claseDiv = "rowpinneds";
                        $claseEdit = "editPinned"; 
                        $claseDelete = "deletePinned";  
                        $clasePinnear = "unPinned";
                        $claseUp = "upArticlePinned";
                        $claseDown = "downArticlePinned";
                        $pinOrUnpin = "Unpin";
                        $count = Article::where('pinned',1)->count() + 1;    
                        $constante = "pinned";   
                    }  
                    else{
                        $article->pinned = 0;
                        $claseDiv = "rowavailables";
                        $claseEdit = "editAvailable";
                        $claseDelete = "deleteAvailable";
                        $clasePinnear = "pinAvailable";
                        $claseUp = "upArticleAvailable";
                        $claseDown = "downArticleAvailable";
                        $pinOrUnpin = "Pin";
                        $count = Article::where('pinned',0)->count() + 1;  
                        $constante = "available";  
                    }    
                $article->start_date = $request->startdate_update;
                $article->expire_date = $request->expiredate_update;
                $now = new DateTime();
                //$article->order = $now;
                $article->save();
                
                $updated_timestamp = $article->updated_at->getTimestamp();

                //search Image and update Image
                $image_id_return = 0;
                $image_name_return = "";

                if ($request->hasFile('image_update')){
                    $file = $request->file('image_update');
                    $img = Image::make($file);
                    Response::make($img->encode('jpeg'));

                        //$imageSearch = Imagen::find($request->update_image_id);
                        $imageSearch = Imagen::find($id_image);
                        //if($request->update_image_name != $file->getClientOriginalName())
                        if($name_image != $file->getClientOriginalName())
                        {
                            
                            $imageSearch->article_id = $article->id;
                            $imageSearch->name = $file->getClientOriginalName();
                            $imageSearch->unique_identifier = uniqid();
                            $imageSearch->image = $img;
                            $imageSearch->save(); 
                            $image_id_return = $imageSearch->id; 
                            $image_name_return = $imageSearch->name;                      
                        }       
                        else
                        {
                            //$image_id_return = $request->update_image_id; 
                            //$image_name_return = $request->update_image_name; 
                            $image_id_return = $id_image; 
                            $image_name_return = $name_image; 
                        }         
                    }
                    else{
                            $image_id_return = $id_image; 
                            $image_name_return = $name_image; 
                    }
                $parametro = $article->updated_at->getTimestamp();
                //update or create categories  
                //aqui es donde tengo que bretear  
                $list = Article_Category::where('article_id' , '=', $article->id)->get();
                //aqui esta un error
                    foreach($list as $item){
                        $eliminar = Article_Category::find($item->id);
                        $eliminar->delete();
                    }     

                $categories = explode(",", $request->categories_update);
                for($i = 0; $i < count($categories); ++$i)
                {
                            //random color
                            $color = 'rgb('.rand(100,255).', '.rand(100,255).', '.rand(100,255).')';
                            /*$color = "";
                            $generate = substr(uniqid(),-6);
                            $color = "#".$generate;*/

                            //Add Category                            
                            $category = new Category();
                            //first parametere search if exists the model with that parameters and second parameter are the values in case the model not exists
                            $category = Category::firstOrCreate(['category' => $categories[$i], 'description' => $categories[$i]], 
                                        ['category' => $categories[$i], 'description' => $categories[$i], 'color' => $color]); 
                            $category->save();
                                          
                            //Add Article Category
                            $articlecategory = new Article_Category();
                            //$articlecategory = Article_Category::firstOrCreate(
                               // ['article_id' => $article->id], ['category_id' => $category->id ]); 
                            $articlecategory->article_id = $article->id;
                            $articlecategory->category_id = $category->id;
                            $articlecategory->save();
                }
                
                $from = "";
                $to = "";
                
                if($article->start_date != ""){
                    $from = "<small>From </small> <small id='$constante"."_startdate'>$article->start_date</small>";
                }     
                if($article->expire_date != ""){
                    $to = "<small> to </small> <small id='$constante"."_expiredate'>$article->expire_date</small>";
                }   

                $buttonsCategories = "";
                foreach($article->categories as $categorys) {   
                        $buttonsCategories = $buttonsCategories . "<button type='button' style='padding: 0.05rem 0.2rem; background-color:$categorys->color; font-weight:bold; margin-left:1%;' class='btn btn-sm'>$categorys->category</button>"; 
                }
            
            
            $html = "<div class='row putBorder $claseDiv' data-id='$article->id' data-pos='$updated_timestamp' data-categories='$request->categories_update' data-image='$image_id_return' data-imagename='$image_name_return'>                                                            
                            <div class='col-xs-6 col-sm-6 col-md-6 col-lg-7'>
                                    <div style='float:left; margin-right: 4%;'>
                                        <div style='background-image: url(getImage/$image_id_return/$updated_timestamp);' class='imageStyle'></div>
                                        
                                    </div>                          
                                    <b id='$constante"."_title'>$article->title</b> 
                                    $from
                                    $to
                                    <p id='$constante"."_snippet'>$article->snippet</p>
                            </div>
                            <div class='col-xs-6 col-sm-6 col-md-6 col-lg-5' style='margin-top: 1%; text-align:right;'>
                                    $buttonsCategories
                                    <div class='btn-group' style='margin-top: 2%; margin-left:2%;'>
                                            <button type='button' class='btn btn-default btn-sm $clasePinnear'><span class='icon-pushpin'></span></i>$pinOrUnpin</button>         
                                            <button type='button' class='btn btn-default btn-sm $claseEdit'><i class='fa fa-fw fa-pencil'></i>Edit</button>
                                            <button type='button' class='btn btn-default btn-sm $claseDelete'><i class='fa fa-fw fa-times-circle'></i>Delete</button>
                                    </div>                    

                                    <div class='btn-group-vertical' style='float:right; margin-top:1%; margin-bottom:1%; margin-left:1%;'>
                                            <button type='button' class='btn $claseUp'><i class='fa fa-fw fa-caret-up'></i></button>
                                            <button type='button' class='btn $claseDown'><i class='fa fa-fw fa-caret-down'></i></button>
                                    </div>
                            </div>                                 
                    </div>";

        $htmlCategories = "";
        $htmlCategoriesToggle = "";

        $listCategories = Category::orderBy('category','asc')->get();
        foreach($listCategories as $itemCategory){
            $htmlCategories = $htmlCategories . "<div class='row' data-id='$itemCategory->id'>
                                                <button type='button' style='padding: 0.05rem 0.2rem; margin-left:5%; margin-top:2%; background-color:$itemCategory->color; font-weight:bold;' 
                                                class='btn btn-sm categories disabled'>$itemCategory->category</button>

                                                <div class='dropdown' style='margin-left:1%; margin-top:1%;'> 
                                                    <button type='button' style='padding: 0.01rem 0.1rem;' 
                                                    class='dropbtn btn btn-default btn-sm'><i class='fa fa-fw fa-pencil'></i></button> 
                                                    
                                                    <div class='dropdown-content'>
                                                        <a class='editColors' style='background-color:red;' href='#'></a>
                                                        <a class='editColors' style='background-color:blue;' href='#'></a>
                                                        <a class='editColors' style='background-color:yellow;' href='#'></a>
                                                        <a class='editColors' style='background-color:hotpink;' href='#'></a>
                                                        <a class='editColors' style='background-color:orange;' href='#'></a>
                                                        <a class='editColors' style='background-color:lime;' href='#'></a>
                                                        <a class='editColors' style='background-color:aqua;' href='#'></a>
                                                    </div>
                                                </div>
                                            </div>";

            $htmlCategoriesToggle = $htmlCategoriesToggle . "<div class='row' data-id='$itemCategory->id'>
                                                <button type='button' style='padding: 0.05rem 0.2rem; margin-left:15%; margin-top:2%; background-color:$itemCategory->color; font-weight:bold;' 
                                                class='btn btn-sm categoriesToggle disabled'>$itemCategory->category</button>

                                                <div class='dropdown' style='margin-left:1%; margin-top:1%;'> 
                                                    <button type='button' style='padding: 0.01rem 0.1rem;' 
                                                    class='dropbtn btn btn-default btn-sm'><i class='fa fa-fw fa-pencil'></i></button> 
                                                    
                                                    <div class='dropdown-content'>
                                                        <a class='editColorsToggle' style='background-color:red;' href='#'></a>
                                                        <a class='editColorsToggle' style='background-color:blue;' href='#'></a>
                                                        <a class='editColorsToggle' style='background-color:yellow;' href='#'></a>
                                                        <a class='editColorsToggle' style='background-color:hotpink;' href='#'></a>
                                                        <a class='editColorsToggle' style='background-color:orange;' href='#'></a>
                                                        <a class='editColorsToggle' style='background-color:lime;' href='#'></a>
                                                        <a class='editColorsToggle' style='background-color:aqua;' href='#'></a>
                                                    </div>
                                                </div>
                                            </div>";
            }                    
   
            $logs = new Log();
            $logs->user_id = 1;
            $logs->action = "Update";
            $logs->data = "la data que viene para update";
            $logs->save();

        return Response::json(array('html' => $html, 'type' => $article->pinned, 'htmlCategories' => $htmlCategories, 'htmlCategoriesToggle' => $htmlCategoriesToggle));     
    }

    public function updateType(Request $request, $id, $type)
    {
        
        $claseDiv = "";
        $claseEdit = "";
        $claseDelete = "";
        $clasePinnear = "";
        $claseUp = "";
        $claseDown = "";
        $pinOrUnpin = "";
        $count = 0; 
        $constante = "";  

            if ($type == "1"){
                $claseDiv = "rowpinneds";
                $claseEdit = "editPinned"; 
                $claseDelete = "deletePinned";  
                $clasePinnear = "unPinned";
                $claseUp = "upArticlePinned";
                $claseDown = "downArticlePinned";
                $pinOrUnpin = "Unpin";
            }  
            else{
                $claseDiv = "rowavailables";
                $claseEdit = "editAvailable";
                $claseDelete = "deleteAvailable";
                $clasePinnear = "pinAvailable";
                $claseUp = "upArticleAvailable";
                $claseDown = "downArticleAvailable";
                $pinOrUnpin = "Pin";
            }    
        
        $article = Article::find($id); 

        $article->pinned = $type;

        $article->save();

        $updated_timestamp = $article->updated_at->getTimestamp();
        
        $varCategories =  "";
        $numComas = 0;                
        $buttonsCategories = "";
             foreach($article->categories as $categorys) {   
                    
                    if($numComas == 0){
                        $varCategories = $varCategories . "$categorys->category";
                        
                    }
                    else{
                        $varCategories = $varCategories. "," . "$categorys->category";
                    }
                    $numComas++;   

                    $buttonsCategories = $buttonsCategories . "<button type='button' style='padding: 0.05rem 0.2rem; background-color:$categorys->color; font-weight:bold; margin-left:1%;' class='btn btn-sm'>$categorys->category</button>";                                                                                                          
                }

        $image_id = $article->image->id;
        $image_name = $article->image->name;

        $from = "";
        $to = "";                
        if($article->start_date != ""){
            $from = "<small>From </small> <small>$article->start_date</small>";
        }     
        if($article->expire_date != ""){
            $to = "<small> to </small> <small>$article->expire_date</small>";
        }  

        $html = "<div class='row putBorder $claseDiv' data-id='$article->id' data-pos='$updated_timestamp' data-categories='$varCategories' data-image='$image_id' data-imagename='$image_name'>                                                            
                            <div class='col-xs-6 col-sm-6 col-md-6 col-lg-7'>
                                    <div style='float:left; margin-right: 4%;'>
                                        <div style='background-image: url(getImage/$image_id/$updated_timestamp);' class='imageStyle'></div>
                                        
                                    </div>                          
                                    <b>$article->title</b> 
                                    $from
                                    $to
                                    <p>$article->snippet</p>
                            </div>
                            <div class='col-xs-6 col-sm-6 col-md-6 col-lg-5' style='margin-top: 1%; text-align:right;'>
                                    $buttonsCategories
                                    <div class='btn-group' style='margin-top: 2%; margin-left:2%;'>
                                            <button type='button' class='btn btn-default btn-sm $clasePinnear'><span class='icon-pushpin'></span></i>$pinOrUnpin</button>         
                                            <button type='button' class='btn btn-default btn-sm $claseEdit'><i class='fa fa-fw fa-pencil'></i>Edit</button>
                                            <button type='button' class='btn btn-default btn-sm $claseDelete'><i class='fa fa-fw fa-times-circle'></i>Delete</button>
                                    </div>                    

                                    <div class='btn-group-vertical' style='float:right; margin-top:1%; margin-bottom:1%; margin-left:1%;'>
                                            <button type='button' class='btn $claseUp'><i class='fa fa-fw fa-caret-up'></i></button>
                                            <button type='button' class='btn $claseDown'><i class='fa fa-fw fa-caret-down'></i></button>
                                    </div>
                            </div>                                 
                    </div>";
   
                    $logs = new Log();
                    $logs->user_id = 1;
                    $logs->action = "Update type";
                    $logs->data = "la data que viene para update Type";
                    $logs->save();

        return Response::json(array('html' => $html));   
    }

    public function updatePosition(Request $request, $idUp, $idDown)
    {
        $articleUp = Article::find($idUp); 
        $articleDown = Article::find($idDown);
        
        $orderUp = $articleUp->order;
        $orderDown = $articleDown->order;

        $articleUp->order = $orderDown;
        $articleDown->order = $orderUp;
        
        $articleUp->save();
        $articleDown->save();

        $logs = new Log();
        $logs->user_id = 1;
        $logs->action = "Update Position";
        $logs->data = "la data que viene para update position";
        $logs->save();
        
        return Response::json(array('html' => "si", 'type' => "no")); 
    }

    public function updateColor(Request $request, $idCategory, $newColor,  $categories = "")
    {
    
        $category = Category::find($idCategory);
        $category->color = $newColor;
        $category->save();   
            

        $now = new DateTime();
        if($categories == ""){

                $pinneds = Article::with('categories')
                        ->where('pinned',1)
                        ->orderBy('order', 'desc')
                        ->take(10)
                        ->get();

                $availables = Article::with('categories')
                        ->where('pinned',0)
                        ->orderBy('order', 'desc')
                        ->take(10)
                        ->get();

        //Pinneds with dates filter
            /*    $firstPinned = Article::with('categories')
                                ->where('pinned',1)
                                ->where([['start_date', '<=' , $now], ['expire_date', '>=', $now]])->orWhere(function ($q) {
                                        $q->whereNull('start_date')->whereNull('expire_date')->where('pinned', 1);
                                        });

                $secondPinned = Article::with('categories')
                                ->where('pinned',1)  
                                ->where([['start_date', '<=' , $now], ['expire_date', '>=', $now]])->orWhere(function ($q) use($now){
                                    $q->whereNull('start_date')->where('expire_date', '>=', $now)->where('pinned', 1);
                                    });    
                                
                $thirdPinned = Article::with('categories')
                                ->where('pinned',1) 
                                ->where([['start_date', '<=' , $now], ['expire_date', '>=', $now]])->orWhere(function ($q) use($now){
                                    $q->whereNull('expire_date')->where('start_date', '<=', $now)->where('pinned', 1);
                                    }); 

                $pinneds = $firstPinned->union($secondPinned)->union($thirdPinned)
                                ->orderBy('order', 'desc')
                                ->take(10)
                                ->get();
            */
        //Availables with dates filter
            /*    $firstAvailable = Article::with('categories')
                    ->where('pinned',0)
                    ->where([['start_date', '<=' , $now], ['expire_date', '>=', $now]])->orWhere(function ($q) {
                        $q->whereNull('start_date')->whereNull('expire_date')->where('pinned', 0);
                        });

                $secondAvailable = Article::with('categories')
                                ->where('pinned',0)  
                                ->where([['start_date', '<=' , $now], ['expire_date', '>=', $now]])->orWhere(function ($q) use($now){
                                    $q->whereNull('start_date')->where('expire_date', '>=', $now)->where('pinned', 0);
                                    });    
                                
                $thirdAvailable = Article::with('categories')
                                ->where('pinned',0) 
                                ->where([['start_date', '<=' , $now], ['expire_date', '>=', $now]])->orWhere(function ($q) use($now){
                                    $q->whereNull('expire_date')->where('start_date', '<=', $now)->where('pinned', 0);
                                    }); 

                $availables = $firstAvailable->union($secondAvailable)->union($thirdAvailable)
                                ->orderBy('order', 'desc')
                                ->take(10)
                                ->get();
            */                    
        }

        else{                                

            $categorys = explode(",", $categories);
            for($i = 0; $i < count($categorys); ++$i){
                $categoriesSelected[$i] = $categorys[$i];
            }

                //Pinneds with dates filter
                    /*   $firstPinned = Article::whereHas('categories', function($q) use ($categoriesSelected)
                            {
                                    $q->whereIn('category', $categoriesSelected);
                            })->where([['start_date', '<=' , $now], ['expire_date', '>=', $now]])
                                ->where('pinned',1);

                            $secondPinned = Article::whereHas('categories', function($q) use ($categoriesSelected)
                            {
                                $q->whereIn('category', $categoriesSelected);
                            })->whereNull('start_date')->whereNull('expire_date')
                            ->where('pinned',1);  
                        
                            $thirdPinned = Article::whereHas('categories', function($q) use ($categoriesSelected)
                                    {
                                        $q->whereIn('category', $categoriesSelected);
                                    })->whereNull('start_date')->where('expire_date', '>=', $now)
                                    ->where('pinned',1); 
                            
                            $fourthPinned = Article::whereHas('categories', function($q) use ($categoriesSelected)
                                    {
                                        $q->whereIn('category', $categoriesSelected);
                                    })->whereNull('expire_date')->where('start_date', '<=', $now)
                                    ->where('pinned',1);  

                            $pinneds = $firstPinned->union($secondPinned)->union($thirdPinned)->union($fourthPinned)
                            ->orderBy('order', 'desc')
                            ->take(10)->get(); 
                        */          
                    
                //Availables with dates filter
                        /*  $firstAvailable = Article::whereHas('categories', function($q) use ($categoriesSelected)
                            {
                                    $q->whereIn('category', $categoriesSelected);
                            })->where([['start_date', '<=' , $now], ['expire_date', '>=', $now]])
                                ->where('pinned',0);

                            $secondAvailable = Article::whereHas('categories', function($q) use ($categoriesSelected)
                            {
                                $q->whereIn('category', $categoriesSelected);
                            })->whereNull('start_date')->whereNull('expire_date')
                            ->where('pinned',0);  
                        
                            $thirdAvailable = Article::whereHas('categories', function($q) use ($categoriesSelected)
                                    {
                                        $q->whereIn('category', $categoriesSelected);
                                    })->whereNull('start_date')->where('expire_date', '>=', $now)
                                    ->where('pinned',0); 
                            
                            $fourthAvailable = Article::whereHas('categories', function($q) use ($categoriesSelected)
                                    {
                                        $q->whereIn('category', $categoriesSelected);
                                    })->whereNull('expire_date')->where('start_date', '<=', $now)
                                    ->where('pinned',0);  

                            $availables = $firstAvailable->union($secondAvailable)->union($thirdAvailable)->union($fourthAvailable)
                            ->orderBy('order', 'desc')
                            ->take(10)->get(); 
                    */

              
        $pinneds = Article::whereHas('categories', function($q) use ($categoriesSelected)
                        {
                                $q->whereIn('category', $categoriesSelected);
                        })->where('pinned',1)
                        ->orderBy('order', 'desc')
                        ->take(10)
                        ->get();

            $availables = Article::whereHas('categories', function($q) use ($categoriesSelected)
                        {
                                $q->whereIn('category', $categoriesSelected);
                        })->where('pinned',0)
                        ->orderBy('order', 'desc')
                        ->take(10)
                        ->get(); 
        }

          


                                        
        $htmlPinneds = "";
        $htmlAvailables = ""; 

        foreach($pinneds as $pinned){
            $updated_timestamp_p = $pinned->updated_at->getTimestamp();
         
            $varCategoriesP =  "";
            $numComasP = 0;                
            $buttonsCategoriesP = "";
                 foreach($pinned->categories as $categorys) {   
                        
                        if($numComasP == 0){
                            $varCategoriesP = $varCategoriesP . "$categorys->category";
                            
                        }
                        else{
                            $varCategoriesP = $varCategoriesP. "," . "$categorys->category";
                        }
                        $numComasP++;   

                        $buttonsCategoriesP = $buttonsCategoriesP . "<button type='button' style='padding: 0.05rem 0.2rem; background-color:$categorys->color; font-weight:bold; margin-left:1%;' class='btn btn-sm'>$categorys->category</button>";                                                                                                          
                    }

            $image_idP = $pinned->image->id;
            $image_nameP = $pinned->image->name;

            $from = "";
            $to = "";                
            if($pinned->start_date != ""){
                $from = "<small>From </small> <small>$pinned->start_date</small>";
            }     
            if($pinned->expire_date != ""){
                $to = "<small> to </small> <small>$pinned->expire_date</small>";
            }   

            $htmlPinneds = $htmlPinneds . "<div class='row putBorder rowpinneds' data-id='$pinned->id' data-pos='$updated_timestamp_p' data-categories='$varCategoriesP' data-image='$image_idP' data-imagename='$image_nameP'>                                                                                   
                    <div class='col-xs-6 col-sm-6 col-md-6 col-lg-7'>
                    <div style='float:left; margin-right: 4%;'>
                            <div style='background-image: url(getImage/$image_idP/$updated_timestamp_p);' class='imageStyle'></div>
                    </div>                          
                        <b>$pinned->title</b> 
                        $from
                        $to
                        <p>$pinned->snippet</p>
                    </div>
                <div class='col-xs-6 col-sm-6 col-md-6 col-lg-5' style='margin-top:1%; text-align:right;'>
                    $buttonsCategoriesP
                    <div class='btn-group' style='margin-top: 2%; margin-left:2%;'>
                            <button type='button' class='btn btn-default btn-sm unPinned'><span class='icon-pushpin'></span></i>Unpin</button>         
                            <button type='button' class='btn btn-default btn-sm editPinned'><i class='fa fa-fw fa-pencil'></i>Edit</button>
                            <button type='button' class='btn btn-default btn-sm deletePinned'><i class='fa fa-fw fa-times-circle'></i>Delete</button>
                    </div>                    

                    <div class='btn-group-vertical' style='float:right; margin-top:1%; margin-bottom:1%; margin-left:1%;'>
                            <button type='button' class='btn upArticlePinned'><i class='fa fa-fw fa-caret-up'></i></button>
                            <button type='button' class='btn downArticlePinned'><i class='fa fa-fw fa-caret-down'></i></button>
                    </div>
                </div>                                 
        </div>"; 
        }

        foreach($availables as $available){
            $updated_timestamp_a = $available->updated_at->getTimestamp();

            $varCategoriesA =  "";
            $numComasA = 0;
            $buttonsCategoriesA = "";

                 foreach($available->categories as $categorys) {   
            
                        if($numComasA == 0){
                            $varCategoriesA = $varCategoriesA . "$categorys->category";
                        }
                        else{
                            $varCategoriesA = $varCategoriesA. "," . "$categorys->category";
                        }
                        $numComasA++; 

                        $buttonsCategoriesA = $buttonsCategoriesA . "<button type='button' style='padding: 0.05rem 0.2rem; background-color:$categorys->color; font-weight:bold; margin-left:1%;' class='btn btn-sm'>$categorys->category</button> "; 
                    }

            $image_idA = $available->image->id;
            $image_nameA = $available->image->name;

            $from = "";
            $to = "";                
            if($available->start_date != ""){
                $from = "<small>From </small> <small>$available->start_date</small>";
            }     
            if($available->expire_date != ""){
                $to = "<small> to </small> <small>$available->expire_date</small>";
            }                      

            $htmlAvailables = $htmlAvailables . "<div class='row putBorder rowavailables' data-id='$available->id' data-pos='$updated_timestamp_a' data-categories='$varCategoriesA' data-image='$image_idA' data-imagename='$image_nameA'>                                                                                   
                    <div class='col-xs-6 col-sm-6 col-md-6 col-lg-7'>
                    <div style='float:left; margin-right: 4%;'>
                            <div style='background-image: url(getImage/$image_idA/$updated_timestamp_a);' class='imageStyle'></div>
                    </div>                          
                        <b>$available->title</b> 
                        $from 
                        $to
                        <p>$available->snippet</p>
                    </div>
                <div class='col-xs-6 col-sm-6 col-md-6 col-lg-5' style='margin-top:1%; text-align:right;'>
                    $buttonsCategoriesA
                    <div class='btn-group' style='margin-top: 2%; margin-left:2%;'>
                            <button type='button' class='btn btn-default btn-sm pinAvailable'><span class='icon-pushpin'></span></i>Unpin</button>         
                            <button type='button' class='btn btn-default btn-sm editAvailable'><i class='fa fa-fw fa-pencil'></i>Edit</button>
                            <button type='button' class='btn btn-default btn-sm deleteAvailable'><i class='fa fa-fw fa-times-circle'></i>Delete</button>
                    </div>   

                    <div class='btn-group-vertical' style='float:right; margin-top:1%; margin-bottom:1%; margin-left:1%;'>
                            <button type='button' class='btn upArticleAvailable'><i class='fa fa-fw fa-caret-up'></i></button>
                            <button type='button' class='btn downArticleAvailable'><i class='fa fa-fw fa-caret-down'></i></button>
                    </div>
                </div>                                 
        </div>"; 
        }
    
    

        $htmlCategories = "";    
        $htmlCategoriesToggle = "";   

        $listCategories = Category::orderBy('category','asc')->get();
        foreach($listCategories as $itemCategory){

            $activeOrDisabled = "disabled";
            if($categories == "")
            {
                $activeOrDisabled = "disabled";
            }
            else{
                $categoriesActive = explode(",", $categories);
                for($i = 0; $i < count($categoriesActive); ++$i){
                    if($categoriesActive[$i] == $itemCategory->category)
                        $activeOrDisabled = "active";
                        break;
                }
            }

        $htmlCategories = $htmlCategories . "<div class='row' data-id='$itemCategory->id'>
                                                <button type='button' style='padding: 0.05rem 0.2rem; margin-left:5%; margin-top:2%; background-color:$itemCategory->color; font-weight:bold;' 
                                                class='btn btn-sm categories $activeOrDisabled'>$itemCategory->category</button>

                                                <div class='dropdown' style='margin-left:1%; margin-top:1%;'> 
                                                    <button type='button' style='padding: 0.01rem 0.1rem;' 
                                                    class='dropbtn btn btn-default btn-sm'><i class='fa fa-fw fa-pencil'></i></button> 
                                                    
                                                    <div class='dropdown-content'>
                                                        <a class='editColors' style='background-color:red;' href='#'></a>
                                                        <a class='editColors' style='background-color:blue;' href='#'></a>
                                                        <a class='editColors' style='background-color:yellow;' href='#'></a>
                                                        <a class='editColors' style='background-color:hotpink;' href='#'></a>
                                                        <a class='editColors' style='background-color:orange;' href='#'></a>
                                                        <a class='editColors' style='background-color:lime;' href='#'></a>
                                                        <a class='editColors' style='background-color:aqua;' href='#'></a>
                                                    </div>
                                                </div>
                                            </div>";
        
        $htmlCategoriesToggle = $htmlCategoriesToggle . "<div class='row' data-id='$itemCategory->id'>
                                                <button type='button' style='padding: 0.05rem 0.2rem; margin-left:15%; margin-top:2%; background-color:$itemCategory->color; font-weight:bold;' 
                                                class='btn btn-sm categoriesToggle $activeOrDisabled'>$itemCategory->category</button>

                                                <div class='dropdown' style='margin-left:1%; margin-top:1%;'> 
                                                    <button type='button' style='padding: 0.01rem 0.1rem;' 
                                                    class='dropbtn btn btn-default btn-sm'><i class='fa fa-fw fa-pencil'></i></button> 
                                                    
                                                    <div class='dropdown-content'>
                                                        <a class='editColorsToggle' style='background-color:red;' href='#'></a>
                                                        <a class='editColorsToggle' style='background-color:blue;' href='#'></a>
                                                        <a class='editColorsToggle' style='background-color:yellow;' href='#'></a>
                                                        <a class='editColorsToggle' style='background-color:hotpink;' href='#'></a>
                                                        <a class='editColorsToggle' style='background-color:orange;' href='#'></a>
                                                        <a class='editColorsToggle' style='background-color:lime;' href='#'></a>
                                                        <a class='editColorsToggle' style='background-color:aqua;' href='#'></a>
                                                    </div>
                                                </div>
                                            </div>";
            }

            $logs = new Log();
            $logs->user_id = 1;
            $logs->action = "Update color";
            $logs->data = "la data que viene para update color";
            $logs->save();
            
            return Response::json(array('htmlCategories' => $htmlCategories, 'htmlPinneds' => $htmlPinneds, 'htmlAvailables' => $htmlAvailables, 'htmlCategoriesToggle' => $htmlCategoriesToggle)); 

    }
    public function update(Request $request, $id)
    {
        return Response::json(array('html' => '', 'type' => $article->pinned)); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    
    public function destroy($id)
    {
        $listCategories = Article_Category::where('article_id' , '=', $id)->delete();
        $listImages = Imagen::where('article_id' , '=', $id)->delete();
                            

        $article = Article::destroy($id); 

        $logs = new Log();
        $logs->user_id = 1;
        $logs->action = "Destroy";
        $logs->data = "la data que viene para destroy";
        $logs->save();

        return Response::json(array('html' => 'si', 'type' => 'no', 'article' => $article)); 
    }

    public function searchArticles($name)
    {
        $delete = "eliminar this";
            $parameter = "%$name%";
            $articles = Article::where('title','like',$parameter)->get();
            $amount = Article::where('title','like',$parameter)->count();
            $html = "There are no records with the word: ".$name." Please change the word.";
            $status = "error";

            if($amount > 0){
            $status = "success";
            $html = "<div class='row'> 
            <label class='control-label'>Top Results</label>
        </div> ";

            foreach($articles as $article){
                $updated_timestamp = $article->updated_at->getTimestamp();
                $image_id = $article->image->id;

                        $html = $html . "<div style = 'border: gray 1px solid;' class='row' data-id='$article->id'>                                                                                   
                        <div class='col-xs-10 col-sm-10 col-md-10 col-lg-10'>
                            <div style='float:left; margin-right: 4%;'>
                                    <div style='background-image: url(getImage/$image_id/$updated_timestamp);' class='imageStyle'></div>
                            </div>                          
                            <b>$article->title</b> 

                            <p>$article->snippet</p>
                        </div>                             
                        <div class='col-xs-2 col-sm-2 col-md-2 col-lg-2'>

                            <button type='button' style='padding: 0.05rem 0.2rem;' class='btn btn-info btn-sm setFirst'>Set as First</button>                                       
                        </div>  
                </div>";
            }
        }

        $logs = new Log();
        $logs->user_id = 1;
        $logs->action = "searchArticles";
        $logs->data = "la data que viene para searchArticles";
        $logs->save();

            return Response::json(array('articles' => $html, 'status' => $status)); 
    }

    public function setFirst(Request $request, $idArticle){
        $article = Article::find($idArticle);
        $now = new DateTime();
        $article->order = $now;
        $article->save();
        $updated_timestamp = $article->updated_at->getTimestamp();

        $claseDiv = "";
        $claseEdit = "";
        $claseDelete = "";
        $clasePinnear = "";
        $claseUp = "";
        $claseDown = "";
        $pinOrUnpin = "";
          
            if ($article->pinned == 1){
                
                $claseDiv = "rowpinneds";
                $claseEdit = "editPinned";
                $claseDelete = "deletePinned";
                $clasePinnear = "unPinned";
                $claseUp = "upArticlePinned";
                $claseDown = "downArticlePinned";
                $pinOrUnpin = "Unpin";
                 
            }  
            else{
        
                $claseDiv = "rowavailables";
                $claseEdit = "editAvailable";
                $claseDelete = "deleteAvailable";
                $clasePinnear = "pinAvailable";
                $claseUp = "upArticleAvailable";
                $claseDown = "downArticleAvailable";
                $pinOrUnpin = "Pin";
        
            }    

            $varCategories =  "";
            $numComas = 0;                
            $buttonsCategories = "";
                 foreach($article->categories as $categorys) {   
                        
                        if($numComas == 0){
                            $varCategories = $varCategories . "$categorys->category";
                            
                        }
                        else{
                            $varCategories = $varCategories. "," . "$categorys->category";
                        }
                        $numComas++;   

                        $buttonsCategories = $buttonsCategories . "<button type='button' style='padding: 0.05rem 0.2rem; background-color:$categorys->color; font-weight:bold; margin-left:1%;' class='btn btn-sm'>$categorys->category</button>";                                                                                                          
                    }

        $image_id = $article->image->id;
        $image_name = $article->image->name;

        $from = "";
        $to = "";                
        if($article->start_date != ""){
            $from = "<small>From </small> <small>$article->start_date</small>";
        }     
        if($article->expire_date != ""){
            $to = "<small> to </small> <small>$article->expire_date</small>";
        }   

        $html = "<div class='row putBorder $claseDiv' data-id='$article->id' data-pos='$updated_timestamp' data-categories='$varCategories' data-image='$image_id' data-imagename='$image_name'>                                                                                   
                    <div class='col-xs-6 col-sm-6 col-md-6 col-lg-7'>
                    <div style='float:left; margin-right: 4%;'>
                            <div style='background-image: url(getImage/$image_id/$updated_timestamp);' class='imageStyle'></div>
                    </div>                          
                    <b>$article->title</b> 
                        $from
                        $to
                    <p>$article->snippet</p>
                    </div>
                <div class='col-xs-6 col-sm-6 col-md-6 col-lg-5' style='margin-top: 1%; text-align:right;'>
                    $buttonsCategories
                    <div class='btn-group' style='margin-top: 2%; margin-left:2%;'>
                            <button type='button' class='btn btn-default btn-sm $clasePinnear'><span class='icon-pushpin'></span></i>$pinOrUnpin</button>         
                            <button type='button' data-id=1 class='btn btn-default btn-sm $claseEdit'><i class='fa fa-fw fa-pencil'></i>Edit</button>
                            <button type='button' data-id=1 class='btn btn-default btn-sm $claseDelete'><i class='fa fa-fw fa-times-circle'></i>Delete</button>
                    </div>                    

                    <div class='btn-group-vertical' style='float:right; margin-top:1%; margin-bottom:1%; margin-left:1%;'>
                            <button type='button' class='btn $claseUp'><i class='fa fa-fw fa-caret-up'></i></button>
                            <button type='button' class='btn $claseDown'><i class='fa fa-fw fa-caret-down'></i></button>
                    </div>
                </div>                                 
            </div>";

            $logs = new Log();
            $logs->user_id = 1;
            $logs->action = "Search articles";
            $logs->data = "la data que viene para search articles";
            $logs->save();

        return Response::json(array('html' => $html, 'pinned' => $article->pinned));  
    }

    public function saveFooter(Request $request){
        
        $contentFooter = $request->contentFooter;        
        $footer = Footer::find(1);
        $footer->footerText = $contentFooter;
        $footer->save();

        $logs = new Log();
        $logs->user_id = 1;
        $logs->action = "Save Footer";
        $logs->data = "la data que viene para save footer";
        $logs->save();

        return Response::json(array('message' => 'The Footer text was updated'));  
    }

    //this method is generic to save logs, just pass parameter user_id, action and data

    public function generateLogs(Request $request){

        $logs = new Log();
        $logs->user_id = $request->user_id;
        $logs->action = $request->action;
        $logs->data = $request->datos;
        $logs->save();
        //listo
        

        return Response::json(array('content' => $logs, 'stataus' => 'successfull'));
    }
}
