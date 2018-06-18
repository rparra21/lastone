
 <!-- Modal -->
 <div class="modal fade" id="modalSearch" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header">            
            <h4 class="modal-title">Search Existing Article</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
            <div class="modal-body">
                  <div class="form-group">
                                    <div class="row">
                                          <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                <label class="control-label" for="textSearch">Search Text:</label>
                                          </div>
                                          <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                                <input type="text" name="textSearch" class="form-control" id="textSearch" placeholder="Enter the text to search" maxlength="255" required>
                                          </div>  
                                      </div> 
                  </div>
                  <div class="row" style="float:right;" > 
                      <button type="button" id="btnSearchText" class="btn btn-sm btn-info">Search</button>
                  </div> 

                  <div id="searchContent" style="margin-top:10%;">

                  </div>  
            </div>
            <div class="modal-footer">            
                            <button type="button" id="btnCancelar" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
      </div>
      
    </div>
  </div>