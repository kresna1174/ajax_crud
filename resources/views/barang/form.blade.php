<div class="form-group">
    <label>Nama Barang</label>
    {!! Form::text('nama_barang', null, ['class' => 'form-control', 'id' => 'nama_barang']) !!}
</div>
<div class="form-group">
    <label>Satuan</label>
    {!! Form::text('satuan_barang', null, ['class' => 'form-control', 'id' => 'satuan_barang']) !!}
</div>

<div class="form-group">
    <table id="table" class="table table-bordered">
        <thead>
            <tr>
                <th>Satuan</th>
                <th class="text-center">X</th>
                <th class="text-center">y</th>
                <td width="100" class="text-center"><button type="button" class="btn btn-primary btn-sm" onclick="add()">Add</button></td>
            </tr>
        </thead>
        <tbody>
        @if (Form::getValueAttribute('satuan'))
				@foreach(Form::getValueAttribute('satuan') as $key => $satuan)
					<tr id="satuan-{!! $key !!}">
						<td>{!! Form::text('satuan['.$key.'][satuan]', null, ['class' => 'form-control form-control-sm']) !!}</td>
						<td>{!! Form::text('satuan['.$key.'][x]', null, ['class' => 'form-control form-control-sm']) !!}</td>
						<td>{!! Form::text('satuan['.$key.'][y]', null, ['class' => 'form-control form-control-sm']) !!}</td>
						<th>
							<button type="button" class="btn btn-sm btn-danger" onclick="deleteSatuan('{!! $key !!}')">Delete</button>
						</th>
					</tr>	
				@endforeach
			@endif
        </tbody>
    </table>
</div>
