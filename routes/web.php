<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Dosen\BerkasController;
use App\Http\Controllers\PPTA\SidangTaController;
use App\Http\Controllers\Mahasiswa\HomeController;
use App\Http\Controllers\PPTA\LaporanFkController;
use App\Http\Controllers\PPTA\LaporanTaController;
use App\Http\Controllers\Dosen\DashboardController;
use App\Http\Controllers\PPTA\ProposalTaController;
use App\Http\Controllers\PPTA\MaintenanceController;
use App\Http\Controllers\PPTA\LaporanProposalController;
use App\Http\Controllers\Mahasiswa\TAPerangkatanController;
use App\Http\Controllers\Mahasiswa\JadwalBimbinganController;
use App\Http\Controllers\Mahasiswa\UsulanTugasAkhirController;
use App\Http\Controllers\Mahasiswa\PencarianPembimbingController;

Route::get('/listdosen', function () {
    $users = DB::connection('oracle')->table('dosen')->get(); // Mengambil semua data dari tabel mahasiswa
    return view('listdosen', compact('users')); // Kirim data ke view 'listmhs'
});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pencarianpembimbing', [PencarianPembimbingController::class, 'index'])->name('pencarianpembimbing');
Route::get('/taperangkatan', [TAPerangkatanController::class, 'index'])->name('taperangkatan');
Route::get('/taperangkatan/jurusan', [TAPerangkatanController::class, 'getByJurusan'])->name('taperangkatan.jurusan');
Route::get('/jadbimbingan', [JadwalBimbinganController::class, 'index'])->name('jadbimbingan');
Route::get('/jadbimbingan/dosen', [JadwalBimbinganController::class, 'getJadwalDosen'])->name('jadbimbingan.dosen');
Route::get('/document', function () {
    return view('mahasiswa.document', ['title' => 'Contact Page']);
})->name('document');
Route::get('/usulan', [UsulanTugasAkhirController::class, 'index'])->name('usulan');

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('loggedin');

Route::middleware(['loggedin'])->group(function () {
    // Dosen Route
    Route::get('/dosen', function () {
        return redirect()->route('dosen.dashboard');
    });
    Route::get('/dosen/dashboard', [DashboardController::class, 'index'])->name('dosen.dashboard');
    Route::get('/dosen/dashboard/penilaian/{mhs_nim}/{kode_antri}', [BerkasController::class, 'penilaian'])->name('dosen.dashboard.penilaian');
    Route::get('/dosen/berkas', [BerkasController::class, 'index'])->name('dosen.berkas');
    Route::get('/dosen/berkas/penilaian/{mhs_nim}/{kode_antri}', [BerkasController::class, 'penilaian'])->name('dosen.berkas.penilaian');

    // PPTA Route
    Route::get('/ppta', function () {
        return redirect()->route('ppta.proposal_ta');
    });
    Route::get('/ppta/proposal_ta', [ProposalTaController::class, 'index'])->name('ppta.proposal_ta');
    Route::get('/ppta/sidang_ta', [SidangTaController::class, 'index'])->name('ppta.sidang_ta');
    Route::get('/ppta/maintenance', [MaintenanceController::class, 'index'])->name('ppta.maintenance');

    // Laporan Route
    Route::get('/ppta/laporan_fk', [LaporanFkController::class, 'index'])->name('ppta.laporan_fk');
    Route::get('/ppta/laporan_fk_pdf', [LaporanFkController::class, 'generatePdf'])->name('ppta.laporan_fk_pdf');
    Route::get('/ppta/laporan_proposal', [LaporanProposalController::class, 'index'])->name('ppta.laporan_proposal');
    Route::get('/ppta/laporan_proposal_pdf', [LaporanProposalController::class, 'generatePdf'])->name('ppta.laporan_proposal_pdf');
    Route::get('/ppta/laporan_ta', [LaporanTaController::class, 'index'])->name('ppta.laporan_ta');
    Route::get('/ppta/laporan_ta_pdf', [LaporanTaController::class, 'generatePdf'])->name('ppta.laporan_ta_pdf');
});


