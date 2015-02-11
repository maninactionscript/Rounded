var expense = [];
var area;
var lineChartData = {
  labels : [],
  datasets : [
    {
      label: "Income",
      fillColor : "rgba(0, 0, 0, 0)",
      strokeColor : "rgba(101,248,243,1)",
      pointColor : "rgba(101,248,243,1)",
      pointStrokeColor : "rgba(101,248,243,1)",
      pointHighlightFill : "rgba(101,248,243,1)",
      pointHighlightStroke : "rgba(101,248,243,1)",
      data : []
    },
    {
      label: "Expense",
      fillColor : "rgba(0, 0, 0, 0)",
      strokeColor : "rgba(249,226,181,1)",
      pointColor : "rgba(249,226,181,1)",
      pointStrokeColor : "rgba(249,226,181,1)",
      pointHighlightFill : "rgba(249,226,181,1)",
      pointHighlightStroke : "rgba(249,226,181,1)",
      data : []
    }
  ]

};
(function($){
  var rightSlider={
    container : '',
    show :  function(){
      var e = $(this.container);
      e.addClass('open');
      e.animate({right : '0'},100);
    },
    hide : function(){
      var e = $(this.container);
      e.removeClass('open');
      e.animate({right : '-500px'},100);
    }
  }
  $.fn.rightSlider = function(){
    var options = {
      container :'.cl-right-sidebar',
    }
    var s =  rightSlider;
    s.container = options.container;
    var el = $(this);
    $(s.container).on('click','.right-slider-close',
      function(){
        s.hide();
        el.removeClass('slider');
        $(s.container).find('.content').html('');
    });
    return this.each(function(){
      var e = $(this);
      var ob = this;
      var o = $(options.container);
      e.bind('click',function(event){
        //if(event.target != ob) return false;
        el.removeClass('slider');
        e.addClass('slider');
        s.show();
      });
    });
  }
  $(document).ready(function(){
    /* right slider*/
    var msg = $('#msg');
    if(msg.length > 0) msg.modal('show');
    var baseurl = window.baseurl();
    var token = window._token();
    var wFilter = false;
    var wType = '';
    var fileUpload = '';
    var wrapper = $('#cl-wrapper');
    var modal = $('.custom-modal');
    var menuItem = $('.cl-vnavigation');
    var menuPage = $('#jmenu-page-content');
    var loading = '<div class="cool-loader-normal"></div>';

    var rounded = {
      init : function(){
        $('a[data-page="dashboard"]').click();
        this.quickSetup();
      },
      loader : {
        open : function(msg){
          var overlay = '<div id="jr7loader" style="background: none repeat scroll 0 0 rgba(0, 0, 0, 0.5);height: 100%;left: 0;position: fixed;top: 0;transition: all 0.3s ease 0s;visibility: visible;width: 100%;z-index: 9999;">'
          +'<div style="position: absolute; border-radius: 5px; background-color: rgb(255, 255, 255); opacity: 0.98; height: 20%; width: 20%; left: 40%; top: 40%;">'
          +'<div class="cool-loader-normal" style="top: 30%;"></div>'
          +'<div style="width: 100%; height: 100%; text-align: center; display: table;"><h6 style="display: table-cell; vertical-align: middle; padding-top: 20%;">'+msg.toUpperCase()+'<br>Please wait...</h6></div>';
          +'</div>'
          +'</div>';
          $('body').css('overflow','hidden').append(overlay);
        },
        close : function(){
          $('body').css('overflow','').children('#jr7loader').remove();
        }
      },
      save : function(data){
        $.ajax({
          type : 'post',
          url  : baseurl + '/ajax/save',
          data :data,
          success : function(response) {
            switch(data['action']) {
              case 'expense' :
              case 'merge' :
                if(data['action'] == 'expense') $('#add_expense')
                  .closest('.cl-right-sidebar')
                  .find('.right-slider-close')
                  .click();
                else  $('#merge_expense').find('.md-close-custom').click(); 
                if(wFilter == true) {
                  $('.btn-custom-filter').click(); 
                }
                else {
                  if(wType == '') {
                    area = 'workbook';
                    var ddata = {};
                    ddata['_token'] = token;
                    ddata['area'] = area;
                    //ddata['date'] = 'this_quarter';
                    ddata['type'] = 'all';
                    //loadChart(ddata);
                    rounded.loadExpense(ddata);
                  }
                  else {
                    $('.custome-filter .filter[data-type="'+wType+'"]').click();
                  } 
                }
                if(rounded.page == 'dashboard') $('a[data-page=dashboard]').click();
                break;
              case 'setting' :
                var closeBtn =  $('#quick_setup .md-close');
                closeBtn.click();
                rounded.showMessage(response.msg);
                if(response.status == '1'){
                  $('#firstname').html(response.name);
                  $('#fullname').html(response.fullname);
                } 
                break;
              case 'changeCategory' :
                expense = [];
                var all = $('#expense > table[data-type="all"]').find('tbody');
                var purchase = $('#expense > table[data-type="purchase"]').find('tbody');
                var income = $('#expense > table[data-type="income"]').find('tbody');
                var body = $('element');
                if(all.length > 0) body = all;
                if(purchase.length > 0 && data['type'] == 'purchase') body = purchase;
                if(income.length > 0 && data['type'] == 'income') body = income;
                for(var i=0;i<data['id'].length;i++){
                  body.find('tr[data-id=' + data['id'][i] + ']').children('td').eq(4).html(response.title);
                  $('input[value="' + data['id'][i] + '"]').prop('checked',false);
                };
                $('input[value="all"]').prop('checked',false);
                var closeBtn = $('#category_modal').find('.md-close-custom');
                closeBtn.click();
                var item =  data['id'].length > 1 ? (data['id'].length + ' items') : (data['id'].length + ' item');
                var msg = 'Changed category ' + item + '.';
                rounded.showMessage(msg);
                break;
              case 'category' :
                $('#add_category_form .btn-default').click();
                $('#category_id').removeAttr('disabled').prepend(response);
                break;
              case 'bankAccount' :
                var closeBtn = $('#addbank_modal').find('.md-close-custom');
                closeBtn.click();
                if( data['account_id'] == '0' || data['account_id']== 0 )
                {
                  var list = wrapper.find('.list-bank');
                  var newb = wrapper.find('.add-bank');
                  if(list.length > 0){
                    $(response).insertBefore('.add-bank-btn')
                  } 
                  if(newb.length > 0){
                    menuItem.find('a[data-page="banking"]').click();
                  }
                }
                else
                {
                  var bank = $('.item-bank[data-id="'+data['account_id']+'"]');
                  bank.find('.info > h5').html(response);
                }

                break;
              case 'addWorkbook' :
                expense = [];
                for(var i=0;i<data['id'].length;i++){
                  $('input[value="' + data['id'][i] + '"]').prop('checked',false);
                  $('tr[data-id="' + data['id'][i] + '"]').find('td').eq(4).html('Yes');
                };
                $('input[value="all"]').prop('checked',false);;
                rounded.showMessage(response);
                break;
              case 'client' :
              /* var content = $('#clients table tbody');
              if(data['id'] == '0' || data['id']== 0){
              content.find('tr[data-id=0]').remove();
              content.prepend(response);
              }
              else{
              content.find('tr[data-id='+data['id']+']').html(response);
              }
              rounded.initSlider('.right-slider');
              $('#add_client').closest('.cl-right-sidebar')
              .find('.right-slider-close')
              .click();
              break;*/
              case 'businessDetail' :
              case 'gstSettings' :
              case 'reminders' :
              case 'invoicing' :
              case 'emailTemplates' :
                $('a[data-page="'+data['action']+'"]').click();
                break;
              case 'changeLoginDetail' :
              case 'pay' :
                $('a[data-page="accountSettings"]').click();
                rounded.showMessage('Settings was saved.');
                break;
              case 'goal' :
                $('#goal_modal .md-close').click();
                $('a[data-page="dashboard"]').click();
                break
              case 'singleInvoice' :
                response['_token'] = token;
				$('#invoice_form').find('input[name=id]').val(response.id);
                if(typeof response['invoice'] != 'undefined' && response['invoice'] != ''){
                  $('#open_new_tab').attr('href',response['invoice']).click();
                };
                if(data['__save']=='save_send'){
                  setTimeout(function(){
                    $('input#ready_send').data('id',response.id).click();
                  },500); 
                };
                rounded.loader.close();
                //rounded.loadInvoice(response);
                break;
              case 'invoicePayment' :
                var d ={};
                d['id'] = response['invoice_id'];  
                d['page'] = 'detail';
                d['client'] = '0';
                d['_token'] = token; 
                rounded.loadInvoice(d);
                break;
              default :
                break;
            }
          }
        })
      },
      loadForm : function(data){
        if(typeof data['id'] == 'undefined') id=0;
        if(data['view'] == 'slider') var content = $('.cl-right-sidebar .content');
        else
          var content = $('#'+data['form']+'_modal.custom-modal .modal-content');
        content.html(loading).addClass('loading');
        //console.log(data);return;
        //return;
        $.ajax({
          type : 'post',
          url  : baseurl + '/ajax/form',
          data :data,
          success : function(response) {
            content.removeClass('loading').html(response); 
          }
        });
      },
      clearFrom : function(form){
        form.find('input[type=text]').val('');
        form.find('input[id="gst"]').val('0.00');
        form.find('input[type=checkbox]').attr('checked', false);
        form.find('textarea').val('');
      },                                     
      receiptHeight : function(){
        var h = $('.expense-list').height();
        $('#receipt').height(h);
      },
      _delete : function(data){
        $.ajax({
          type : 'post',
          url  : baseurl + '/ajax/delete',
          data :data,
          success : function(response) {
            expense = [];
            switch(data['action']) {
              case 'expense' :
                $('.custome-filter .button[data-type="all"]').click();
                $('.custom-filter-reset').click();
                break;
              case 'gst' :
                var body = $('#expense > table').find('tbody');
                var e = area == 'banking' ? 6 : 7;
                for(var i=0;i<data['id'].length;i++)
                {
                  body.find('tr[data-id=' + data['id'][i] + ']').children('td').eq(e).html('$0.00');
                  $('input[value="' + data['id'][i] + '"]').prop('checked',false);
                }
                $('input[value="all"]').prop('checked',false);
                var item =  data['id'].length > 1 ? (data['id'].length + ' items') : (data['id'].length + ' item');
                var msg = '<label>Removed GST ' + item + '.</label>';
                rounded.showMessage(msg);     
                break;
              case 'receipt' :
                var body = $('#expense > table').find('tbody');
                body.find('tr[data-id=' + data['id'] + ']').children('td').eq(5).html('');
                var closeBtn = $('#receipt_modal').find('.md-close-custom');
                closeBtn.click();
                break;
              case 'bankAccount' :
                var list = $('.list-bank ul.bank-ctn');

                list.find('.item-bank[data-id="'+data['id']+'"]').remove();
                var b = list.find('.item-bank').length;
                if(b > 0) list.find('.item-bank').eq(0).click();
                else menuItem.find('a[data-page="banking"]').click();
                break;
              case 'client' :
                var content = $('#clients table tbody');
                content.find('tr[data-id='+data['id']+']').remove();
                break;
              case 'invoice' :
                $('a[data-page=invoices]').click();
                break;
              default :
                break;
            }
          }
        })
      },
      initModal : function(e) {
        $(e).modalEffects(); 
      },
      initSlider : function(e) {
        $(e).rightSlider(); 
      },
      showMessage : function(msg){
        $('#jmessage').find('.modal-body').html(msg);
        this.initModal('#btn-jmessage');
        $('#btn-jmessage').click();
      },
      upload : function(data){
        $.ajax({
          type : 'post',
          url  : baseurl + '/ajax/upload',
          data :data,
          processData: false,
          cache       : false,
          contentType : false,
          success : function(response){
            fileUpload = JSON.parse(response);
          }
        });
      },
      _import : function(data){
        $('#import_modal').find('.md-close').click();
        $('#expense').html(loading);
        $.ajax({
          type : 'post',
          url  : baseurl + '/ajax/import',
          data :data,
          success : function(response){
            var item = $('.item-bank[data-id="'+data['bank_id']+'"]');
            item.find('.info-new-trans').html(response.info);
            item.find('.total-new-trans').html(response.transactions);
            item.click();
          }
        });
      },
      clearFile : function(file){
        $.ajax({
          type : 'post',
          url  : baseurl + '/ajax/clear',
          data :{
            'type' : 'file',
            'file' : file,
            '_token' : token
          },
          success : function(resonse){
          }
        });
      },
      deleteAll : function(type){
        $.ajax({
          type : 'post',
          url  : baseurl + '/ajax/deleteall',
          data :{
            'type' : type,
            '_token' : token
          },
          success : function(resonse){
            $('a[data-page='+type+']').click();
          }
        });
      },
      loadExpense : function(data){
        $('#expense').html(loading);
        expense = [];
        $.ajax({
          type : 'post',
          url  : baseurl + '/ajax/expense',
          data :data,
          success : function(response){
            $('#expense').html(response);
            $('.expense-head').scrollToFixed({
              marginTop:137
            });
            rounded.initModal('.receipt-modal, .form-modal');
            rounded.initSlider('.right-slider > td:not(:first-child)');
          }
        });
      },
      quickSetup : function(){
        $.ajax({
          type : 'post',
          url  : baseurl + '/ajax/quicksetup',
          data :{
            '_token' : token
          },
          success : function(response){
            if(response == '0'){
              rounded.initModal('#btn-quicksetup');
              $('#btn-quicksetup').click();
            }
            return true;   
          }
        });
      },
      loadChart : function(data) {
        $.ajax({
          type : 'post',
          url  : baseurl + '/ajax/chart',
          data :data,
          success : function(response){
            $('.item-trans .total-income').html('$' + response.income.total);
            $('.item-trans .total-expense').html('$' + response.expense.total);
            lineChartData.labels = response.labels;
            lineChartData.datasets[0].data = response.income.data;
            lineChartData.datasets[1].data = response.expense.data;
            if( typeof window.myLine != 'undefined' )
            {
              window.myLine.destroy();
            }
            var option =  {
              responsive: true,
              bezierCurve: false,
              scaleShowGridLines : true,
              scaleGridLineColor : "rgba(255,255,255,0.3)",
              showScale: true,
              scaleLineWidth : 3,
              scaleFontColor: "#fff",
              scaleFontFamily: "'brandon_grotesquelight',sans-serif",
              pointDot : true,
            };
            if(response.empty == 1){
              option.showScale = false;
            }
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myLine = new Chart(ctx).Line(lineChartData,option);
            return true;   
          }
        });
      } ,           
      loadMenuPage : function(mode,page){
        rounded.page = page;
        menuPage.html(loading).addClass('loading');
        $.ajax({
          type : 'post',
          url  : baseurl + '/ajax/page',
          data : {
            'page' : page,
            'mode' : mode,
            '_token' : token
          },
          success : function(response){
            expense = [];
            menuPage.removeClass('loading').html(response);
            $('.navbar.nav-small').scrollToFixed({zIndex : 1003});
            switch(page){
              case 'workbook' :
                area = 'workbook';
                var data = {};
                data['_token'] = token;
                data['area'] = area;
                //data['date'] = 'this_quarter';
                data['type'] = 'all';
                rounded.loadExpense(data);
                rounded.initModal('.form-modal, .receipt-modal');
                rounded.initSlider('.right-silder');
                $('.container-action').scrollToFixed({zIndex :1001, marginTop : 50});
                break;
              case 'banking' :
                rounded.initModal('.form-modal');
                //initCheckbox();
                area = 'banking';
                $('.list-bank .list').find('.item-bank').eq(0).click();
                $('.container-action').scrollToFixed({zIndex :1001, marginTop : 50}); 
                //$('.list-bank ').scrollToFixed({zIndex :1001, marginTop : 50});
                break;
              case 'client' :
                rounded.initSlider('.right-silder');
                break;
              case 'emailTemplates' :
                $('.container-action').scrollToFixed({zIndex :1001, marginTop : 50});
                break;
              default :
                rounded.initModal('.form-modal');
                break;
            }
          }
        })
      },
      page : '',
      loadInvoice : function(data){
        menuItem.children('li').removeClass('active');
        menuItem.find('a[data-page="invoices"]').parent('li').addClass('active');
        menuPage.html(loading).addClass('loading');
        $.ajax({
          type : 'post',
          url  : baseurl + '/ajax/invoice',
          data : data,
          success : function(response){
            menuPage.removeClass('loading').html(response);
            if(data['id'] == 0){
              rounded.addNewLine();
            }
            rounded.initSlider('.right-slider');
          }
        })      
      },
      loadInvoices : function(data){
        $('#load_invoice').html(loading);
        $.ajax({
          type : 'post',
          url  : baseurl + '/ajax/invoices',
          data : data,
          success : function(response){
            $('#load_invoice').html(response);   
          }
        })      
      },
      addNewLine : function(){
        var id = generateUid();
        var html = '<div class="row">'+
        '<div class="large-2 columns">'+
        '<input type="text" name="desc">'+
        '</div>'+
        '<div class="large-2 columns">'+
        '<input type="text" name="quantity">'+
        '</div>'+
        '<div class="large-3 columns">'+
        '<div class="input-group">'+
        '<span class="input-group-addon">$</span>'+
        '<input type="text" name="unit_price">'+
        '</div>'+
        '</div>'+
        '<div class="large-2 columns" style="padding-top: 0.5rem;">'+
        '<span class="jcheckbox">'+
        '<input type="checkbox" value="1" name="inc_gst" id="gst_'+id+'">'+
        '<label class="fa fa-check" for="gst_'+id+'"></label>'+
        '</span>'+
        '</div>'+
        '<div class="large-3 columns">'+
        '<span class="amount">$0.00</span><input value="0" type="hidden" name="amount">'+
        '</div>'+
        '</div>';
        $('.price-content').append(html);
      },
      invoiceAction : function(data){
        $.ajax({
          type : 'post',
          url  : baseurl + '/ajax/invoice/action',
          data : data,
          success : function(response){
            rounded.loader.close();
            if(data['action'] == 'pdf'){
              if(response['status'] == '1'){
                window.open(response['invoice'],'_blank');
              }
              return;
            } 
            if(data['action'] == 'duplicate'){
              var msg = 'Invoice duplicated !';
              rounded.showMessage(msg);
            }
            if(data['action'] == 'sendInvoice'){
              rounded.loadInvoice({
                '_token' : token,
                'id' : data['id'],
                'page' : 'detail',
                'client' : '0'
              })
            }
            //rounded.showMessage(msg);
          }
        })  
      },
      changeAmount : function(e){
        var p = $(e).closest('.row');
        var price = parseFloat(p.find('input[name="unit_price"]').val());  
        var quantity = parseInt(p.find('input[name="quantity"]').val());
        if(p.find('input[name="inc_gst"]').is(':checked')){
          var amount =  price*quantity + price*quantity/10;
        }
        else {
          var amount =  price*quantity; 
        }
        amount = isNaN(amount) ? 0 : amount;  
        p.find('.amount').html('$' + amount.toFixed(2)); 
        p.find('input[name="amount"]').val(amount.toFixed(2));
        var subtotal = 0;
        var gst = 0;
        var total = 0;
        var price = 0;
        var quantity = 0;
        $('.price-content > .row').each(function(i,e){
          price =  parseFloat($(e).find('input[name="unit_price"]').val());
          price = isNaN(price) ? 0 : price;   
          quantity = parseInt($(e).find('input[name="quantity"]').val()); 
          quantity = isNaN(quantity) ? 0 : quantity;   
          subtotal += price*quantity;
          if($(e).find('input[name="inc_gst"]').is(':checked')){
            gst += price*quantity/10;
          } 
        });
        $('#cal_subtotal').html('$' + subtotal.toFixed(2));   
        $('input[name=subtotal]').val(subtotal.toFixed(2));   
        $('#cal_gst').html('$' + gst.toFixed(2));
        $('input[name=gst]').val(gst.toFixed(2));
        total = subtotal + gst;   
        $('#cal_total').html('$' + total.toFixed(2));
        $('input[name=total]').val(total.toFixed(2)); 
      },
      getUrlParameter : function(sParam)
      {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++) 
        {
          var sParameterName = sURLVariables[i].split('=');
          if (sParameterName[0] == sParam) 
          {
            return sParameterName[1];
          }
        }
      },
      pasteHtmlAtCaret : function(html, selectPastedContent) {
        var sel, range;
        if (window.getSelection) {
          // IE9 and non-IE
          sel = window.getSelection();
          if (sel.getRangeAt && sel.rangeCount) {
            range = sel.getRangeAt(0);
            range.deleteContents();

            // Range.createContextualFragment() would be useful here but is
            // only relatively recently standardized and is not supported in
            // some browsers (IE9, for one)
            var el = document.createElement("div");
            el.innerHTML = html;
            var frag = document.createDocumentFragment(), node, lastNode;
            while ( (node = el.firstChild) ) {
              lastNode = frag.appendChild(node);
            }
            var firstNode = frag.firstChild;
            range.insertNode(frag);

            // Preserve the selection
            if (lastNode) {
              range = range.cloneRange();
              range.setStartAfter(lastNode);
              if (selectPastedContent) {
                range.setStartBefore(firstNode);
              } else {
                range.collapse(true);
              }
              sel.removeAllRanges();
              sel.addRange(range);
            }
          }
        } else if ( (sel = document.selection) && sel.type != "Control") {
          // IE < 9
          var originalRange = sel.createRange();
          originalRange.collapse(true);
          sel.createRange().pasteHTML(html);
          if (selectPastedContent) {
            range = sel.createRange();
            range.setEndPoint("StartToStart", originalRange);
            range.select();
          }
        }
      },
      getDateOrder : function(number){
        if(number == 11) return 'th';
        switch(number%10){
          case 1 :
            return 'st';
          case 2 :
            return 'nd';
          case 3 :
            return 'rd';
          default :
            return 'th';
        }
      },
      previewTemplate : function(element){
        var now = new Date();
        month = now.getMonth();
        date = now.getDate();
        year = now.getFullYear();
        var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        var dueDay =  months[month] + ' ' + date + rounded.getDateOrder(date) + ', ' + year;

        var mark = [
          {
            key : '<span contenteditable="false">invoice number</span>',
            value : 'RDN-001'
          },
          {
            key : '<span contenteditable="false">your full name</span>',
            value : 'Jonh Smith'
          },
          {
            key : '<span contenteditable="false">your business name</span>',
            value : 'Rounded'
          },
          {
            key : '<span contenteditable="false">invoice due date</span>',
            value : dueDay
          },
          {
            key :'<span contenteditable="false">invoice due days</span>',
            value :'7'
          },
          {
            key : '<span contenteditable="false">payment amount</span>',
            value : '$7000'
          },
          {
            key : '<span contenteditable="false">client name</span>',
            value : 'Rounded'
          }
        ];

        var name = element.attr('name');
        var html = element.html();

        for(var i=0;i<mark.length;i++){
          html = html.replace( new RegExp(mark[i].key,'g'),mark[i].value);
        }
        if(name=='reminder_subject' || name=='invoice_subject'){
          $('div[data-name="'+name+'"] > p').html('Subject: ' + html);
        }
        else {
          $('div[data-name="'+name+'"] > p').html(html);
        }
      }
    }
    /* End rounded */

    $('body').on('focus', 'input, textarea', function(){
      $(this).removeAttr('style');
    });

    $('body').on('click', '.show-password',
      function(e){
        var id = '#' + $(this).data('show');
        $(id).attr('type') == 'password' ? $(id).attr('type','text') : $(id).attr('type','password'); 
    });
    menuItem.on('click', 'li > a', 
      function(e){
        e.preventDefault();
        var page = $(this).data('page');
        var parent = $(this).parent('li');
        var sub = parent.find('.sub-menu');
        menuItem.find('li').removeClass('active');
        if(parent.hasClass('parent')==false || (parent.hasClass('parent')==true && sub.length == 0)){
          parent.addClass('active');
        }
        if(page == '') return false;
        rounded.loadMenuPage('pages',page);
    });
    $('body').on('click', 'a[data-page="accountSettings"]',
      function(e){
        e.preventDefault();
        rounded.loadMenuPage('pages','accountSettings');
    });
    $('body').on('click', 'a[data-page="invoice"]',
      function(e){
        e.preventDefault();
        var data = {
          'id'  : 0,
          'client' : $(this).data('client'),
          '_token' : token 
        };
        rounded.loadInvoice(data);
    });
    wrapper.on('click','#update_login',
      function(){
        var form =$('#login_details_form');
        var data = {};
        var valid = true;
        data['email'] = form.find('input[name="email"]').val();
        data['password'] = form.find('input[name="password"]').val();
        if(data['email'] == ''){
          con
          form.find('input[name="email"]').css('border-color','red');
          valid = false;
        } 
        if(data['password'] == ''){
          form.find('input[name="password"]').css('border-color','red');
          valid = false;
        }
        data['_token'] = token;
        data['action'] = 'changeLoginDetail';
        if(valid == false) return valid;
        rounded.save(data);
    });
    wrapper.on('click','#pay',
      function(){
        var form =$('#payment_form');
        var data = {};
        var valid = true;
        data['credit_card'] = form.find('input[name="credit_card"]').val();
        data['sercurity_number'] = form.find('input[name="sercurity_number"]').val();
        if(data['credit_card'] == ''){
          form.find('input[name="credit_card"]').css('border-color','red');
          valid = false;
        } 
        if(data['sercurity_number'] == ''){
          form.find('input[name="sercurity_number"]').css('border-color','red');
          valid = false;
        }
        data['_token'] = token;
        data['action'] = 'pay';
        var year =  form.find('select[name="year"]').val();
        var month =  form.find('select[name="month"]').val();
        data['expiry_date'] = year + '-' + month;
        if(valid == false) return valid;
        rounded.save(data);
    });
    wrapper.on('click','#update_payment_show',
      function(){
        $(this).closest('.paid').hide();
        $('#payment_form').show();

    });
    wrapper.on('click', '.button.right-slider, a.right-slider',
      function(){
        var data={};
        data['form'] = $(this).data('form');
        if(data['form'] == '') return false;
        data['id']  = $(this).data('id');
        data['send']  = $(this).data('send');
        data['bank_id']  = $(this).data('bank-id');
        data['_token'] = token;
        data['view'] = 'slider';
        rounded.loadForm(data);
    });
    var selected = {
      removeClass : function(){}
    }; 
    wrapper.on('click', 'tr.right-slider > td:not(:first-child)',
      function(){
        var p = $(this).parent('.right-slider');
        selected.removeClass('selected');
        p.addClass('selected');
        selected = p;
        var data={};
        data['form'] = p.data('form');
        if(data['form'] == '') return false;
        data['id']  = p.data('id');
        data['bank_id']  = p.data('bank-id');
        data['_token'] = token;
        data['view'] = 'slider';
        rounded.loadForm(data);
    });
    wrapper.on('click', '.form-modal', 
      function(e){
        e.preventDefault();
        e.stopPropagation();
        var data={};
        data['form'] = $(this).data('form');
        if(data['form'] == '') return false;
        data['id']  = $(this).data('id');
        data['bank_id']  = $(this).data('bank-id');
        data['_token'] = token;
        rounded.loadForm(data);
    });
    wrapper.on('change','#expense input.check[type="checkbox"]',
      function(e){
        e.stopPropagation();
        var id = $(this).val();
        if($(this).is(':checked')){
          expense.push(id);
        }
        else{
          var idx = expense.indexOf(id);
          if(idx >= 0)
            expense.splice(idx,1); 
        };
    });
  // start modify
    wrapper.on('change','#date',function(){
      var data = {};
      data['_token'] = token;

      data['date'] = $('#date').find('option:selected').val();
      $.ajax({
        type : 'post',
        url : baseurl+'/ajax/changeDate',
        data : data,
        success : function(response){
          $('#from_view').val(response.from) ;
          $('#to_view').val(response.to) ;
        }
      })   ;


    });
    //$(document).ready(function(){
    //  var data = {};
    //  data['_token'] = token;
    //
    //  data['date'] = $('#date').find('option:selected').val();
    //  $.ajax({
    //    type : 'post',
    //    url : baseurl+'/ajax/changeDate',
    //    data : data,
    //    success : function(response){
    //      $('#from_view').val(response.from) ;
    //      $('#to_view').val(response.to) ;
    //    }
    //  })   ;
    //
    //})
 // end modify
    wrapper.on('change','#expense input.check-all[type=checkbox]',
      function(){
        var checkAll = $(this).is(':checked');
        if(checkAll==true){
          $('#expense input.check[type=checkbox]').each(
            function(i,e){
              var id = $(e).val();
              if($(e).is(':checked')==false) {
                $(e).prop('checked',true);
                expense.push(id);
              }
          });
        }
        else {
          $('#expense input.check[type=checkbox]').each(
            function(i,e){
              var id = $(e).val();
              if($(e).is(':checked')==true) {
                $(e).prop('checked',false);
                var idx = expense.indexOf(id);
                if(idx >= 0)
                  expense.splice(idx,1);
              }

          });
        };
    }); 
    wrapper.on('click', 'a.receipt-modal', 
      function(e){
        e.preventDefault();
        e.stopPropagation();
        $('#purchase_modal').removeClass('md-show');
        var data={};
        data['form'] = $(this).data('form');
        data['id']  = $(this).closest('tr').data('id');
        data['_token'] = token;
        rounded.loadForm(data);
    });
    wrapper.on('click', '.custome-filter .filter',
      function(){
        var target = $(this).data('target');
        if(target != 'action') return false;
        expense = [];
        $('.custome-filter .filter').removeClass('blue');
        $('.custome-filter').find('button[data-toggle=jdropdown]').removeClass('blue');
        $(this).addClass('blue');
        var type = $(this).data('type');
        var data = {};
        data['_token'] = token;
        data['type'] = type;
        data['area'] = area;
        data['date'] = 'all';
        var bank = $('.item-bank.active');
        if(bank.length > 0) data['bank_id'] = bank.data('id');
        wFilter = false;
        wType = type;
        rounded.loadExpense(data);
    });
    wrapper.on('click', '.custome-filter .ifilter',
      function(){
        var target = $(this).data('target');
        if(target != 'action') return false;
        expense = [];
        $('.custome-filter .ifilter').removeClass('blue');
        $('.custome-filter').find('button[data-toggle=jdropdown]').removeClass('blue');
        $(this).addClass('blue');
        var type = $(this).data('type');
        var data = {};
        data['_token'] = token;
        data['type'] = type;
        rounded.loadInvoices(data);
    });  
    wrapper.on('click', '#filter_form .filter',
      function(){
        expense = [];
        $('#filter_form .filter').removeClass('blue');
        //$('.custome-filter').find('button[data-toggle=jdropdown]').removeClass('blue');
        $(this).addClass('blue');
        var type = $(this).data('type');
        $('#transaction_type').val(type); 
    }); 
    wrapper.on('click', '.custom-filter-reset',
      function(){
        var form = $('form#filter_form');
        form.find('.filter[data-type=all]').click();
        form.find('#date').children('option').eq(0).prop('selected', true);
        form.find('#from_date').val('');
        form.find('#from_date_view').val('');
        form.find('#to_date').val('');
        form.find('#to_date_view').val('');
        form.find('#description_contains').val('');

        form.find('select[name="client"]').children('option').eq(0).prop('selected', true);
        form.find('select[name="state"]').children('option').eq(0).prop('selected', true);
    });
    wrapper.on('click', '.btn-custom-filter',
      function(){
        var form = $('form#filter_form');
        var data = {};
        data['_token'] = token;

        $('.custome-filter > li > .filter, .custome-filter > li > .ifilter').removeClass('blue');
        if( $('.custome-filter > li').hasClass('open') == true )
        {
          $('.custome-filter').find('button[data-toggle=jdropdown]').addClass('blue').click();
        }
        if($(this).attr('filter') == 'invoice'){
          data['from_date'] = form.find('#from_date').val();
          data['to_date'] = form.find('#to_date').val();
          data['state'] = form.find('select[name="state"]').val();
          data['client'] = form.find('select[name="client"]').val();
          data['type'] = 'custom';
          rounded.loadInvoices(data);
        }
        else
        {
          data['type'] = form.find('#transaction_type').val();
          data['date'] = form.find('#date').val();
          data['from_date'] = form.find('#from_date').val();
          data['to_date'] = form.find('#to_date').val();
          data['desc'] = form.find('#description_contains').val();
          var bank = $('.item-bank.active');
          if(bank.length > 0) data['bank_id'] = bank.data('id');
          data['area'] = area;
          wFilter = true;
          rounded.loadExpense(data);
        }

    });

    wrapper.on('click', '#emerge',
      function(e){
        e.preventDefault();
        if( expense.length != 2) {
          rounded.showMessage('<label>Select 2 items to merge...</label>');
          return false;
        }
        var amount1 = $('tr[data-id='+expense[0]+']').find('td').eq(6).html();
        var amount2 = $('tr[data-id='+expense[1]+']').find('td').eq(6).html();
        var type1 = $('tr[data-id='+expense[0]+']').find('td').eq(2).html();
        var type2 = $('tr[data-id='+expense[1]+']').find('td').eq(2).html();
        if( (amount1 !==  amount2 &&  amount1 !== '$0.00' &&  amount2 !== '$0.00') ||  type1 != type2) {
          rounded.showMessage('<label>2 items must same amount or 1 item has no amount and same type.</label>');
          return false;
        }
        $('a[data-modal="merge_modal"]').data('id',expense);
        $('a[data-modal="merge_modal"]').click();
    });

    wrapper.on('click', '#edelete', 
      function(e){
        e.preventDefault();
        if( expense.length == 0) {
          rounded.showMessage('<label>Select one or more items.</label>');
          return false;
        }
        var item =  expense.length > 1 ? (expense.length + ' items') : (expense.length + ' item');
        var msg = 'Delete ' + item + '. Are you sure ?';
        var option = {
          title : 'Delete Confirmation',
          text : msg,
          confirm : function(button) {
            var data = {
              '_token' : token,
              'id' : expense,
              'action' : 'expense'
            }
            rounded._delete(data);       
            return true;
          }
        };
        $.confirm(option); 
    });
    wrapper.on('click', '#bdelete',
      function(e){
        console.log(1);
        e.preventDefault();
        e.stopPropagation();
        var id = $(this).closest('.item-bank').data('id');
        var msg = 'Delete bank account and all expenses. Are you sure ?';
        var option = {
          title : 'Delete Confirmation',
          text : msg,
          confirm : function(button) {
            var data = {
              '_token' : token,
              'id' : id,
              'action' : 'bankAccount'
            }
            rounded._delete(data);       
            return true;
          }
        };
        $.confirm(option); 
    })
    wrapper.on('click', '#eremovegst', 
      function(e){
        e.preventDefault();
        if( expense.length == 0) {
          rounded.showMessage('<label>Select one or more items.</label>');
          return false;
        }
        var item =  expense.length > 1 ? (expense.length + ' items') : (expense.length + ' item');
        var msg = 'Remove GST ' + item + '. Are you sure ?';
        var option = {
          title : 'Remove GST Confirmation',
          text : msg,
          confirm : function(button) {
            var data = {
              '_token' : token,
              'id' : expense,
              'action' : 'gst'
            }
            rounded._delete(data);       
            return true;
          }
        };
        $.confirm(option); 
    });
    wrapper.on('click', '#ecategorise', 
      function(e){
        e.preventDefault();
        if( expense.length == 0) {
          rounded.showMessage('<label>Select one or more items.</label>');
          return false;
        }
        $('a[data-modal="category_modal"]').click();
    });
    wrapper.on('click', '#addwordbook', 
      function(e){
        e.preventDefault();
        if( expense.length == 0) {
          rounded.showMessage('<label>Select one or more items.</label>');
          return false;
        }
        var data = {};
        data['action'] = 'addWorkbook';
        data['_token'] = token;
        data['id'] = expense;
        rounded.save(data);
    });
    wrapper.on('click', '#generate_report', 
      function(e){
        e.preventDefault();
        var data = {};
        data['_token'] = token;
        data['year'] = $('#year').val();
        data['period'] = $('#period').val();
        $('#generate-basr').html(loading);
        $.ajax({
          type : 'post',
          url : baseurl + '/ajax/genreport',
          data : data,
          success : function(response){
            $('#generate-basr').html(response);
            $('#generate-basr .sales').height($('#generate-basr .purchases').height());
          }
        })
    });
   // modify
    wrapper.on('click', '#expense-report',
        function(e){
          e.preventDefault();
          var data = {};
          data['_token'] = token;

          data['date'] = $('#date').val();
          data['from_date'] = $('#from').val();
          data['to_date'] = $('#to').val();

          //data['year'] = $('#year').val();
          //data['from'] = $('#from').val();
          //data['to'] = $('#to').val();
          data['category'] = $('#category').val();
          $('#expense-basr').html(loading);
          $.ajax({
            type : 'post',
            url : baseurl + '/ajax/expensereport',
            data : data,
            success : function(response){
              $('#expense-basr').html(response);
              $('#expense-basr .sales').height($('#expense-basr .purchases').height());
            }
          })
        })






    //wrapper.on('change','#date',function(e){
    //  e.preventDefault();
    // var attr =  $('#date option:selected').val();
    //  if(attr == 'custom'){
    //    $('#custom-area').show();
    //  }else{
    //    $('#custom-area').hide();
    //  }
    //});
    // end modify
    wrapper.on('click', '#expense table tbody tr > td:not(:first-child)',
      function(e){
        if(area == 'banking') {
          var check = $(this).parent('tr').find('.check[type="checkbox"]').click();
        };
    })
    modal.on('click', '#categorise_select', 
      function(e){
        e.preventDefault();
        var data = {};
        data['_token'] = token; 
        data['action'] = 'changeCategory'; 
        data['id'] = expense;
        data['type'] = $('#transaction_type').val();
        data['categorise_select_id'] = $('#categorise_select_id').val();
        if($('#categorise_select_id').val() == '' || $('#categorise_select_id').val() == '0'){
          $('#categorise_select_id').css('border-color','red');
          return false;
        }
        rounded.save(data); 
    });
    modal.on('click', '.merge_select', 
      function(e){
        e.preventDefault();
        var id = $(this).data('id');
        modal.find('#merged_id').val(id);
        modal.find('.merge_select').removeAttr('style');
        $(this).css('font-weight','bold');
    }); 
    modal.on('click', '#merge_transaction', 
      function(e){
        e.preventDefault();
        var data = {};
        data['_token'] = token; 
        data['action'] = 'merge'; 
        data['merged_id'] = $('#merged_id').val();
        data['delete_id'] = parseInt(data['merged_id']) == expense[0] ? expense[1] : expense[0];
        data['description'] = $('#description').val();
        data['type'] = $('#transaction_type').val();
        if(data['merged_id'] == '')
        {
          alert('Select correct date.');
          return false;
        }
        rounded.save(data); 
    });
    modal.on('click', '#delete_receipt', 
      function(e){
        e.preventDefault();
        var del = confirm("Delete this receipt image ?");
        if (del == false) {
          return false;
        };
        var data = {};
        var form = $('#receipt-form');
        data['id'] =  form.find('#id').val();
        data['action'] = 'receipt';
        data['_token'] = token;
        rounded._delete(data);
    });
    modal.on('click', '#quicksetup', 
      function(){
        var fields = [
          {
            'field' : 'name',
            'required' : true 
          },
          {
            'field' : 'business_name',
            'required' : true 
          },
          {
            'field' : 'abn',
            'required' : true
          },
          {
            'field' : 'register_gst',
            'required' : false
          },
          {
            'field' : 'report_gst',
            'required' : false
        }];
        var data = {};
        data['_token'] = token;
        data['action'] = 'setting';
        for(var i=0; i < fields.length ; i++){
          var field = fields[i].field;
          if(field == 'register_gst'){
            data[field] = $('#register_gst').is(':checked') ? '1' : '0';
          }
          else{
            data[field] = $('#'+field).val();
          }
          if(data[field] == '' && fields[i].required == true ) {
            $('#'+field).css('border-color','red');
            return false;
          } 
        }
        rounded.save(data);

    });
    modal.on('click','#create_bank_count' ,
      function(){
        var data ={};
        data['account_name'] = $('#account_name').val();
        data['account_id'] = $('#account_id').val();
        if(data['account_name']=='') {
          $('#account_name').css('border-color','red');
          return false;
        }
        data['action'] = 'bankAccount';
        data['_token'] = token;
        rounded.save(data);
    });
    modal.on('click','#add_goal_btn' ,
      function(){
        var form = $('#add_goal');
        var data ={};
        data['month'] = form.find('*[name="month"]').val();
        data['quarter'] = form.find('*[name="quarter"]').val();
        data['financial_year'] = form.find('*[name="financial_year"]').val();

        data['action'] = 'goal';
        data['_token'] = token;
        rounded.save(data);
    });
    modal.on('click','.md-close-custom' ,
      function(){
        var parent = $(this).closest('.custom-modal.md-show');
        var modal = $('.custom-modal.md-show');
        if(modal.length > 0) modal.removeClass('md-show');                
        parent.find('.md-close').click();
        parent.find('.modal-content').html('');
    });
    wrapper.on('change','#category_id' ,
      function(){
        var form = $('#add_category_form');                 
        var val = $(this).val();
        if(val == 'create_category') 
        {
          form.slideDown(500);
          $(this).attr('disabled','disabled')
        }
    });
    wrapper.on('click','#add_category_form .btn-default' ,
      function(){
        var form = $('#add_category_form');
        form.find('#category_title').val('');                 
        form.slideUp(500);
        $('#category_id').removeAttr('disabled').find('option').eq(0).prop('selected',true);
    });
    wrapper.on('click','#add_category_form .btn-primary' ,
      function(){
        var form = $('#add_category_form');
        var data = {};
        data['_token'] = token;
        data['action'] = 'category';
        data['category_title'] = form.find('#category_title').val();
        if( data['category_title']=='' ) {
          form.find('#category_title').css('border-color','red');
          return false;
        };
        rounded.save(data);                 
    });
    wrapper.on('keyup', 'input#amount',
      function(){
        var type = $(this).closest('form').data('type');
        var rate = 11;
        var amount = parseFloat($(this).val());
        if(isNaN(amount) && amount != '.' ){
          amount=0;
          $(this).val('');
        }
        var gst = amount/rate;
        var inc_gst = $('#inc_gst').is(':checked') ;
        if(inc_gst) $('#gst').val(gst.toFixed(2)); 
    }); 

    //import from QIF
    modal.on('click','#import',
      function(){
        var income = $('#im-income').is(':checked')==true?'1':'0';
        var purchase = $('#im-purchase').is(':checked')==true?'1':'0';
        var inc_gst = $('#inc-gst').is(':checked')==true?'1':'0';
        var bank_id = $('#bank_id').val();
        var file = $('#attachment')[0].files[0];
        if(income == '0' && purchase=='0'){
          alert('Choose import type');
          return false;
        };
        if($('#attachment').val() == ''){
          alert('Choose file !');
          return false;
        };
        var fileSrc = '';
        var data = new FormData();
        data.append('file', file);
        data.append('type','tmp');
        data.append('_token',token);
        rounded.upload(data);
        var _int = setInterval(
          function(){
            if(fileUpload !== ''){
              clearInterval(_int);
              var file = fileUpload;
              fileUpload = '';
              if(file.extension != 'qif'){
                alert('You must upload QIF file');
                rounded.clearFile(file.path);
                return false;
              } else {
                var data = {};
                data['file'] = file.path;
                data['income'] = income;
                data['purchase'] = purchase;
                data['inc_gst'] = inc_gst;
                data['bank_id'] = bank_id;
                data['_token'] = token;
                rounded._import(data);
                return true;
              }
            } 
          },500);
        return true;
    });

    // crud
    wrapper.on('click', '#add-income', 
      function(e){
        var fields = [
          {
            'field' : 'id',
            'required' : true 
          },
          {
            'field' : 'amount',
            'required' : true
          },
          {
            'field' : 'inc_gst',
            'required' : false
          },
          {
            'field' : 'gst',
            'required' : false
          },
          {
            'field' : 'category_id',
            'required' : false
          },
          {
            'field' : 'invoice_id',
            'required' : false
          },
          {
            'field' : 'updated_at',
            'required' : false
          },
          {
            'field' : 'description',
            'required' : false
        }];
        var data = {};
        data['id'] = 0;
        data['type'] = $(this).data('type');
        data['action'] = 'expense';
        data['_token'] = token;
        for(var i=0; i < fields.length ; i++){
          var field = fields[i].field;
          data[field] = $('#'+field).val();
          if(field == 'inc_gst') {
            if($('#'+field).is(':checked') == true){
              data[field] = 1;
            }
            else {
              data[field] = 0;
            }
          }
          if(data[field] == '' && fields[i].required == true ) {
            $('#'+field).css('border-color','red');
            return false;
          } 
        }
        var form = $('form#add_expense');
        $(this).attr('disabled','disabled').html('creating...');
        $('.md-close-custom').attr('disabled','disabled');
        form.find('input, textarea, select, .jclose').attr('disabled','disabled');
        rounded.save(data);
        var form = $(this).closest('form');
        if(data['id']=='0') rounded.clearFrom(form);              
    });

    // add receipt
    wrapper.on('click', '#add-purchase',
      function(){
        var form = $('form#add_expense');
        var data = {};
        data['id'] = form.find('#id').val();
        data['amount'] = form.find('#amount').val();
        data['gst'] = form.find('#gst').val();
        data['inc_gst'] = form.find('#inc_gst').is(':checked') == true?1:0;
        data['updated_at'] = form.find('#updated_at').val();
        data['category_id'] = form.find('#category_id').val();
        data['description'] = form.find('#description').val();
        data['business_use'] = form.find('#business_use').val();
        data['expense_type'] = form.find('#expense_type').val();
        data['frequency'] = form.find('#frequency').val();
        data['until'] = form.find('#until').val();
        data['until_date'] = form.find('#until_date').val();
        data['p_attachment'] = form.find('#p_attachment').val();
        data['recurring_expense'] = form.find('#recurring_expense').val();
        data['type'] = $(this).data('type');
        data['action'] = 'expense';
        data['_token'] = token;
        var validate = true;
        if(form.find('#amount').val()==''){
          form.find('#amount').css('border-color','red');
          validate = false;
        }
        if(validate == false) return false;
        if($('#recur_id').val() != '0' && data['recurring_expense'] == '1'){
          var r = confirm("Do you want to use these expense for all future recurring expense?");
          if (r == false) {
            return false;
          }
        }
        $(this).attr('disabled','disabled').html('creating...');
        $('.md-close-custom').attr('disabled','disabled');
        form.find('input, textarea, select, .jclose').attr('disabled','disabled');
        var formdata = new FormData();
        var attachment = form.find('#attachment');
        if(attachment.length > 0 && attachment.val() != '') {
          var file = form.find('#attachment')[0].files[0];
          formdata.append('file', file);
          formdata.append('type','tmp');
          formdata.append('_token',token);
          rounded.upload(formdata);

          var _int = setInterval(
            function(){
              if(fileUpload !== ''){
                clearInterval(_int);
                var file = fileUpload;
                fileUpload = '';
                if(file.extension != 'png' && file.extension != 'jpg' && file.extension != 'bmp'){
                  alert('You must an image!');
                  rounded.clearFile(file.path);
                  return false;
                } else {
                  data['attachment'] = file.path;
                  rounded.save(data);
                  return true;
                }
              } 
            },500);
        } 
        else {
          rounded.save(data); 
        }
    });
    modal.on('change','#add_expense input[type="file"]',
      function(){ 
        var allow = ['jpg','png','gif','JPG','PNG','GIF'];
        var file = $(this)[0].files[0];
        var name = file.name;
        var aExt = name.split('.');
        var ext = aExt[aExt.length-1];
        if($.inArray(ext,allow) >= 0){
          var filerdr = new FileReader();
          filerdr.onload = function(e) {
            $('.file-preview img').attr('src', e.target.result);
          }
          filerdr.readAsDataURL(file);
          $('#purchase_modal .upload-content .file-preview').show();
        }
    });
    modal.on('click','a.jclose',
      function(e){
        e.preventDefault();
        var disabled = $(this).attr('disabled');
        if(disabled == 'disabled') return false;
        $('#purchase_modal .upload-content .file-preview').removeAttr('style');
        $('#attachment').val('');
        $('#attachment').next().attr('title','').find('span').html('Or select file');
        $('#p_attachment').val('');
    })
    modal.on('change','#register_gst',
      function(e){
        if($(this).is(':checked')){
          $('#report_gst').parent().show();
        }
        else {
          $('#report_gst').parent().hide();
        }
    })
    // action
    wrapper.on('click','table#purchase .action, table#income .action',
      function(e){
        e.preventDefault();
        var action = $(this).data('action');
        var id = $(this).closest('tr').data('id');
        var form = $(this).closest('table').attr('id');
        if(action == 'edit'){
          loadForm(form, id);
          return true;
        }
        return false;
    });
    wrapper.click(
      function(e){
        $('.custome-filter > li').removeClass('open');
    });
    wrapper.on('click', 'button[data-toggle=jdropdown]', 
      function(e){
        e.stopPropagation();
        $('button[data-toggle=dropdown]').parent().removeClass('open');
        var parent = $(this).parent('li');
        if( parent.hasClass('open')) parent.removeClass('open');
        else parent.addClass('open');    
    });
    wrapper.on('click','#filter_form',
      function(e){
        e.stopPropagation();
    });
    wrapper.on('click','.list-bank .item-bank',
      function(e){
        $('.list-bank .item-bank').removeClass('active');
        $(this).addClass('active');
        var form = $('form#filter_form');
        var data = {};
        data['_token'] = token;
        data['type'] = form.find('#transaction_type').val();
        data['date'] = form.find('#date').val();
        data['from_date'] = form.find('#from_date').val();
        data['to_date'] = form.find('#to_date').val();
        data['desc'] = form.find('#description_contains').val();
        data['bank_id'] =  $(this).data('id');
        data['area'] = area;
        $('.custome-filter').find('button[data-toggle=jdropdown]').click();
        rounded.loadExpense(data);
    });
    wrapper.on('click', '.bank-action > button',
      function(e){
        e.stopPropagation();
        if($(this).parent('.bank-action').hasClass('open'))
          $(this).parent('.bank-action').removeClass('open');
        else
          $(this).parent('.bank-action').addClass('open');

    }); 
    wrapper.on('click', '#add_client_btn',
      function(e){
        e.preventDefault();
        var fields = [
          {
            field : 'business_name',
            require : true
          },
          {
            field : 'contact_name',
            require : true
          },
          {
            field : 'email',
            require : true
          },
          {
            field : 'abn',
            require : true
          },
          {
            field : 'invoice_prefix',
            require : true
          },
          {
            field : 'sign',
            require : false
          },
          {
            field : 'address',
            require : true
          },
        ];
        var form = $('#add_client_btn');
        var data = {};
        var valid = true
        for(var i=0;i<fields.length;i++){
          var field =  fields[i];
          var value = $('#'+field.field).val();
          if(value == '' && field.require == true){
            valid = false;
            $('#'+field.field).css('border-color','red')
          }
          data[field.field] = value;  
        }
        if (valid==false) return valid;
        data['id'] = $('#id').val();
        data['_token'] = token;
        data['action'] = 'client';
        rounded.save(data); 

    });
    wrapper.on('click','.delete-client',
      function(e){
        e.preventDefault();
        var id = $(this).closest('tr').data('id');
        var msg = 'Delete client. Are you sure ?';
        var option = {
          title : 'Delete Confirmation',
          text : msg,
          confirm : function(button) {
            var data = {
              '_token' : token,
              'id' : id,
              'action' : 'client'
            }
            rounded._delete(data);       
            return true;
          }
        };
        $.confirm(option);
    });
    wrapper.on('click','.save_setting',
      function(e){
        e.preventDefault();
        var form = $('form[setting-form="true"]');
        if(form.length == 0) return false;
        var fields = [];
        form.find('*[form-field="true"]').each(function(i,e){
          var field = {};
          field['field'] = $(e).attr('name');
          field['type'] = $(e).attr('type');
          fields[i] = field;
        });
        //console.log(fields);return;
        var data =  {};
        for(var i=0;i<fields.length;i++){
          var field = fields[i];
          switch(field['type']){
            case 'checkbox' :
              data[field['field']] = $('*[name="'+field['field']+'"]').is(':checked') ? '1' : '0';
              break;
            case 'radio' :
              data[field['field']] = $('*[name="'+field['field']+'"]:checked').val();
              break;
            case 'customize' :
              data[field['field']] =$('div[name="'+field['field']+'"]').html();
              break;
            default :
              data[field['field']] = $('*[name="'+field['field']+'"]').val();
              break
          }

        }   
        data['_token'] = token;
        data['action'] = form.attr('setting-type');
        if(data['action'] == 'invoicing' && $('#file_logo').val() != ''){
          var file = $('#file_logo')[0].files[0]; 
          var fileData = new FormData();
          fileData.append('file', file);
          fileData.append('type','tmp');
          fileData.append('_token',token);
          rounded.upload(fileData);
          var _int = setInterval(
            function(){
              if(fileUpload !== ''){
                clearInterval(_int);
                var file = fileUpload;
                fileUpload = '';
                data['logo'] = file.path;
                console.log(data);  
                rounded.save(data);
              } 
            },500); 
        } else {
          rounded.save(data);
        }  
        return true;

    });

    wrapper.on('click', '.insert',
      function(){ 
        var mu = $(this).data('insert');
        var m =  $(this).html();
        //var img = 'assets/images/markup/mark_' + mu + '.png';
        var mk = '<span contenteditable="false">'+m+'</span>';
        fm.focus() ; // DIV with cursor is 'myInstance1' (Editable DIV)
        rounded.pasteHtmlAtCaret(mk, false);
        rounded.previewTemplate(fm);
        return false;
    });
    wrapper.on('keyup', '#invoice_form input[name="unit_price"],#invoice_form input[name="quantity"]',function(){ 
      rounded.changeAmount(this);
    });
    wrapper.on('change', '#invoice_form input[name="inc_gst"]',function(){ 
      rounded.changeAmount(this);
    });
    wrapper.on('click', '#add_new_line',function(e){
      e.preventDefault();
      rounded.addNewLine();
    });
    wrapper.on('click', '.page_back',function(e){
      e.preventDefault(); 
      $('a[data-page="'+ rounded.page +'"]').click();
    });
    wrapper.on('click', '.save-invoice',function(e){
      e.preventDefault(); 
      var data = {};
      var field = ['client_id', 'invoice_number', 'company_name',
        'company_legal', 'company_address', 'company_abn',
        'client_name', 'client_legal', 'client_address',
        'due_date', 'issued_date', 'payment_term', 'description',
        'subtotal', 'gst', 'total','id'];
      for(var i=0;i<field.length;i++){
        switch (field[i]) {
          case 'description' :
            data[field[i]] = $('textarea[name="'+field[i]+'"]').val();
            break;
          default :
            data[field[i]] = $('input[name="'+field[i]+'"]').val(); 
            break;
        }   
      }
      if(data['client_id'] == '' || data['client_id']=='0'){
        rounded.showMessage('Select client');
        return false;
      }
      var price = [];
      $('.price-content > .row').each(function(i,e){
        var p ={};
        p['desc'] = $(e).find('input[name=desc]').val();
        p['price'] = $(e).find('input[name=unit_price]').val();
        p['quantity'] = $(e).find('input[name=quantity]').val();
        p['inc_gst'] = $(e).find('input[name=inc_gst]').is(':checked') ? 1 : 0;
        p['amount'] = $(e).find('input[name=amount]').val();
        price.push(p);
      });
      data['price'] = price;
      data['_token'] = token;
      data['action'] = 'singleInvoice';
      data['__save'] = $(this).data('save');
	  if(data['__save'] == 'save_send' && ($('input[name=total]').val() == '0' ||  $('input[name=total]').val() == '0.00')){
		//var msg = 'Invoice have no amout.Can you want to fill some amount before send invoce.<br>Continue send?';
        rounded.showMessage('You can\'t send empty invoice. Please fill invoice amount.');
		return false;
	  } else {
		rounded.loader.open('In progress');
		rounded.save(data);
	  }
    });
    wrapper.on('click', '.edit-invoice, .detail-invoice',
      function(e){
        e.preventDefault();
        var page = 'default';
        if($(this).hasClass('detail-invoice')) {
          page = 'detail';
        }
        var id = $(this).closest('.invoice-block').data('id');
        var data = {
          'id' : id,
          'client' : 0,
          'page' : page,
          '_token' : token
        };
        rounded.loadInvoice(data);
    });
    wrapper.on('click', '#record_payment',
      function(e){
        e.preventDefault();
        var data = {};
        var form = $('#payment_form');
        data['_token'] = token;

        data['amount'] = form.find('input[name="amount"]').val();
        if(isNaN(data['amount']) == true || data['amount'] == '') {
          form.find('input[name="amount"]').css('border-color','red');
          return false;
        }
        data['created_date'] = form.find('input[name="created_date"]').val();
        data['note'] = form.find('input[name="note"]').val();
        data['invoice_id'] = form.find('input[name="invoice_id"]').val();
        data['gst'] = form.find('input[name="gst"]').val();
        data['inc_gst'] = form.find('input[name=inc_gst]').is(':checked') ? 1 : 0;
        data['action'] = 'invoicePayment';
        rounded.save(data);

    });
    wrapper.on('click', '.delete-invoice',
      function(e){
        e.preventDefault();
        var id = $(this).data('id');
        msg = 'Delete invoice ?'
        var option = {
          title : 'Delete Confirmation',
          text : msg,
          confirm : function(button) {
            var data = {
              'id' : id,
              'action' : 'invoice',
              '_token' : token
            };
            rounded._delete(data);       
            return true;
          }
        };
        $.confirm(option);

    });
    wrapper.on('click', '.inv-action',
      function(e){
        e.preventDefault();
        var data ={};
        data['id'] = $(this).data('id');
        data['action'] = $(this).data('action');
        if(data['action'] == 'sendInvoice'){
          var form = $('.send-invoice');
          data['email_to'] = form.find('input[name=email_to]').val();
          data['id'] = form.find('input[name=id]').val();
          data['subject'] = form.find('input[name=subject]').val();
          data['content'] = form.find('textarea[name=content]').val();
          data['attach_invoice'] = form.find('input[name=attach_invoice]').is(':checked') ? '1' : '0';
          data['attach_link'] = form.find('input[name=attach_link]').is(':checked') ? '1' : '0';
          data['bbc_me'] = form.find('input[name=bbc_me]').is(':checked') ? '1' : '0';
          data['send'] = $(this).data('send');
        }
        data['_token'] = token;
        rounded.loader.open('In progress')
        rounded.invoiceAction(data);
    });
    /*wrapper.on('change', 'input[name="attach_invoice"]', function(){
      var self = $(this);
      var msg = 'If option is checked Rounded will generate PDF and attach to your email.\nThis process will take a few minutes'; 
      if(self.is(':checked')){
        self.prop('checked',false);
        var option = {
          title : 'Notice',
          text : msg,
          confirm : function(button) {
            self.prop('checked',true);
            return true;
          }
        };
        $.confirm(option); 
      } 
    })*/ 
    /*wrapper.on('click', '#ready_send',function(e){
    e.preventDefault();
    $('.save-invoice[data-save="save"]').click(); 
    /*var inv = $('#invoice_form input[name="id"]').val();  
    if(inv == '' || inv == '0'){
    rounded.showMessage('Save Invoice Before Send.')
    return false;
    }
    });*/
    $('body').on('click', '.custome-filter .md-close-custom', 
      function(){
        var customModal = $(this).closest('.custome-filter');
        customModal.removeClass('open');
    });
    $('body').on('click','a.custom-file',
      function(e){
        e.preventDefault();
        var id = $(this).data('target');
        $(id+'[type="file"]').click();
        return false;
    });
    $('body').on('change','input[type=file]',
      function(e){
        e.preventDefault();
        if($(this).next().hasClass('custom-file')){
          var label = $(this).next();
          var fileID = label.data('target');
          var input =  $(fileID)[0];
          var file = input.files[0].name;

          var review = file;
          if(file.length > 12 ){
            review = file.substring(0,12);
            review += '...';
          }

          label.attr('title',file).find('span').html(review);
          $(this).next().removeAttr('style');
        }
    });
    $('body').on('change','.trans-import > input',
      function(e){
        var p = $(this).parent('.trans-import');
        var ol = p.find('span.attachment').html();
        var f = l = $(this)[0].files[0].name;
        var l = f;
        var aExt = f.split('.');
        var ext = aExt[aExt.length-1];
        if(ext != 'qif' && ext != 'QIF'){
          alert('You must choose a qif file.');
          return false;
        }
        if(f.length > 25){
          l = f.substring(0,25);
          l +='...QIF';
        }
        p.find('span.attachment').html(l); 
    });
    $('body').on('change','.upload-button > input',
      function(e){
        var p = $(this).parent('.upload-button');
        var allow = ['jpg','png','gif'];
        var file = $(this)[0].files[0];
        var name = file.name;
        var aExt = name.split('.');
        var ext = aExt[aExt.length-1];
        if($.inArray(ext,allow) >= 0){
          var filerdr = new FileReader();
          filerdr.onload = function(e) {
            p.find('.upoad-preview > img').attr('src', e.target.result);
          }
          filerdr.readAsDataURL(file);
          p.addClass('showed');
        } else {
          rounded.showMessage('Please choosse an image file (jpg,png,gif)');
        }
        return true;
    });
    $('body').on('click','.upload-button > .upoad-delete',
      function(e){
        e.preventDefault();
        var p = $(this).parent('.upload-button');
        if(p.hasClass('showed')){
          p.find('input').val('');
          p.removeClass('showed');
        }
        return false;

    });
    var fm;
    $('body').on('keyup','.jinput',function(){
      rounded.previewTemplate($(this));   
    });
    $('body').on('focus', '.jinput',
      function(e){
        fm =$(this);
    });
    $('body').on('keypress', '.jinput[data-input="input"]',
      function(e){
        return e.which != 13;
    });
    $(document).keyup(function(e) {
      if (e.keyCode == 27) { 
        var modal = $('.md-show');
        if(modal.length > 0) {
          for(var i = 0 ; i < modal.length ; i++){
            modal.eq(i).find('.md-close').click();
          }
        }
      } 
    });
    modal.keypress(function(e) {
      if (e.which == 13) { 
        $(this).find('.btn-primary').click();
        return false;
      } 
    });
    var invoiceId = rounded.getUrlParameter('invoice');
    if(!isNaN(invoiceId)){
      var data = {
        id : invoiceId,
        client : 0,
        _token : token,
        page : 'detail'
      };
      rounded.page = 'dashboard';
      menuItem.children('li').removeClass('open').children('.sub-menu').removeAttr('style');
      rounded.loadInvoice(data);
    }
    else {
      rounded.init(); 
    }
    //$('.cl-navblock').scrollToFixed();

  });                 
})(jQuery)


