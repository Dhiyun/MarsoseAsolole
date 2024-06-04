<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\DetailKriteria;
use App\Models\Alternatif;
use App\Models\LaporanSpk;
use Exception;
use Illuminate\Http\Request;

class LaporanSpkController extends Controller
{
    // CRUD for Kriteria
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kriteria',
            'list' => ['Home, Kriteria']
        ];

        $activeMenu = 'kriteria';
        $kriterias = Kriteria::all();

        return view('super-admin.kriterias.index', [
            'breadcrumb' => $breadcrumb,
            'kriterias' => $kriterias,
            'activeMenu' => $activeMenu
        ]);
    }

    public function create()
    {
        return view('super-admin.kriterias.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kriteria' => 'required|string|max:255',
            'jenis_kriteria' => 'required|string|max:255',
        ]);

        Kriteria::create($data);

        return redirect()->route('kriterias.index')->with('success', 'Kriteria created successfully.');
    }

    public function edit(Kriteria $kriteria)
    {
        return view('super-admin.kriterias.edit', compact('kriteria'));
    }

    public function update(Request $request, Kriteria $kriteria)
    {
        $data = $request->validate([
            'nama_kriteria' => 'required|string|max:255',
            'jenis_kriteria' => 'required|string|max:255',
        ]);

        $kriteria->update($data);

        return redirect()->route('kriterias.index')->with('success', 'Kriteria updated successfully.');
    }

    public function destroy(Kriteria $kriteria)
    {
        try {
            $kriteria->delete();
            return redirect()->route('kriterias.index')->with('success', 'Kriteria deleted successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('kriterias.index')->with('error', 'Failed to delete Kriteria due to related records.');
        }
    }

    public function deleteSelectedKriteria(Request $request)
    {
        $selectedIdsJson = $request->input('selectedIds');

        if (empty($selectedIdsJson)) {
            return redirect()->route('kriterias.index')->with('error', 'No Kriteria selected for deletion.');
        }

        $selectedIds = json_decode($selectedIdsJson, true);

        try {
            $deletedKriterias = Kriteria::whereIn('id_kriteria', $selectedIds)->delete();

            if ($deletedKriterias > 0) {
                return redirect()->route('kriterias.index')->with('success', 'Selected Kriteria deleted successfully.');
            } else {
                return redirect()->route('kriterias.index')->with('error', 'Failed to delete selected Kriteria due to related records.');
            }
        } catch (Exception $e) {
            return redirect()->route('kriterias.index')->with('error', 'Failed to delete selected Kriteria due to related records.');
        }
    }
    
    // CRUD for DetailKriteria (nilai rentang)
    public function indexDetailKriteria()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Detail Kriteria',
            'list' => ['Home, Kriteria, Detail Kriteria']
        ];

        $activeMenu = 'kriteria';
        $details = DetailKriteria::all();
        $kriterias = Kriteria::all();

        return view('super-admin.kriterias.index', [
            'breadcrumb' => $breadcrumb,
            'details' => $details,
            'kriterias' => $kriterias,
            'activeMenu' => $activeMenu
        ]);
    }

    public function createDetailKriteria()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Detail Kriteria',
            'list' => ['Home, Kriteria, Detail Kriteria, Tambah']
        ];

        return view('super-admin.kriterias.create', compact('kriteria', 'breadcrumb'));
    }

    public function storeDetailKriteria(Request $request)
    {
        $request->validate([
            'rentang' => 'required|string|max:255',
            'nilai' => 'required|integer',
            'bobot_normalisasi' => 'required|numeric|between:0,999.99',
        ]);

        DetailKriteria::create($request->all());

        return redirect()->route('super-admin.kriterias.index')->with('success', 'Detail Kriteria created successfully.');
    }

    public function editDetailKriteria(DetailKriteria $detailKriteria)
    {
        $breadcrumb = (object) [
            'title' => 'Edit Detail Kriteria',
            'list' => ['Home', 'Kriteria', 'Detail Kriteria', 'Edit']
        ];

        $allKriterias = Kriteria::all(); // Mengambil semua kriteria
        $kriteria = $detailKriteria->kriteria; // Asumsikan ada relasi antara DetailKriteria dan Kriteria

        return view('super-admin.kriterias.edit', compact('kriteria', 'detailKriteria', 'breadcrumb', 'allKriterias'));
    }


    public function updateDetailKriteria(Request $request, DetailKriteria $detailKriteria)
    {
        $request->validate([
            'rentang' => 'required|string|max:255',
            'nilai' => 'required|integer',
            'bobot_normalisasi' => 'required|numeric|between:0,999.99',
        ]);

        $detailKriteria->update($request->all());

        return redirect()->route('super-admin.kriterias.index')->with('success', 'Detail Kriteria updated successfully.');
    }

    public function destroyDetailKriteria(DetailKriteria $detailKriteria)
    {
        $detailKriteria->delete();

        return redirect()->route('super-admin.kriterias.index')->with('success', 'Detail Kriteria deleted successfully.');
    }

    public function deleteSelectedDetailKriteria(Request $request)
    {
        $selectedIdsJson = $request->input('selectedIds');

        if (empty($selectedIdsJson)) {
            return redirect()->route('super-admin.kriterias.index')->with('error', 'Data Kriteria Tidak Ditemukan');
        }

        $selectedIds = json_decode($selectedIdsJson, true);

        try {
            $deletedKriteria = LaporanSpk::whereIn('id_detail_kriteria', $selectedIds)->delete();

            if ($deletedKriteria > 0) {
                return redirect()->route('super-admin.kriterias.index')->with('success', 'Semua Data Kriteria Berhasil Dihapus');
            } else {
                return redirect()->route('super-admin.kriterias.index')->with('error', 'Data Kriteria Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
            }
        } catch (Exception $e) {
            return redirect()->route('super-admin.kriterias.index')->with('error', 'Data Kriteria Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }

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
            'list' => ['Home, Laporan SPK']
        ];

        $activeMenu = 'spk';
        $laporans = LaporanSpk::all();

        return view('super-admin.laporan_spk.index', [
            'breadcrumb' => $breadcrumb,
            'laporans' => $laporans,
            'activeMenu' => $activeMenu
        ]);
    }

    public function createLaporanSpk()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Laporan SPK',
            'list' => ['Home', 'Laporan SPK', 'Tambah']
        ];

        $kriterias = Kriteria::all();
        $alternatifs = Alternatif::all();
        return view('super-admin.laporan_spk.create', compact('kriterias', 'alternatifs', 'breadcrumb'));
    }

    public function storeLaporanSpk(Request $request)
    {
        $request->validate([
            'id_kriteria' => 'required|exists:kriterias,id_kriteria',
            'id_alternatif' => 'required|exists:alternatifs,id_alternatif',
        ]);

        LaporanSpk::create($request->all());

        return redirect()->route('super-admin.laporan_spk.index')->with('success', 'Laporan SPK created successfully.');
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

    public function updateLaporanSpk(Request $request, LaporanSpk $laporanSpk)
    {
        $request->validate([
            'id_kriteria' => 'required|exists:kriterias,id_kriteria',
            'id_alternatif' => 'required|exists:alternatifs,id_alternatif',
        ]);

        $laporanSpk->update($request->all());

        return redirect()->route('super-admin.laporan_spk.index')->with('success', 'Laporan SPK updated successfully.');
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

    // SPK Calculation and Chart
    private function getKriteriaScore($criteria, $value)
    {
        $detailKriteria = DetailKriteria::where('id_kriteria', $criteria->id_kriteria)
            ->where('rentang', $value)
            ->first();

        return $detailKriteria ? $detailKriteria->bobot_normalisasi : 0;
    }

    private function normalizeDecisionMatrix($matrix)
    {
        $normalizedMatrix = [];
        foreach ($matrix as $criteria => $values) {
            $criteriaModel = Kriteria::where('nama_kriteria', $criteria)->first();
            if ($criteriaModel) {
                $normalizedMatrix[$criteria] = array_map(function ($value) use ($criteriaModel) {
                    return $this->getKriteriaScore($criteriaModel, $value);
                }, $values);
            } else {
                // Normalisasi default untuk kriteria yang tidak dikenal
                $columnMax = max($values);
                $normalizedMatrix[$criteria] = $columnMax == 0 ? array_fill(0, count($values), 0) : array_map(fn ($value) => $value / $columnMax, $values);
            }
        }
        return $normalizedMatrix;
    }

    private function calculateUtility($values)
    {
        $min = min($values);
        $max = max($values);

        if ($min == $max) {
            return array_fill(0, count($values), 1);
        }

        return array_map(fn ($value) => ($value - $min) / ($max - $min), $values);
    }

    private function calculateROCWeights($criteriaCount)
    {
        $weights = [];
        for ($i = 1; $i <= $criteriaCount; $i++) {
            $weights[] = array_sum(array_map(function ($j) use ($i) {
                return 1 / $j;
            }, range($i, $criteriaCount))) / $criteriaCount;
        }
        return $weights;
    }

    private function calculateMAUTScores($utilityMatrix, $weights)
    {
        $scores = [];
        foreach ($utilityMatrix as $criteria => $values) {
            foreach ($values as $index => $value) {
                $scores[$index] = ($scores[$index] ?? 0) + $value * $weights[array_search($criteria, array_keys($utilityMatrix))];
            }
        }
        arsort($scores);
        return $scores;
    }

    public function calculatePriority()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Prioritas Laporan SPK',
            'list' => ['Home', 'Laporan SPK', 'Priority']
        ];

        $activeMenu = 'spk';

        // Dapatkan semua data LaporanSpk
        $laporans = LaporanSpk::all();

        // Buat decision matrix secara dinamis berdasarkan kriteria yang ada di database
        $kriterias = Kriteria::all();
        $decisionMatrix = [];
        foreach ($kriterias as $kriteria) {
            $decisionMatrix[$kriteria->nama_kriteria] = $laporans->pluck($kriteria->nama_kriteria)->toArray();
        }

        // Hitung jumlah kriteria dan bobotnya
        $criteriaCount = count($decisionMatrix);
        $weights = $this->calculateROCWeights($criteriaCount);

        // Normalisasi decision matrix
        $normalizedMatrix = $this->normalizeDecisionMatrix($decisionMatrix);

        // Hitung utility matrix
        $utilityMatrix = [];
        foreach ($normalizedMatrix as $criteria => $values) {
            $utilityMatrix[$criteria] = $this->calculateUtility($values);
        }

        // Hitung skor MAUT
        $mautScores = $this->calculateMAUTScores($utilityMatrix, $weights);

        // Beri skor ke setiap laporan dan urutkan
        foreach ($laporans as $index => $laporan) {
            $laporan->total_score = $mautScores[$index];
        }

        // Urutkan LaporanSpk berdasarkan total skor secara descending
        $sortedLaporans = $laporans->sortByDesc('total_score');

        // Kembalikan tampilan dengan LaporanSpk yang sudah diurutkan
        return view('super-admin.laporan_spk.priority', [
            'breadcrumb' => $breadcrumb,
            'laporans' => $sortedLaporans,
            'activeMenu' => $activeMenu
        ]);
    }

    public function showChart()
    {
        $breadcrumb = (object) [
            'title' => 'Chart Prioritas Laporan SPK',
            'list' => ['Home', 'Laporan SPK', 'Chart']
        ];

        $activeMenu = 'spk';
        $laporans = LaporanSpk::all();

        // Buat decision matrix secara dinamis berdasarkan kriteria yang ada di database
        $kriterias = Kriteria::all();
        $decisionMatrix = [];
        foreach ($kriterias as $kriteria) {
            $decisionMatrix[$kriteria->nama_kriteria] = $laporans->pluck($kriteria->nama_kriteria)->toArray();
        }

        // Hitung jumlah kriteria dan bobotnya
        $criteriaCount = count($decisionMatrix);
        $weights = $this->calculateROCWeights($criteriaCount);

        // Normalisasi decision matrix
        $normalizedMatrix = $this->normalizeDecisionMatrix($decisionMatrix);

        // Hitung utility matrix
        $utilityMatrix = [];
        foreach ($normalizedMatrix as $criteria => $values) {
            $utilityMatrix[$criteria] = $this->calculateUtility($values);
        }

        // Hitung skor MAUT
        $mautScores = $this->calculateMAUTScores($utilityMatrix, $weights);

        $labels = $laporans->pluck('jenis_laporan');
        $scores = array_values($mautScores);

        return view('super-admin.laporan_spk.chart', [
            'breadcrumb' => $breadcrumb,
            'laporans' => $laporans,
            'activeMenu' => $activeMenu,
            'labels' => $labels,
            'scores' => $scores
        ]);
    }
}
