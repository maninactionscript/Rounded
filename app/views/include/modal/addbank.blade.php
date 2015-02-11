<div class="modal-header">
    <h4>Add Account</h4>
</div>
<div class="modal-body">
    <form class="quicksetup">
        <div class="row">
            <div class="large-12 columns ">
                <label>ACCOUNT NAME</label> 
                <input type="text" class="form-control" value="{{ isset($bank) ? $bank->account_name : '' }}" id="account_name">
                <input type="hidden" class="form-control" value="{{ $bankID }}" id="account_id">
            </div>
        </div>
        <div class="row"> 
            <div class="medium-5 columns "><button class="button btn-default expand md-close-custom" type="button">Cancel</button></div> 
            <div class="medium-5 columns"><button id="create_bank_count" class="button success expand btn-primary" type="button">Save</button></div>
        </div>     
    </form>
</div>