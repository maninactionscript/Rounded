@include('layouts.right-sidebar')
@include('layouts.headnav-small', array('title' => 'GST Settings', 'user' => $user, 'setting' => true))
<div class="container-fluid">
    <form id="gstsettings" setting-form="true" setting-type="gstSettings">
        <div class="row">
            <div class="large-12 columns">
                <div class="large-11 columns">
                    <div class="large-5 columns">
                        <div class="row">
                            <label>ARE YOU REGISTERED FOR GST?</label>
                            <div class="switch round">
                                <span>YES</span>
                                <input  form-field="true" value="1" id="register_gst" {{($setting != null && $setting->register_gst=='1') ? 'checked' : ''}} name="register_gst" type="checkbox">
                                <label for="register_gst"></label>
                                <span>NO</span>
                            </div>  
                        </div>
                        <div class="row">
                            <label>REPORT FREQUENCY?</label>
                            <span class="jradio">
                                <input  form-field="true" id="report_gst_1" value="quarterly" {{($setting != null && $setting->report_gst=='quarterly') ? 'checked' : ''}} name="report_gst" type="radio">
                                <label for="report_gst_1"></label>
                                <span>Quarterly</span>
                            </span>
                            <span class="jradio">
                                <input id="report_gst_2" value="monthly" {{($setting != null && $setting->report_gst=='monthly') ? 'checked' : ''}} name="report_gst" type="radio">
                                <label for="report_gst_2" ></label>
                                <span>Monthly</span>
                            </span>
                            <span class="jradio">
                                <input id="report_gst_3" value="annualy" {{($setting != null && $setting->report_gst=='annualy') ? 'checked' : ''}} name="report_gst" type="radio">
                                <label for="report_gst_3"></label>
                                <span>Annualy</span>
                            </span>

                        </div>
                        <div class="row">
                            <label>HOW DO YOU LODGE YOUR BAS?</label>
                            <select form-field="true" id="lodge_bas" name="lodge_bas">
                                <option {{ ($setting != null && $setting->lodge_bas == '1')  ? 'selected' : '' }} value="1">Electronically via Business Portal</option>
                            </select>

                        </div>
                    </div>
                    <div class="large-6 columns tips">
                       <p style="font-size: 16px;">Your business activity statements (BAS) are due on the following dates:</p>
                        <div><p>Quarter 1 (1st  July - 30th September): BAS due on 11 November</p></div>
                        <div><p>Quarter 2 (1st October - 31st December): BAS due on 28 February</p></div>
                        <div><p>Quarter 3 (1st January - 31st March): BAS due on 12 May</p></div>
                        <div><p>Quarter 4 (1st April - 30th June): BAS due on 11 August</p></div>
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
    document.title = 'Rounded - GST Settings';
</script>
