<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Jobs\SyncBkd;
use App\Models\Import;
use GuzzleHttp\Client;
use App\Models\Pegawai;
use App\Jobs\ProcessAccount;
use Illuminate\Http\Request;
use App\Imports\PegawaiImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    public function index()
    {
        $data = Pegawai::paginate(10);
        $import = Import::get();
        return view('superadmin.pegawai.index',compact('data','import'));
    }
    
    public function account()
    {
        $data = Pegawai::get();
        $role = Role::where('name', 'pegawai')->first();
        foreach($data as $datas){
            ProcessAccount::dispatch($datas, $role);
        }
        
        toastr()->success('User Pegawai Berhasil Di Buat');
        return back();
    }

    public function clear()
    {
        $data['nip']            = '';
        $data['nm_lengkap']     = '';
        $data['nm_skpd']        = '';
        $data['nm_unitkerja']   = '';
        $data['nm_pangkat']     = '';
        $data['gol_pangkat']    = '';
        $data['status_pns']     = '';
        $data['ket_jabatan']    = '';
        $data['tmt_pangkat']    = '';
        $data['tmt_eselon']     = '';
        return $data;
    }

    public function create()
    {
        $data = $this->clear();
        return view('superadmin.pegawai.create',compact('data'));
    }
    
    public function checktobkd()
    {
        try{
            $nip        = request()->nip.'/api20211';
            $client     = new Client(['base_uri' => 'http://114.7.16.53:1028/ci4-bkd/pegawai/']);
            $response   = $client->request('GET', 'apipegawai/'.$nip);
            $resp       = json_decode($response->getBody())->isidata[0];

            $data['nip']        = $resp->nip;
            $data['nm_lengkap'] = $resp->nm_lengkap;
            $data['nm_skpd']    = $resp->nm_skpd;
            $data['status_pns'] = $resp->nm_status;
            $data['nm_unitkerja']    = $resp->nm_unitkerja;
            $data['nm_pangkat']      = $resp->nm_pangkat;
            $data['gol_pangkat']     = $resp->gol_pangkat;
            $data['ket_jabatan']     = $resp->ket_jabatan;
            $data['tmt_pangkat']      = $resp->tmt_pangkat;
            $data['tmt_eselon']      = $resp->tmt_eselon;
            
            request()->flash();
            toastr()->success('Pegawai Di Temukan');
            
            return view('superadmin.pegawai.create',compact('data'));
        }catch(\Exception $e){
            
            request()->flash();
            toastr()->error('Data Pegawai Tidak Di Temukan atau NIP anda salah');
            
            $data = $this->clear();
            return view('superadmin.pegawai.create',compact('data'));
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' =>  'unique:pegawai',
        ]);

        if ($validator->fails()) {
            $request->flash();
            toastr()->error('NIP sudah ada');
            return back();
        }

        $attr = $request->all();
        $attr['tanggal_lahir'] = Carbon::createFromFormat('Ymd', substr($request->nip, 0, 8))->format('Y-m-d');
        
        Pegawai::create($attr);
        
        toastr()->success('Sukses Di Simpan');
        return redirect('/superadmin/pegawai');   
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        $data = Peserta::find($id);
        
        return view('superadmin.peserta.edit',compact('data'));
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nik' =>  'unique:peserta,nik,'.$id,
        ]);

        if ($validator->fails()) {
            $request->flash();
            toastr()->error('NIK sudah ada');
            return back();
        }

        $attr = $request->all();

        Peserta::find($id)->update($attr);

        toastr()->success('Sukses Di Update');
        return redirect('/superadmin/peserta');
    }

    public function destroy($id)
    {
        Peserta::find($id)->delete();
        toastr()->success('Sukses Di Hapus');
        return back();
    }

    public function akun($id)
    {
        $role = Role::where('name', 'pegawai')->first();
        //Create User Peserta
        $pegawai = Pegawai::find($id);
        $n = new User;
        $n->name = $pegawai->nama;
        $n->username = $pegawai->nip;
        $n->password = bcrypt(Carbon::parse($pegawai->tanggal_lahir)->format('dmY'));
        $n->save();

        $n->roles()->attach($role);

        $pegawai->update(['user_id' => $n->id]);

        toastr()->success('Akun sukses di buat, Password : '. Carbon::parse($pegawai->tanggal_lahir)->format('dmY'));
        return back();
    }

    public function pass($id)
    {
        $u = Pegawai::find($id)->user;
        $u->password = bcrypt(Carbon::parse(Pegawai::find($id)->tanggal_lahir)->format('dmY'));
        $u->save();
        
        toastr()->success('Password Baru : '. Carbon::parse($u->tanggal_lahir)->format('dmY'));
        return back();
    }

    public function import(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'file' => 'mimes:xls,xlsx|max:2048'
        ]);

        if ($validator->fails()) {
            toastr()->error('File harus xls, xlsx dan max 2MB');
            return back();
        }

        $filename = date('d-m-Y-H-i-s').'.xlsx';
        $req->file->storeAs('/public/import',$filename);

        Import::create(['file' => $filename]);
        
        toastr()->success('Berhasil Di Upload');
        return back();
    }

    public function importDelete($id)
    {
        $data = Import::find($id);
        $path = '/public/import/'.$data->file;

        Storage::delete($path);

        $data->delete();
        
        toastr()->success('Berhasil Di Hapus');
        return back();
    }

    public function sinkronBkd($id)
    {
        $data = Import::find($id);
        $path = 'storage/import/'.$data->file;

        $data = Excel::toArray(new PegawaiImport, $path)[0];
        foreach($data as $datas){
            $nip = $datas[1];
            SyncBkd::dispatch($nip);
        }
        
        toastr()->info('Sinkron Data BKD berhasil');
        return back();
    }

    public function search()
    {
        $search = request()->get('search');
        $data   = Pegawai::where('nama', 'LIKE','%'.$search.'%')->orWhere('nip', 'LIKE','%'.$search.'%')->paginate(10);
        $data->appends(['search' => $search])->links();
        request()->flash();
        
        $import = Import::get();
        return view('superadmin.pegawai.index',compact('data','import'));
    }

    public function detail($id)
    {
        $page = 'profil';
        $pegawai = Pegawai::find($id);
        
        $pathfoto = '/storage/'.$pegawai->nip.'/'.$pegawai->foto;
        return view('superadmin.pegawai.detail',compact('page','id','pegawai','pathfoto'));
    }

    public function editProfil($id)
    {
        $page = 'edit_profil';
        $pegawai = Pegawai::find($id);
        return view('superadmin.pegawai.detail',compact('page','id','pegawai'));
    }

    public function pasangan($id)
    {
        $page = 'pasangan';
        return view('superadmin.pegawai.detail',compact('page','id'));
    }
    public function anak($id)
    {
        $page = 'anak';
        return view('superadmin.pegawai.detail',compact('page','id'));
    }
    public function orangtua($id)
    {
        $page = 'orangtua';
        return view('superadmin.pegawai.detail',compact('page','id'));
    }
    public function pendidikan($id)
    {
        $page = 'pendidikan';
        return view('superadmin.pegawai.detail',compact('page','id'));
    }
}
