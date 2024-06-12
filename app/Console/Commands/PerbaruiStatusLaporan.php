<?php

namespace App\Console\Commands;

use App\Models\LaporanPengaduan;
use Illuminate\Console\Command;

class PerbaruiStatusLaporan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:perbarui-status-laporan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $laporans = LaporanPengaduan::all();

        foreach ($laporans as $laporan) {
            if ($laporan->status == 'diproses' && $laporan->tanggal_selesai < now()) {
                $laporan->update(['status' => 'selesai']);
            }
        }

        $this->info('Status laporan berhasil diperbarui.');

        }
}
