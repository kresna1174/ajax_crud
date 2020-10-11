<?php

namespace App\Http\Controllers;
use App\Models\Barang_m;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(){
        $title = 'Crud Using Ajax';
        return view('barang.index', ['title' => $title]);
    }

    public function get(){
        $model = Barang_m::all();
        return view('barang.get', ['model' => $model]);
    }

    public function view($id){
        $model = Barang_m::find($id);
        return view('barang.view', compact('model'));
    }

    public function create(){
        return view('barang.create');
    }

    public function edit($id){
        $model = Barang_m::findOrFail($id);
        return view('barang.edit', compact('model'));
    }

    public function update(Request $request, $id){
        $request->validate(self::validation());
        $model = Barang_m::findOrFail($id);
        if($model->update($request->all())){
            return [
                'success' => true,
                'message' => 'Data Berhasil Di Perbarui'
            ];
        }else{
            return [
                'success' => false,
                'message' => 'Data Gagal Di Perbarui'
            ];
        }
    }

    public function store(Request $request){
        $request->validate(self::validation());
        if(Barang_m::create($request->all())){
            return [
                'success' => true,
                'message' => 'Data Berhasil Di Tambahkan'
            ];
        }else{
            return [
                'success' => false,
                'message' => 'Data Gagal Di Tambahkan'
            ];
        }
    }

    public function delete($id){
        $model = Barang_m::find($id);
        if($model){
            if($model->delete()){
                return [
                    'success' => true,
                    'message' => 'Data Berhasil Di Hapus'
                ];
            }else{
                return [
                    'success' => false,
                    'message' => 'Data Gagal Di Hapus'
                ];
            }
        }else{
            return [
                'success' => true,
                'message' => 'Data Tidak Di Temukan'
            ];
        }
    }

    public function validation(){
        return [
            'nama_barang' => 'required',
            'satuan' => 'required'
        ];
    }
}