// API

Route::get('/api/ppta/laporan/fk', function (Request $request) {
    $tanggalAwal = $request->query('tanggal_awal');
    $tanggalAkhir = $request->query('tanggal_akhir');
    $krs = $request->query('krs');
    $kodeProdi = $request->query('kode_prodi');

    $query = "SELECT
            ap.jdl_proposal,
            vm.nim,
            vm.nama,
            nama_plus_gelar(ap.pembimbing_1) AS pembimbing_1_nama, 
            nama_plus_gelar(ap.pembimbing_2) AS pembimbing_2_nama,
            nama_plus_gelar(jp.penguji1) AS penguji_1_nama,
            nama_plus_gelar(jp.penguji2) AS penguji_2_nama,
            TO_CHAR(ap.wkt_proposal, 'DD-MM-YYYY') AS wkt_proposal,
            ap.ket_tolak
        FROM 
           v_antri_proposal ap
        JOIN 
            v_jdw_proposal jp ON ap.kode_antrian = jp.kode_antrian
        JOIN 
            v_mhs_ vm ON ap.mhs_nim = vm.nim
        WHERE
            jp.penguji1 IS NULL 
            AND ap.sts_proposal IS NULL
            AND ROWNUM <= 10
        ";

    $params = [];

    if (!empty($tanggalAwal) && !empty($tanggalAkhir)) {
        $query .= " AND ap.wkt_proposal BETWEEN TO_DATE(?, 'YYYY-MM-DD') AND TO_DATE(?, 'YYYY-MM-DD')";
        $params[] = $tanggalAwal;
        $params[] = $tanggalAkhir;
    }

    if (!empty($krs)) {
        $query .= " AND ap.sts_ta = ?";
        $params[] = $krs;
    }

    if (!empty($kodeProdi) && is_numeric($kodeProdi)) {
        $query .= " AND SUBSTR(vm.nim, 3, 5) = ?";
        $params[] = $kodeProdi;
    }

    $query .= " ORDER BY ap.wkt_proposal DESC";

    // Eksekusi query
    $data = DB::select($query, $params);

    return response()->json($data);
});

Route::get('/api/ppta/laporan/prop', function (Request $request) {
    $tanggalAwal = $request->query('tanggal_awal');
    $tanggalAkhir = $request->query('tanggal_akhir');
    $hasilSidang = $request->query('hasil_sidang');
    $kodeProdi = $request->query('kode_prodi');

    $query = "SELECT
            ap.jdl_proposal,
            vm.nim,
            vm.nama,
            nama_plus_gelar(ap.pembimbing_1) AS pembimbing_1_nama, 
            nama_plus_gelar(ap.pembimbing_2) AS pembimbing_2_nama,
            nama_plus_gelar(jp.penguji1) AS penguji_1_nama,
            nama_plus_gelar(jp.penguji2) AS penguji_2_nama,
            TO_CHAR(ap.wkt_proposal, 'DD-MM-YYYY') AS wkt_proposal,
            ap.sts_proposal
        FROM 
           v_antri_proposal ap
        JOIN 
            v_jdw_proposal jp ON ap.kode_antrian = jp.kode_antrian
        JOIN 
            v_mhs_ vm ON ap.mhs_nim = vm.nim
        WHERE
            jp.penguji1 IS NULL 
            AND ap.sts_proposal IS NULL
            AND ROWNUM <= 10
        ";

    $params = [];

    if (!empty($tanggalAwal) && !empty($tanggalAkhir)) {
        $query .= " AND ap.wkt_proposal BETWEEN TO_DATE(?, 'YYYY-MM-DD') AND TO_DATE(?, 'YYYY-MM-DD')";
        $params[] = $tanggalAwal;
        $params[] = $tanggalAkhir;
    }

    if (!empty($hasilSidang)) {
        $query .= " AND ap.sts_ta = ?";
        $params[] = $hasilSidang;
    }

    if (!empty($kodeProdi) && is_numeric($kodeProdi)) {
        $query .= " AND SUBSTR(vm.nim, 3, 5) = ?";
        $params[] = $kodeProdi;
    }

    $query .= " ORDER BY ap.wkt_proposal DESC";

    $data = DB::select($query, $params);

    return response()->json($data);
});

