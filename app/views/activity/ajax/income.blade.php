<div class="row">
    <div class="col-sm-12 expense-list">
        <div class="row basr-actions">
            <div class="col-sm-3" style="width: 15.5%;">                                
                <a href="#" data-form="income" data-modal="modal" class="form-modal"><i class="fa fa-plus"></i><span>Add income</span></a>
            </div>
            <div class="col-sm-2">                                
                <a href="#" data-form="import" data-modal="modal" class="form-modal"><i class="fa fa-download"></i><span>Import from bank</span></a>
            </div> 
            <div class="col-sm-3">                                
                <a href="#" data-type="income" class="delete-all"><i class="fa fa-trash-o"></i><span>Delete all</span></a>
            </div>
        </div>
        <div class="row">
            <table class="no-border table-list" id="income">
                <thead class="no-border">
                    <tr>
                        <th style="width: 12%;">Date</th>
                        <th style="width: 40%;">Description</th>
                        <th>Amount</th>
                        <th>Gst</th>
                        <th>Inc. Gst</th>
                        <th style="text-align: center; width: 12%;">Actions</th>
                    </tr>
                </thead>
                <tbody class="no-border-x no-border-y">
                    @if($expense->count())
                    @foreach($expense as $exp)
                    <tr data-id="{{ $exp->id }}">
                        <td>{{ date('j M, y', strtotime($exp->updated_at)) }}</td>
                        <td>{{ $exp->description }}</td>
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
                        <td colspan="5">No data found</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>