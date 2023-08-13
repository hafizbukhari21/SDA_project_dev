<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Task</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="user" id="addTaskForm">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6      ">
                                <div class="form-group ">
                                    <label for="">Project Name</label>
                                        <input type="text" class="form-control " name="task_name" id="project_name"placeholder="Project Name">
                                </div>
                               
                                <div class="form-group">
                                    <label for="">Select Group</label>
                                    <select class="form-control" id="timeline_group" name="idGroup" aria-label="Default select example">
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6      ">
                                <div class="form-group ">
                                    <label for="">Start Date</label>
                                    <input type="date" class="form-control " name="from" id="project_name"placeholder="Start Date">
                                </div>
                                <div class="form-group ">
                                    <label for="">End Date</label>
                                    <input type="date" class="form-control " name="to" id="project_name"placeholder="End Date">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="">Notes</label>
                            <textarea type="text" class="form-control " name="notes" id="project_name"placeholder="Notes"></textarea>
                        </div>
                       
                      
                       
                        <input type="hidden" name="project_id" value="" id="project_id">
                        
                        <!-- <button type="submit" class="btn btn-primary   btn-block">
                            Create Task
                        </button> -->
                        
                   
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" href="">Create</button>
                </div>
            </form>
            </div>
        </div>
</div>