Route::get('/api/ppta/laporan/ta', function (Request $request) {
    $tanggalAwal = $request->query('tanggal_awal');
    $tanggalAkhir = $request->query('tanggal_akhir');
    $hasilSidang = $request->query('hasil_sidang');
    $kodeProdi = $request->query('kode_prodi');

    $query = "SELECT
            ap.jdl_proposal,
            vm.nim,
            vm.nama,
            nama_plus_gelar(ap.pembimbing_1) AS pembimbing_1_nama, 
            nama_plus_gelar(ap.pembimbing_2) AS pembimbing_2_nama,
            nama_plus_gelar(jp.penguji1) AS penguji_1_nama,
            nama_plus_gelar(jp.penguji2) AS penguji_2_nama,
            TO_CHAR(ap.wkt_proposal, 'DD-MM-YYYY') AS wkt_proposal, 
            TO_CHAR(ap.wkt_ta, 'DD-MM-YYYY') AS wkt_ta,
            jp.ruang,
            ap.sts_ta
        FROM 
           v_antri_proposal ap
        JOIN 
            v_jdw_proposal jp ON ap.kode_antrian = jp.kode_antrian
        JOIN 
            v_mhs_ vm ON ap.mhs_nim = vm.nim
        WHERE
            ap.file_bimbingan IS NOT NULL 
            AND ap.file_laporan IS NOT NULL
            AND ROWNUM <= 10
        ";

    $params = [];

    if (!empty($tanggalAwal) && !empty($tanggalAkhir)) {
        $query .= " AND ap.wkt_proposal BETWEEN TO_DATE(?, 'YYYY-MM-DD') AND TO_DATE(?, 'YYYY-MM-DD')";
        $params[] = $tanggalAwal;
        $params[] = $tanggalAkhir;
    }

    if (!empty($hasilSidang)) {
        $query .= " AND ap.sts_ta = ?";
        $params[] = $hasilSidang;
    }

    if (!empty($kodeProdi) && is_numeric($kodeProdi)) {
        $query .= " AND SUBSTR(vm.nim, 3, 5) = ?";
        $params[] = $kodeProdi;
    }

    $query .= " ORDER BY ap.kode_antrian";

    // Eksekusi query
    $data = DB::select($query, $params);

    return response()->json($data);
});


Route::get('/api/dosens', function () {
    $query = "SELECT 
            vk.nik, 
            nama_plus_gelar(vk.nik) AS nama_gelar,
            nama
        FROM 
            v_prodiewmp vp
        JOIN 
            v_karyawan_ vk ON vp.nik = vk.nik
        ORDER BY 
            nama_gelar
        ";

    $execute = DB::select($query);

    return response()->json($execute);
});

Route::get('/api/ruangs', function () {
    $query = "SELECT 
            *
        FROM 
            v_rng
        ORDER BY 
            id
        ";

    $execute = DB::select($query); // Menggunakan raw SQL query

    return response()->json($execute);
});

Route::get('/api/prodi', function () {
    $query = "SELECT 
            id, 
            substr(alias,0,2) || ' ' || nama as nama_prodi
        FROM 
            v_fakultas 
        WHERE 
            sts_aktif='Y'
        ";

    $execute = DB::select($query);

    return response()->json($execute);
});

