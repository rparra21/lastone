<div class="modal fade" id="modalPrueba" role="dialog">
      <div class="modal-dialog">    
            <!-- Modal content-->
            <div class="modal-content">
            
                       
                  <div class="modal-header">
                 
                        <h4 class="modal-title">Prueba</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>         
                  </div>
                  <div class="modal-body">
                        <form id="formPrueba" name="formPrueba" class="form-horizontal" data-toggle="validator">

                              {!! csrf_field() !!}
                              <div class="form-group">
                                 <div class="row">
                                      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <label class="control-label" for="psone">ps1:</label>
                                      </div>                     
                                      <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">      
                                                <input type="password" name="psone" class="form-control" id="psone" required>                                                                                         
                                      </div>  
                                      
                                  </div> 
                              </div>
                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <label class="control-label" for="title">ps2:</label>
                                      </div>
                                      <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                            <input type="password" name="pstwo" class="form-control" id="pstwo" required>
                                      </div>  
                                  </div> 
                              </div> 
                              
                                                      
                  </div>
                 
                  <div class="modal-footer">              
                        <button type="button" id="btnpruebaad" class="btn btn-success">Add</button>
                        <button type="button" id="btnpruebacan" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                  </div>
                  </form>
            </div>      
      </div>
  </div>