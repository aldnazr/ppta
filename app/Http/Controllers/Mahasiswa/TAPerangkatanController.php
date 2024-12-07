<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TAPerangkatanController extends Controller
{
    private $data = [
        'Sistem Informasi' => [
            '2021' => [
                [
                    'judul' => 'Penerapan Gamifikasi pada Aplikasi Pencucian Mobil Kenzou Drive Thru Car Wash',
                    'nama' => 'Muhammad Afriza Hanif',
                    'nim' => '21410100013',
                    'pembimbing_1' => 'Endra Rahmawati, M.Kom.',
                    'pembimbing_2' => 'Ayuningtyas, S.Kom., M.MT, MOS'
                ],
            ],
            '2020' => [
                [
                    'judul' => 'Penerapan Gamifikasi pada Aplikasi Pencucian Mobil Kenzou Drive Thru Car Wash',
                    'nama' => 'Erick Winata',
                    'nim' => '20410100005',
                    'pembimbing_1' => 'Ayuningtyas, S.Kom., M.MT, MOS',
                    'pembimbing_2' => 'Ayouvi Poerna Wardhanie, S.M.B., M.M.'
                ],
                [
                    'judul' => 'Analisis dan Perancangan Desain Antarmuka Website Sertifikasi PT. Development Power Indonesia Menggunakan Metode Double Diamond',
                    'nama' => 'Reynalda Vonna Syalwa',
                    'nim' => '20410100006',
                    'pembimbing_1' => 'Ayouvi Poerna Wardhanie, S.M.B., M.M.',
                    'pembimbing_2' => 'Tri Sagirani, S.Kom., M.MT.'
                ],
                [
                    'judul' => 'RANCANG BANGUN APLIKASI PEMESANAN KUE ONLINE PADA TOKO KUE DREAM DESSERT',
                    'nama' => 'Reynaldi Rizky Pratama',
                    'nim' => '20410100009',
                    'pembimbing_1' => 'Teguh Sutanto, M.Kom., MCP',
                    'pembimbing_2' => 'Endra Rahmawati, M.Kom.'
                ],
                [
                    'judul' => 'Pengembangan Aplikasi Monitoring Jasa Layanan Notaris pada Notaris Nur Afil, SH, MH',
                    'nama' => 'Amiroh Adillia',
                    'nim' => '20410100015',
                    'pembimbing_1' => 'Tri Sagirani, S.Kom., M.MT.',
                    'pembimbing_2' => 'Vivine Nurcahyawati, M.Kom, OCP'
                ],
                [
                    'judul' => 'Rancang Bangun Aplikasi Pengendalian Persediaan Kosmetik Menggunakan Metode ROP Dan EOQ Pada Toko Tara Surabaya',
                    'nama' => 'Putri Nurhaliza Rahman',
                    'nim' => '20410100019',
                    'pembimbing_1' => 'Sulistiowati, S.Si., M.M.',
                    'pembimbing_2' => 'Ir. Henry Bambang Setyawan, M.M.'
                ],
            ],
            '2019' => [
                [
                    'judul' => 'Perancangan Desain UI/UX Website Fumigasi untuk Meningkatkan Customer Experience pada PT. Prana Argentum Corporation',
                    'nama' => 'Faisal Maulana Akbar',
                    'nim' => '19410100039',
                    'pembimbing_1' => 'Ayouvi Poerna Wardhanie, S.M.B., M.M.',
                    'pembimbing_2' => 'Tan Amelia, S.Kom., M.MT., MCP'
                ],
                [
                    'judul' => 'Rekomendasi Desain User Interface berdasarkan Hasil Analisis Pengaruh Faktor Minat terhadap Penggunaan Aplikasi Seabank menggunakan Model UTAUT2',
                    'nama' => 'Shavira Khofifah Azka',
                    'nim' => '19410100041',
                    'pembimbing_1' => 'Sulistiowati, S.Si., M.M.',
                    'pembimbing_2' => 'Ir. Henry Bambang Setyawan, M.M.'
                ],
                [
                    'judul' => 'Sistem Informasi Persediaan Alat Kesehatan menggunakan Metode Fifo dan Min-Max pada Website PT. Dakonan Mas',
                    'nama' => 'Ichsan Ghaniy Rosyidi',
                    'nim' => '19410100044',
                    'pembimbing_1' => 'Dr. M.J. Dewiyani Sunarto',
                    'pembimbing_2' => 'Tony Soebijono, S.E., S.H., M.Ak.'
                ],
                [
                    'judul' => 'Perancangan UI/UX Website Laksmi Muslimah menggunakan Metode Design Thinking untuk Memudahkan Transaksi Klien Memilih Paket Pernikahan',
                    'nama' => 'Adelia Nurokiaviany Wisan Putri',
                    'nim' => '19410100045',
                    'pembimbing_1' => 'Tri Sagirani, S.Kom., M.MT.',
                    'pembimbing_2' => 'Dr. Anjik Sukmaaji, S.Kom., M.Eng.'
                ],
                [
                    'judul' => 'Rancang Bangun Aplikasi Pengendalian Persediaan Spare Part pada Bengkel Aufa Motor menggunakan Metode Min Max',
                    'nama' => 'Slamet Purdopo',
                    'nim' => '19410100047',
                    'pembimbing_1' => 'Sulistiowati, S.Si., M.M.',
                    'pembimbing_2' => 'Endra Rahmawati, M.Kom.'
                ]
            ],
            '2018' => [
                [
                    'judul' => 'Penerapan Gamifikasi pada Aplikasi Pencucian Mobil Kenzou Drive Thru Car Wash',
                    'nama' => 'Erick Winata',
                    'nim' => '20410100005',
                    'pembimbing_1' => 'Ayuningtyas, S.Kom., M.MT, MOS',
                    'pembimbing_2' => 'Ayouvi Poerna Wardhanie, S.M.B., M.M.'
                ],
                [
                    'judul' => 'Penerapan Algoritma Content-Based Filtering untuk Rekomendasi Destinasi Wisata pada Aplikasi Picnicker',
                    'nama' => 'Aprianto',
                    'nim' => '18410100002',
                    'pembimbing_1' => 'Julianto Lemantara, S.Kom., M.Eng, OCA., MCTS',
                    'pembimbing_2' => 'Tri Sagirani, S.Kom., M.MT.'
                ],
                [
                    'judul' => 'Peran Perceived Usability, Satisfaction, dan Customer Trust dalam Merancang dan Mengembangkan Loyalitas Pengguna Website Edutech',
                    'nama' => 'Michael Vinsent Djulianto',
                    'nim' => '18410100003',
                    'pembimbing_1' => 'Ayouvi Poerna Wardhanie, S.M.B., M.M.',
                    'pembimbing_2' => 'Candraningrat, S.E., M.SM.'
                ],
                [
                    'judul' => 'Analisis dan Perancangan User Interface dan User Experience pada Startup Picnicker dengan Pendekatan User Persona Berbasis Design Thinking',
                    'nama' => 'Reva Eka Prasetyo',
                    'nim' => '18410100004',
                    'pembimbing_1' => 'Tan Amelia, S.Kom., M.MT., MCP',
                    'pembimbing_2' => 'Julianto Lemantara, S.Kom., M.Eng, OCA., MCTS'
                ],
                [
                    'judul' => 'Rancang Bangun Sistem Pendukung Keputusan Penentuan Jumlah Pengadaan Stok Bahan Baku dengan Metode Fuzzy Sugeno pada UMKM Pembawa Kopi',
                    'nama' => 'Abyan Akbar Indroyono',
                    'nim' => '18410100005',
                    'pembimbing_1' => 'Agus Dwi Churniawan, S.Si., M.Kom.',
                    'pembimbing_2' => 'Vivine Nurcahyawati, M.Kom, OCP'
                ],
                [
                    'judul' => 'Perancangan Strategi Digital Marketing melalui Instagram dan Tiktok dengan Metode Sostac guna Meningkatkan Jumlah Marchant yang Bergabung pada Startup Picnicker',
                    'nama' => 'Indana Nazulfa',
                    'nim' => '18410100006',
                    'pembimbing_1' => 'Sri Hariani Eko Wulandari, S.Kom., M.MT.',
                    'pembimbing_2' => 'Rudi Santoso, S.Sos., M.M.'
                ]
            ],
            '2017' => [
                [
                    'judul' => 'Sistem Informasi Smart RT/RW menggunakan Metode Statistik Deskriptif Berbasis Website pada Perumahan Pakal Residence Surabaya',
                    'nama' => 'Arif Prasetiyo Utomo',
                    'nim' => '17410100001',
                    'pembimbing_1' => 'Dr. Anjik Sukmaaji, S.Kom., M.Eng.',
                    'pembimbing_2' => 'Agus Dwi Churniawan, S.Si., M.Kom.'
                ],
                [
                    'judul' => 'Sistem Pendukung Keputusan Pemilihan Laptop dengan Metode AHP (Studi Kasus pada CV Maju Bersama)',
                    'nama' => 'Noel Nicolaz Godzallez',
                    'nim' => '17410100002',
                    'pembimbing_1' => 'Sulistiowati, S.Si., M.M.',
                    'pembimbing_2' => 'Tony Soebijono, S.E., S.H., M.Ak.'
                ],
                [
                    'judul' => 'RANCANG BANGUN APLIKASI PENGENDALIAN STOK ATK DAN ALAT KEBERSIHAN MENGGUNAKAN METODE REORDER POINT BERBASIS WEB PADA CV. AMIIN NUGERAHA',
                    'nama' => 'Achmad Lukman Hakim',
                    'nim' => '17410100004',
                    'pembimbing_1' => 'Agus Dwi Churniawan, S.Si., M.Kom.',
                    'pembimbing_2' => 'Vivine Nurcahyawati, M.Kom, OCP'
                ],
                [
                    'judul' => 'Analisis dan Desain Sistem E-Commerce Penjualan Produk Kecantikan pada CV E-Smart B',
                    'nama' => 'Dwiky Rachman Hidayat',
                    'nim' => '17410100009',
                    'pembimbing_1' => 'Dr. Anjik Sukmaaji, S.Kom., M.Eng.',
                    'pembimbing_2' => 'Sri Hariani Eko Wulandari, S.Kom., M.MT.'
                ],
                [
                    'judul' => 'Analisis dan Perancangan User Interface Aplikasi Transaksi Pemesanan dan Pemasaran pada Kunokini Cafe & Resto Berbasis User Centered Design (UCD)',
                    'nama' => 'Heryawan Wisnuyana',
                    'nim' => '17410100010',
                    'pembimbing_1' => 'Sulistiowati, S.Si., M.M.',
                    'pembimbing_2' => 'Nunuk Wahyuningtyas, M.Kom, OCJA'  // Data pembimbing 2 tidak terlihat di gambar
                ]
            ]
        ],
        'Teknik Komputer' => [
            '2021' => [
                [
                    'judul' => 'Penerapan Algoritma Pencarian pada Sistem Rekomendasi',
                    'nama' => 'Budi Santoso',
                    'nim' => '20410200001',
                    'pembimbing_1' => 'Dr. Suharjito, S.Kom., M.Kom.',
                    'pembimbing_2' => 'Dra. Sri Wahyuni, S.Kom., M.M.'
                ],
                [
                    'judul' => 'Perancangan Sistem Keamanan Jaringan pada PT. XYZ',
                    'nama' => 'Andi Setiawan',
                    'nim' => '20410200002',
                    'pembimbing_1' => 'Teguh Sutanto, M.Kom., MCP',
                    'pembimbing_2' => 'Endra Rahmawati, M.Kom.'
                ]
            ],
            '2020' => [
                [
                    'judul' => 'Analisis Kinerja Sistem Operasi Linux',
                    'nama' => 'Rahmat Budi',
                    'nim' => '20410200003',
                    'pembimbing_1' => 'Dr. Suharjito, S.Kom., M.Kom.',
                    'pembimbing_2' => 'Dra. Sri Wahyuni, S.Kom., M.M.'
                ],
                [
                    'judul' => 'Pengembangan Aplikasi Monitoring Kesehatan',
                    'nama' => 'Dewi Nurhayati',
                    'nim' => '20410200004',
                    'pembimbing_1' => 'Teguh Sutanto, M.Kom., MCP',
                    'pembimbing_2' => 'Endra Rahmawati, M.Kom.'
                ]
            ]
        ],

        'Desain Komunikasi Visual' => [
            '2021' => [
                [
                    'judul' => 'Perancangan Identitas Visual Perusahaan',
                    'nama' => 'Ayuningtyas',
                    'nim' => '20410300001',
                    'pembimbing_1' => 'Dra. Ani Setianingsih, S.Sn., M.Ds.',
                    'pembimbing_2' => 'Drs. Bambang Supriyanto, M.Sn.'
                ],
                [
                    'judul' => 'Desain Komunikasi Visual untuk Media Sosial',
                    'nama' => 'Bimo Prasetyo',
                    'nim' => '20410300002',
                    'pembimbing_1' => 'Dra. Ani Setianingsih, S.Sn., M.Ds.',
                    'pembimbing_2' => 'Drs. Bambang Supriyanto, M.Sn.'
                ]
            ],
            '2020' => [
                [
                    'judul' => 'Analisis Efektivitas Desain Iklan',
                    'nama' => 'Candra Kirana',
                    'nim' => '20410300003',
                    'pembimbing_1' => 'Dra. Ani Setianingsih, S.Sn., M.Ds.',
                    'pembimbing_2' => 'Drs. Bambang Supriyanto, M.Sn.'
                ],
                [
                    'judul' => 'Perancangan Brosur Wisata',
                    'nama' => 'Dina Wahyuni',
                    'nim' => '20410300004',
                    'pembimbing_1' => 'Dra. Ani Setianingsih, S.Sn., M.Ds.',
                    'pembimbing_2' => 'Drs. Bambang Supriyanto, M.Sn.'
                ]
            ]
        ],

        'Desain Produk' => [
            '2021' => [
                [
                    'judul' => 'Perancangan Produk Mebel Minimalis',
                    'nama' => 'Eko Sulistiyanto',
                    'nim' => '20410400001',
                    'pembimbing_1' => 'Drs. Sugeng Priyanto, S.Pd., M.Sn.',
                    'pembimbing_2' => 'Dra. Sri Mulyani, S.Sn., M.Ds.'
                ],
                [
                    'judul' => 'Desain Produk Kemasan Makanan',
                    'nama' => 'Fajar Setiawan',
                    'nim' => '20410400002',
                    'pembimbing_1' => 'Drs. Sugeng Priyanto, S.Pd., M.Sn.',
                    'pembimbing_2' => 'Dra. Sri Mulyani, S.Sn., M.Ds.'
                ]
            ],
            '2020' => [
                [
                    'judul' => 'Analisis Material Produk Ramah Lingkungan',
                    'nama' => 'Galuh Widyastuti',
                    'nim' => '20410400003',
                    'pembimbing_1' => 'Drs. Sugeng Priyanto, S.Pd., M.Sn.',
                    'pembimbing_2' => 'Dra. Sri Mulyani, S.Sn., M.Ds.'
                ],
                [
                    'judul' => 'Perancangan Produk Furniture Ergonomis',
                    'nama' => 'Hariyanto',
                    'nim' => '20410400004',
                    'pembimbing_1' => 'Drs. Sugeng Priyanto, S.Pd., M.Sn.',
                    'pembimbing_2' => 'Dra. Sri Mulyani, S.Sn., M.Ds.'
                ]
            ]
        ],

        'Manajemen' => [
            '2021' => [
                [
                    'judul' => 'Analisis Strategi Pemasaran Produk Baru',
                    'nama' => 'Indah Wahyuni',
                    'nim' => '20410500001',
                    'pembimbing_1' => 'Dr. Agus Mulyanto, S.E., M.M.',
                    'pembimbing_2' => 'Dra. Rini Setiawati, S.E., M.M.'
                ],
                [
                    'judul' => 'Perancangan Sistem Manajemen Sumber Daya Manusia',
                    'nama' => 'Joko Supriyanto',
                    'nim' => '20410500002',
                    'pembimbing_1' => 'Dr. Agus Mulyanto, S.E., M.M.',
                    'pembimbing_2' => 'Dra. Rini Setiawati, S.E., M.M.'
                ]
            ],
            '2020' => [
                [
                    'judul' => 'Analisis Kinerja Keuangan Perusahaan',
                    'nama' => 'Kurniawan',
                    'nim' => '20410500003',
                    'pembimbing_1' => 'Dr. Agus Mulyanto, S.E., M.M.',
                    'pembimbing_2' => 'Dra. Rini Setiawati, S.E., M.M.'
                ],
                [
                    'judul' => 'Perancangan Sistem Manajemen Rantai Pasok',
                    'nama' => 'Lestari',
                    'nim' => '20410500004',
                    'pembimbing_1' => 'Dr. Agus Mulyanto, S.E., M.M.',
                    'pembimbing_2' => 'Dra. Rini Setiawati, S.E., M.M.'
                ]
            ]
        ],
        'Akuntansi' => [
            '2021' => [
                [
                    'judul' => 'Perancangan Sistem Akuntansi Manajemen',
                    'nama' => 'Nurhayati',
                    'nim' => '20410600002',
                    'pembimbing_1' => 'Dr. Sri Wahyuni, S.E., M.Ak.',
                    'pembimbing_2' => 'Dra. Ani Setianingsih, S.E., M.Ak.'
                ],
                [
                    'judul' => 'Analisis Pengaruh Pajak Terhadap Kinerja Keuangan Perusahaan',
                    'nama' => 'Oktaviana',
                    'nim' => '20410600003',
                    'pembimbing_1' => 'Dr. Sri Wahyuni, S.E., M.Ak.',
                    'pembimbing_2' => 'Dra. Ani Setianingsih, S.E., M.Ak.'
                ]
            ],
            '2020' => [
                [
                    'judul' => 'Pengaruh Kualitas Laba Terhadap Harga Saham',
                    'nama' => 'Putri Wahyuni',
                    'nim' => '20410600004',
                    'pembimbing_1' => 'Dr. Sri Wahyuni, S.E., M.Ak.',
                    'pembimbing_2' => 'Dra. Ani Setianingsih, S.E., M.Ak.'
                ],
                [
                    'judul' => 'Analisis Faktor-Faktor yang Mempengaruhi Kualitas Audit',
                    'nama' => 'Rahmat Budi',
                    'nim' => '20410600005',
                    'pembimbing_1' => 'Dr. Sri Wahyuni, S.E., M.Ak.',
                    'pembimbing_2' => 'Dra. Ani Setianingsih, S.E., M.Ak.'
                ]
            ]
        ]
    ];

    public function index(Request $request)
    {
        $activeJurusan = $request->query('jurusan', 'Sistem Informasi');
        $jurusan = array_keys($this->data);
        $angkatan = $this->data[$activeJurusan];
        $totalData = array_sum(array_map('count', $angkatan));

        return view('mahasiswa.taperangkatan', compact(
            'jurusan',
            'angkatan',
            'totalData',
            'activeJurusan'
        ));
    }

    public function getByJurusan(Request $request)
    {
        $jurusan = $request->jurusan;
        $data = $this->data[$jurusan];

        return response()->json([
            'data' => $data
        ]);
    }
}