Route::get('/api/dosen/dashboard', function (Request $request) {
    $nikDosen = $request->query('nik_dosen');

    $query = "
        SELECT * FROM (
            SELECT 
                ap.kode_antrian,
                ap.wkt_proposal,
                ap.wkt_ta,
                ap.jdl_proposal,
                ap.mhs_nim,
                vm.nama as mhs_nama
            FROM
                v_antri_proposal ap
            JOIN 
                v_jdw_proposal jdw 
                    ON ap.kode_antrian = jdw.kode_antrian
            JOIN 
                v_mhs_ vm 
                    ON ap.mhs_nim = vm.nim
            WHERE
                NOT EXISTS (
                    SELECT 1 
                    FROM v_rincian_nilai_ta_ rnt 
                    WHERE rnt.kode_antrian = ap.kode_antrian
                )
            AND
                ? IN (ap.pembimbing_1, ap.pembimbing_2, jdw.penguji1, jdw.penguji2)
            AND
                ap.mhs_nim NOT IN (SELECT nim FROM v_alumni_)
            ORDER BY
                ap.kode_antrian DESC
        )
    ";

    $execute = DB::select($query, [$nikDosen]);

    return response()->json($execute);
});



Route::get('/api/dosen/berkas', function (Request $request) {
    $nikDosen = $request->query('nik_dosen');
    $filterBerkas = $request->query('filter_berkas', 'semua');

    // Siapkan variabel tambahan untuk menampung kondisi
    $additionalWhere = '';

    switch ($filterBerkas) {
        case 'proposal':
            $additionalWhere = 'AND prop.wkt_ta IS NULL';
            break;
        case 'tugas_akhir':
            $additionalWhere = 'AND prop.wkt_ta IS NOT NULL';
            break;
        case 'semua':
        default:
            $additionalWhere = '';
            break;
    }

    $query = "
        SELECT 
            prop.kode_antrian,
            prop.wkt_proposal,
            prop.wkt_ta,
            prop.jdl_proposal,
            vm.nama as mhs_nama,
            prop.mhs_nim,
            file_proposal,
            file_bimbingan,
            nama_plus_gelar(prop.pembimbing_1) AS pembimbing_1_nama, 
            nama_plus_gelar(prop.pembimbing_2) AS pembimbing_2_nama,
            nama_plus_gelar(jdw.penguji1) AS penguji_1_nama,
            CASE 
                WHEN prop.pembimbing_1 = ? THEN 'Pembimbing 1'
                WHEN prop.pembimbing_2 = ? THEN 'Pembimbing 2'
                WHEN jdw.penguji1 = ? THEN 'Penguji 1'
                ELSE 'Tidak ditemukan'
            END AS status_dosen
        FROM 
            v_antri_proposal prop
        JOIN 
            v_jdw_proposal jdw ON prop.kode_antrian = jdw.kode_antrian
        JOIN 
            v_mhs_ vm ON prop.mhs_nim = vm.nim
        WHERE 
            ? IN (prop.pembimbing_1, prop.pembimbing_2, jdw.penguji1, jdw.penguji2)
            $additionalWhere
        ORDER BY
            prop.wkt_proposal DESC
    ";

    $execute = DB::select($query, [$nikDosen, $nikDosen, $nikDosen, $nikDosen]);

    return response()->json($execute);
});

Route::get('/api/dosen/penilaian', function (Request $request) {
    $nikDosen = $request->query('nik_dosen', '020393');

    $query = "SELECT 
            prop.wkt_proposal,
            prop.wkt_ta,
            prop.jdl_proposal,
            vm.nama as mhs_nama,
            prop.mhs_nim,
            nama_plus_gelar(prop.pembimbing_1) AS pembimbing_1_nama, 
            nama_plus_gelar(prop.pembimbing_2) AS pembimbing_2_nama,
            nama_plus_gelar(jdw.penguji1) AS penguji_1_nama
        FROM 
           v_antri_proposal prop
        JOIN 
            v_jdw_proposal jdw on prop.kode_antrian = jdw.kode_antrian
        JOIN 
            v_mhs_ vm ON prop.mhs_nim = vm.nim
        WHERE 
            ? in (prop.pembimbing_1, prop.pembimbing_2, jdw.penguji1, jdw.penguji2)
        ORDER BY
            prop.wkt_proposal DESC
        ";

    $execute = DB::select($query, [$nikDosen]); // Menggunakan raw SQL query

    return response()->json($execute);
});

