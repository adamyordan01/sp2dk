<table class="table table-hover mb-3" id="table1">
    <thead>
        <tr>
            <th>#</th>
            <th>NPWP</th>
            <th>Nama</th>
            <th>AR</th>
            <th>Nomor SP2DK</th>
            <th>Tanggal SP2DK</th>
            <th>Tahun SP2DK</th>
            <th>Tahun Pajak</th>
            <th>Potensi Awal</th>
            <th>Tanggal Kirim ke SUKI</th>
            <th>Tanggal Kirim POS</th>
            <th>Tanggal Kempos</th>
            <th>Tanggal Telp WP</th>
            <th>Hasil Telp WP</th>
            <th>Tanggal Konseling</th>
            <th>Hasil Konseling</th>
            <th>Tanggal BA Tidak Hadir</th>
            <th>No BA Tidak Hadir</th>
            <th>Tanggal Visit</th>
            <th>Hasil Visit</th>
            <th>Nomor SP2DK</th>
            <th>Tanggal SP2DK</th>
            <th>Keputusan</th>
            <th>Kesimpulan</th>
            <th>Potensi Akhir</th>
            <th>Realisasi</th>
            <th>Tanggal Setor</th>
            <th>Tanggal Usul Pemeriksaan</th>
            <th>No DSPP</th>
            <th>Tanggal DSPP</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($letters as $letter)
            <tr>
                <td class="fourth">{{ $loop->iteration }}</td>
                <td class="first">
                    {{ $letter->taxpayer->npwp }}
                </td>
                <td class="first">
                    {{ $letter->taxpayer->nama }}
                </td>
                <td class="second">
                    {{ $letter->taxpayer->user->name }}
                </td>
                <td class="first">
                    {{ $letter->no_sp2dk }}
                </td>
                <td class="second">
                    {{ $letter->tanggal_sp2dk }}
                </td>
                <td class="third">
                    {{ $letter->tahun }}
                </td>
                <td class="second">
                    {{ $letter->potensi_awal }}
                </td>
                <td class="second">
                    {{ $letter->tanggal_kirim_suki }}
                </td>
                <td class="second">
                    {{ $letter->tanggal_kirim_pos }}
                </td>
                <td class="second">
                    {{ $letter->tanggal_kempos }}
                </td>
                <td class="second">
                    {{ $letter->tanggal_telpon_wp }}
                </td>
                <td class="second">
                    {{ $letter->hasil_telpon_wp }}
                </td>
                <td class="second">
                    {{ $letter->tanggal_konseling }}
                </td>
                <td class="second">
                    {{ $letter->hasil_konseling }}
                </td>
                <td class="second">
                    {{ $letter->tanggal_ba_tidak_hadir }}
                </td>
                <td class="second">
                    {{ $letter->no_ba_tidak_hadir }}
                </td>
                <td class="second">
                    {{ $letter->tanggal_visit }}
                </td>
                <td class="second">
                    {{ $letter->hasil_visit }}
                </td>
                <td class="first">
                    {{ $letter->no_lhp2dk }}
                </td>
                <td class="second">
                    {{ $letter->tanggal_lhp2dk }}
                </td>
                <td class="second">
                    {{ $letter->keputusan }}
                </td>
                <td class="second">
                    {{ $letter->kesimpulan }}
                </td>
                <td class="second">
                    {{ $letter->potensi_akhir }}
                </td>
                <td class="second">
                    {{-- {{ number_format($letter->realisasi) }} --}}
                    {{ $letter->realisasi }}
                </td>
                <td class="second">
                    {{ $letter->tanggal_setor }}
                </td>
                <td class="second">
                    {{ $letter->tanggal_usul_pemeriksaan }}
                </td>
                <td class="second">
                    {{ $letter->no_dspp }}
                </td>
                <td class="second">
                    {{ $letter->tanggal_dspp }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">Data Belum Tersedia.</td>
            </tr>
        @endforelse
    </tbody>
</table>