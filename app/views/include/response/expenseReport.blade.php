<div class="row">
    <div class="large-12 columns" style="margin-top: 100px;">
        <table class="table-noborder no-border no-strip" border="0"  cellspacing="0" cellpadding="0" style="border: none !important;">
            
        </table>
        <?php $i=0;   $sTotalAmount = 0;
        $sTotalGst = 0;
        $sTotalInGst = 0;
        ?>
        <?php foreach($expense as $key => $item) {
            if(!empty($item['expense'])){

            $totalAmount = 0;$totalGst = 0; $totalInGst = 0;  $i++;

            ?>
        <table class="table-noborder no-border no-strip" border="0"  cellspacing="0" cellpadding="0" style="position:relative">
			<?php if($i < 2) { ?><thead class="no-border-y thead_fixed" id="thead_scroll">
            <tr>
                <th width="100" id="th_1">Date</th>
                <th id="th_2"  width="250">Description</th>
                <th width="150" id="th_3">Amount inc GST</th>
                <th width="150" id="th_4">GST</th>
                <th width="150" id="th_5">Amount excl GST</th>
            </tr>
            </thead>
			<?php } ?>
             <caption>{{$item['title']}}</caption>
            
         <!--   <thead class="no-border-y" id="thead_scroll" style="opacity: 0">
            <tr>
                <th width="100" id="th_1">Date</th>
                <th id="th_2"  width="250">Description</th>
                <th width="150" id="th_3">Amount inc GST</th>
                <th width="150" id="th_4">GST</th>
                <th width="150" id="th_5">Amount excl GST</th>
            </tr>

            </thead>-->
            
            <tbody class="no-border-y">
          <?php  foreach($item['expense'] as $keyItem){ ?>
            <tr>
                <td  width="100">{{date("y M, d",strtotime($keyItem->updated_at))}}</td>
                <td width="250">{{$keyItem->description}}</td>
                <td width="150"> ${{(number_format($keyItem->amount,2))}}</td>
                <td width="150">${{number_format($keyItem->gst,2)}}</td>
                <td width="150">${{ number_format(($keyItem->amount) -  ($keyItem->gst),2)}}</td>
            </tr>
                <?php
                $totalAmount += $keyItem->amount ;
               $totalGst += $keyItem->gst;
                $totalInGst += $keyItem->amount - ( $keyItem->gst);
              } ?>
            <tr>
                <td colspan="2" style="text-align: right;color: #000003;font-weight: bold"><strong>Total</strong></td>

                <td style="color: #000003;font-weight: bold"><strong>${{number_format($totalAmount,2)}}</strong></td>
                <td style="color: #000003;font-weight: bold"><strong>${{number_format($totalGst,2)}}</strong></td>
                <td style="color: #000003;font-weight: bold"><strong>${{number_format($totalInGst,2)}}</strong></td>
            </tr>
            </tbody>
        </table>
            <?php
                $sTotalAmount += $totalAmount;
                $sTotalGst += $totalGst;
                $sTotalInGst += $totalInGst;
                    $i++;

            }

        } ?>
        <table  style="margin-top: 90px"  class="table-noborder  no-border no-strip" border="0"  cellspacing="0" cellpadding="0">
            <thead class="no-border-y">
                <th   width="350" style="color: #0ed8b9;font-weight: bold;">TOTAL {{$timeReport}} </th>
                <th width="150" >Amount inc GST</th>
                <th width="150">GST</th>
                <th width="150">Amount excl GST</th>
            </thead>
            <tbody class="no-border-y">
            <tr>
                <td  style="text-align: right;color: #0ed8b9;font-weight: bold"></td>

                <td style="color: #0ed8b9;font-weight: bold"><strong>${{number_format($sTotalAmount,2)}}</strong></td>
                <td style="color: #0ed8b9;font-weight: bold"><strong>${{number_format($sTotalGst,2)}}</strong></td>
                <td style="color: #0ed8b9;font-weight: bold"><strong>${{number_format($sTotalInGst,2)}}</strong></td>
            </tr>
            </tbody>

        </table>

   </div>
</div>
<!--<script>

    $(document).ready(function() {
        var offset = $('#thead_scroll').offset().top;
        var duration = 500;
        $(window).scroll(function () {
            if ($(this).scrollTop() > (10)) {
              //  $('#wrap_fluid').addClass('display_none');
                $('#thead_scroll').addClass('thead_fixed');

            } else {
              //  $('#wrap_fluid').removeClass('display_none');
                $('#thead_scroll').removeClass('thead_fixed');
            }
        });

    });
</script>-->
<style>
    table.no-border tr th{
        border:none !important;
    }
    .cl-sidebar {
     
        float: left;
    }

</style>