<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class UserRequest extends FormRequest
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
            //
            'name'=>'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,',
            'email'=>'required|email',
            'introduction'=>'max:80',
            'avatar'=>"mimes:jpeg,bmp,png,gi|dimensions:min_width:200,min_height:200",
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
     public function messages()
     {
       return [
         'avatar.dimensions'=>"图片清晰度不够，宽和高需要达到200px以上",
         'name.required'=>"用户名不能为空。",
         'name.between'=>'用户名应为3到25的字符。',
         'name.regex'=>'用户名只能为英文、数字、横杆和下划线。',
         'name.unique'=>'用户名必须唯一。',
       ];
     }

}
