<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\IpalMonitoring;
use App\Models\B3Logbook;
use App\Models\B3Inspection;
use App\Models\B3InspectionItem;
use Carbon\Carbon;

class EnvironmentalDashboardWidget extends Widget
{
    protected string $view = 'filament.widgets.environmental-dashboard-widget';
    protected int | string | array $columnSpan = 'full';

    // Hilangkan kata 'string' agar tipe datanya lebih fleksibel ditangkap oleh Livewire
    public $bulan;
    public $tahun;

    public function mount(): void
    {
        $this->bulan = date('m');
        $this->tahun = date('Y');
    }

    // --- TAMBAHKAN DUA FUNGSI INI ---
    // Fungsi ini otomatis dipanggil Livewire setiap kali dropdown Bulan diganti
    public function updatedBulan($value)
    {
        // Tidak perlu diisi, otomatis memicu render ulang getViewData()
    }

    // Fungsi ini otomatis dipanggil Livewire setiap kali dropdown Tahun diganti
    public function updatedTahun($value)
    {
        // Tidak perlu diisi, otomatis memicu render ulang getViewData()
    }
    // --------------------------------

    // protected function getViewData(): array
    // {
    //     // Pastikan variabel bulan dan tahun memiliki nilai (fallback ke bulan ini jika kosong)
    //     $bulanTerpilih = $this->bulan ?: date('m');
    //     $tahunTerpilih = $this->tahun ?: date('Y');

    //     $namaBulan = Carbon::createFromDate($tahunTerpilih, $bulanTerpilih, 1)->translatedFormat('F Y');

    //     // Ambil data dari DB berdasarkan bulan dan tahun terpilih
    //     $latestIpal = IpalMonitoring::whereMonth('tanggal', $bulanTerpilih)
    //         ->whereYear('tanggal', $tahunTerpilih)
    //         ->latest('tanggal')
    //         ->first();

    //     $limbahMasuk = B3Logbook::where('tipe_transaksi', 'Masuk')
    //         ->whereMonth('tanggal', $bulanTerpilih)
    //         ->whereYear('tanggal', $tahunTerpilih)
    //         ->sum('jumlah');

    //     $limbahKeluar = B3Logbook::where('tipe_transaksi', 'Keluar')
    //         ->whereMonth('tanggal', $bulanTerpilih)
    //         ->whereYear('tanggal', $tahunTerpilih)
    //         ->sum('jumlah');

    //     $sisaLimbah = $limbahMasuk - $limbahKeluar;

    //     // Logika Status pH
    //     $phNilai = $latestIpal ? $latestIpal->ph_outlet : 0;
    //     $phTeks = '-';
    //     $phWarna = 'status-white';

    //     if ($latestIpal) {
    //         if ($phNilai >= 6 && $phNilai <= 9) {
    //             $phTeks = '✓ Normal';
    //             $phWarna = 'status-green';
    //         } else {
    //             $phTeks = 'Tidak Normal';
    //             $phWarna = 'status-red';
    //         }
    //     }

    //     return [
    //         'company_info' => [
    //             'nama' => 'PT Mitratani Dua Tujuh',
    //             'bidang' => 'Pengolahan Makanan / Agroindustri',
    //             'alamat' => 'Jl. Brawijaya 83 Mangli Jember',
    //             'pelaksana' => auth()->user()?->name ?? 'Petugas Sistem',
    //             'periode' => $namaBulan,
    //         ],
    //         'indicators' => [
    //             [
    //                 'nama' => 'pH Outlet IPAL',
    //                 'target' => '6 - 9',
    //                 'nilai' => $latestIpal ? number_format($phNilai, 2, ',', '.') : '0,00',
    //                 'status_teks' => $phTeks,
    //                 'warna' => $phWarna,
    //             ],
    //             [
    //                 'nama' => 'Debit Air Limbah',
    //                 'target' => 'Sesuai Izin',
    //                 'nilai' => $latestIpal ? number_format($latestIpal->total_debit, 2, ',', '.') : '0,00',
    //                 'status_teks' => $latestIpal ? '[Cek Izin]' : '-',
    //                 'warna' => 'status-white',
    //             ],
    //             [
    //                 'nama' => 'Limbah B3 Tersimpan',
    //                 'target' => '< Kapasitas TPS',
    //                 'nilai' => number_format($sisaLimbah, 2, ',', '.'),
    //                 'status_teks' => $sisaLimbah > 0 ? 'Aman' : 'Kosong',
    //                 'warna' => $sisaLimbah > 0 ? 'status-green' : 'status-white',
    //             ],
    //             [
    //                 'nama' => 'Kebersihan Area',
    //                 'target' => '100% Baik',
    //                 'nilai' => '0%',
    //                 'status_teks' => 'Perlu Perbaikan',
    //                 'warna' => 'status-yellow',
    //             ],
    //             [
    //                 'nama' => 'Izin Lingkungan',
    //                 'target' => 'Aktif',
    //                 'nilai' => '0',
    //                 'status_teks' => 'Kurang',
    //                 'warna' => 'status-red',
    //             ],
    //         ]
    //     ];
    // }

