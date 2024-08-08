<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function edit()
    {
        $member = Auth::user();

        return view('profile.edit', compact('member'));
    }

    public function update(Request $request)
    {
        $member = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members,email,'.$member->id,
            // 必要に応じて追加のバリデーションルールを追加
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile.edit')
                ->withErrors($validator)
                ->withInput();
        }

        $member->name = $request->input('name');
        $member->email = $request->input('email');
        // 他のプロフィール情報を保存
        $member->save();

        return redirect()->route('profile.edit')->with('success', 'プロフィールを更新しました');
    }

    public function showPasswordChangeForm()
    {
        return view('profile.password_change');
    }
}
