<div class="modal fade" id="addGroupActivityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Group</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                        <div class="container">
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col-lg-4 ">
                                    <form class="user needs-validation" id="addGroupForm" novalidate>
                                        @csrf
                                        <div class="form-group ">
                                            <input type="text" class="form-control " name="Group" id="Group"placeholder="Group Name" required>
                                        </div>
                                        <div class="form-group ">
                                            <input type="number" class="form-control " name="order" id="order"placeholder="Order" min="0" required>
                                        </div>
                                        <input type="hidden"  name="idProject" id="idProjectGroup"  required>
                                        <button type="submit" class="btn btn-primary   btn-block">
                                            Create Group 
                                        </button>
                                    </form>
                                    <br/>
                                </div>
                                <div class="col-lg-7 ">
                                    <div class="table-responsive">
                                        <table class="table table-bordered " id="tableAddGroup" width="120%" cellspacing="0">
                                            <thead>
                                                <tr><th style="width: 10%">Delete</th>
                                                    <th >Group name</th>
                                                    <th style="width: 20%">Order</th>
                                                    
                                                    
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th style="width: 10%">Delete</th>
                                                    <th >Group name</th>
                                                    <th style="width: 20%">Order</th>
                                                   
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                
                                               
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                   
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
           
            </div>
        </div>
</div>