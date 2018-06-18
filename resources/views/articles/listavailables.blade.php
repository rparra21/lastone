<?php 
      $varCategoriesA =  "";
      $numComasA = 0;
?> 
      @foreach($available->categories as $categorys)            
                  <?php 
                        if($numComasA == 0){
                              $varCategoriesA = $varCategoriesA . "$categorys->category";
                        }
                        else{
                              $varCategoriesA = $varCategoriesA. "," . "$categorys->category";
                        }
                        $numComasA++; 
                  ?>   
                                                                  
      @endforeach
                   
                    
      <div class="row putBorder rowavailables" data-id="{{$available->id}}" data-pos="{{$available->order}}" data-categories="{{$varCategoriesA}}" data-image="{{$available->image->id}}" data-imagename="{{$available->image->name}}">                                                                                                               
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-7">
                  <div style="float:left; margin-right: 4%;">
                        <div style="background-image: url(/getImage/{{$available->image->id}}/listavailables);" class="imageStyle"></div>
                  </div>
                        
                  <b id="available_title">{{ $available->title }}</b> 
                        @if($available->start_date != "")
                              <small>From </small> <small id="available_startdate">{{ $available->start_date }}</small> 
                        @endif 
                        @if($available->expire_date != "")    
                              <small> to </small> <small id="available_expiredate"> {{ $available->expire_date }}</small>
                        @endif 
                  <p id="available_snippet">{{ $available->snippet }} </p>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-5" style="margin-top:1%; text-align:right;">
                  @foreach($available->categories as $categorys)                
                        <button type="button" style="padding: 0.05rem 0.2rem; background-color:{{$categorys->color}}; font-weight:bold;" class="btn btn-sm">{{$categorys->category}}</button>
                  @endforeach  
                  <div class="btn-group" style="margin-top: 2%; margin-left:2%;">
                        <button type="button" class="btn btn-default btn-sm pinAvailable"><span class="icon-pushpin"></span></i> Pin</button>         
                        <button type="button" data-id="{{$posAvailables}}" class="btn btn-default btn-sm editAvailable"><i class="fa fa-fw fa-pencil"></i>Edit</button>
                        <button type="button" data-id="{{$posAvailables}}" class="btn btn-default btn-sm deleteAvailable"><i class="fa fa-fw fa-times-circle"></i>Delete</button>
                  </div>    
  
                  <div class="btn-group-vertical" style="float:right; margin-top:1%; margin-bottom:1%; margin-left:1%;">
                        <button type="submit" class="btn upArticleAvailable"><i class="fa fa-fw fa-caret-up"></i></button>
                        <button type="button" class="btn downArticleAvailable"><i class="fa fa-fw fa-caret-down"></i></button>
                  </div>
            </div>                                 
      </div>  

    
                                                                                   