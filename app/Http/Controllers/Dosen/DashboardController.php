<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public static function getAssessedData()
    {
        return [
            [
                'name' => 'John Doe',
                'score' => 85,
                'assessed_at' => '2024-03-15',
            ],
            [
                'name' => 'Jane Smith',
                'score' => 92,
                'assessed_at' => '2024-03-14',
            ],
            [
                'name' => 'Bob Johnson',
                'score' => 78,
                'assessed_at' => '2024-03-13',
            ],
            [
                'name' => 'Alice Brown',
                'score' => 95,
                'assessed_at' => '2024-03-12',
            ],
            [
                'name' => 'Charlie Davis',
                'score' => 88,
                'assessed_at' => '2024-03-11',
            ],
            [
                'name' => 'Eva Wilson',
                'score' => 91,
                'assessed_at' => '2024-03-10',
            ],
        ];
    }

    public static function getUnassessedData()
    {
        return [
            [
                'name' => 'Frank Miller',
                'created_at' => '2024-03-15',
            ],
            [
                'name' => 'Grace Lee',
                'created_at' => '2024-03-14',
            ],
            [
                'name' => 'Henry Taylor',
                'created_at' => '2024-03-13',
            ],
            [
                'name' => 'Ivy Chen',
                'created_at' => '2024-03-12',
            ],
            [
                'name' => 'Jack Robinson',
                'created_at' => '2024-03-11',
            ],
            [
                'name' => 'Karen White',
                'created_at' => '2024-03-10',
            ],
        ];
    }
    public function index()
    {
        $assessedData = $this->getAssessedData();
        $unassessedData = $this->getUnassessedData();

        return view('dosen.dashboard', [
            'assessedData' => array_slice($assessedData, 0, 5),
            'unassessedData' => array_slice($unassessedData, 0, 5),
            'assessedCount' => count($assessedData),
            'unassessedCount' => count($unassessedData),
        ])->with([
            'user' => 'dosen'
        ]);
    }
}
