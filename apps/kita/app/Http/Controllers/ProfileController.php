<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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
        return view('modals.modal_password_change');
    }

    public function passwordChange(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $member = Auth::user();

        if (! Hash::check($request->current_password, $member->password)) {
            throw ValidationException::withMessages([
                'current_password' => '現在のパスワードが正しくありません',
            ]);
        }

        $member->password = Hash::make($request->new_password);
        $member->save();

        return redirect()->route('profile.edit')->with('success', 'パスワードを更新しました');
    }
}
