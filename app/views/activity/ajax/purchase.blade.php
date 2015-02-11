<div class="row">
    <div class="col-sm-9 expense-list">
        <div class="row basr-actions">
            <div class="col-sm-3" style="width: 19%;">                                
                <a href="#" data-form="purchase" data-modal="modal" class="form-modal"><i class="fa fa-plus"></i><span>Add purchase</span></a>
            </div>
            <div class="col-sm-3">                                
                <a href="#" data-form="import" data-modal="modal" class="form-modal"><i class="fa fa-download"></i><span>Import from bank</span></a>
            </div>
            <div class="col-sm-3">                                
                <a href="#" data-type="purchase" class="delete-all"><i class="fa fa-trash-o"></i><span>Delete all</span></a>
            </div>
        </div>
        <div class="row">
            <table class="no-border table-list" id="purchase">
                <thead class="no-border">
                    <tr>
                        <th style="width: 12%;">Date</th>
                        <th style="width: 30%;">Description</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Gst</th>
                        <th>Inc. Gst</th>
                        <th style="width:14%">Actions</th>
                    </tr>
                </thead>
                <tbody class="no-border-x no-border-y">
                    @if($expense->count())
                    @foreach($expense as $exp)
                    <tr data-id="{{ $exp->id }}">
                        <td>{{ date('j M, y', strtotime($exp->updated_at)) }}</td>
                        <td>{{ $exp->description }}</td>
                        <td>
                            {{ $exp->category?$exp->category->title:'N/A'}}
                        </td>
                        <td>${{ number_format($exp->amount,2) }}</td>
                        <td>${{ number_format($exp->gst,2) }}</td>
                        <td>
                            {{ $exp->inc_gst == '1'?'<i class="fa fa-check-square-o"></i>':'<i class="fa fa-ban"></i>' }}
                        </td>
                        <td>
                            <a class="action" data-modal="modal" data-action="edit" href="#">Edit</a>
                            <a class="action" data-action="delete" href="#">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr data-id="0">
                        <td colspan="6">No data found</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-3" id="receipt">
        <div class="col-sm-12 add-receipt">
            <div class="form-group">
                <h5 style="font-weight: bold;"><span id="num-receipt">{{ $receipt->count() }}</span> receipts for period</h5>
            </div>
            <div class="form-group">
                <a data-form="receipt" data-modal="modal" href="#" class="btn btn-trans form-modal"><i class="fa fa-file-text-o"></i> <span>New receipt</span></a>
            </div>
        </div>
        <div class="receipt-list">
            <div>
                @if($receipt->count() > 0)
                @foreach($receipt as $exp)
                <div class="receipt-item">
                    <div data-id="{{ $exp->id }}" class="item col-sm-12">
                        <div class="col-sm-3"><img src="{{ URL::to($exp->attachment) }}" width="50" height="65" /></div>
                        <div class="col-sm-7">
                            <p>{{ $exp->description?$exp->description:'&nbsp' }}</p>
                            <p>${{  number_format($exp->amount,2) }} &nbsp {{ date('j M, y', strtotime($exp->updated_at)) }}</p>
                        </div>
                        <div class="col-sm-2"><a href="#" class="action" data-action="delete"><i class="fa fa-trash-o"></i></a></div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>