Route::get('/api/dosen/penilaian_nilai',  function (Request $request) {
    $kodeAntrian = $request->query('kode_antrian');

    $query = "SELECT 
            kode_antrian,
            kriteria_id,
            kriteria_nama,
            bobot,
            nilai
        FROM 
           v_kriteria_nilai_ta_ knt
        JOIN 
            v_ta_bobot_nilai_ tbn ON knt.kriteria_id = tbn.kriteria_nilai_ta
        JOIN 
            v_rincian_nilai_ta_ rnt ON knt.kriteria_id = rnt.kriteria_nilai_ta
        WHERE
            kode_antrian = ?
        ORDER BY
            parent_id
        ";

    $penilaian = DB::select($query, [$kodeAntrian]);

    if (!empty($penilaian)) {
        return response()->json($penilaian);
    }

    $dummyTemplate = [
        [
            "kriteria_id" => "F2.1.1",
            "kriteria_nama" => "Perumusan masalah",
            "bobot" => "30",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F2.1.2",
            "kriteria_nama" => "Kajian pustaka",
            "bobot" => "20",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F2.1.3",
            "kriteria_nama" => "Metodologi",
            "bobot" => "30",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F2.1.4",
            "kriteria_nama" => "Luaran tugas akhir",
            "bobot" => "20",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F2.2.1",
            "kriteria_nama" => "Perumusan masalah",
            "bobot" => "30",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F2.2.2",
            "kriteria_nama" => "Kajian pustaka",
            "bobot" => "20",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F2.2.4",
            "kriteria_nama" => "Luaran tugas akhir",
            "bobot" => "20",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F2.2.3",
            "kriteria_nama" => "Metodologi",
            "bobot" => "30",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F3.1.1",
            "kriteria_nama" => "Kemandirian",
            "bobot" => "30",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F3.1.3",
            "kriteria_nama" => "Kreatifitas",
            "bobot" => "20",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F3.1.2",
            "kriteria_nama" => "Keaktifan",
            "bobot" => "20",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F3.1.4",
            "kriteria_nama" => "Analisa Ilmiah",
            "bobot" => "30",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F3.2.3",
            "kriteria_nama" => "Kreatifitas",
            "bobot" => "20",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F3.2.4",
            "kriteria_nama" => "Analisa Ilmiah",
            "bobot" => "30",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F3.2.2",
            "kriteria_nama" => "Keaktifan",
            "bobot" => "20",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F3.2.1",
            "kriteria_nama" => "Kemandirian",
            "bobot" => "30",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F5.1.1.2",
            "kriteria_nama" => "Sikap dan penampilan",
            "bobot" => "50",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F5.1.1.1",
            "kriteria_nama" => "Persiapan, sistematika pemakaian bahasa, dan pengaturan waktu penyajian",
            "bobot" => "50",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F5.1.2.5",
            "kriteria_nama" => "Format dan tata tulis",
            "bobot" => "10",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F5.1.2.3",
            "kriteria_nama" => "Analisis dan metodologi",
            "bobot" => "25",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F5.1.2.4",
            "kriteria_nama" => "Kreatifitas",
            "bobot" => "15",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F5.1.2.1",
            "kriteria_nama" => "Sistematika dan kelengkapan naskah",
            "bobot" => "25",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F5.1.2.2",
            "kriteria_nama" => "Kompleksitas dan manfaat",
            "bobot" => "25",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F5.1.3.1",
            "kriteria_nama" => "Penguasaan materi",
            "bobot" => "60",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F5.1.3.2",
            "kriteria_nama" => "Ketepatan jawaban dan objektifitas dalam menanggapi permasalahan",
            "bobot" => "40",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F5.2.1.1",
            "kriteria_nama" => "Persiapan, sistematika pemakaian bahasa, dan pengaturan waktu penyajian",
            "bobot" => "50",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F5.2.1.2",
            "kriteria_nama" => "Sikap dan penampilan",
            "bobot" => "50",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F5.2.2.1",
            "kriteria_nama" => "Sistematika dan kelengkapan naskah",
            "bobot" => "25",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F5.2.2.4",
            "kriteria_nama" => "Kreatifitas",
            "bobot" => "15",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F5.2.2.3",
            "kriteria_nama" => "Analisis dan metodologi",
            "bobot" => "25",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F5.2.2.2",
            "kriteria_nama" => "Kompleksitas dan manfaat",
            "bobot" => "25",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F5.2.2.5",
            "kriteria_nama" => "Format dan tata tulis",
            "bobot" => "10",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F5.2.3.2",
            "kriteria_nama" => "Ketepatan jawaban dan objektifitas dalam menanggapi permasalahan",
            "bobot" => "40",
            "nilai" => "0"
        ],
        [
            "kriteria_id" => "F5.2.3.1",
            "kriteria_nama" => "Penguasaan materi",
            "bobot" => "60",
            "nilai" => "0"
        ]
    ];

    // Tambahkan kode_antrian ke setiap item
    $dummyData = array_map(function ($item) use ($kodeAntrian) {
        return array_merge(
            ['kode_antrian' => $kodeAntrian],
            $item
        );
    }, $dummyTemplate);

    return response()->json($dummyData);
});

