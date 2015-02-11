<div class="row">
    <div class="col-sm-12 expense-list">
        <div class="row basr-actions">
            <h1>Imported</h1>
        </div>
        <div class="row">
            <table class="no-border table-list" id="imported">
                <thead class="no-border">
                    <tr>
                        <th style="width: 5%;">No.</th>
                        <th style="width: 20%;">Date</th>
                        <th style="width: 40%;">Description</th>
                        <th>Amount</th>
                        <th>GST</th>
                        <th>Type</th>
                        <th style="text-align: center; width: 12%;">Status</th>
                    </tr>
                </thead>
                <tbody class="no-border-x no-border-y">
                    @if(count($imported) > 0)
                    @foreach($imported as $i => $exp)
                    <tr data-id="">
                        <td>{{ sprintf('%03d', ($i+1)) }}</td>
                        <td>{{ date('j M, y', strtotime($exp->updated_at)) }}</td>
                        <td>{{ $exp->description }}</td>
                        <td>${{ number_format($exp->amount,2) }}</td>
                        <td>${{ number_format($exp->gst,2) }}</td>
                        <td>{{ $exp->type }}</td>
                        <td style="text-align: center">
                            <i class="fa fa-check-square-o"></i>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr data-id="0">
                        <td colspan="5">No data imported</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-sm-12">
                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var oTable = $('#imported').dataTable({
            "aLengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            "bFilter": false,
            "bLengthChange": false,
            // set the initial value
            "iDisplayLength": 50,
            //"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
            "oLanguage": {
                "sLengthMenu": "_MENU_ records per page",
                "oPaginate": {
                    "sPrevious": "Prev",
                    "sNext": "Next"
                }
            },
            "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [5]
                }
            ]
        }); 
</script>