<link href="{{ asset('css/widget.css') }}" rel="stylesheet">

<link href="{{ asset('flexboxgrid/flexboxgrid.css') }}" rel="stylesheet">


<div class="rdgWidgetNewsArticles">
    <div class="container-fluid">    
                                  
                   <div class="row">
                       
                        @foreach($articles as $article)       
                            <?php 
                                    $order = strtotime($article->order);
                            ?>                                 
                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"> 
                                         
                                            <a target="_blank" href="{{$article->url}}" class="nullStyle">                            
                                                <div style="margin-top:10%; background-image: url(http://{{$server}}/getImage/{{$article->id}}/{{$order}})" class="rdgWidgetImageStyle"></div>
                                                <b class="titleWidget">{{$article->title}}</b> 
                                                    @if($snippet == 'snippet')
                                                        <br>
                                                        <span class="snippetWidget">{{$article->snippet}}</span>
                                                    @endif    
                                            </a>
                                                                                                                                                                
                                </div>                                                                                   
                        @endforeach                                                                               
                      
            </div>
            <div class="row" style="float:right;">
            @foreach($footer as $item)   
   
            {!! $item->footerText !!}                
 
            @endforeach 
            </div> 
    </div>
</div>    