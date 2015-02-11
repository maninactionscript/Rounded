<div class="basr row">
    <div class="large-12 columns">
        <div class="large-6 columns sales">                            
            <div class="large-12 header">
                <h6>Sales</h6>
            </div>
            <div class="large-12 columns">
                Sales with GST: ${{ number_format($report['totalSalesIncGST'],2) }}
            </div>
            <div class="large-12 columns">
                Sales excluding GST: ${{ number_format($report['totalSalesNoGST'],2) }}
            </div>
            <div class="large-12 columns">
                <span class="total-text">Total Sales: ${{ number_format($report['totalSales'],2) }}</span>
            </div>
           {{-- @if(isset($user->businessDetail) && $user->businessDetail->register_gst == '1' ) --}}
            <div class="large-12 columns">
                <span class="gst-text">GST on Sales: ${{ number_format($report['totalSalesGST'],2) }}</span>
            </div>
          {{--  @endif  --}}
        </div>

        <div class="large-6 columns purchases">
            <div class="large-12 header">
                <h6>Purchases</h6>
            </div>                            
            <div class="large-12 columns">
                Capital puchases: ${{ number_format($report['capPurchases'],2) }}
            </div>
            <div class="large-12 columns">
                Non capital puchases: ${{ number_format($report['noncapPurchases'],2) }}
            </div>
            <div class="large-12 columns">
                Puchases with GST: ${{ number_format($report['totalPurchasesIncGST'],2) }}
            </div>
            <div class="large-12 columns">
                Puchases excluding GST: ${{ number_format($report['totalPurchasesNoGST'],2) }}
            </div>
            <div class="large-12 columns">
                <span class="total-text">Total Puchases: ${{ number_format($report['totalPurchases'],2) }}</span>
            </div>
           {{-- @if(isset($user->businessDetail) && $user->businessDetail->register_gst == '1' )  --}}
            <div class="large-12 columns">
                <span class="gst-text">GST on Puchases: ${{ number_format($report['totalPurchasesGST'],2) }}</span>
            </div>
           {{-- @endif --}}
        </div>
        <div class="modal-footer large-12 columns" style="margin: 0px; border-radius: 4px;">                            

            <div class="large-6 columns text-left" style="padding-top: 25px;">
                <span class="tax-off-text">{{ $report['taxTitle'] }}</span>
            </div>
            <div class="large-6 columns text-right">
                <span class="tax-off-num">${{ number_format($report['taxOffice'],2) }}</span>
            </div>
        </div>
    </div>
</div>