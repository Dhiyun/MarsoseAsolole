<?php

namespace App\Http\Controllers\Super_admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\DetailKriteria;
use App\Models\Alternatif;
use App\Models\LaporanSpk;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class LaporanSpkController extends Controller
{
    // CRUD for Alternatif
    public function indexAlternatif()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Alternatif',
            'list' => ['Home', 'Alternatif']
        ];

        $alternatifs = Alternatif::all();
        return view('super-admin.alternatifs.index', compact('alternatifs', 'breadcrumb'));
    }

    public function createAlternatif()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Alternatif',
            'list' => ['Home', 'Alternatif', 'Tambah']
        ];

        return view('super-admin.alternatifs.create', compact('breadcrumb'));
    }

    public function storeAlternatif(Request $request)
    {
        $request->validate([
            'kode_alternatif' => 'required|string|max:20',
            'id_laporan' => 'required|exists:laporan_pengaduan,id_laporan',
        ]);

        Alternatif::create($request->all());

        return redirect()->route('super-admin.alternatifs.index')->with('success', 'Alternatif created successfully.');
    }

    public function editAlternatif(Alternatif $alternatif)
    {
        $breadcrumb = (object) [
            'title' => 'Edit Alternatif',
            'list' => ['Home', 'Alternatif', 'Edit']
        ];

        return view('super-admin.alternatifs.edit', compact('alternatif', 'breadcrumb'));
    }

    public function updateAlternatif(Request $request, Alternatif $alternatif)
    {
        $request->validate([
            'kode_alternatif' => 'required|string|max:20',
            'id_laporan' => 'required|exists:laporan_pengaduan,id_laporan',
        ]);

        $alternatif->update($request->all());

        return redirect()->route('super-admin.alternatifs.index')->with('success', 'Alternatif updated successfully.');
    }

    public function destroyAlternatif(Alternatif $alternatif)
    {
        $alternatif->delete();

        return redirect()->route('super-admin.alternatifs.index')->with('success', 'Alternatif deleted successfully.');
    }

    // CRUD for LaporanSPK
    public function indexLaporanSpk()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Laporan SPK',
            'list' => ['Home,', 'Laporan SPK']
        ];

        $activeMenu = 'spk';

        $kriterias = Kriteria::all();
        $alternatifs = Alternatif::whereNotIn('id_alternatif', LaporanSpk::pluck('id_alternatif'))->get();
        $detail = DetailKriteria::all();

        $rawClauses = [];
        foreach ($kriterias as $kriteria) {
            $rawClauses[] = DB::raw("MAX(CASE WHEN id_kriteria = $kriteria->id_kriteria THEN nilai ELSE NULL END) AS Kriteria$kriteria->id_kriteria");
        }

        $laporans = LaporanSpk::select('id_alternatif', ...$rawClauses)
            ->groupBy('id_alternatif')
            ->get();

        return view('super-admin.laporan_spk.index', [
            'breadcrumb' => $breadcrumb,
            'laporans' => $laporans,
            'kriterias' => $kriterias, // Mengirim data kriteria ke view
            'alternatifs' => $alternatifs, // Mengirim data Alternatif ke view
            'activeMenu' => $activeMenu,
            'detail' => $detail,
        ]);
    }

    public function createLaporanSpk()
    {
        //
    }

    public function storeLaporanSpk(Request $request)
    {
        $kriterias = Kriteria::all();

        $validationRules = [
            'id_alternatif' => 'required|exists:alternatif,id_alternatif',
        ];

        foreach ($kriterias as $kriteria) {
            $validationRules[$kriteria->nama_kriteria] = 'required|max:255';
        }

        $validate = $request->validate($validationRules);

        foreach ($kriterias as $kriteria) {
            LaporanSpk::create([
                'id_kriteria' => $kriteria->id_kriteria,
                'id_alternatif' => $validate['id_alternatif'],
                'nilai' => $validate[$kriteria->nama_kriteria],
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('laporan_spk.index')->with('success', 'Laporan SPK berhasil dibuat.');
    }

    public function editLaporanSpk(LaporanSpk $laporanSpk)
    {
        $breadcrumb = (object) [
            'title' => 'Edit Laporan SPK',
            'list' => ['Home', 'Laporan SPK', 'Edit']
        ];

        $kriterias = Kriteria::all();
        $alternatifs = Alternatif::all();
        return view('super-admin.laporan_spk.edit', compact('laporanSpk', 'kriterias', 'alternatifs', 'breadcrumb'));
    }

    public function updateLaporanSpk(Request $request, $id)
    {
        $validationRules = [
            'id_alternatif' => 'required|exists:alternatif,id_alternatif',
        ];

        $kriterias = Kriteria::all();

        foreach ($kriterias as $kriteria) {
            $validationRules[$kriteria->nama_kriteria] = 'required|max:255';
        }

        $validate = $request->validate($validationRules);

        $laporanSpk = LaporanSpk::where('id_alternatif', $id)->get();
        
        foreach ($laporanSpk as $spk) {
            foreach ($kriterias as $kriteria) {
                $namaKriteria = $kriteria->nama_kriteria;
        
                $nilaiBaru = $validate[$namaKriteria];

                if ($spk->id_kriteria == $kriteria->id_kriteria) {
                    $spk->update(['nilai' => $nilaiBaru]);
                    break;
                }
            }
        }

        return redirect()->route('laporan_spk.index')->with('success', 'Data laporan SPK berhasil diperbarui.');
    }

    public function destroyLaporanSpk($id)
    {
        $check = LaporanSpk::find($id);
        if (!$check) {
            return redirect()->route('super-admin.laporan_spk.index')->with('error', 'Data Laporan SPK Tidak Ditemukan');
        }

        try {
            LaporanSpk::destroy($id);
            return redirect()->route('super-admin.laporan_spk.index')->with('success', 'Data Laporan SPK Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('super-admin.laporan_spk.index')->with('error', 'Data Laporan SPK Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }

    public function deleteSelected(Request $request)
    {
        $selectedIdsJson = $request->input('selectedIds');

        if (empty($selectedIdsJson)) {
            return redirect()->route('super-admin.laporan_spk.index')->with('error', 'Data Laporan SPK Tidak Ditemukan');
        }

        $selectedIds = json_decode($selectedIdsJson, true);

        try {
            $deletedLaporans = LaporanSpk::whereIn('id_spk', $selectedIds)->delete();

            if ($deletedLaporans > 0) {
                return redirect()->route('super-admin.laporan_spk.index')->with('success', 'Semua Data Laporan SPK Berhasil Dihapus');
            } else {
                return redirect()->route('super-admin.laporan_spk.index')->with('error', 'Data Laporan SPK Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
            }
        } catch (Exception $e) {
            return redirect()->route('super-admin.laporan_spk.index')->with('error', 'Data Laporan SPK Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }

    public function calculateROCWeights($criteriaCount)
    {
        $weights = [];
        for ($i = 1; $i <= $criteriaCount; $i++) {
            $weights[] = array_sum(array_map(function ($j) use ($i) {
                return 1 / $j;
            }, range($i, $criteriaCount))) / $criteriaCount;
        }

        return $weights;
    }

    public function normalizeValues($nilai, $maxValue, $minValue)
    {
        $nilai = floatval($nilai);
        $maxValue = floatval($maxValue);
        $minValue = floatval($minValue);

        // Handle the case where maxValue equals minValue to avoid division by zero
        if ($maxValue == $minValue) {
            return 0.0; // or 1.0 depending on the context
        }

        return ($nilai - $minValue) / ($maxValue - $minValue);
    }

    public function calculatePriority()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Prioritas Laporan SPK',
            'list' => ['Home', 'Laporan SPK', 'Priority']
        ];

        $activeMenu = 'perangkingan';

        // Mengambil semua data yang diperlukan
        $kriterias = Kriteria::all();
        $detailKriterias = DetailKriteria::all();

        // Membuat klausa SQL mentah untuk setiap kriteria
        $rawClauses = [];
        foreach ($kriterias as $kriteria) {
            $rawClauses[] = DB::raw("MAX(CASE WHEN id_kriteria = $kriteria->id_kriteria THEN nilai ELSE NULL END) AS Kriteria$kriteria->id_kriteria");
        }

        // Mengambil LaporanSpk yang dikelompokkan berdasarkan id_alternatif dengan kolom kriteria
        $laporans = LaporanSpk::select('id_alternatif', ...$rawClauses)
            ->groupBy('id_alternatif')
            ->get();

        // Memetakan id kriteria ke bobotnya
        $weights = $this->calculateROCWeights(count($kriterias));
        $weightMap = array_combine($kriterias->pluck('id_kriteria')->toArray(), $weights);

        // Menghitung skor untuk setiap alternatif
        $scores = [];
        $normalizedValues = []; // Menyimpan nilai normalisasi untuk ditampilkan di view
        foreach ($laporans as $laporan) {
            $totalScore = 0;
            $laporanNormalizedValues = [];
            foreach ($kriterias as $kriteria) {
                $nilaiField = "Kriteria{$kriteria->id_kriteria}";
                $nilai = $laporan->$nilaiField;

                // Memeriksa apakah nilai adalah deskriptor kualitatif
                if (!is_numeric($nilai)) {
                    // Mendapatkan nilai numerik untuk deskriptor kualitatif dari detail_kriteria
                    $detailKriteria = $detailKriterias->where('id_kriteria', $kriteria->id_kriteria)
                        ->where('rentang', $nilai)
                        ->first();
                } else {
                    // Mendapatkan nilai numerik untuk nilai dari rentang detail_kriteria
                    $detailKriteria = $detailKriterias->where('id_kriteria', $kriteria->id_kriteria)
                        ->filter(function ($item) use ($nilai) {
                            return $this->isInRange($nilai, $item->rentang);
                        })
                        ->first();
                }

                if ($detailKriteria) {
                    $nilai = $detailKriteria->nilai;
                    Log::debug("Nilai untuk kriteria {$kriteria->id_kriteria} dan alternatif {$laporan->id_alternatif}: $nilai");
                } else {
                    // Menangani kasus di mana tidak ada catatan detail_kriteria yang cocok
                    $nilai = 0; // atau beberapa nilai default
                    Log::debug("Nilai untuk kriteria {$kriteria->id_kriteria} dan alternatif {$laporan->id_alternatif} tidak ditemukan, menggunakan nilai default: $nilai");
                }

                // Menentukan nilai maksimum dan minimum untuk normalisasi dari detail_kriterias untuk kriteria saat ini
                $maxValue = $detailKriterias->where('id_kriteria', $kriteria->id_kriteria)->max('nilai');
                $minValue = $detailKriterias->where('id_kriteria', $kriteria->id_kriteria)->min('nilai');

                // Menormalisasi nilai
                $normalizedValue = $this->normalizeValues($nilai, $maxValue, $minValue);
                $laporanNormalizedValues[$nilaiField] = $normalizedValue;

                // Menambahkan ke total skor dengan bobot
                if (isset($weightMap[$kriteria->id_kriteria])) {
                    $totalScore += $normalizedValue * $weightMap[$kriteria->id_kriteria];
                }
            }

            $scores[$laporan->id_alternatif] = $totalScore;
            $normalizedValues[$laporan->id_alternatif] = $laporanNormalizedValues;
            Log::debug("Total skor akhir untuk alternatif {$laporan->id_alternatif}: $totalScore");
            Log::debug("Nilai normalisasi untuk kriteria {$kriteria->id_kriteria} dan alternatif {$laporan->id_alternatif}: $normalizedValue");
        }

        // Mengurutkan alternatif berdasarkan skor
        arsort($scores);

        // Mengambil alternatif untuk ditampilkan
        $alternatif = Alternatif::whereIn('id_alternatif', array_keys($scores))->get();

        // Mengembalikan tampilan dengan LaporanSpk yang sudah diurutkan
        return view('super-admin.laporan_spk.perangkingan.index', [
            'breadcrumb' => $breadcrumb,
            'laporans' => $laporans,
            'kriterias' => $kriterias,
            'scores' => $scores,
            'alternatif' => $alternatif,
            'activeMenu' => $activeMenu,
            'normalizedValues' => $normalizedValues // Mengirim nilai normalisasi ke tampilan
        ]);
    }


    private function parseRange($rentang)
    {
        $rentang = trim($rentang);
        $rentang = str_replace('hari', ' days', $rentang);

        // Jika rentang menggunakan format 'x && y'
        if (strpos($rentang, '&&') !== false) {
            // Memisahkan rentang berdasarkan '&&'
            [$min, $max] = explode('&&', $rentang);

            // Menghapus karakter tidak perlu dan mengkonversi ke float
            $min = (float)trim(str_replace(['>', '<', '=', ' '], '', $min));
            $max = (float)trim(str_replace(['>', '<', '=', ' '], '', $max));

            return [$min, $max];
        }

        // Jika rentang menggunakan format 'x - y'
        if (strpos($rentang, '-') !== false) {
            // Memisahkan rentang berdasarkan '-'
            [$min, $max] = explode('-', $rentang);

            // Menghapus karakter tidak perlu dan mengkonversi ke float
            $min = (float)trim(str_replace(['>', '<', '=', ' '], '', $min));
            $max = (float)trim(str_replace(['>', '<', '=', ' '], '', $max));

            return [$min, $max];
        }

        // Jika rentang menggunakan format '> x' atau '<= x'
        if (preg_match('/[><=]/', $rentang)) {
            $operator = substr($rentang, 0, 1);
            $value = (float)trim(str_replace(['>', '<', '=', ' '], '', substr($rentang, 1)));

            if ($operator === '>') {
                return [$value, PHP_INT_MAX];
            } elseif ($operator === '<') {
                return [0, $value];
            } elseif (strpos($rentang, '<=') !== false) {
                return [0, $value];
            } elseif (strpos($rentang, '>=') !== false) {
                return [$value, PHP_INT_MAX];
            }
        }

        // Jika format rentang tidak sesuai, mengembalikan nilai default
        return [null, null];
    }

    private function isInRange($nilai, $rentang)
    {
        [$min, $max] = $this->parseRange($rentang);

        if ($min !== null && $max !== null) {
            $inRange = $nilai > $min && $nilai <= $max;
            
            return $inRange;
        }

        return false;
    }

    public function show_calculatePriority($id)
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Perankingan Laporan SPK',
            'list' => ['Home', 'Laporan SPK', 'Priority']
        ];

        $activeMenu = 'perangkingan';

        // Ambil data kriteria
        $kriterias = Kriteria::all();

        // Ambil data alternatif berdasarkan ID
        $alternatif = Alternatif::find($id);

        return view('super-admin.laporan_spk.perangkingan.detail', compact('breadcrumb', 'activeMenu', 'alternatif', 'kriterias'));
    }

    public function displayCalculations()
    {
        $breadcrumb = (object) [
            'title' => 'Detail Perhitungan SPK',
            'list' => ['Home,', 'Laporan SPK,', 'Detail Perhitungan']
        ];

        $activeMenu = 'perhitungan';

        $kriterias = Kriteria::all();
        $detailKriterias = DetailKriteria::all();

        $rawClauses = [];
        foreach ($kriterias as $kriteria) {
            $rawClauses[] = DB::raw("MAX(CASE WHEN id_kriteria = $kriteria->id_kriteria THEN nilai ELSE NULL END) AS Kriteria$kriteria->id_kriteria");
        }

        $laporans = LaporanSpk::select('id_alternatif', ...$rawClauses)
            ->groupBy('id_alternatif')
            ->get();

        $weights = $this->calculateROCWeights(count($kriterias));
        $weightMap = array_combine($kriterias->pluck('id_kriteria')->toArray(), $weights);

        $calculations = [];
        $scores = [];
        foreach ($laporans as $laporan) {
            $alternatifCalculation = [
                'id_alternatif' => $laporan->id_alternatif,
                'kriteria' => []
            ];
            $totalScore = 0;
            foreach ($kriterias as $kriteria) {
                $nilaiField = "Kriteria{$kriteria->id_kriteria}";
                $nilai = $laporan->$nilaiField;

                if (!is_numeric($nilai)) {
                    $detailKriteria = $detailKriterias->where('id_kriteria', $kriteria->id_kriteria)
                        ->where('rentang', $nilai)
                        ->first();
                } else {
                    $detailKriteria = $detailKriterias->where('id_kriteria', $kriteria->id_kriteria)
                        ->filter(function ($item) use ($nilai) {
                            return $this->isInRange($nilai, $item->rentang);
                        })
                        ->first();
                }

                if ($detailKriteria) {
                    $nilai = $detailKriteria->nilai;
                } else {
                    $nilai = 0;
                }

                $maxValue = $detailKriterias->where('id_kriteria', $kriteria->id_kriteria)->max('nilai');
                Log::debug("Nilai untuk kriteria max {$kriteria->id_kriteria} dan alternatif {$laporan->id_alternatif}: $maxValue");
                $minValue = $detailKriterias->where('id_kriteria', $kriteria->id_kriteria)->min('nilai');
                Log::debug("Nilai untuk kriteria min {$kriteria->id_kriteria} dan alternatif {$laporan->id_alternatif}: $minValue");

                $normalizedValue = $this->normalizeValues($nilai, $maxValue, $minValue);

                if (isset($weightMap[$kriteria->id_kriteria])) {
                    $weightedValue = $normalizedValue * $weightMap[$kriteria->id_kriteria];
                    $totalScore += $weightedValue;
                } else {
                    $weightedValue = 0;
                }

                $alternatifCalculation['kriteria'][] = [
                    'id_kriteria' => $kriteria->id_kriteria,
                    'nilai_awal' => $nilai,
                    'nilai_normalisasi' => $normalizedValue,
                    'bobot' => $weightMap[$kriteria->id_kriteria],
                    'nilai_terbobot' => $weightedValue
                ];
            }

            $alternatifCalculation['total_score'] = $totalScore;
            $calculations[] = $alternatifCalculation;
            $scores[$laporan->id_alternatif] = $totalScore;
        }

        usort($calculations, function ($a, $b) {
            return $b['total_score'] <=> $a['total_score'];
        });

        $sortedScores = array_column($calculations, 'total_score', 'id_alternatif');
        arsort($sortedScores);

        $alternatif = Alternatif::whereIn('id_alternatif', array_column($calculations, 'id_alternatif'))->get();

        $maxValues = [];
        $minValues = [];
        foreach ($kriterias as $kriteria) {
            $maxValues[$kriteria->id_kriteria] = $detailKriterias
                ->where('id_kriteria', $kriteria->id_kriteria)->max('nilai');
            $minValues[$kriteria->id_kriteria] = $detailKriterias->where('id_kriteria', $kriteria->id_kriteria)->min('nilai');
        }

        return view('super-admin.laporan_spk.perhitungan.index', [
            'breadcrumb' => $breadcrumb,
            'weights' => $weights,
            'laporans' => $laporans,
            'detailKriterias' => $detailKriterias,
            'minValues' => $minValues,
            'maxValues' => $maxValues,
            'calculations' => $calculations,
            'alternatif' => $alternatif,
            'kriterias' => $kriterias,
            'activeMenu' => $activeMenu,
            'scores' => $scores,
            'sortedScores' => $sortedScores,
        ]);
    }
}
