<div role="dialog" tabindex="-1" id="msg"  class="modal fade colored-header" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 style="font-size:1.5rem">Message</h3>
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach($message as $msg )
                    <label>{{$msg}}</label>
                    @endforeach
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>