{!! Form::open(['id' => 'form_barang']) !!}
    @include('barang.form')
    <div class="form-group">
        <button type="button" class="btn btn-primary btn-sm" onclick="store()">Store</button>
        <button type="button" class="btn btn-default btn-sm" onclick="bootbox.hideAll()">Cancel</button>
    </div>
{!! Form::close() !!}