    protected function getViewData(): array
    {
        $bulanTerpilih = $this->bulan ?: date('m');
        $tahunTerpilih = $this->tahun ?: date('Y');

        $namaBulan = Carbon::createFromDate($tahunTerpilih, $bulanTerpilih, 1)->translatedFormat('F Y');

        // --- 1. DATA IPAL ---
        $latestIpal = IpalMonitoring::whereMonth('tanggal', $bulanTerpilih)
            ->whereYear('tanggal', $tahunTerpilih)
            ->latest('tanggal')
            ->first();

        // --- 2. DATA LIMBAH B3 ---
        $limbahMasuk = B3Logbook::where('tipe_transaksi', 'Masuk')
            ->whereMonth('tanggal', $bulanTerpilih)
            ->whereYear('tanggal', $tahunTerpilih)
            ->sum('jumlah');

        $limbahKeluar = B3Logbook::where('tipe_transaksi', 'Keluar')
            ->whereMonth('tanggal', $bulanTerpilih)
            ->whereYear('tanggal', $tahunTerpilih)
            ->sum('jumlah');

        $sisaLimbah = $limbahMasuk - $limbahKeluar;

        // --- 3. LOGIKA PERSENTASE KEBERSIHAN AREA (CHECKLIST B3) ---
        // Cari ID inspeksi pada bulan dan tahun terpilih
        $inspectionIds = B3Inspection::whereMonth('tanggal', $bulanTerpilih)
            ->whereYear('tanggal', $tahunTerpilih)
            ->pluck('id');

        // Hitung total seluruh item yang diperiksa
        $totalItems = B3InspectionItem::whereIn('b3_inspection_id', $inspectionIds)->count();

        // Hitung item yang statusnya "Aman" atau "Bersih"
        $amanItems = B3InspectionItem::whereIn('b3_inspection_id', $inspectionIds)
            ->whereIn('status', ['Aman', 'Bersih', 'aman', 'bersih'])
            ->count();

        // Hitung persentase
        $persentaseKebersihan = $totalItems > 0 ? ($amanItems / $totalItems) * 100 : 0;
        $nilaiKebersihanTampil = number_format($persentaseKebersihan, 2, ',', '') . '%';

        // Tentukan teks dan warna status kebersihan
        $kebersihanTeks = '-';
        $kebersihanWarna = 'status-white';

        if ($totalItems > 0) {
            if ($persentaseKebersihan == 100) {
                $kebersihanTeks = '✓ Sangat Baik';
                $kebersihanWarna = 'status-green';
            } elseif ($persentaseKebersihan >= 80) {
                $kebersihanTeks = 'Perlu Perbaikan';
                $kebersihanWarna = 'status-yellow'; // Kuning jika ada temuan sedikit
            } else {
                $kebersihanTeks = 'Buruk';
                $kebersihanWarna = 'status-red'; // Merah jika terlalu banyak temuan/kotor
            }
        } else {
            $nilaiKebersihanTampil = '0%';
            $kebersihanTeks = 'Belum Ada Data';
        }

        // --- 4. LOGIKA STATUS PH ---
        $phNilai = $latestIpal ? $latestIpal->ph_outlet : 0;
        $phTeks = '-';
        $phWarna = 'status-white';

        if ($latestIpal) {
            if ($phNilai >= 6 && $phNilai <= 9) {
                $phTeks = '✓ Normal';
                $phWarna = 'status-green';
            } else {
                $phTeks = 'Tidak Normal';
                $phWarna = 'status-red';
            }
        }

        return [
            'company_info' => [
                'nama' => 'PT Mitratani Dua Tujuh',
                'bidang' => 'Pengolahan Makanan / Agroindustri',
                'alamat' => 'Jl. Brawijaya 83 Mangli Jember',
                'pelaksana' => auth()->user()?->name ?? 'Petugas Sistem',
                'periode' => $namaBulan,
            ],
            'indicators' => [
                [
                    'nama' => 'pH Outlet IPAL',
                    'target' => '6 - 9',
                    'nilai' => $latestIpal ? number_format($phNilai, 2, ',', '.') : '0,00',
                    'status_teks' => $phTeks,
                    'warna' => $phWarna,
                ],
                [
                    'nama' => 'Debit Air Limbah',
                    'target' => 'Sesuai Izin',
                    'nilai' => $latestIpal ? number_format($latestIpal->total_debit, 2, ',', '.') : '0,00',
                    'status_teks' => $latestIpal ? '[Cek Izin]' : '-',
                    'warna' => 'status-white',
                ],
                [
                    'nama' => 'Limbah B3 Tersimpan',
                    'target' => '< Kapasitas TPS',
                    'nilai' => number_format($sisaLimbah, 2, ',', '.'),
                    'status_teks' => $sisaLimbah > 0 ? 'Aman' : 'Kosong',
                    'warna' => $sisaLimbah > 0 ? 'status-green' : 'status-white',
                ],
                [
                    'nama' => 'Kebersihan Area',
                    'target' => '100% Baik',
                    'nilai' => $nilaiKebersihanTampil, // Variabel persentase
                    'status_teks' => $kebersihanTeks,  // Variabel teks
                    'warna' => $kebersihanWarna,       // Variabel warna
                ],
                [
                    'nama' => 'Izin Lingkungan',
                    'target' => 'Aktif',
                    'nilai' => '0',
                    'status_teks' => 'Kurang',
                    'warna' => 'status-red',
                ],
            ]
        ];
    }
}
