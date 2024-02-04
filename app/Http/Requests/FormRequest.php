<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
  public function rules(): array
  {
    // バリデーションルールを定義
    return [
        'name' => 'required|string|max:255',
        'uni_num' => 'required|numeric', // 入力必須で、半角数字のみ許可
        'club' => 'required|string', // 入力必須で、文字列のみ許可
        'height' => 'required|numeric', // 入力必須で、半角数字のみ許可
        'weight' => 'required|numeric',
    ];
  }
}