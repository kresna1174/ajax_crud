@foreach($model as $row)
    <tr>
        <td>{!! $row->id !!}</td>
        <td>{!! $row->nama_barang !!}</td>
        <td>{!! $row->satuan_barang !!}</td>
        <td><a href="javascript:void()" class="btn btn-info btn-sm" onclick="view(<?= $row->id;?>)">View</a> <a href="javascript:void()" class="btn btn-primary btn-sm" onclick="edit(<?= $row->id;?>)">Edit</a> <a href="javascript:void()" class="btn btn-danger btn-sm" onclick="destroy(<?= $row->id ?>)">Delete</a></td>
    </tr>
@endforeach