@include('layouts.right-sidebar')
@include('layouts.headnav-small', array('title' => 'Reminders Settings', 'user' => $user, 'setting' => true))

<div class="container-fluid">
    <form id="reminders" setting-form="true" setting-type="reminders">
        <div class="row">
            <div class="large-12 columns">
                <div class="large-12 columns">
                    <div class="large-12 columns">
                        <label>Account Summary</label>
                        <div class="row">
                            <span class="jcheckbox">
                                <input {{($setting != null && $setting->summary=='1') ? 'checked' : ''}} form-field="true" type="checkbox" id="summary" name="summary" value="1">
                                <label for="summary" class="fa fa-check"></label>
                            </span>
                            <span class="label-1">Email me a summary of my business performance every week</span>
                        </div>
                    </div>
                </div> 
                <div class="large-12 columns">
                    <div class="large-12 columns">
                        <label>Reminder</label>
                        <div class="row">
                            <span class="jcheckbox">
                                <input {{($setting != null && $setting->invoice_overdue=='1') ? 'checked' : ''}} form-field="true" type="checkbox" id="invoice_overdue" name="invoice_overdue" value="1">
                                <label for="invoice_overdue" class="fa fa-check"></label>
                            </span>
                            <span class="label-1">Email me when an invoice becomes overdue</span>
                        </div>
                        <div class="row">
                            <span class="jcheckbox">
                                <input {{($setting != null && $setting->end_quarter=='1') ? 'checked' : ''}} form-field="true" type="checkbox" id="end_quarter" name="end_quarter" value="1">
                                <label for="end_quarter" class="fa fa-check"></label>
                            </span>
                            <span class="label-1">Remind me by email to do my BAS at the end of the quarter</span>
                        </div>
                        <div class="row">
                            <span class="jcheckbox">
                                <input {{($setting != null && $setting->bas_overdue=='1') ? 'checked' : ''}} form-field="true" type="checkbox" id="bas_overdue" name="bas_overdue" value="1">
                                <label for="bas_overdue" class="fa fa-check"></label>
                            </span>
                            <span class="label-1">Email me when my BAS is overdue</span>
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
    document.title = 'Rounded - Reminders Settings';
</script>
