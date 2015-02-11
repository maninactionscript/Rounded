@include('layouts.right-sidebar')
@include('layouts.headnav-small', array('title' => 'Business Details', 'user' => $user, 'setting' => true))
<div class="container-fluid">
    <form id="business_details" setting-form="true" setting-type="businessDetail">
        <div class="row">
            <div class="large-12 columns">
                <div class="large-7 columns">
                    <div class="large-6 columns">
                        <label>business name</label>
                        <input form-field="true" type="text" value="{{ $setting != null ? $setting->business_name : '' }}" id="business_name" name="business_name">
                    </div>
                    <div class="large-6 columns">
                        <label>yours abn/acn</label>
                        <input form-field="true" type="text" value="{{ $setting != null ? $setting->abn : '' }}" id="abn" name="abn">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <div class="large-12 columns">
                    <div class="large-12 columns">
                        <h5>CONTACT DETAILS</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <div class="large-7 columns">
                    <div class="large-12 columns">
                        <label>first name</label>
                        <input form-field="true" type="text" value="{{ $setting != null ? $setting->first_name : '' }}" id="first_name" name="first_name">
                    </div>
                </div>
            </div>
            <div class="large-12 columns">
                <div class="large-7 columns">
                    <div class="large-12 columns">
                        <label>last name</label>
                        <input form-field="true" type="text" value="{{ $setting != null ? $setting->last_name : '' }}" id="last_name" name="last_name">
                    </div>
                </div>
            </div>
            <div class="large-12 columns">
                <div class="large-7 columns">
                    <div class="large-12 columns">
                        <label>business email address</label>
                        <input form-field="true" form-field="true" type="email" value="{{ ($setting != null && $setting->email != '')  ? $setting->email : $user->email }}" id="email" name="email">
                    </div>
                </div>
            </div>
            <div class="large-12 columns">
                <div class="large-7 columns">
                    <div class="large-12 columns">
                        <label>phone number</label>
                        <input form-field="true" type="text" value="{{ $setting != null ? $setting->phone : '' }}" id="phone" name="phone">
                    </div>
                </div>
            </div>
            <div class="large-12 columns">
                <div class="large-7 columns">
                    <div class="large-12 columns">
                        <label>fax number</label>
                        <input form-field="true" type="text" value="{{ $setting != null ? $setting->fax : '' }}" id="fax" name="fax">
                    </div>
                </div>
            </div>
            <div class="large-12 columns">
                <div class="large-7 columns">
                    <div class="large-12 columns">
                        <label>website</label>
                        <input form-field="true" type="text" value="{{ $setting != null ? $setting->website : '' }}" id="website" name="website">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <div class="large-12 columns">
                    <div class="large-12 columns">
                        <h5>address</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <div class="large-7 columns">
                    <div class="large-12 columns">
                        <label>address</label>
                        <input form-field="true" type="text" value="{{ $setting != null ? $setting->address : '' }}" id="address" name="address">
                    </div>
                </div>
            </div>
            <div class="large-12 columns">
                <div class="large-7 columns">
                    <div class="large-12 columns">
                        <label>address 2</label>
                        <input form-field="true" type="text" value="{{ $setting != null ? $setting->address2 : '' }}" id="address2" name="address2">
                    </div>
                </div>
            </div>
            <div class="large-12 columns">
                <div class="large-7 columns">
                    <div class="large-12 columns">
                        <label>SUBURB</label>
                        <input form-field="true" type="text" value="{{ $setting != null ? $setting->suburb : '' }}" id="suburb" name="suburb">
                    </div>
                </div>
            </div>
            <div class="large-12 columns">
                <div class="large-7 columns">
                    <div class="large-6 columns">
                        <label>state</label>
                        <input form-field="true" type="text" value="{{ $setting != null ? $setting->state : '' }}" id="state" name="state">
                    </div>
                    <div class="large-6 columns">
                        <label>post code</label>
                        <input form-field="true" type="text" value="{{ $setting != null ? $setting->postcode : '' }}" id="postcode" name="postcode">
                    </div>
                </div>
            </div>
             <div class="large-12 columns">
                <div class="large-7 columns">
                    <div class="large-12 columns">
                        <label>country</label>
                        <select form-field="true" id="country" name="country">
                            <option {{ ($setting != null && $setting->country == 'Australia')  ? 'selected' : '' }} value="Australia">Australia</option>
                        </select>
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
    document.title = 'Rounded - Business Details';
</script>