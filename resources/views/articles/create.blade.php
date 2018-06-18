<div class="modal fade" id="modalAdd" role="dialog">
      <div class="modal-dialog">    
            <!-- Modal content-->
            <div class="modal-content">
            
                       
                  <div class="modal-header">
                 
                        <h4 class="modal-title">Add New Article</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>         
                  </div>
                  <div class="modal-body">
                        <form id="formAdd" name="formAdd" class="form-horizontal" enctype="multipart/form-data" data-toggle="validator">

                              {!! csrf_field() !!}
                              <div class="form-group">
                                 <div class="row">
                                      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <label class="control-label" for="url">URL:</label>
                                      </div>                     
                                      <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">      
                                                <input type="url" name="url" class="form-control" id="url" placeholder="Please add the URL of the article" maxlength="255" required>                                                                                         
                                      </div>  
                                      
                                  </div> 
                              </div>
                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <label class="control-label" for="title">Title:</label>
                                      </div>
                                      <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                            <input type="text" name="title" class="form-control" id="title" placeholder="Please add the title of the article" maxlength="100" required>
                                      </div>  
                                  </div> 
                              </div>  
                              <div class="form-group">
                                 <div class="row">
                                      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <label class="control-label" for="snippet">Snippet:</label>
                                      </div>
                                      <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                            <textarea class="form-control" name="snippet" id="snippet" placeholder="Enter a short description" maxlength="200" required></textarea>
                                      </div>  
                                  </div> 
                              </div>  
                              <div class="form-group">
                                 <div class="row">
                                      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <label class="control-label" for="image">Image:</label>
                                      </div>
                                      <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                      <input type="file" name="image" id="image" accept=".png, .jpg, .jpeg" required/>                              
                                      </div>  
                                  </div> 
                              </div>  
                              <div class="form-group">
                                 <div class="row">
                                      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <label class="control-label" for="categories">Categories:</label>
                                      </div>
                                      <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                            <div class="ui-front">
                                                <input type="text" name="categories" id="categories" class="tagBorder">
                                            </div>
                                            <div id="errorCategories" style="color:red"> <span class="help-block with-errors">Add Category</span> </div>
                                      </div> 
                                  </div> 
                              </div>       
                              <div class="form-group">
                                 <div class="row">
                                      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <label class="control-label" for="pinned">Pinned:</label>
                                      </div>
                                      <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                            <input type="checkbox" class="styleCheck" name="pinned" id="pinned">
                                      </div>  
                                  </div> 
                              </div>   
                              <div class="form-group">
                                 <div class="row">
                                      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <label class="control-label" for="start_date">Start Date: (Optional)</label>
                                      </div>
                                      <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                            <input type="date" class="form-control" name="startdate" id="startdate">
                                      </div>  
                                  </div> 
                              </div>  
                              <div class="form-group">
                                 <div class="row">
                                      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <label class="control-label" for="expire_date">Expire Date: (Optional)</label>
                                      </div>
                                      <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                            <input type="date" class="form-control" name="expiredate" id="expiredate">
                                      </div>  
                                  </div> 
                              </div>                               
                  </div>
                 
                  <div class="modal-footer">              
                        <button type="submit" id="btnAddArticle" class="btn btn-success">Add</button>
                        <button type="button" id="btnCancelar" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                  </div>
                  </form>
            </div>      
      </div>
  </div>