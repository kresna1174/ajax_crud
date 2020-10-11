{!! Form::model($model, ['id' => 'form_barang']) !!}
    @include('barang.form')
    <div class="form-group">
        <button type="button" class="btn btn-primary btn-sm" onclick="update(<?= $model->id ?>)">Update</button>
        <button type="button" class="btn btn-default btn-sm" onclick="bootbox.hideAll()">Cancel</button>
    </div>
{!! Form::close() !!}