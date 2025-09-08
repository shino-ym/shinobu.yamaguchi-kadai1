<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Response;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        // まず、クエリ作成
        $query = Contact::with('category');

        // キーワード検索
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('first_name', 'LIKE', "%{$keyword}%")
                  ->orWhere('last_name', 'LIKE', "%{$keyword}%")
                  ->orWhere('email', 'LIKE', "%{$keyword}%");
            });
        }

        // 性別検索
        if ($request->filled('gender')) {
            $query->where('gender', (int)$request->gender);
        }

        // カテゴリ検索
        if ($request->filled('category_id')) {
            $query->where('category_id', (int)$request->category_id);
        }

        // 日付検索
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // 絞り込み結果を取得（条件なしなら全件）
        $contacts = $query->get();

        // 性別表示用
        $genders = [
            1 => '男性',
            2 => '女性',
            3 => 'その他'
        ];

        // 一時的なストリームを作成
        $csvContent = fopen('php://temp', 'r+');

        // ヘッダー行
        fputcsv($csvContent, ['ID', '姓', '名', '性別', 'メール', '電話', '住所', '建物名', 'お問い合わせの種類', 'お問い合わせ内容']);

        // データ行
        foreach ($contacts as $contact) {
            fputcsv($csvContent, [
                $contact->id,
                $contact->last_name,
                $contact->first_name,
                $genders[$contact->gender] ?? '不明',
                $contact->email,
                $contact->tel,
                $contact->address,
                $contact->building,
                $contact->category->content ?? '未分類',
                $contact->detail
            ]);
        }

        // ストリームの先頭に戻す
        rewind($csvContent);

        // データを読み込む
        $csvData = stream_get_contents($csvContent);

        // Shift-JIS に変換（Excel対応）
        $sjisData = mb_convert_encoding($csvData, 'SJIS-win', 'UTF-8');

        // ストリームを閉じる
        fclose($csvContent);

        // CSVファイルをダウンロード
        return Response::make($sjisData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ]);
    }
}
