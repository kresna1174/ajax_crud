<?php

namespace App\Http\Controllers;
use App\Models\Barang_m;
use App\Models\Satuan_barang_m;
use Illuminate\Support\Facades\Validator;
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
        $model->satuan = Satuan_barang_m::where('id_satuan', $id)->get();
        return view('barang.edit', compact('model'));
    }

    public function update(Request $request, $id){
        $rules = self::validation($request->all());
        $messages = self::validationMessage($request->all());
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return response()->json ([
                'message'  => 'Terjadi kesalahan input',
                'errors' => $validator->messages()
            ], 400);
        }
        $model = Barang_m::findOrFail($id);
        if($model->update($request->all())){
            Satuan_barang_m::where('id_satuan', $id)->delete();
            if($request->post('satuan')){
                foreach($request->post('satuan') as $key => $satuan){
                    $satuan['id_satuan'] = $model->id;
                    Satuan_barang_m::create($satuan);
                }
            }
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
        $rules = self::validation($request->all());
        $messages = self::validationMessage($request->all());
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'message'  => 'Terjadi kesalahan input',
                'errors' => $validator->messages()
            ], 400);
        }    
        if($barang = Barang_m::create($request->all())){
            if ($request->post('satuan')) {
                foreach ($request->post('satuan') as $satuan) {
                    $satuan['id_satuan'] = $barang->id;
                    Satuan_barang_m::create($satuan);
                } 
            }
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

    public function validation($data){
        $rules = [
            'nama_barang' => 'required',
            'satuan_barang' => 'required'
        ];
        if(isset($data['satuan'])){
            foreach($data['satuan'] as $key => $satuan){
                $rules['satuan.'.$key.'.satuan'] = 'required'; 
                $rules['satuan.'.$key.'.x'] = 'required|numeric';
                $rules['satuan.'.$key.'.y'] = 'required|numeric';               
            }
        }
        return $rules;
    }

    public function validationMessage($data) {        
        $messages = [];
        $countSatuan = 1;
        if (isset($data['satuan'])) {
            foreach ($data['satuan'] as $key => $satuan) {           
               $messages['satuan.'.$key.'.satuan.required'] = 'Satuan ke-'.$countSatuan.' harus diisi.';
               $messages['satuan.'.$key.'.x.required'] = 'X ke-'.$countSatuan.' harus diisi.';
               $messages['satuan.'.$key.'.y.required'] = 'Y ke-'.$countSatuan.' harus diisi.';
               $messages['satuan.'.$key.'.x.numeric'] = 'X ke-'.$countSatuan.' harus angka.';
               $messages['satuan.'.$key.'.y.numeric'] = 'Y ke-'.$countSatuan.' harus angka.';
               $countSatuan++;
            }   
            }         
        return $messages;
    }    
}
