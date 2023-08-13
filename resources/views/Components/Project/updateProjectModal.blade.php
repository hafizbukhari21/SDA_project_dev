<div class="modal fade" id="updateProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Project</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="user" id="updateProjectForm">
                        @csrf
                        <div class="form-group ">
                            <label for="">Project Name</label>
                                <input type="text" class="form-control " name="project_name" id="project_name_update"placeholder="Project Name">
                        </div>
                        <div class="form-group">
                            <label for="">PIC</label>
                            <select class="form-control" id="project_pic_id_update" name="pic_id" aria-label="Default select example">
                                <!-- <option selected>PIC</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option> -->
                              </select>

                        </div>
                        <div class="form-group ">
                            <label for="">Category</label>
                            <select class="form-control " id="category_project_update" name="category_id" aria-label="Default select example">
                               
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <textarea type="text" class="form-control status_update"  id="status_update" name= "status" placeholder="Status"></textarea>

                        </div>
                        <div class="form-group ">
                            <label for="">Time</label>
                            <input type="number" class="form-control " id="time_update"placeholder="Time" name="time" step="0.5">

                        </div>
                        <div class="form-group">
                            
                            <label for="customRange2" class="form-label">Urgensi - <span id="previewUrgensi_update" >0</span></label><br>
                            <input type="range" class="form-control" value="0" min="0" max="5" name="urgensi" step="1" id="urgensi_update">
                        </div>
                        <input type="hidden" name="id" id="project_id_update">
                        
                            
                        {{-- <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control "
                                    id="exampleInputPassword" placeholder="Password">
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control "
                                    id="exampleRepeatPassword" placeholder="Repeat Password">
                            </div>
                        </div> --}}
                        
                        
                   
                
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" >Update</button>
                </div>
            </form>
            </div>
        </div>
</div>