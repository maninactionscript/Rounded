<div class="modal-header">
    <h4>Import transactions</h4>
</div>
<div class="modal-body">
    <form id="import-form">
        <div class="row">
            <span>
                @if($lastImport != NULL)
                <p>Last transactions imported from {{ date('j F, Y',strtotime($lastImport->imported_from))  }} 
                    to {{ date('j F, Y',strtotime($lastImport->imported_to)) }}</p>
                @else
                <p>No transaction was imported.
                @endif
            </span>
        </div>
        <div class="row">
            <div class="large-12 trans-import">
                    <div class="large-2">
                        <span class="jcon large jcon-import">&nbsp;</span>
                    </div>
                    <div class="large-7">
                           <span class="attachment">Drag and drop file here or click on dashed area to upload.</span>
                    </div>
                    <input type="file" id="attachment">
                    <span class="qif">.qif</span>   
            </div>
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="large-12">
                <p class="litle-text">You can export this from your online banking<br>Only dd/mm/yy format accepted</p>
            </div>
        </div>
        <div class="row">
            <div class="large-1 columns">
                <span class="jcheckbox">
                    <input value="1" type="checkbox" checked="checked" id="im-income">
                    <label class="fa fa-check" for="im-income"></label>
                </span>
            </div>
            <div class="large-11 columns">   
                <label for="im-income">Import income</label>
            </div> 
        </div>
        <div class="row">
            <div class="large-1 columns">
                <span class="jcheckbox">
                    <input value="1" type="checkbox" checked="checked" id="im-purchase">
                    <label class="fa fa-check" for="im-purchase"></label>
                </span>
            </div> 
            <div class="large-11 columns">  
                <label for="im-income">Import purchases</label> 
            </div>
        </div>
        <div class="row">
            <div class="large-1 columns">
                <span class="jcheckbox">
                    <input value="1" type="checkbox" checked="checked" id="inc-gst">
                    <label class="fa fa-check" for="inc-gst"></label>
                </span> 
            </div>
            <div class="large-11 columns">  
                <label for="inc-gst">Automatically include GST on all transactions</label>
            </div>   
        </div>
        <div class="row" style="margin-top:20px ;">
            <div class="large-12"><button id="import" class="button success expand btn-primary" type="button">import</button></div>
        </div>
        <input type="hidden" value="{{ $bankID }}" id="bank_id">
    </form>
</div>