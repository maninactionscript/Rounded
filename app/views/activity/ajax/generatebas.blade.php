<div class="block-flat" id="generate-basr">
    <div class="header">                            
        <h5>Sales</h5>
        <div>
            <div class="row">
                <div class="col-sm-3"><label>Total Sales:</label></div><div class="col-sm-9"><span>${{ number_format($totalSales,2) }}</span></div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3"><label>&nbsp;&nbsp;Sales with GST:</label></div><div class="col-sm-9"><span>${{ number_format($totalSalesIncGST,2) }}</span></div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><label>&nbsp;&nbsp;Sales excluding GST:</label></div><div class="col-sm-9"><span>${{ number_format($totalSalesNoGST,2) }}</span></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3"><label>GST on Sales:</label></div><div class="col-sm-9"><span>${{ number_format($totalSalesGST,2) }}</span></div>
            </div>

        </div>
    </div>
    <div class="header">                            
        <h5>Purchases</h5>
        <div>
            <div class="row">
                <div class="col-sm-3"><label>Total Puchases:</label></div><div class="col-sm-9"><span>${{ number_format($totalPurchases,2) }}</span></div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3"><label>&nbsp;&nbsp;Puchases with GST:</label></div><div class="col-sm-9"><span>${{ number_format($totalPurchasesIncGST,2) }}</span></div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><label>&nbsp;&nbsp;Puchases excluding GST:</label></div><div class="col-sm-9"><span>${{ number_format($totalPurchasesNoGST,2) }}</span></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3"><label>GST on Puchases:</label></div><div class="col-sm-9"><span>${{ number_format($totalPurchasesGST,2) }}</span></div>
            </div>

        </div>
    </div>
    <div class="header">                            
        <h5>Amounts owed</h5>
         <div>
            <div class="row">
                <div class="col-sm-3"><label>{{ $taxTitle }}</label></div><div class="col-sm-9"><span>${{ number_format($taxOffice,2) }}</span></div>
            </div>
        </div>
    </div>
</div>