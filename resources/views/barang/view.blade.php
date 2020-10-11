{!! Form::model($model, ['id' => 'form_barang']) !!}
    <table width="100%">
        <tr>
            <th>Nama Barang</th>
            <th>:</th>
            <td>{!! $model->nama_barang !!}</td>
        </tr>
        <tr>
            <th>Satuan</th>
            <th>:</th>
            <td>{!! $model->satuan !!}</td>
        </tr>
    </table>
{!! Form::close() !!}