Route::post('/api/nilai-ta/insert', function (Request $request) {
    // Ambil input dari request
    $nikDosen = $request->input('nik_dosen');
    $kodeAntrian = $request->input('kode_antrian');
    $nilai = $request->input('nilai');
    $idKriteria = $request->input('id_kriteria');

    $cekData = DB::table('v_kriteria_nilai_ta_ as knt')
        ->join('v_ta_bobot_nilai_ as tbn', 'knt.kriteria_id', '=', 'tbn.kriteria_nilai_ta')
        ->join('v_rincian_nilai_ta_ as rnt', 'knt.kriteria_id', '=', 'rnt.kriteria_nilai_ta')
        ->where('kode_antrian', $kodeAntrian)
        ->exists();

    // if ($cekData) {
    // DB::statement("BEGIN sp_update_nilai_ta_(:nik_dosen, :kode_antrian, :nilai, :id_kriteria); END;", [
    //     'nik_dosen'   => $nikDosen,
    //     'kode_antrian'=> $kodeAntrian,
    //     'nilai'       => $nilai,
    //     'id_kriteria' => $idKriteria,
    // ]);
    // } else {
    DB::statement("BEGIN sp_insert_nilai_ta_(:nik_dosen, :kode_antrian, :nilai, :id_kriteria); END;", [
        'nik_dosen'   => $nikDosen,
        'kode_antrian' => $kodeAntrian,
        'nilai'       => $nilai,
        'id_kriteria' => $idKriteria,
    ]);
    // }

    return response()->json(['message' => 'Data nilai TA berhasil ditambahkan.']);
});

Route::get('/api/mhs/jadbim', function () {
    $query = "SELECT 
            nama_plus_gelar(vjb.nik) as nama_gelar, 
            vjb.*
        FROM 
            v_jdw_bimbing vjb
        ";

    $execute = DB::select($query);

    return response()->json($execute);
});

Route::get('/api/mhs/usulan', function () {
    $query = "SELECT 
            nama_plus_gelar(vu.nik) as nama_gelar, 
            vu.*
        FROM 
            v_usulta vu
        ";

    $execute = DB::select($query);

    return response()->json($execute);
});

