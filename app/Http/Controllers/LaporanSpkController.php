<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanSpk;
use Exception;

class LaporanSpkController extends Controller
{
    public function index()
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

    public function create()
    {
        return view('super-admin.laporan_spk.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'dampak' => 'required|integer',
            'biaya' => 'required|integer',
            'jenis_laporan' => 'required|string|max:100',
            'sdm' => 'required|integer',
            'durasi_pekerjaan' => 'required|integer',
        ]);

        LaporanSpk::create($data);

        return redirect()->route('laporan_spk.index');
    }

    public function edit($id)
    {
        $laporan = LaporanSpk::findOrFail($id);
        return view('laporan_spk.edit', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'dampak' => 'required|integer',
            'biaya' => 'required|integer',
            'jenis_laporan' => 'required|string|max:100',
            'sdm' => 'required|integer',
            'durasi_pekerjaan' => 'required|integer',
        ]);

        $laporan = LaporanSpk::findOrFail($id);
        $laporan->update($data);

        return redirect()->route('laporan_spk.index');
    }

    public function destroy($id)
    {
        $check = LaporanSpk::find($id);
        if (!$check) {
            return redirect()->route('laporan_spk.index')->with('error' . 'Data Laporan SPK Tidak Ditemukan');
        }

        try {
            LaporanSpk::destroy($id);

            return redirect()->route('laporan_spk.index')->with('success' . 'Data Laporan SPK Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('laporan_spk.index')->with('error' . 'Data Laporan SPK Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }

    public function deleteSelected(Request $request)
    {
        $selectedIdsJson = $request->input('selectedIds');

        if (empty($selectedIdsJson)) {
            return redirect('/laporan_spk')->with('error' . 'Data Laporan SPK Tidak Ditemukan');
        }

        $selectedIds = json_decode($selectedIdsJson, true);

        try {
            $deletedLaporans = LaporanSpk::whereIn('id_spk', $selectedIds)->delete();

            if ($deletedLaporans > 0) {
                return redirect('/laporan_spk')->with('success' . 'Semua Data Laporan SPK Berhasil Dihapus');
            } else {
                return redirect('/laporan_spk')->with('error' . 'Data Laporan SPK Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
            }
        } catch (Exception $e) {
            return redirect('/laporan_spk')->with('error' . 'Data Laporan SPK Gagal Dihapus Karena Masih Terdapat Tabel Lain yang Terkait Dengan Data Ini');
        }
    }

    private function getJenisLaporanScore($jenis)
    {
        return match ($jenis) {
            'keamanan' => 1,
            'kesehatan' => 0.8,
            'infrastruktur' => 0.6,
            'layanan Masyarakat' => 0.4,
            'lingkungan' => 0.2,
            default => 0,
        };
    }

    private function getBiayaScore($biaya)
    {
        if ($biaya >= 0 && $biaya <= 500000) {
            return 1;
        } elseif ($biaya > 500000 && $biaya <= 1000000) {
            return 0.8;
        } elseif ($biaya > 1000000 && $biaya <= 2000000) {
            return 0.6;
        } elseif ($biaya > 2000000 && $biaya <= 3000000) {
            return 0.4;
        } elseif ($biaya > 3000000) {
            return 0.2;
        }
    }

    private function getDampakScore($dampak)
    {
        if ($dampak == 1) {
            return 1 / 3;
        } elseif ($dampak == 2) {
            return 2 / 3;
        } elseif ($dampak == 3) {
            return 1;
        }
    }

    private function getDurasiPekerjaanScore($durasi)
    {
        if ($durasi >= 1 && $durasi <= 7) {
            return 1;
        } elseif ($durasi > 7 && $durasi <= 14) {
            return 0.75;
        } elseif ($durasi > 14 && $durasi <= 21) {
            return 0.5;
        } else {
            return 0.25;
        }
    }

    private function getSDMScore($sdm)
    {
        if ($sdm == 1) {
            return 1;
        } elseif ($sdm > 1 && $sdm <= 5) {
            return 0.75;
        } elseif ($sdm > 5 && $sdm <= 10) {
            return 0.5;
        } elseif ($sdm > 10) {
            return 0.25;
        }
    }

    private function normalizeDecisionMatrix($matrix)
    {
        $normalizedMatrix = [];
        foreach ($matrix as $criteria => $values) {
            switch ($criteria) {
                case 'dampak':
                    $normalizedMatrix[$criteria] = array_map([$this, 'getDampakScore'], $values);
                    break;
                case 'biaya':
                    $normalizedMatrix[$criteria] = array_map([$this, 'getBiayaScore'], $values);
                    break;
                case 'jenis_laporan':
                    $normalizedMatrix[$criteria] = array_map([$this, 'getJenisLaporanScore'], $values);
                    break;
                case 'sdm':
                    $normalizedMatrix[$criteria] = array_map([$this, 'getSDMScore'], $values);
                    break;
                case 'durasi_pekerjaan':
                    $normalizedMatrix[$criteria] = array_map([$this, 'getDurasiPekerjaanScore'], $values);
                    break;
                default:
                    $columnMax = max($values);
                    $normalizedMatrix[$criteria] = $columnMax == 0 ? array_fill(0, count($values), 0) : array_map(fn ($value) => $value / $columnMax, $values);
                    break;
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
            'list' => ['Home, Laporan SPK, Priority']
        ];

        $activeMenu = 'spk';

        // Get all LaporanSpk records
        $laporans = LaporanSpk::all();

        // Create the decision matrix
        $decisionMatrix = [
            'dampak' => $laporans->pluck('dampak')->toArray(),
            'biaya' => $laporans->pluck('biaya')->toArray(),
            'jenis_laporan' => $laporans->pluck('jenis_laporan')->toArray(),
            'sdm' => $laporans->pluck('sdm')->toArray(),
            'durasi_pekerjaan' => $laporans->pluck('durasi_pekerjaan')->toArray(),
        ];

        // Calculate the number of criteria and their weights
        $criteriaCount = count($decisionMatrix);
        $weights = $this->calculateROCWeights($criteriaCount);

        // Normalize the decision matrix
        $normalizedMatrix = $this->normalizeDecisionMatrix($decisionMatrix);

        // Calculate the utility matrix
        $utilityMatrix = [];
        foreach ($normalizedMatrix as $criteria => $values) {
            $utilityMatrix[$criteria] = $this->calculateUtility($values);
        }

        // Calculate the MAUT scores
        $mautScores = $this->calculateMAUTScores($utilityMatrix, $weights);

        // Assign scores to each laporan and sort them
        foreach ($laporans as $index => $laporan) {
            $laporan->total_score = $mautScores[$index];
        }

        // Sort the LaporanSpk by total score in descending order
        $sortedLaporans = $laporans->sortByDesc('total_score');

        // Return the view with sorted LaporanSpk
        return view('super-admin.laporan_spk.priority', [
            'breadcrumb' => $breadcrumb,
            'laporans' => $sortedLaporans, // Use sortedLaporans instead of laporans
            'activeMenu' => $activeMenu
        ]);
    }

    public function showChart()
    {
        $breadcrumb = (object) [
            'title' => 'Chart Prioritas Laporan SPK',
            'list' => ['Home, Laporan SPK, Chart']
        ];

        $activeMenu = 'spk';
        $laporans = LaporanSpk::all();

        $decisionMatrix = [
            'dampak' => $laporans->pluck('dampak')->toArray(),
            'biaya' => $laporans->pluck('biaya')->toArray(),
            'jenis_laporan' => $laporans->pluck('jenis_laporan')->toArray(),
            'sdm' => $laporans->pluck('sdm')->toArray(),
            'durasi_pekerjaan' => $laporans->pluck('durasi_pekerjaan')->toArray(),
        ];

        $criteriaCount = count($decisionMatrix);
        $weights = $this->calculateROCWeights($criteriaCount);

        $normalizedMatrix = $this->normalizeDecisionMatrix($decisionMatrix);

        $utilityMatrix = [];
        foreach ($normalizedMatrix as $criteria => $values) {
            $utilityMatrix[$criteria] = $this->calculateUtility($values);
        }

        $mautScores = $this->calculateMAUTScores($utilityMatrix, $weights);

        $labels = $laporans->pluck('jenis_laporan');
        $scores = array_values($mautScores); // Convert mautScores to a simple array

        return view('super-admin.laporan_spk.chart', [
            'breadcrumb' => $breadcrumb,
            'laporans' => $laporans,
            'activeMenu' => $activeMenu,
            'labels' => $labels,
            'scores' => $scores
        ]);
    }
}
