<div class="modal fade" id="updateTimeline" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Task</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <form class="user" id="updateTask">
                @csrf
                <div class="form-group ">
                    <label for="">Task Name</label>
                        <input type="text" class="form-control " name="task_name" id="timeline_name_update" placeholder="Project Name">
                </div>
                <div class="form-group ">
                    <label for="">Task Notes</label>
                    <textarea type="text" class="form-control " name="notes" id="timeline_notes_update"placeholder="Notes"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Task Group</label>
                    <select class="form-control" id="timeline_group_update" name="idGroup" aria-label="Default select example">
                    </select>

                </div>
                <div class="form-group ">
                    <label for="">Start Date</label>
                    <input type="date" class="form-control " name="from" id="timeline_from_update"placeholder="Start Date">
                </div>
                <div class="form-group ">
                    <label for="">End Date</label>
                    <input type="date" class="form-control " name="to" id="timeline_to_update"placeholder="End Date">
                </div>
               
                <input type="text" name="id" value="" id="project_id_update">
                
                <!-- <button type="submit" class="btn btn-primary   btn-block">
                    Create Task
                </button> -->
                
           
            
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" href="">Update Task</button>
        </div>
    </form>
    </div>
</div>
</div>