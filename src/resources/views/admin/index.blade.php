<form action="{{ route('admin.contacts.index') }}" method="get">
    <input type="text" name="keyword" placeholder="名前やメール" value="{{ request('keyword') }}">
    <select name="gender">
        <option value="">性別</option>
        <option value="1" {{ request('gender') == 1 ? 'selected' : '' }}>男性</option>
        <option value="2" {{ request('gender') == 2 ? 'selected' : '' }}>女性</option>
        <option value="3" {{ request('gender') == 3 ? 'selected' : '' }}>その他</option>
    </select>
    <select name="category_id">
        <option value="">お問い合わせ種類</option>
        @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->content }}
        </option>
        @endforeach
    </select>
    <input type="date" name="date_from" value="{{ request('date_from') }}">
    <input type="date" name="date_to" value="{{ request('date_to') }}">
    <button type="submit">検索</button>
</form>
