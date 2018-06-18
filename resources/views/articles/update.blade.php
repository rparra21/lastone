<div class="modal fade" id="modalUpdate" role="dialog">
      <div class="modal-dialog">    
            <!-- Modal content-->
            <div class="modal-content">

                  <div class="modal-header">
                 
                        <h4 class="modal-title">Update Article</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>         
                  </div>
                  <div class="modal-body">
                        <form id="formUpdate" name="formUpdate" class="form-horizontal" enctype="multipart/form-data" data-toggle="validator">
                            
                            {!! csrf_field() !!}


                              <div class="form-group">
                                 <div class="row">
                                      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <label class="control-label" for="url_update">URL:</label>
                                      </div>
                                      <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                            <input type="text" name="url_update" class="form-control" id="url_update" placeholder="Please add the URL of the article" maxlength="255" required>
                                      </div>  
                                  </div> 
                              </div>
                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <label class="control-label" for="title_update">Title:</label>
                                      </div>
                                      <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                            <input type="text" name="title_update" class="form-control" id="title_update" placeholder="Please add the title of the article" maxlength="100" required>
                                      </div>  
                                  </div> 
                              </div>  
                              <div class="form-group">
                                 <div class="row">
                                      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <label class="control-label" for="snippet_update">Snippet:</label>
                                      </div>
                                      <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                            <textarea class="form-control" name="snippet_update" id="snippet_update" placeholder="Enter a short description" maxlength="200" required></textarea>
                                      </div>  
                                  </div> 
                              </div>  
                              <div class="form-group">
                                 <div class="row">
                                      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <label class="control-label" for="image_update">Image:</label>
                                      </div>
                                      <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                          <input type="file" name="image_update" id="image_update" accept=".png, .jpg, jpeg"/>  
                                          <br></br>
                                          <div id="previewImage" class="imageStyle"></div>                            
                                      </div>  
                                  </div> 
                              </div>  
                              <div class="form-group">
                                 <div class="row">
                                      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <label class="control-label" for="categories_update">Categories:</label>
                                      </div>
                                      <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                            <div class="ui-front">
                                                <input type="text" name="categories_update" id="categories_update" class="tagBorder" required>
                                            </div>
                                      </div> 
                                  </div> 
                              </div>       
                              <div class="form-group">
                                 <div class="row">
                                      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <label class="control-label" for="pinned_update">Pinned:</label>
                                      </div>
                                      <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                            <input type="checkbox" class="styleCheck" name="pinned_update" id="pinned_update">
                                      </div>  
                                  </div> 
                              </div>   
                              <div class="form-group">
                                 <div class="row">
                                      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <label class="control-label" for="start_date_update">Start Date: (Optional)</label>
                                      </div>
                                      <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                            <input type="date" class="form-control" name="startdate_update" id="startdate_update">
                                      </div>  
                                  </div> 
                              </div>  
                              <div class="form-group">
                                 <div class="row">
                                      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <label class="control-label" for="expiredate_update">Expire Date: (Optional)</label>
                                      </div>
                                      <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                            <input type="date" class="form-control" name="expiredate_update" id="expiredate_update">
                                      </div>  
                                  </div> 
                              </div>    
                                                       
                           
                  </div>
                 
                        <div class="modal-footer">            
                            <button type="submit" id="btnUpdateArticle" class="btn btn-success">Update</button>
                            <button type="button" id="btnCancelara" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                  </form>
            </div>      
      </div>
  </div>