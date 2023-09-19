<div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <form class="user row needs-validation" id="updateUserForm" novalidate>
                        @csrf
                        <div class="col-lg-6 row">
                            <div class="form-group col-lg-12 ">
                                <label for="customRange2" class="form-label">Nama</label><br>
                                <input type="text" class="form-control " name="name" id="name_update"placeholder="Title" required>

                                <input type="hidden" class="form-control " name="id" id="id_update"placeholder="Title" required>



                            </div>
                            <div class="form-group col-lg-12">
                                <label for="">Role</label>
                                <select class="form-control" id="select_role_update" name="role" aria-label="Default select example" required>
                                    <option value="Super User">Super User</option>
                                    <option value="Head">Head</option>
                                    <option value="Officer">Officer</option> 
                                  </select>
    
                            </div>  
                        </div>
                        <div class="col-lg-6 row">
                            <div class="form-group col-lg-12 ">
                                <label for="customRange2" class="form-label">Email</label><br>
                                <input type="email" class="form-control " name="email" id="email_update" placeholder="Title" required>
                            </div>
                            <div class="form-group col-lg-12" id="HeadPartUpdate" style="display: none">
                                <label for="">Select Head</label>
                                <select class="form-control" id="getMyHead_update" name="myHeadId" aria-label="Default select example" required>
                                    
                                </select>
    
                            </div>
                          
                            
                        </div>
                                 
                    
                        
                   
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" href="">Create</button>
                </div>
            </form>
            </div>
        </div>
</div>