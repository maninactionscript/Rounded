@include('layouts.right-sidebar')
@include('layouts.headnav-small', array('title' => 'Invoicing Settings', 'user' => $user, 'setting' => true))

<div class="container-fluid">
    <form id="invoicing" setting-form="true" setting-type="invoicing">
        <div class="row">
            <div class="large-12 columns">
                <div class="large-12 columns">
                    <div class="large-12 columns">
                        <label>PAYMENT TERMS</label>
                        <div class="invoicing-field-block">
                            <input form-field="true" value="{{ $setting != null ? $setting->payment_term : '7'  }}" type="text" name="payment_term">
                            <span>Days</span>
                            <span class="tool-tips">You can overide this on each invoice</span>
                        </div>
                    </div>
                </div> 
                <div class="large-12 columns">
                    <div class="large-12 columns">
                        <label>INVOICING FOOTER</label>
                        <div class="invoicing-field-block">
                            <textarea form-field="true" id="invoice_footer" name="footer">{{ $setting != null ? str_replace('<br />',"\n",$setting->footer ) : ''  }}</textarea>
                            <span class="tool-tips">This will appear on bottom of each invoice.<br> 
                                You might want to include your bank details for<br>payment.</span>
                        </div>
                    </div>
                </div> 
                <div class="large-12 columns" style="margin-bottom: 5rem;">
                    <div class="large-12 columns">
                        <label>LOGO</label>
                        <div class="invoicing-field-block">
                            <div class="upload-button  {{ ($setting != null && $setting->logo != '') ? 'showed' : ''  }}">
                                <input type="file" id="file_logo">
                                <input form-field="true" type="hidden" value="{{ $setting != null ? $setting->logo : ''  }}" name="logo">
                                <div class="upoad-preview">
                                    <img src="{{ ($setting != null && $setting->logo != '') ? URL::to($setting->logo) : '' }}" width="100%" height="100%" alt="">
                                </div>
                                <a href="#" class="upoad-delete"><i class="fa fa-trash-o"></i></a>
                            </div>
                            <span class="tool-tips">Its best if your logo has white background.<br>No larger than 760x300px.</span>
                        </div>
                    </div>
                </div> 
            </div>
        </div> 
        <div class="modal-footer columns">
            <div class="medium-2 columns"><button type="button" class="save_setting button success btn-primary">Save details</button></div>
        </div>
    </form>
</div>
<script type="text/javascript">
 document.title = 'Rounded - Invoicing Settings';
</script>
