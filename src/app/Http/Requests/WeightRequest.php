<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeightRequest extends FormRequest
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
            //バリデーションのルール
            'user_id' => 'required|exits:users,id',
            'target_weight' => ['required', 'numeric', 'regex:/^\d{1,4}(\.\d{1})?$/'],
            'weight' => ['required', 'numeric', 'regex:/^\d{1,4}(\.\d{1})?$/'],
        ];
    }

    //エラーメッセージの日本語化
    public function messages()
    {
        return [
            'target_weight.required' => '目標の体重を入力してください',
            'target_weight.numeric' => '4桁までの数字で入力してください',
            'target_weight.regex' => '小数点は1桁で入力してください',
            'weight.required' => '目標の体重を入力してください',
            'weight.numeric' => '4桁までの数字で入力してください',
            'weight.regex' => '小数点は1桁で入力してください',

        ];
    }
}
