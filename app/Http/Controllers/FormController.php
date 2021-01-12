<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class FormController extends Controller
{
    public function postValidates(Request $request)
    {
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|max:255|email|unique:users,email',
        'subject' => ['required|max:255'],
    ];)

    // 記述方法：Validator::make('値の配列', '検証ルールの配列');

    if ($validator->fails()) {
        return redirect('/form_js')
        ->withErrors($validator)
        ->withInput();
    } 

    // 記述方法：if($validator->fails()) {失敗時の処理} else {成功時の処理}
    }
}
