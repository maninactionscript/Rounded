@include('layouts.right-sidebar')
@include('layouts.headnav-small', array('title' => 'Your Account', 'user' => $user, 'setting' => false))
<div class="container-fluid account_settings">
    @if($setting->status == 'trial')
    <div class="large-12 header">
        <span class="trial-text">{{ $dayleft }} days left on your free trial.</span> 
        <h6>You're steps away from keeping your accounting simple forever.</h6>
    </div>
    @endif
    <div class="large-12 columns no-padding">
        <div class="large-12 columns">
            @if($setting->status == 'trial')
            <form id="payment_form">
                <h4>PAYMENT DETAILS</h4>
                <p><i class="fa fa-lock"></i> This is a 256 bit encrypted payment. Your details are safe.</p>
                <div class="large-12 columns no-padding">
                    <div class="large-5 columns no-padding">
                        <div class="large-12 no-padding">
                            <label class="large-8 columns no-padding">CREDIT CARD NUMBER</label>
                            <label class="large-4 columns no-padding"><span class="jcon jcon-visa">&nbsp;</span></label>
                            <input type="text" class="large-12 columns" value="" name="credit_card">
                        </div>
                        <div class="large-12 columns no-padding">
                            <div class="large-6 columns no-padding">
                                <label>Expiry date</label>
                                <div class="large-5 columns no-padding">
                                    <select name="month">
                                        @for($i=1;$i<=12;$i++)
                                        <option value="{{ sprintf('%02s',$i)}}">{{ sprintf('%02s',$i)}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="large-7 columns">
                                    {{--*/ $y1 = 1990;$y2=2100  /*--}}
                                    <select name="year">
                                        @for($i=$y1;$i<=$y2;$i++)
                                        <option {{ date('Y') == $i ? 'selected' : '' }} value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="large-6 columns no-padding">
                                <label>Sercuriy number</label>
                                <input type="text" name="sercurity_number"/>
                            </div>
                        </div>
                    </div>
                    <div class="large-7 columns" style="padding-left: 2rem; padding-top: 1rem;">
                        <label>&nbsp;</label>
                        <h1 style="font-style: italic; margin-bottom: 0px;">$11 / month</h1>
                        <span>Cancel anytime, no contracts.</span>
                        <span style="position: absolute; top: 3rem; left: 17rem;">( Inc GST )</span>
                    </div>
                </div>
                <div class="large-12 columns no-padding">
                    <button type="button" id="pay" class="button success btn-primary">&nbsp;PAY NOW&nbsp;</button>&nbsp;<span>By clicking pay now you agree to the terms & conditions.</span>
                </div>
            </form>
            @else
            <div class="large-12 columns">
                <div class="large-12 columns paid">
                    <h4>PAYMENT DETAILS</h4>
                    <p>You're next payment of $11 will occur on the {{date('jS', strtotime($setting->expires_date))}} of {{date('F', strtotime($setting->expires_date))}}<br> and well be charging your credit card ending in <span style="font-weight:bold;font-size: 1rem;">{{$setting->sercurity_number}}</span> </p> 
                    <div class="large-12 columns no-padding">
                        <button type="button" id="update_payment_show" class="button success btn-primary">&nbsp;UPDATE&nbsp;</button>
                    </div>
                </div>
                <form id="payment_form" style="display: none;">
                    <h4>PAYMENT DETAILS</h4>
                    <p><i class="fa fa-lock"></i> This is a 256 bit encrypted payment. Your details are safe.</p>
                    <div class="large-12 columns no-padding">
                        <div class="large-5 columns no-padding">
                            <div class="large-12 no-padding">
                                <label class="large-8 columns no-padding">CREDIT CARD NUMBER</label>
                                <label class="large-4 columns no-padding"><span class="jcon jcon-visa">&nbsp;</span></label>
                                <input type="text" class="large-12 columns" value="{{$setting->credit_card}}" name="credit_card">
                            </div>
                            {{--*/ $expiry_date = explode('-',$setting->expiry_date) /*--}}
                            {{--*/ $year = $expiry_date[0] /*--}}
                            {{--*/ $month = $expiry_date[1] /*--}}
                            <div class="large-12 columns no-padding">
                                <div class="large-6 columns no-padding">
                                    <label>Expiry date</label>
                                    <div class="large-5 columns no-padding">
                                        <select name="month">
                                            @for($i=1;$i<=12;$i++)
                                            <option {{ $month == sprintf('%02s',$i) ? 'selected' : '' }}  value="{{ sprintf('%02s',$i)}}">{{ sprintf('%02s',$i)}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="large-7 columns">
                                        {{--*/ $y1=1990;$y2=2100  /*--}}
                                        <select name="year">
                                            @for($i=$y2;$i>=$y1;$i--)
                                            <option  {{ $i == $year ? 'selected' : '' }} value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="large-6 columns no-padding">
                                    <label>Sercuriy number</label>
                                    <input type="text" value="{{$setting->sercurity_number}}" name="sercurity_number"/>
                                </div>
                            </div>
                        </div>
                        <div class="large-7 columns" style="padding-left: 2rem; padding-top: 1rem;">
                            <label>YOUR CURRENT CARD</label>
                            <span>Your current card ends with <span style="font-weight:bold;font-size: 1rem;">{{$setting->sercurity_number}}</span> </span>
                        </div>
                    </div>
                    <div class="large-12 columns no-padding">
                        <button type="button" id="pay" class="button success btn-primary">&nbsp;UPDATE&nbsp;</button>&nbsp;<span>By clicking pay now you agree to the terms & conditions.</span>
                    </div>
                </form>
            </div>
            @endif
        </div>  <!-- End payment form -->
        <div class="large-12 columns ">
            <form id="login_details_form">
                <h4>LOGIN DETAILS</h4>
                <div class="large-12 columns no-padding">
                    <div class="large-5 columns no-padding">
                        <label>EMAIL ADDRESS</label>
                        <input type="email" value="{{$user->email}}" name="email">
                    </div>
                </div>
                <div class="large-12 columns no-padding">
                    <div class="large-5 columns no-padding">
                        <label class="large-8 columns no-padding">PASSWORD</label>
                        <label class="show-password" data-show="password">Show password</label>
                        <input name="password" type="password" id="password" value="">
                    </div>
                    <div class="large-5 columns end">
                        <label>&nbsp;</label>
                        <span>Your password should be at least 8 characters and contain both numbers and letters.</span>
                    </div>
                </div>
                <div class="large-12 columns no-padding">
                    <button type="button" id="update_login" class="button success btn-primary">&nbsp;Update&nbsp;</button>&nbsp;
                </div>
            </form>
        </div>
        <div class="large-12 columns">
            <form id="account_details_form">
                <h4>ACCOUNT DETAILS</h4>
                <button type="button" id="download_data" class="button">&nbsp;Download all my data&nbsp;</button>&nbsp;
                <button type="button" id="delete_account" class="button">&nbsp;Delete my account&nbsp;</button>&nbsp;
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    document.title = 'Rounded - Account Settings';
</script
