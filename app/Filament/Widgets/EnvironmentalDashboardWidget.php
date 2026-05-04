<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\IpalMonitoring; // Pastikan model ini sudah di-import
use App\Models\B3Logbook;      // Pastikan model ini sudah di-import
use Carbon\Carbon;

class EnvironmentalDashboardWidget extends Widget
{
    protected string $view = 'filament.widgets.environmental-dashboard-widget';
    protected int | string | array $columnSpan = 'full';

    // Properti penampung pilihan dropdown
    public string $bulan;
    public string $tahun;

    // Method ini otomatis dijalankan pertama kali widget di-load
    public function mount(): void
    {
        // Set default ke bulan dan tahun saat ini
        $this->bulan = date('m');
        $this->tahun = date('Y');
    }

    protected function getViewData(): array
    {
        // Ubah format angka bulan jadi nama bulan untuk tampilan Info Perusahaan
        $namaBulan = Carbon::createFromDate($this->tahun, $this->bulan, 1)->translatedFormat('F Y');

        // 1. Ambil data IPAL terakhir sesuai bulan & tahun terpilih
        $latestIpal = IpalMonitoring::whereMonth('tanggal', $this->bulan)
            ->whereYear('tanggal', $this->tahun)
            ->latest('tanggal')
            ->first();

        // 2. Hitung jumlah Limbah B3 sesuai bulan & tahun terpilih
        $limbahMasuk = B3Logbook::where('tipe_transaksi', 'Masuk')
            ->whereMonth('tanggal', $this->bulan)
            ->whereYear('tanggal', $this->tahun)
            ->sum('jumlah');

        $limbahKeluar = B3Logbook::where('tipe_transaksi', 'Keluar')
            ->whereMonth('tanggal', $this->bulan)
            ->whereYear('tanggal', $this->tahun)
            ->sum('jumlah');

        $sisaLimbah = $limbahMasuk - $limbahKeluar;

        // --- LOGIKA PENENTUAN STATUS PH ---
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
                'pelaksana' => auth()->user()?->name ?? 'Pelaksana Lingkungan',
                'periode' => $namaBulan, // Tampil dinamis! (Misal: May 2026)
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
                // ... Sisanya biarkan hardcode dulu sambil menunggu logika dari tabel B3 Inspections
                [
                    'nama' => 'Kebersihan Area',
                    'target' => '100% Baik',
                    'nilai' => '6,25%',
                    'status_teks' => 'Perlu Perbaikan',
                    'warna' => 'status-yellow',
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
