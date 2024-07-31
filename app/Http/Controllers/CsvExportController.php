<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class CsvExportController extends Controller
{
    public function exportUser()
    {
        $fileName = 'users_' . Carbon::now()->format('Ymd') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];

        $callback = function() {
            // UTF-8 BOMを追加
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // CSVヘッダーの書き込み
            fputcsv($file, ['ID', 'Name', 'Email', 'Created At']);

            // ユーザーデータの取得
            $users = User::all();

            // ユーザーデータの書き込み
            foreach ($users as $user) {
                fputcsv($file, [$user->id, $user->name, $user->email, $user->created_at]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

}
