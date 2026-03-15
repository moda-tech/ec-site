<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //管理者側 ユーザー一覧
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(30);

        return view('admin.users.index', compact('users'));
    }

    //管理者側 ユーザー編集
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    //管理者側 ユーザー編集 更新
    public function update(Request $request, $id)
    {
        // 対象ユーザー取得
        $user = User::findOrFail($id);

        // バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // 更新
        $user->update($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'ユーザー情報を更新しました');
    }

    //管理者側 ユーザー削除
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'ユーザーを削除しました');
    }
}
