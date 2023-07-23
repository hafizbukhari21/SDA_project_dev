<!-- Add Update Timesheet Modal -->
<div class="modal fade" id="udapteTimeSheetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Timesheet</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="p-4">
                            
                            <form class="user row" id="updateTimeSheet">
                                @csrf
                                <div class="col-lg-6 row">
                                    <div class="form-group col-lg-12 ">
                                        <label for="customRange2" class="form-label">Summary</label><br>
                                        <input type="text" class="form-control " name="title" id="upd_title"placeholder="Title">
                                    </div>
                                    <div class="form-group col-lg-12">
                                        
                                        <textarea type="text" class="form-control " rows="3" name="detail_activity" id="upd_detail_activity"placeholder="Status"></textarea>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-6 row">
                                    <div class="form-group col-lg-12">
                                        <label for="customRange2" class="form-label">Date</label><br>
                                        <input type="date" class="form-control " name="activity_date" id="upd_activity_date"placeholder="Title">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="customRange2" class="form-label">Start</label><br>
                                        <input type="time" class="form-control " name="from" id="upd_from"placeholder="Title">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="customRange2" class="form-label">Finish</label><br>
                                        <input type="time" class="form-control " name="finish" id="upd_finish"placeholder="Status">
                                    </div>
                                </div>
                              
                                <input type="hidden" name="id" id="upd_id" value="">
                                
                                
                                <div class="col-lg-12 row"  >
                                    <div class="form-group  btn-block col-lg-12">
                                    <button type="submit" class="btn btn-primary  ">
                                        Udpate Activity 
                                    </button>
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                                    </div>
                                   
                                </div>
                                
                           
                            </form>
                       
                        </div>
                    </div>
                        
                   
                    
                </div>
                <!-- <div class="modal-footer">
                    {{-- <button class="btn btn-primary" href="">Create</button> --}}
                </div> -->
            </form>
            </div>
        </div>
    </div>