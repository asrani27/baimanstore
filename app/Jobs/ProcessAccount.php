<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $pegawai;
    public $role;

    public function __construct($pegawai, $role)
    {
        $this->pegawai = $pegawai;
        $this->role = $role;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pegawai = $this->pegawai;

        $check = User::where('username', $pegawai->nip)->first();
        if($check == null){
            $n = new User;
            $n->name = $pegawai->nama;
            $n->username = $pegawai->nip;
            $n->password = bcrypt(Carbon::parse($pegawai->tanggal_lahir)->format('dmY'));
            $n->save();
    
            $n->roles()->attach($this->role);
    
            $pegawai->update(['user_id' => $n->id]);
        }else{
            $pegawai->update(['user_id' => $check->id]);
        }
    }
}
