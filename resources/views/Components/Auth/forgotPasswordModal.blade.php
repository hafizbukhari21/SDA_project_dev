<div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <form class="user needs-validation" id="sentForgetPassword" novalidate>
                @csrf
                <div class="form-group ">
                    <label for="">Insert Your Email</label>
                        <input type="email" class="form-control " name="email" id="timeline_name_update" placeholder="email" required>
                </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" href="">Send</button>
        </div>
    </form>
    </div>
</div>
</div>