Route::get('/api/mhs/home', function () {
    $query = "SELECT 
            TO_CHAR(vp.tgl_smn, 'DD/MM/YYYY') AS tgl,
            TO_CHAR(vp.jam, 'HH24:MI') AS jam,
            vp.ruang_smn,
            vm.nama,
            vm.nim,
            vp.jdl_proposal, 
            nama_plus_gelar(vp.pembimbing_1) AS pembimbing_1_nama, 
            nama_plus_gelar(vp.pembimbing_2) AS pembimbing_2_nama,
            vp.tgl_smn
        FROM 
            v_propta vp
        JOIN 
            v_mhs_ vm ON vp.mhs_nim = vm.nim
        WHERE 
            vp.tgl_smn >= TRUNC(add_months(sysdate,-1)) 
            AND vp.tgl_smn < TRUNC(add_months(sysdate,1))
        ORDER BY
            vp.ruang_smn
            ";

    $execute = DB::select($query);

    return response()->json($execute);
});

Route::get('/api/mhs/pencarianpembimbing', function () {
    $query = "SELECT
            vp.jdl_proposal, 
            vm.nama,
            vm.nim,
            nama_plus_gelar(pembimbing_1) as pemb_1, 
            nama_plus_gelar(pembimbing_2) as pemb_2, 
            TO_CHAR(vp.tgl_smn, 'DD/MM/YYYY') AS tgl,
            vp.ruang_smn,
            TO_CHAR(vp.jam, 'HH24:MI') AS jam
        FROM 
            v_propta vp
        JOIN 
            v_karyawan_ vk1 ON vp.pembimbing_1 = vk1.nik
        JOIN 
            v_karyawan_ vk2 ON vp.pembimbing_2 = vk2.nik
        JOIN 
            v_mhs_ vm ON vp.mhs_nim = vm.nim
        WHERE 
            EXTRACT(YEAR FROM vp.tgl_smn) > 2022
        ";

    $execute = DB::select($query);

    return response()->json($execute);
});

Route::get('/api/mhs/taperangkatan', function (Request $request) {
    $kodeProdi = $request->query('kode_prodi', 39010);

    if (!$kodeProdi || !is_numeric($kodeProdi)) {
        return Response::json(['error' => 'Kode prodi tidak valid'], 400);
    }

    $query = "SELECT 
                '20' || SUBSTR(mhs_nim, 1, 2) AS ANGKATAN, 
                COUNT(1) AS jumlah_mahasiswa
            FROM 
                v_propta
            WHERE 
                SUBSTR(mhs_nim, 3, 5) = ? AND CAST(SUBSTR(mhs_nim, 1, 2) AS INTEGER) <= 24
            GROUP BY 
                SUBSTR(mhs_nim, 1, 2)
            ORDER BY 
                ANGKATAN DESC";

    $execute = DB::select($query, [$kodeProdi]);

    return response()->json($execute);
});

Route::get('/api/mhs/taperangkatan/detail', function (Request $request) {
    $kodeNim = $request->query('kode_nim');
    $kodeProdi = $request->query('kode_prodi');

    $query = "SELECT
            vp.jdl_proposal, 
            vm.nama,
            vm.nim,
            nama_plus_gelar(vp.pembimbing_1) AS pembimbing_1_nama, 
            nama_plus_gelar(vp.pembimbing_2) AS pembimbing_2_nama
        FROM 
            v_propta vp
        JOIN 
            v_mhs_ vm ON vp.mhs_nim = vm.nim
        WHERE
            SUBSTR(mhs_nim, 1, 2) = :kodeNim
            AND SUBSTR(mhs_nim, 3, 5) = :kodeProdi
            AND ROWNUM <= 40
        ORDER BY vm.nim";

    $execute = DB::select($query, [
        'kodeNim' => $kodeNim,
        'kodeProdi' => $kodeProdi
    ]);

    return response()->json($execute);
});

