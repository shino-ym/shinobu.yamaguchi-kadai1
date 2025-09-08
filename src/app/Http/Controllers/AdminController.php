<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Models\Admin;
use App\Http\Request\AdminRequest;

class AdminController extends Controller
{

        public function index(Request $request)
    {
    $query = Contact::with('category');

    // キーワード検索
    $keyword = $request->input('keyword');
    if (!empty($keyword)) {
        $query->where(function($q) use ($keyword) {
            $q->where('first_name', 'LIKE', "%{$keyword}%")
            ->orWhere('last_name', 'LIKE', "%{$keyword}%")
            ->orWhere('email', 'LIKE', "%{$keyword}%");
        });
    }
    // 性別検索
    if ($request->filled('gender')) {
        $query->where('gender', (int)$request->gender); // 数字にキャスト
    }
    // カテゴリ検索

    if ($request->filled('category_id')) {
    $query->where('category_id', (int)$request->category_id);
    }

    // 日付検索
    if ($request->filled('date')) {
    $query->whereDate('created_at', $request->input('date')); // 日付のみで検索
    }

    $contacts = $query->paginate(7)->withQueryString();

    // 性別のマスターデータ
    $genders = [
    1=> '男性',
    2=> '女性',
    3=> 'その他',
    ];

    $categories = Category::all();


    $params = $request->all();

    return view('admin', compact('contacts', 'categories', 'keyword','genders', 'params'));
    }

    public function destroy($id)
    {
    $contact = Contact::findOrFail($id); // IDでレコードを取得
    $contact->delete(); // 削除
    return redirect()->route('admin.index')->with('success', 'お問い合わせを削除しました。');
    }


    }

