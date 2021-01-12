<?php

namespace App\Http\Requests;

class AjaxRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:posts|max:255',
            'email' => 'required|email',
            'subject' => 'required|unique:posts|max:255'
        ];
    }

    public function attributes()
    {
        return [
            'email'          => 'メールアドレス',
            'password'       => 'パスワード',
            'lastname'       => '姓',
            'firstname'      => '名',
            'lastname_kana'  => 'セイ',
            'firstname_kana' => 'メイ',
            'gender'         => '性別',
        ];
    }
   
}