Route::get('/api/ppta/maintenance', function () {
    $query = "SELECT 
            dp.*,
            nama_plus_gelar(dp.nik) AS nama_gelar
        FROM 
            v_dos_penguji dp
        ORDER BY
            nama_gelar
        ";

    $execute = DB::select($query); // Menggunakan raw SQL query

    return response()->json($execute);
});

//SEMENTARA MENGGUNAKAN prop.wkt_app_proposal UNTUK JADWAL SIDANG TA SUDAH DIJADWALKAN ATAU BELUM
Route::get('/api/ppta/proposal', function () {
    $query = "SELECT 
            prop.kode_antrian,
            prop.wkt_proposal,
            prop.wkt_app_proposal,  
            prop.jdl_proposal,
            vm.nama as mhs_nama,
            prop.mhs_nim,
            nama_plus_gelar(prop.pembimbing_1) AS pembimbing_1_nama, 
            nama_plus_gelar(prop.pembimbing_2) AS pembimbing_2_nama,
            vjp.wkt_proposal as sidang_prop,
            'https://sicyca.dinamika.ac.id/' || prop.file_proposal as prop_link,
            vjp.ruang,
            vjp.penguji1 as nik_penguji1,
            nama_plus_gelar(vjp.penguji1) as penguji1
        FROM 
           v_antri_proposal prop
        JOIN 
            v_mhs_ vm ON prop.mhs_nim = vm.nim
        JOIN
            v_jdw_proposal vjp ON prop.kode_antrian = vjp.kode_antrian
        WHERE
            CAST(SUBSTR(prop.mhs_nim, 1, 2) AS INTEGER) <= 24 AND
            CAST(SUBSTR(prop.mhs_nim, 1, 2) AS INTEGER) >= 18
        ORDER BY
            prop.wkt_proposal DESC
        ";

    $execute = DB::select($query); // Menggunakan raw SQL query

    return response()->json($execute);
});

//SEMENTARA MENGGUNAKAN prop.wkt_app_ta UNTUK JADWAL SIDANG TA SUDAH DIJADWALKAN ATAU BELUM
Route::get('/api/ppta/ta', function () {
    $query = "SELECT 
            prop.kode_antrian,
            prop.wkt_ta,
            vp.tgl_smn,
            vp.ruang_smn,
            vp.penguji,
            prop.jdl_proposal,
            vm.nama as mhs_nama,
            prop.mhs_nim,
            nama_plus_gelar(prop.pembimbing_1) AS pembimbing_1_nama, 
            nama_plus_gelar(prop.pembimbing_2) AS pembimbing_2_nama,
            'https://sicyca.dinamika.ac.id/' || prop.file_proposal AS proposal_link,
            'https://sicyca.dinamika.ac.id/' || prop.file_laporan AS laporan_link,
            'https://sicyca.dinamika.ac.id/' || prop.file_jurnal AS jurnal_link,
            'https://sicyca.dinamika.ac.id/' || prop.file_seminar AS seminar_link,
            'https://sicyca.dinamika.ac.id/' || prop.file_bimbingan AS bimbingan_link,
            'https://sicyca.dinamika.ac.id/' || prop.file_poster AS poster_link,
            'https://sicyca.dinamika.ac.id/' || prop.file_ori AS original_link,
            'https://sicyca.dinamika.ac.id/' || prop.file_upjur AS upload_jurnal_link,
            'https://sicyca.dinamika.ac.id/' || prop.file_keaslian AS keaslian_link
        FROM 
           v_antri_proposal prop
        JOIN 
            v_propta vp ON prop.mhs_nim = vp.mhs_nim
        JOIN 
            v_mhs_ vm ON prop.mhs_nim = vm.nim
        WHERE 
            CAST(SUBSTR(prop.mhs_nim, 1, 2) AS INTEGER) <= 24 AND
            CAST(SUBSTR(prop.mhs_nim, 1, 2) AS INTEGER) >= 18
        ORDER BY
            prop.wkt_proposal DESC
        ";

    $execute = DB::select($query); // Menggunakan raw SQL query

    return response()->json($execute);
});
