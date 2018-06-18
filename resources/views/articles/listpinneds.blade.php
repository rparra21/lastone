<?php 
      $varCategoriesP =  "";
      $numComasP = 0;
?> 
      @foreach($pinned->categories as $categorys)    
                  <?php 
                        if($numComasP == 0){
                              $varCategoriesP = $varCategoriesP . "$categorys->category";
                        }
                        else{
                              $varCategoriesP = $varCategoriesP. "," . "$categorys->category";
                        }
                        $numComasP++; 
                  ?> 
                                                                  
      @endforeach
                
            
            
            
      <div class="row putBorder rowpinneds" data-id="{{$pinned->id}}" data-pos="{{$pinned->order}}" data-categories="{{$varCategoriesP}}" data-image="{{$pinned->image->id}}" data-imagename="{{$pinned->image->name}}">             
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-7">
                  <div style="float:left; margin-right: 4%;">
                        <div style="background-image: url(/getImage/{{ $pinned->image->id }}/listpinneds);" class="imageStyle"></div>
                  </div>
                              
                  <b id="pinned_title">{{ $pinned->title }}</b> 
                        @if($pinned->start_date != "")
                              <small>From </small> <small id="pinned_startdate">{{ $pinned->start_date }}</small> 
                        @endif
                        @if($pinned->expire_date != "")
                              <small> to </small> <small id="pinned_expiredate">{{ $pinned->expire_date }}</small>
                        @endif
                  <p id="pinned_snippet">{{ $pinned->snippet }} </p>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-5" style="margin-top:1%; text-align:right;">     
                  @foreach($pinned->categories as $categorys)                
                        <button type="button" style="padding: 0.05rem 0.2rem; background-color:{{$categorys->color}}; font-weight:bold;" class="btn btn-sm">{{$categorys->category}}</button>                        
                  @endforeach                    
     
                  <div class="btn-group" style="margin-top:2%; margin-left:2%;">
                        <button type="button" class="btn btn-default btn-sm unPinned"><span class="icon-pushpin"></span></i> Unpin</button>         
                        <button type="button" data-id="{{$posPinned}}" class="btn btn-default btn-sm editPinned"><i class="fa fa-fw fa-pencil"></i>Edit</button>
                        <button type="button" data-id="{{$posPinned}}" class="btn btn-default btn-sm deletePinned"><i class="fa fa-fw fa-times-circle"></i>Delete</button>
                  </div>                    

                  <div class="btn-group-vertical" style="float:right; margin-top:1%; margin-bottom:1%; margin-left:1%;">
                        <button type="button" class="btn upArticlePinned"><i class="fa fa-fw fa-caret-up"></i></button>
                        <button type="button" class="btn downArticlePinned"><i class="fa fa-fw fa-caret-down"></i></button>
                  </div>
            </div>                                 
      </div>                               