//modify
jQuery(document).on('click','.cat-action-button',function(){
  var action = jQuery(this).attr('data-action');
  var parentId = jQuery(this).attr('data-id');
  parentId = '#cat-'+parentId;
  if(action == 'edit'){
    showUpdateForm(parentId);
  }
  if(action =='delete'){
    showDeleteForm(parentId);
  }
})
//update form
function showUpdateForm($parentID){

  jQuery($parentID+' .cat-content').children('.form_title').toggleClass('action-hide');
  jQuery($parentID+' .cat-content').children('.form_action').toggleClass('action-hide');
}
//update action
jQuery(document).on('click','.form_action_submit', function(){
  var id = jQuery(this).attr('data-id');
  var val = jQuery('#value-'+id).val();
  jQuery.ajax({
    'url': '/ajax/category/renameCategory',
    'type' : 'POST',
    'data' : { id: id, title : val }
  }).done(function($res){
      console.log($res);
      if($res.code == 1){
        showUpdateForm('#cat-'+id);
          jQuery('#cat-'+id).children('.cat-content').children('.form_title').html(val);

      }
  })
});
//delete
function showDeleteForm($parentID){
  var id = $parentID;
  var msg = 'Delete client. Are you sure ?';
  var option = {
    title : 'Delete Confirmation',
    text : msg,
    confirm : function(button) {
      var data = {
        'id' : id,
        'action' : 'client'
      }
      deleteCategoryAction(id);
      return true;
    }
  };
  jQuery.confirm(option);
}
function deleteCategoryAction(categoryId){
  var id = jQuery(categoryId).children('.cat-action').children('.delete').attr('data-id');
  jQuery.ajax({
    'url' : '/ajax/category/deleteCategory',
    'type' : 'POST',
    'data' : {id: id}
  }).done(function($res){
    console.log($res);
    if($res.code == 1){
      jQuery('#cat-'+id).parent().remove();
    }
  });
}

