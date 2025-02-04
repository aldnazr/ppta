<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class JadwalBimbinganController extends Controller
{
    // private $dosensWithSchedules = [
    //     "Julianto Lemantara, S.Kom., M.Eng." => [
    //         ['tanggal' => 'Selasa', 'jam_mulai' => '15:00', 'jam_selesai' => '17:30', 'ruang' => 'M-306', 'ket' => 'Progres'],
    //         ['tanggal' => 'Jumat', 'jam_mulai' => '14:30', 'jam_selesai' => '17:00', 'ruang' => 'R Dosen SI LT-2', 'ket' => 'Proposal'],
    //     ],
    //     "Yoppy Mirza Maulana, S.Kom., M.MT." => [
    //         ['tanggal' => 'Senin', 'jam_mulai' => '10:00', 'jam_selesai' => '12:00', 'ruang' => 'M-303', 'ket' => 'Diskusi'],
    //         ['tanggal' => 'Kamis', 'jam_mulai' => '13:00', 'jam_selesai' => '15:00', 'ruang' => 'M-307', 'ket' => 'Review'],
    //     ],
    //     "Vivine Nurcahyawati, M.Kom." => [
    //         ['tanggal' => 'Rabu', 'jam_mulai' => '08:00', 'jam_selesai' => '10:00', 'ruang' => 'M-308', 'ket' => 'Ujian'],
    //         ['tanggal' => 'Sabtu', 'jam_mulai' => '11:00', 'jam_selesai' => '13:00', 'ruang' => 'M-309', 'ket' => 'Bimbingan'],
    //     ],
    //     "Teguh Sutanto, M.Kom." => [
    //         ['tanggal' => 'Senin', 'jam_mulai' => '08:30', 'jam_selesai' => '10:30', 'ruang' => 'M-301', 'ket' => 'Skripsi'],
    //         ['tanggal' => 'Kamis', 'jam_mulai' => '16:00', 'jam_selesai' => '18:00', 'ruang' => 'M-303', 'ket' => 'Review Proposal'],
    //     ],
    //     "Sri Hariani Eko Wulandari, S.Kom., M.MT." => [
    //         ['tanggal' => 'Selasa', 'jam_mulai' => '09:00', 'jam_selesai' => '11:00', 'ruang' => 'M-304', 'ket' => 'Bimbingan'],
    //         ['tanggal' => 'Jumat', 'jam_mulai' => '08:30', 'jam_selesai' => '10:30', 'ruang' => 'M-305', 'ket' => 'Evaluasi'],
    //     ],
    //     "Valentinus Roby Hananto, S.Kom., M.Sc." => [
    //         ['tanggal' => 'Rabu', 'jam_mulai' => '13:00', 'jam_selesai' => '15:00', 'ruang' => 'M-307', 'ket' => 'Review Skripsi'],
    //         ['tanggal' => 'Jumat', 'jam_mulai' => '10:30', 'jam_selesai' => '12:00', 'ruang' => 'M-309', 'ket' => 'Progres'],
    //     ],
    //     "Agus Dwi Churniawan, S.Si., M.Kom." => [
    //         ['tanggal' => 'Senin', 'jam_mulai' => '13:00', 'jam_selesai' => '15:00', 'ruang' => 'M-310', 'ket' => 'Skripsi'],
    //         ['tanggal' => 'Kamis', 'jam_mulai' => '14:30', 'jam_selesai' => '16:30', 'ruang' => 'M-311', 'ket' => 'Proposal'],
    //         ['tanggal' => 'Senin', 'jam_mulai' => '13:00', 'jam_selesai' => '15:00', 'ruang' => 'M-310', 'ket' => 'Skripsi'],
    //         ['tanggal' => 'Kamis', 'jam_mulai' => '14:30', 'jam_selesai' => '16:30', 'ruang' => 'M-311', 'ket' => 'Proposal'],
    //         ['tanggal' => 'Senin', 'jam_mulai' => '13:00', 'jam_selesai' => '15:00', 'ruang' => 'M-310', 'ket' => 'Skripsi'],
    //         ['tanggal' => 'Kamis', 'jam_mulai' => '14:30', 'jam_selesai' => '16:30', 'ruang' => 'M-311', 'ket' => 'Proposal'],
    //         ['tanggal' => 'Senin', 'jam_mulai' => '13:00', 'jam_selesai' => '15:00', 'ruang' => 'M-310', 'ket' => 'Skripsi'],
    //         ['tanggal' => 'Kamis', 'jam_mulai' => '14:30', 'jam_selesai' => '16:30', 'ruang' => 'M-311', 'ket' => 'Proposal'],
    //     ],
    //     "Pantjawati Sudarmaningtyas, S.Kom., M.Eng., OCA" => [
    //         ['tanggal' => 'Senin', 'jam_mulai' => '09:00', 'jam_selesai' => '11:00', 'ruang' => 'M-312', 'ket' => 'Diskusi'],
    //         ['tanggal' => 'Rabu', 'jam_mulai' => '13:00', 'jam_selesai' => '15:00', 'ruang' => 'M-313', 'ket' => 'Review'],
    //     ],
    //     "Slamet, M.T, CCNA" => [
    //         ['tanggal' => 'Selasa', 'jam_mulai' => '10:00', 'jam_selesai' => '12:00', 'ruang' => 'M-314', 'ket' => 'Bimbingan'],
    //         ['tanggal' => 'Kamis', 'jam_mulai' => '15:00', 'jam_selesai' => '17:00', 'ruang' => 'M-315', 'ket' => 'Proposal'],
    //     ],
    //     "Dr. M.J. Dewiyani Sunarto" => [],
    //     // Tambahkan data dosen dan jadwal lainnya sesuai kebutuhan
    // ];


    private function jadwalBimbingan()
    {
        $response = Http::get('https://kpta84.dinamika.ac.id/18410100143/ppta/public/api/mhs/jadbim');
        return collect($response->json());
    }

    public function index()
    {
        $jadBim = $this->jadwalBimbingan();
        return view('mahasiswa.jadbimbingan', compact('jadBim'));
    }

    public function getJadwalDosen(Request $request)
    {
        $namaGelar = $request->query('dosen'); // Ambil nama lengkap dengan gelar dari query string

        // Ambil semua data jadwal bimbingan
        $jadwalBimbingan = $this->jadwalBimbingan();

        // Filter data berdasarkan nama_gelar
        $filteredSchedules = $jadwalBimbingan->where('nama_gelar', $namaGelar);

        return response()->json(['schedules' => $filteredSchedules->values()]);
    }
}
