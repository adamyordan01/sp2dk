<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Letter;
use App\Models\Taxpayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // $filters = Letter::pluck('tanggal_sp2dk')->unique();
        // $filters = Letter::select('tanggal_sp2dk')->distinct()->get();
        
        if (Auth::user()->position->nama_jabatan == "Account Representative") {
            if ($request->year) {
                $id = Auth::id();
                $filters = DB::select("
                    SELECT YEAR
                        ( l.tanggal_sp2dk ) AS year 
                    FROM
                        users AS u
                        JOIN taxpayers AS t ON t.user_id = u.id
                        JOIN letters AS l ON l.taxpayer_id = t.id
                        JOIN sections ON u.section_id = sections.id 
                    WHERE
                        u.id = '$id'
                    GROUP BY
                        YEAR (
                        l.tanggal_sp2dk)
                    ORDER BY
                        1
                ");
                $filtersLhp2dk = DB::select("
                    SELECT YEAR
                        ( l.tanggal_lhp2dk ) AS lhp2dk 
                    FROM
                        users AS u
                        JOIN taxpayers AS t ON t.user_id = u.id
                        JOIN letters AS l ON l.taxpayer_id = t.id
                        JOIN sections ON u.section_id = sections.id 
                    WHERE
                        u.id = '$id'
                        AND YEAR(l.tanggal_lhp2dk) IS NOT NULL
                    GROUP BY
                        YEAR (
                        l.tanggal_lhp2dk)
                    ORDER BY
                        1
                ");
                $section_id = Auth::user()->section_id;
                $letters = DB::select("
                    SELECT
                        u.`name` AS AR,
                        nama_seksi,
                        u.section_id,
                        sum( l.potensi_awal ) AS total_potensi_awal,
                        count( l.no_sp2dk ) AS total_sp2dk,
                        COUNT( l.tanggal_kirim_pos ) AS total_sp2dk_kirim_pos,
                        COUNT( l.tanggal_kempos ) AS total_kempos,
                        COUNT( l.tanggal_telpon_wp ) AS total_telpon_wp,
                        COUNT( l.tanggal_konseling ) AS total_konseling,
                        COUNT( l.tanggal_ba_tidak_hadir ) AS total_ba_tidak_hadir,
                        COUNT( l.tanggal_visit ) AS total_visit,
                        COUNT( l.no_lhp2dk ) AS total_lhp2dk,
                        sum( l.potensi_akhir ) AS total_potensi_akhir,
                        sum( l.realisasi ) AS total_realisasi,
                        COUNT( l.no_dspp ) AS total_dspp 
                    FROM
                        users u
                        JOIN taxpayers t ON t.user_id = u.id
                        JOIN letters l ON l.taxpayer_id = t.id
                        JOIN sections ON u.section_id = sections.id 
                    WHERE
                        u.position_id > 2 
                        AND u.section_id = sections.id 
                        AND u.id = '$id'
                        AND YEAR ( l.tanggal_sp2dk ) = '$request->year' 
                    GROUP BY
                        u.`name`
                ");
                
                return view('dashboard', [
                    'letters' => $letters,
                    'filters' => $filters,
                    'filtersLhp2dk' => $filtersLhp2dk,
                ]);
            } elseif ($request->lhp2dk) {
                $id = Auth::id();
                $letters = DB::select("
                    SELECT
                        u.`name` AS AR,
                        nama_seksi,
                        u.section_id,
                        sum( l.potensi_awal ) AS total_potensi_awal,
                        count( l.no_sp2dk ) AS total_sp2dk,
                        COUNT( l.tanggal_kirim_pos ) AS total_sp2dk_kirim_pos,
                        COUNT( l.tanggal_kempos ) AS total_kempos,
                        COUNT( l.tanggal_telpon_wp ) AS total_telpon_wp,
                        COUNT( l.tanggal_konseling ) AS total_konseling,
                        COUNT( l.tanggal_ba_tidak_hadir ) AS total_ba_tidak_hadir,
                        COUNT( l.tanggal_visit ) AS total_visit,
                        COUNT( l.no_lhp2dk ) AS total_lhp2dk,
                        sum( l.potensi_akhir ) AS total_potensi_akhir,
                        sum( l.realisasi ) AS total_realisasi,
                        COUNT( l.no_dspp ) AS total_dspp 
                    FROM
                        users u
                        JOIN taxpayers t ON t.user_id = u.id
                        JOIN letters l ON l.taxpayer_id = t.id
                        JOIN sections ON u.section_id = sections.id 
                    WHERE
                        u.position_id > 2 
                        AND u.section_id = sections.id 
                        AND u.id = '$id'
                        AND YEAR ( l.tanggal_lhp2dk ) = '$request->lhp2dk' 
                    GROUP BY
                        u.`name`
                ");
                $filters = DB::select("
                    SELECT YEAR
                        ( l.tanggal_sp2dk ) AS year 
                    FROM
                        users AS u
                        JOIN taxpayers AS t ON t.user_id = u.id
                        JOIN letters AS l ON l.taxpayer_id = t.id
                        JOIN sections ON u.section_id = sections.id 
                    WHERE
                        u.id = '$id'
                    GROUP BY
                        YEAR (
                        l.tanggal_sp2dk)
                    ORDER BY
                        1
                ");
                $filtersLhp2dk = DB::select("
                    SELECT YEAR
                        ( l.tanggal_lhp2dk ) AS lhp2dk 
                    FROM
                        users AS u
                        JOIN taxpayers AS t ON t.user_id = u.id
                        JOIN letters AS l ON l.taxpayer_id = t.id
                        JOIN sections ON u.section_id = sections.id 
                    WHERE
                        u.id = '$id'
                        AND YEAR(l.tanggal_lhp2dk) IS NOT NULL
                    GROUP BY
                        YEAR (
                        l.tanggal_lhp2dk)
                    ORDER BY
                        1
                ");
                $section_id = Auth::user()->section_id;
                
                return view('dashboard', [
                    'letters' => $letters,
                    'filters' => $filters,
                    'filtersLhp2dk' => $filtersLhp2dk,
                ]);
            } elseif (! $request->year) {
                $id = Auth::id();
                $filters = DB::select("
                    SELECT YEAR
                        ( l.tanggal_sp2dk ) AS year 
                    FROM
                        users AS u
                        JOIN taxpayers AS t ON t.user_id = u.id
                        JOIN letters AS l ON l.taxpayer_id = t.id
                        JOIN sections ON u.section_id = sections.id 
                    WHERE
                        u.id = '$id'
                    GROUP BY
                        YEAR (
                        l.tanggal_sp2dk)
                    ORDER BY
                        1
                ");
                $filtersLhp2dk = DB::select("
                    SELECT YEAR
                        ( l.tanggal_lhp2dk ) AS lhp2dk 
                    FROM
                        users AS u
                        JOIN taxpayers AS t ON t.user_id = u.id
                        JOIN letters AS l ON l.taxpayer_id = t.id
                        JOIN sections ON u.section_id = sections.id 
                    WHERE
                        u.id = '$id'
                        AND YEAR(l.tanggal_lhp2dk) IS NOT NULL
                    GROUP BY
                        YEAR (
                        l.tanggal_lhp2dk)
                    ORDER BY
                        1
                ");
                $section_id = Auth::user()->section_id;
                $letters = DB::select("
                    SELECT
                        u.`name` AS AR,
                        nama_seksi,
                        u.section_id,
                        sum( l.potensi_awal ) AS total_potensi_awal,
                        count( l.no_sp2dk ) AS total_sp2dk,
                        COUNT( l.tanggal_kirim_pos ) AS total_sp2dk_kirim_pos,
                        COUNT( l.tanggal_kempos ) AS total_kempos,
                        COUNT( l.tanggal_telpon_wp ) AS total_telpon_wp,
                        COUNT( l.tanggal_konseling ) AS total_konseling,
                        COUNT( l.tanggal_ba_tidak_hadir ) AS total_ba_tidak_hadir,
                        COUNT( l.tanggal_visit ) AS total_visit,
                        COUNT( l.no_lhp2dk ) AS total_lhp2dk,
                        sum( l.potensi_akhir ) AS total_potensi_akhir,
                        sum( l.realisasi ) AS total_realisasi,
                        COUNT( l.no_dspp ) AS total_dspp 
                    FROM
                        users u
                        JOIN taxpayers t ON t.user_id = u.id
                        JOIN letters l ON l.taxpayer_id = t.id
                        JOIN sections ON u.section_id = sections.id 
                    WHERE
                        u.position_id > 2 
                        AND u.section_id = sections.id 
                        AND u.id = '$id'
                    GROUP BY
                        u.`name`
                ");
                return view('dashboard', [
                    'letters' => $letters,
                    'filters' => $filters,
                    'filtersLhp2dk' => $filtersLhp2dk,
                ]);
            }
        } elseif (Auth::user()->position->nama_jabatan == "Kepala Seksi") {
            // $letters = User::with('letterTaxpayer')->pluck('name')->dd();
            if ($request->year) {
                $id = Auth::id();
                $filters = DB::select("
                    SELECT YEAR
                        ( l.tanggal_sp2dk ) AS year 
                    FROM
                        users AS u
                        JOIN taxpayers AS t ON t.kasi_id = u.id
                        JOIN letters AS l ON l.taxpayer_id = t.id
                        JOIN sections ON u.section_id = sections.id 
                    WHERE
                        u.id = '$id'
                    GROUP BY
                        YEAR (
                        l.tanggal_sp2dk)
                    ORDER BY
                        1
                ");
                $filtersLhp2dk = DB::select("
                    SELECT YEAR
                        ( l.tanggal_lhp2dk ) AS lhp2dk 
                    FROM
                        users AS u
                        JOIN taxpayers AS t ON t.kasi_id = u.id
                        JOIN letters AS l ON l.taxpayer_id = t.id
                        JOIN sections ON u.section_id = sections.id 
                    WHERE
                        u.id = '$id'
                        AND YEAR(l.tanggal_lhp2dk) IS NOT NULL
                    GROUP BY
                        YEAR (
                        l.tanggal_lhp2dk)
                    ORDER BY
                        1
                ");
                $section_id = Auth::user()->section_id;
                $letters = DB::select("
                    SELECT
                        u.`name` AS AR,
                        sum( l.potensi_awal ) AS total_potensi_awal,
                        COUNT( l.no_sp2dk ) AS total_sp2dk,
                        COUNT( l.tanggal_kirim_pos ) AS total_sp2dk_kirim_pos,
                        COUNT( l.tanggal_kempos ) AS total_kempos,
                        COUNT( l.tanggal_telpon_wp ) AS total_telpon_wp,
                        COUNT( l.tanggal_konseling ) AS total_konseling,
                        COUNT( l.tanggal_ba_tidak_hadir ) AS total_ba_tidak_hadir,
                        COUNT( l.tanggal_visit ) AS total_visit,
                        COUNT( l.no_lhp2dk ) AS total_lhp2dk,
                        sum( l.potensi_akhir ) AS total_potensi_akhir,
                        sum( l.realisasi ) AS total_realisasi,
                        COUNT( l.no_dspp ) AS total_dspp
                    FROM
                        users u
                        JOIN taxpayers t ON t.user_id = u.id
                        JOIN letters l ON l.taxpayer_id = t.id 
                    WHERE
                        u.section_id = '$section_id' 
                        AND u.position_id > 4 AND
                        YEAR(l.tanggal_sp2dk) = '$request->year'
                    GROUP BY
                    u.`name`
                ");
                $lettersKasi = DB::select("
                    SELECT
                        u.`name` AS Kasi,
                    -- 	nama_seksi,
                    -- 	u.section_id,
                        sum( l.potensi_awal ) AS total_potensi_awal,
                        count( l.no_sp2dk ) AS total_sp2dk,
                        COUNT( l.tanggal_kirim_pos ) AS total_sp2dk_kirim_pos,
                        COUNT( l.tanggal_kempos ) AS total_kempos,
                        COUNT( l.tanggal_telpon_wp ) AS total_telpon_wp,
                        COUNT( l.tanggal_konseling ) AS total_konseling,
                        COUNT( l.tanggal_ba_tidak_hadir ) AS total_ba_tidak_hadir,
                        COUNT( l.tanggal_visit ) AS total_visit,
                        COUNT( l.no_lhp2dk ) AS total_lhp2dk,
                        sum( l.potensi_akhir ) AS total_potensi_akhir,
                        sum( l.realisasi ) AS total_realisasi,
                        COUNT( l.no_dspp ) AS total_dspp
                    FROM
                        users u
                        JOIN taxpayers t ON t.kasi_id = u.id
                        JOIN letters l ON l.taxpayer_id = t.id
                        JOIN sections ON u.section_id = sections.id
                    WHERE
                        u.position_id > 2 AND
                        u.section_id = sections.id AND
                        u.id = '$id' AND
                        YEAR(l.tanggal_sp2dk) = '$request->year'
                    GROUP BY
                        u.`name`
                ");
                
                return view('dashboard', [
                    'letters' => $letters,
                    'lettersKasi' => $lettersKasi,
                    'filters' => $filters,
                    'filtersLhp2dk' => $filtersLhp2dk,
                ]);
            } elseif ($request->lhp2dk) {
                $id = Auth::id();
                $filters = DB::select("
                    SELECT YEAR
                        ( l.tanggal_sp2dk ) AS year 
                    FROM
                        users AS u
                        JOIN taxpayers AS t ON t.kasi_id = u.id
                        JOIN letters AS l ON l.taxpayer_id = t.id
                        JOIN sections ON u.section_id = sections.id 
                    WHERE
                        u.id = '$id'
                    GROUP BY
                        YEAR (
                        l.tanggal_sp2dk)
                    ORDER BY
                        1
                ");
                $filtersLhp2dk = DB::select("
                    SELECT YEAR
                        ( l.tanggal_lhp2dk ) AS lhp2dk 
                    FROM
                        users AS u
                        JOIN taxpayers AS t ON t.kasi_id = u.id
                        JOIN letters AS l ON l.taxpayer_id = t.id
                        JOIN sections ON u.section_id = sections.id 
                    WHERE
                        u.id = '$id'
                        AND YEAR(l.tanggal_lhp2dk) IS NOT NULL
                    GROUP BY
                        YEAR (
                        l.tanggal_lhp2dk)
                    ORDER BY
                        1
                "); 
                $section_id = Auth::user()->section_id;
                $letters = DB::select("
                    SELECT
                        u.`name` AS AR,
                        sum( l.potensi_awal ) AS total_potensi_awal,
                        COUNT( l.no_sp2dk ) AS total_sp2dk,
                        COUNT( l.tanggal_kirim_pos ) AS total_sp2dk_kirim_pos,
                        COUNT( l.tanggal_kempos ) AS total_kempos,
                        COUNT( l.tanggal_telpon_wp ) AS total_telpon_wp,
                        COUNT( l.tanggal_konseling ) AS total_konseling,
                        COUNT( l.tanggal_ba_tidak_hadir ) AS total_ba_tidak_hadir,
                        COUNT( l.tanggal_visit ) AS total_visit,
                        COUNT( l.no_lhp2dk ) AS total_lhp2dk,
                        sum( l.potensi_akhir ) AS total_potensi_akhir,
                        sum( l.realisasi ) AS total_realisasi,
                        COUNT( l.no_dspp ) AS total_dspp
                    FROM
                        users u
                        JOIN taxpayers t ON t.user_id = u.id
                        JOIN letters l ON l.taxpayer_id = t.id 
                    WHERE
                        u.section_id = '$section_id' 
                        AND u.position_id > 4 AND
                        YEAR(l.tanggal_lhp2dk) = '$request->lhp2dk'
                    GROUP BY
                    u.`name`
                ");
                $lettersKasi = DB::select("
                    SELECT
                        u.`name` AS Kasi,
                    -- 	nama_seksi,
                    -- 	u.section_id,
                        sum( l.potensi_awal ) AS total_potensi_awal,
                        count( l.no_sp2dk ) AS total_sp2dk,
                        COUNT( l.tanggal_kirim_pos ) AS total_sp2dk_kirim_pos,
                        COUNT( l.tanggal_kempos ) AS total_kempos,
                        COUNT( l.tanggal_telpon_wp ) AS total_telpon_wp,
                        COUNT( l.tanggal_konseling ) AS total_konseling,
                        COUNT( l.tanggal_ba_tidak_hadir ) AS total_ba_tidak_hadir,
                        COUNT( l.tanggal_visit ) AS total_visit,
                        COUNT( l.no_lhp2dk ) AS total_lhp2dk,
                        sum( l.potensi_akhir ) AS total_potensi_akhir,
                        sum( l.realisasi ) AS total_realisasi,
                        COUNT( l.no_dspp ) AS total_dspp
                    FROM
                        users u
                        JOIN taxpayers t ON t.kasi_id = u.id
                        JOIN letters l ON l.taxpayer_id = t.id
                        JOIN sections ON u.section_id = sections.id
                    WHERE
                        u.position_id > 2 AND
                        u.section_id = sections.id AND
                        u.id = '$id' AND
                        YEAR(l.tanggal_lhp2dk) = '$request->lhp2dk'
                    GROUP BY
                        u.`name`
                ");
                return view('dashboard', [
                    'letters' => $letters,
                    'lettersKasi' => $lettersKasi,
                    'filters' => $filters,
                    'filtersLhp2dk' => $filtersLhp2dk,
                ]);
            } elseif (! $request->year) {
                $id = Auth::id();
                $filters = DB::select("
                    SELECT YEAR
                        ( l.tanggal_sp2dk ) AS year 
                    FROM
                        users AS u
                        JOIN taxpayers AS t ON t.kasi_id = u.id
                        JOIN letters AS l ON l.taxpayer_id = t.id
                        JOIN sections ON u.section_id = sections.id 
                    WHERE
                        u.id = '$id'
                    GROUP BY
                        YEAR (
                        l.tanggal_sp2dk)
                    ORDER BY
                        1
                ");
                $filtersLhp2dk = DB::select("
                    SELECT YEAR
                        ( l.tanggal_lhp2dk ) AS lhp2dk 
                    FROM
                        users AS u
                        JOIN taxpayers AS t ON t.kasi_id = u.id
                        JOIN letters AS l ON l.taxpayer_id = t.id
                        JOIN sections ON u.section_id = sections.id 
                    WHERE
                        u.id = '$id'
                        AND YEAR(l.tanggal_lhp2dk) IS NOT NULL
                    GROUP BY
                        YEAR (
                        l.tanggal_lhp2dk)
                    ORDER BY
                        1
                ");
                $section_id = Auth::user()->section_id;
                $letters = DB::select("
                    SELECT
                        u.`name` AS AR,
                        sum( l.potensi_awal ) AS total_potensi_awal,
                        COUNT( l.no_sp2dk ) AS total_sp2dk,
                        COUNT( l.tanggal_kirim_pos ) AS total_sp2dk_kirim_pos,
                        COUNT( l.tanggal_kempos ) AS total_kempos,
                        COUNT( l.tanggal_telpon_wp ) AS total_telpon_wp,
                        COUNT( l.tanggal_konseling ) AS total_konseling,
                        COUNT( l.tanggal_ba_tidak_hadir ) AS total_ba_tidak_hadir,
                        COUNT( l.tanggal_visit ) AS total_visit,
                        COUNT( l.no_lhp2dk ) AS total_lhp2dk,
                        sum( l.potensi_akhir ) AS total_potensi_akhir,
                        sum( l.realisasi ) AS total_realisasi,
                        COUNT( l.no_dspp ) AS total_dspp
                    FROM
                        users u
                        JOIN taxpayers t ON t.user_id = u.id
                        JOIN letters l ON l.taxpayer_id = t.id 
                    WHERE
                        u.section_id = '$section_id' 
                        AND u.position_id > 4 
                    GROUP BY
                    u.`name`
                ");
                $lettersKasi = DB::select("
                        SELECT
                            u.`name` AS Kasi,
                        -- 	nama_seksi,
                        -- 	u.section_id,
                            sum( l.potensi_awal ) AS total_potensi_awal,
                            count( l.no_sp2dk ) AS total_sp2dk,
                            COUNT( l.tanggal_kirim_pos ) AS total_sp2dk_kirim_pos,
                            COUNT( l.tanggal_kempos ) AS total_kempos,
                            COUNT( l.tanggal_telpon_wp ) AS total_telpon_wp,
                            COUNT( l.tanggal_konseling ) AS total_konseling,
                            COUNT( l.tanggal_ba_tidak_hadir ) AS total_ba_tidak_hadir,
                            COUNT( l.tanggal_visit ) AS total_visit,
                            COUNT( l.no_lhp2dk ) AS total_lhp2dk,
                            sum( l.potensi_akhir ) AS total_potensi_akhir,
                            sum( l.realisasi ) AS total_realisasi,
                            COUNT( l.no_dspp ) AS total_dspp
                        FROM
                            users u
                            JOIN taxpayers t ON t.kasi_id = u.id
                            JOIN letters l ON l.taxpayer_id = t.id
                            JOIN sections ON u.section_id = sections.id
                        WHERE
                            u.position_id > 2 AND
                            u.section_id = sections.id AND
                            u.id = '$id'
                        GROUP BY
                            u.`name`
                    ");
                
                return view('dashboard', [
                    'letters' => $letters,
                    'lettersKasi' => $lettersKasi,
                    'filters' => $filters,
                    'filtersLhp2dk' => $filtersLhp2dk,
                ]);
            }
        } else {
            if ($request->year) {
                $filters = DB::select("
                    SELECT YEAR(tanggal_sp2dk) AS year
                        FROM letters
                    GROUP BY YEAR(tanggal_sp2dk)
                    ORDER BY 1
                ");
                $filtersLhp2dk = DB::select("
                    SELECT YEAR
                        ( tanggal_lhp2dk ) AS lhp2dk 
                    FROM
                        letters 
                    WHERE
                        YEAR ( tanggal_lhp2dk ) IS NOT NULL 
                    GROUP BY
                        YEAR ( tanggal_lhp2dk ) 
                    ORDER BY
                        1
                ");
                $letters = DB::select("
                    SELECT
                        u.`name` AS AR,
                        sum( l.potensi_awal ) AS total_potensi_awal,
                        count( l.no_sp2dk ) AS total_sp2dk,
                        COUNT( l.tanggal_kirim_pos ) AS total_sp2dk_kirim_pos,
                        COUNT( l.tanggal_kempos ) AS total_kempos,
                        COUNT( l.tanggal_telpon_wp ) AS total_telpon_wp,
                        COUNT( l.tanggal_konseling ) AS total_konseling,
                        COUNT( l.tanggal_ba_tidak_hadir ) AS total_ba_tidak_hadir,
                        COUNT( l.tanggal_visit ) AS total_visit,
                        COUNT( l.no_lhp2dk ) AS total_lhp2dk,
                        sum( l.potensi_akhir ) AS total_potensi_akhir,
                        sum( l.realisasi ) AS total_realisasi,
                        COUNT( l.no_dspp ) AS total_dspp,
                        sections.nama_seksi 
                    FROM
                        users AS u
                        JOIN taxpayers AS t ON t.user_id = u.id
                        JOIN letters AS l ON l.taxpayer_id = t.id
                        JOIN sections ON u.section_id = sections.id 
                    WHERE
                        u.position_id > 4 AND
                        YEAR(l.tanggal_sp2dk) = '$request->year'
                    GROUP BY
                        u.`name`,
                        sections.nama_seksi
                ");
                $lettersKasi = DB::select("
                    SELECT
                        u.`name` AS AR,
                        sections.nama_seksi,
                        sum( l.potensi_awal ) AS total_potensi_awal,
                        count( l.no_sp2dk ) AS total_sp2dk,
                        COUNT( l.tanggal_kirim_pos ) AS total_sp2dk_kirim_pos,
                        COUNT( l.tanggal_kempos ) AS total_kempos,
                        COUNT( l.tanggal_telpon_wp ) AS total_telpon_wp,
                        COUNT( l.tanggal_konseling ) AS total_konseling,
                        COUNT( l.tanggal_ba_tidak_hadir ) AS total_ba_tidak_hadir,
                        COUNT( l.tanggal_visit ) AS total_visit,
                        COUNT( l.no_lhp2dk ) AS total_lhp2dk,
                        sum( l.potensi_akhir ) AS total_potensi_akhir,
                        sum( l.realisasi ) AS total_realisasi,
                        COUNT( l.no_dspp ) AS total_dspp 
                    FROM
                        users AS u
                        JOIN taxpayers AS t ON t.kasi_id = u.id
                        JOIN letters AS l ON l.taxpayer_id = t.id
                        JOIN sections ON u.section_id = sections.id 
                    WHERE
                        u.position_id > 2 AND
                        u.section_id = sections.id AND
                        YEAR(l.tanggal_sp2dk) = '$request->year'
                    GROUP BY
                        u.`name`,
                        sections.nama_seksi
                ");
                $lettersKk = DB::select("
                    SELECT
                        sum( l.potensi_awal ) AS total_potensi_awal,
                        count( l.no_sp2dk ) AS total_sp2dk,
                        COUNT( l.tanggal_kirim_pos ) AS total_sp2dk_kirim_pos,
                        COUNT( l.tanggal_kempos ) AS total_kempos,
                        COUNT( l.tanggal_telpon_wp ) AS total_telpon_wp,
                        COUNT( l.tanggal_konseling ) AS total_konseling,
                        COUNT( l.tanggal_ba_tidak_hadir ) AS total_ba_tidak_hadir,
                        COUNT( l.tanggal_visit ) AS total_visit,
                        COUNT( l.no_lhp2dk ) AS total_lhp2dk,
                        sum( l.potensi_akhir ) AS total_potensi_akhir,
                        sum( l.realisasi ) AS total_realisasi,
                        COUNT( l.no_dspp ) AS total_dspp 
                    FROM
                        letters l 
                    WHERE
                        YEAR ( l.tanggal_sp2dk ) = '$request->year'
                ");
                return view('dashboard', [
                    'letters' => $letters,
                    'lettersKasi' => $lettersKasi,
                    'lettersKk' => $lettersKk,
                    'filters' => $filters,
                    'filtersLhp2dk' => $filtersLhp2dk,
                ]);
            } elseif ($request->lhp2dk) {
                $filters = DB::select("
                    SELECT YEAR(tanggal_sp2dk) AS year
                        FROM letters
                    GROUP BY YEAR(tanggal_sp2dk)
                    ORDER BY 1
                ");
                $filtersLhp2dk = DB::select("
                    SELECT YEAR
                        ( tanggal_lhp2dk ) AS lhp2dk 
                    FROM
                        letters 
                    WHERE
                        YEAR ( tanggal_lhp2dk ) IS NOT NULL 
                    GROUP BY
                        YEAR ( tanggal_lhp2dk ) 
                    ORDER BY
                        1
                ");
                $letters = DB::select("
                    SELECT
                        u.`name` AS AR,
                        sum( l.potensi_awal ) AS total_potensi_awal,
                        count( l.no_sp2dk ) AS total_sp2dk,
                        COUNT( l.tanggal_kirim_pos ) AS total_sp2dk_kirim_pos,
                        COUNT( l.tanggal_kempos ) AS total_kempos,
                        COUNT( l.tanggal_telpon_wp ) AS total_telpon_wp,
                        COUNT( l.tanggal_konseling ) AS total_konseling,
                        COUNT( l.tanggal_ba_tidak_hadir ) AS total_ba_tidak_hadir,
                        COUNT( l.tanggal_visit ) AS total_visit,
                        COUNT( l.no_lhp2dk ) AS total_lhp2dk,
                        sum( l.potensi_akhir ) AS total_potensi_akhir,
                        sum( l.realisasi ) AS total_realisasi,
                        COUNT( l.no_dspp ) AS total_dspp,
                        sections.nama_seksi 
                    FROM
                        users AS u
                        JOIN taxpayers AS t ON t.user_id = u.id
                        JOIN letters AS l ON l.taxpayer_id = t.id
                        JOIN sections ON u.section_id = sections.id 
                    WHERE
                        u.position_id > 4 AND
                        YEAR(l.tanggal_lhp2dk) = '$request->lhp2dk'
                    GROUP BY
                        u.`name`,
                        sections.nama_seksi
                ");
                $lettersKasi = DB::select("
                    SELECT
                        u.`name` AS AR,
                        sections.nama_seksi,
                        sum( l.potensi_awal ) AS total_potensi_awal,
                        count( l.no_sp2dk ) AS total_sp2dk,
                        COUNT( l.tanggal_kirim_pos ) AS total_sp2dk_kirim_pos,
                        COUNT( l.tanggal_kempos ) AS total_kempos,
                        COUNT( l.tanggal_telpon_wp ) AS total_telpon_wp,
                        COUNT( l.tanggal_konseling ) AS total_konseling,
                        COUNT( l.tanggal_ba_tidak_hadir ) AS total_ba_tidak_hadir,
                        COUNT( l.tanggal_visit ) AS total_visit,
                        COUNT( l.no_lhp2dk ) AS total_lhp2dk,
                        sum( l.potensi_akhir ) AS total_potensi_akhir,
                        sum( l.realisasi ) AS total_realisasi,
                        COUNT( l.no_dspp ) AS total_dspp 
                    FROM
                        users AS u
                        JOIN taxpayers AS t ON t.kasi_id = u.id
                        JOIN letters AS l ON l.taxpayer_id = t.id
                        JOIN sections ON u.section_id = sections.id 
                    WHERE
                        u.position_id > 2 AND
                        u.section_id = sections.id AND
                        YEAR(l.tanggal_lhp2dk) = '$request->lhp2dk'
                    GROUP BY
                        u.`name`,
                        sections.nama_seksi
                ");
                $lettersKk = DB::select("
                    SELECT
                        sum( l.potensi_awal ) AS total_potensi_awal,
                        count( l.no_sp2dk ) AS total_sp2dk,
                        COUNT( l.tanggal_kirim_pos ) AS total_sp2dk_kirim_pos,
                        COUNT( l.tanggal_kempos ) AS total_kempos,
                        COUNT( l.tanggal_telpon_wp ) AS total_telpon_wp,
                        COUNT( l.tanggal_konseling ) AS total_konseling,
                        COUNT( l.tanggal_ba_tidak_hadir ) AS total_ba_tidak_hadir,
                        COUNT( l.tanggal_visit ) AS total_visit,
                        COUNT( l.no_lhp2dk ) AS total_lhp2dk,
                        sum( l.potensi_akhir ) AS total_potensi_akhir,
                        sum( l.realisasi ) AS total_realisasi,
                        COUNT( l.no_dspp ) AS total_dspp 
                    FROM
                        letters l 
                    WHERE
                        YEAR ( l.tanggal_lhp2dk ) = '$request->lhp2dk'
                ");
                return view('dashboard', [
                    'letters' => $letters,
                    'lettersKasi' => $lettersKasi,
                    'lettersKk' => $lettersKk,
                    'filters' => $filters,
                    'filtersLhp2dk' => $filtersLhp2dk,
                ]);
            } elseif (! $request->year) {
                $letters = DB::select("
                    SELECT
                        u.`name` AS AR,
                        sum( l.potensi_awal ) AS total_potensi_awal,
                        count( l.no_sp2dk ) AS total_sp2dk,
                        COUNT( l.tanggal_kirim_pos ) AS total_sp2dk_kirim_pos,
                        COUNT( l.tanggal_kempos ) AS total_kempos,
                        COUNT( l.tanggal_telpon_wp ) AS total_telpon_wp,
                        COUNT( l.tanggal_konseling ) AS total_konseling,
                        COUNT( l.tanggal_ba_tidak_hadir ) AS total_ba_tidak_hadir,
                        COUNT( l.tanggal_visit ) AS total_visit,
                        COUNT( l.no_lhp2dk ) AS total_lhp2dk,
                        sum( l.potensi_akhir ) AS total_potensi_akhir,
                        sum( l.realisasi ) AS total_realisasi,
                        COUNT( l.no_dspp ) AS total_dspp,
                        sections.nama_seksi 
                    FROM
                        users AS u
                        JOIN taxpayers AS t ON t.user_id = u.id
                        JOIN letters AS l ON l.taxpayer_id = t.id
                        JOIN sections ON u.section_id = sections.id 
                    WHERE
                        u.position_id > 4 
                    GROUP BY
                        u.`name`,
                        sections.nama_seksi
                ");
                $filtersLhp2dk = DB::select("
                    SELECT YEAR
                        ( tanggal_lhp2dk ) AS lhp2dk 
                    FROM
                        letters 
                    WHERE
                        YEAR ( tanggal_lhp2dk ) IS NOT NULL 
                    GROUP BY
                        YEAR ( tanggal_lhp2dk ) 
                    ORDER BY
                        1
                ");
                $lettersKasi = DB::select("
                    SELECT
                        u.`name` AS AR,
                        sections.nama_seksi,
                        sum( l.potensi_awal ) AS total_potensi_awal,
                        count( l.no_sp2dk ) AS total_sp2dk,
                        COUNT( l.tanggal_kirim_pos ) AS total_sp2dk_kirim_pos,
                        COUNT( l.tanggal_kempos ) AS total_kempos,
                        COUNT( l.tanggal_telpon_wp ) AS total_telpon_wp,
                        COUNT( l.tanggal_konseling ) AS total_konseling,
                        COUNT( l.tanggal_ba_tidak_hadir ) AS total_ba_tidak_hadir,
                        COUNT( l.tanggal_visit ) AS total_visit,
                        COUNT( l.no_lhp2dk ) AS total_lhp2dk,
                        sum( l.potensi_akhir ) AS total_potensi_akhir,
                        sum( l.realisasi ) AS total_realisasi,
                        COUNT( l.no_dspp ) AS total_dspp 
                    FROM
                        users AS u
                        JOIN taxpayers AS t ON t.kasi_id = u.id
                        JOIN letters AS l ON l.taxpayer_id = t.id
                        JOIN sections ON u.section_id = sections.id 
                    WHERE
                        u.position_id > 2 
                        AND u.section_id = sections.id 
                    GROUP BY
                        u.`name`,
                        sections.nama_seksi
                ");
                $lettersKk = DB::select("
                    SELECT
                        sum( l.potensi_awal ) AS total_potensi_awal,
                        count( l.no_sp2dk ) AS total_sp2dk,
                        COUNT( l.tanggal_kirim_pos ) AS total_sp2dk_kirim_pos,
                        COUNT( l.tanggal_kempos ) AS total_kempos,
                        COUNT( l.tanggal_telpon_wp ) AS total_telpon_wp,
                        COUNT( l.tanggal_konseling ) AS total_konseling,
                        COUNT( l.tanggal_ba_tidak_hadir ) AS total_ba_tidak_hadir,
                        COUNT( l.tanggal_visit ) AS total_visit,
                        COUNT( l.no_lhp2dk ) AS total_lhp2dk,
                        sum( l.potensi_akhir ) AS total_potensi_akhir,
                        sum( l.realisasi ) AS total_realisasi,
                        COUNT( l.no_dspp ) AS total_dspp 
                    FROM
                        letters l
                ");
                $filters = DB::select("
                    SELECT YEAR(tanggal_sp2dk) AS year
                        FROM letters
                    GROUP BY YEAR(tanggal_sp2dk)
                    ORDER BY 1
                ");

                return view('dashboard', [
                    'letters' => $letters,
                    'lettersKasi' => $lettersKasi,
                    'lettersKk' => $lettersKk,
                    'filters' => $filters,
                    'filtersLhp2dk' => $filtersLhp2dk,
                ]);
            }
        }
    }
}
