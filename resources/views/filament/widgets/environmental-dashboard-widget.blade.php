<x-filament-widgets::widget>
    <x-filament::section>

        <style>
            /* Custom CSS agar tabel rapi tanpa perlu compile Tailwind */
            .env-container {
                width: 100%;
                color: inherit;
                position: relative;
            }

            .env-header {
                text-align: center;
                margin-bottom: 2rem;
            }

            .env-title {
                font-size: 1.5rem;
                font-weight: bold;
                text-transform: uppercase;
                margin-bottom: 0.25rem;
            }

            .env-subtitle {
                opacity: 0.7;
            }

            /* Style Dropdown Filter */
            .env-filter-box {
                display: flex;
                justify-content: flex-end;
                gap: 10px;
                margin-bottom: 1.5rem;
            }

            .env-select {
                padding: 0.5rem 1rem;
                border-radius: 0.375rem;
                border: 1px solid #4b5563;
                background-color: #1f2937;
                color: white;
                cursor: pointer;
                outline: none;
            }

            .env-select:focus {
                border-color: #3b82f6;
            }

            .env-section-title {
                font-size: 1.125rem;
                font-weight: bold;
                text-transform: uppercase;
                margin-bottom: 0.75rem;
                border-bottom: 1px solid #4b5563;
                padding-bottom: 0.5rem;
            }

            .env-info-table {
                width: 100%;
                max-width: 600px;
                margin-bottom: 2rem;
                font-size: 0.875rem;
            }

            .env-info-table td {
                padding: 0.25rem 0;
            }

            .env-info-label {
                font-weight: bold;
                width: 35%;
            }

            .env-info-value {
                color: #0284c7;
            }

            .env-table {
                width: 100%;
                border-collapse: collapse;
                text-align: left;
                font-size: 0.875rem;
                border: 1px solid #4b5563;
            }

            .env-table th,
            .env-table td {
                padding: 0.75rem 1rem;
                border: 1px solid #4b5563;
            }

            .env-table th {
                background-color: #1f2937;
                color: white;
                text-align: center;
            }

            .env-table td {
                text-align: center;
            }

            .env-table td.text-left {
                text-align: left;
                font-weight: bold;
            }

            /* Warna Status */
            .env-status {
                font-weight: bold;
                text-align: center;
            }

            .status-green {
                background-color: #16a34a !important;
                color: white !important;
            }

            .status-yellow {
                background-color: #eab308 !important;
                color: black !important;
            }

            .status-red {
                background-color: #ef4444 !important;
                color: white !important;
            }

            .status-white {
                background-color: transparent !important;
            }
        </style>

        <div class="env-container">

            <!-- Area Dropdown Filter -->
            <div class="env-filter-box">
                <!-- Dropdown Bulan -->
                <select wire:model.live="bulan" class="env-select">
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>

                <!-- Dropdown Tahun -->
                <select wire:model.live="tahun" class="env-select">
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                </select>
            </div>

            <!-- Judul -->
            <div class="env-header">
                <h1 class="env-title">Monitoring Lingkungan</h1>
                <p class="env-subtitle">Sistem Monitoring Kepatuhan Lingkungan Perusahaan</p>
            </div>

            <!-- Informasi Perusahaan -->
            <div>
                <h2 class="env-section-title">Informasi Perusahaan</h2>
                <table class="env-info-table">
                    <tbody>
                        <tr>
                            <td class="env-info-label">Nama Perusahaan</td>
                            <td class="env-info-value">{{ $company_info['nama'] }}</td>
                        </tr>
                        <tr>
                            <td class="env-info-label">Bidang Industri</td>
                            <td class="env-info-value">{{ $company_info['bidang'] }}</td>
                        </tr>
                        <tr>
                            <td class="env-info-label">Alamat</td>
                            <td class="env-info-value">{{ $company_info['alamat'] }}</td>
                        </tr>
                        <tr>
                            <td class="env-info-label">Pelaksana Lingkungan</td>
                            {{-- <td class="env-info-value">-</td> --}}
                            <td class="env-info-value" style="font-weight: bold; text-transform: capitalize;">
                                {{ $company_info['pelaksana'] }}
                            </td>
                        </tr>
                        <tr>
                            <td class="env-info-label">Periode Monitoring</td>
                            <td class="env-info-value" style="font-weight: bold; color: #16a34a;">
                                {{ $company_info['periode'] }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Ringkasan Indikator Utama -->
            <div>
                <h2 class="env-section-title">Ringkasan Indikator Utama</h2>
                <div style="overflow-x: auto;">
                    <table class="env-table">
                        <thead>
                            <tr>
                                <th>Indikator</th>
                                <th>Target</th>
                                <th>Status Terakhir</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($indicators as $row)
                                <tr>
                                    <td class="text-left">{{ $row['nama'] }}</td>
                                    <td>{{ $row['target'] }}</td>
                                    <td>{{ $row['nilai'] }}</td>
                                    <td class="env-status {{ $row['warna'] }}">
                                        {{ $row['status_teks'] }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </x-filament::section>
</x-filament-widgets::widget>
