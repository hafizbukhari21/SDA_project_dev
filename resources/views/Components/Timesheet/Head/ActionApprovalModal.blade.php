<div class="modal fade" id="previewApprovalTimesheetHead" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Approval Head Action</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="col-lg-12">
                <div class="p-4">
                    {{-- <a id="sendRequestButton" class="btn btn-primary  ">
                        Send Request
                    </a> --}}

                   <div>
                    <h5 class="mb-3" style="font-weight: bold;" id="officerApprove">Officer: </h5>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <p >Title: <span style="font-weight: bold;" id="titleApprove"></span></p>
                            <p >Status: <span style="font-weight: bold;" id="statusApprove"></span></p>
                           
                        </div>
                        <div class="col-lg-6">
                            <p >Submited Date: <span style="font-weight: bold;" id="submittedDateApprove"></span> </p>
                            <p >Attempt: <span style="font-weight: bold;" id="attempApprove"></span></p>
                        </div>
                        <div class="col-lg-6" id="buttonAction">
                            <button type="button" class="btn btn-success" id="apvButton">Approve</button>
                            <button type="button" class="btn btn-warning" id="revButton">Revision</button>
                        </div>
                    </div>
                   </div>
                    <div class="table-responsive">
                        <table class="table table-bordered " id="tableTimesheetApproval" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Activity Date</th>
                                    <th>Start</th>
                                    <th>Finish</th>
                                  
                                    
                                    
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Start</th>
                                    <th>Finish</th>
                                  
                                    
                                </tr>
                            </tfoot>
                            <tbody>
                             
                              
                            </tbody>
                        </table>
                    </div>
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