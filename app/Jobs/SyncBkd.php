<?php

namespace App\Jobs;

use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Pegawai;
use Illuminate\Bus\Queueable;
use App\Imports\PegawaiImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SyncBkd implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $nip;

    public function __construct($nip)
    {
        $this->nip = $nip;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            $nip        = $this->nip.'/api20211';
            $client     = new Client(['base_uri' => 'http://114.7.16.53:1028/ci4-bkd/pegawai/']);
            $response   = $client->request('GET', 'apipegawai/'.$nip);
            $resp       = json_decode($response->getBody())->isidata[0];
            
            $data['nip']        = $resp->nip;
            $data['nama']       = $resp->nm_lengkap;
            $data['skpd']       = $resp->nm_skpd;
            $data['status_pegawai']  = $resp->nm_status;
            $data['unit_kerja']      = $resp->nm_unitkerja;
            $data['nm_pangkat']      = $resp->nm_pangkat;
            $data['gol_pangkat']     = $resp->gol_pangkat;
            $data['ket_jabatan']     = $resp->ket_jabatan;
            //$data['tmt_pangkat']     = $resp->tmt_pangkat;
            //$data['tmt_eselon']      = $resp->tmt_eselon;
            $data['status_aktif']    = 1;
            //dd($data);
            $check = Pegawai::where('nip', $data['nip'])->first();
            if($check == null){
                $attr = $data;
                $attr['tanggal_lahir'] = Carbon::createFromFormat('Ymd', substr($data['nip'], 0, 8))->format('Y-m-d');
                
                Pegawai::create($attr);
            }else{

            }
        }
        catch(\Exception $e)
        {
            //dd($e);
        }
    }
}
