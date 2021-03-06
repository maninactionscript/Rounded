@include('layouts.right-sidebar')
@include('layouts.headnav-small', array('title' => 'Email Templates', 'user' => $user, 'setting' => true))

<div class="container-fluid email_templates">
  <div class="large-12 columns container-action" style="padding-top: 15px;">
    <div class="large-8 columns no-padding">
      <span>Email tags insert useful information into your email templates, like invoice numbers and client names etc,
        so you don't have to do it manually every time. Tags will be inserted at your current cursor position</span>
    </div>
    <div class="large-4 columns no-padding text-center">
      <button data-toggle="dropdown" class="button dropdown-toggle" type="button" style="background-color: rgb(146, 157, 181);">insert</button>
      <ul class="dropdown-menu" role="menu">
        <li>
          <table class="no-border">
            <thead>
              <tr>
                <th colspan="2">INSERT</th>
              </tr> 
            </thead>
            <tbody>
              <tr>
                <td><a class="insert" data-insert="your_full_name" href="#">your full name</a></td>
                <td><a class="insert" data-insert="your_business_name" href="#">your business name</a></td>
              </tr>
              <tr>
                <td><a class="insert" data-insert="invoice_number" href="#">invoice number</a></td>
                <td><a class="insert" data-insert="invoice_due_date" href="#">invoice due date</a></td>
              </tr>
              <tr>
                <td><a class="insert" data-insert="invoice_due_days" href="#">invoice due days</a></td>
                <td><a class="insert" data-insert="payment_amount" href="#">payment amount</a></td>
              </tr>
              <tr>
                <td><a class="insert" data-insert="client_name" href="#">client name</a></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </li>
      </ul>
    </div>
  </div>
  <form setting-form="true" setting-type="emailTemplates">
    <div class="large-12 columns form-block">
      <div class="large-7 columns">
        <h4>EMAIL FOR SENDING AN INVOICE</h4>
        <div class="row">
          <p>Subject</p>
          <div type="customize" contenteditable="true" name="invoice_subject" data-input="input" class="jinput" form-field="true">{{$setting != null ? $setting->invoice_subject : ''}}</div>
        </div>
        <div class="row">
          <p>Message</p>
          <div type="customize" contenteditable="true" name="invoice_content" data-input="textarea" class="jinput" form-field="true">{{$setting != null ? $setting->invoice_content : ''}}</div>
          <!--<textarea class="jinput" form-field="true" name="invoice_content">{{$setting != null ? $setting->invoice_content : ''}}</textarea>-->
        </div>
      </div>
      <div class="large-4 end columns" style="margin-left: 3rem;">
        <h4>&nbsp;</h4>
        <div class="row">
          <p>Preview</p>
          <div class="large-12 tmpl-preview">
            <div class="tmpl-preview-header">
              <i class="fa fa-circle"></i>&nbsp;
              <i class="fa fa-circle"></i>&nbsp;
              <i class="fa fa-circle"></i> 
            </div>
            <div class="tmpl-preview-content">
              <div class="tmpl-subject" data-name="invoice_subject">
                <p>Subject: {{$preview->invoice_subject}}</p>
              </div>
              <div class="tmpl-content" data-name="invoice_content">
                <p>{{$preview->invoice_content}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="large-12 columns form-block">
      <div class="large-7 columns">
        <h4>EMAIL FOR SENDING A REMINDER</h4>
        <div class="row">
          <p>Subject</p>
          <div type="customize" contenteditable="true" name="reminder_subject" data-input="input" class="jinput" form-field="true">{{$setting != null ? $setting->reminder_subject : ''}}</div>
          <!--<input class="jinput" form-field="true" type="text" name="reminder_subject" value="{{$setting != null ? $setting->reminder_subject : ''}}" />-->
        </div>
        <div class="row">
          <p>Message</p>
          <div type="customize" contenteditable="true" name="reminder_content" data-input="textarea" class="jinput" form-field="true">{{$setting != null ? $setting->reminder_content : ''}}</div>
          <!--<textarea class="jinput" form-field="true" name="reminder_content">{{$setting != null ? $setting->reminder_content : ''}}</textarea>-->
        </div>
      </div>
      <div class="large-4 end columns" style="margin-left: 3rem;">
        <h4>&nbsp;</h4>
        <div class="row">
          <p>Preview</p>
          <div class="large-12 tmpl-preview">
            <div class="tmpl-preview-header">
              <i class="fa fa-circle"></i>&nbsp;
              <i class="fa fa-circle"></i>&nbsp;
              <i class="fa fa-circle"></i> 
            </div>
            <div class="tmpl-preview-content">
              <div class="tmpl-subject" data-name="reminder_subject">
                <p>Subject: {{$preview->reminder_subject}}</p>
              </div>
              <div class="tmpl-content" data-name="reminder_content">
                <p>{{$preview->reminder_content}}</p>
              </div>
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
  document.title = 'Rounded - Email Templates';
  $('div[contenteditable="true"]').keydown(function(e){
	console.log('keydown');
	if (e.keyCode === 13) {
      // insert 2 br tags (if only one br tag is inserted the cursor won't go to the next line)
      document.execCommand('insertHTML', false, '<br><br>');
      // prevent the default behaviour of return key pressed
      return false;
	 }
  });
</script>