//add new
jQuery(document).on('click','#addNewCategoryBtn',function(){
  var value = jQuery('#addNewCategoryText').val();
  if(value != ''){
    jQuery.ajax({
      url: '/ajax/category/addNewCategory',
      type : 'POST',
      data : { title : value }
    }).done(function($res){
      if($res.code == 1){
        var row = renderRow($res.id,value);
        jQuery('#categoryTable').children('tbody').append(row);
      }
    });
  }
})

function renderRow($id,$title){
  var row = '<tr data-id="'+$id+'" class="category-item"> \
      <td style="" id="cat-'+$id+'"> \
  <div class="cat-content"> \
  <span class="form_title">'+$title+'</span> \
  <div class="form_action action-hide"> \
  <input data-id="'+$id+'" id="value-'+$id+'" type="text" value="'+$title+'" class="form_action_value"> \
  <input data-id="'+$id+'" type="button" value="Save" class="form_action_submit button right-slider"> \
  </div> \
  </div> \
  <div class="cat-action"> \
  <a data-id="'+$id+'" data-action="edit" class="cat-action-button edit">Edit</a> \
  <a data-id="'+$id+'" data-action="delete" class="cat-action-button delete">Delete</a> \
  </div> \
  </td> \
  </tr>';
  return row;
}


//end modify

