<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    private $table = 'user';
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
        $id     = $this->id;
        $task   = 'add';

        $condAvatar   = '';
        $condUserName = '';
        $condEmail    = '';
        $condPassword = '';
        $condLevel    = '';
        $condStatus   = '';
        $condFullname = '';
        $condOldPassword = '';

        if(isset($this->taskChangePassword))  $task = 'change-password';
        if(isset($this->taskChangeLevel))  $task = 'change-level';
        if(isset($this->taskEditInfo))  $task = 'edit-info';
        if(isset($this->taskChangeLoggedPassword))  $task = 'change-logged-password';

        switch ($task) {
            case 'add':
                $condUserName   = "bail|required|between:5,100|unique:$this->table,username";
                $condEmail      = "bail|required|email|unique:$this->table,email";
                $condFullname   = 'bail|required|min:5';
                $condPassword   = 'bail|required|between:5,100|confirmed';
                $condStatus     = 'bail|in:active,inactive';
                $condLevel      = 'bail|in:admin,member';
                $condAvatar     = 'bail|required|image|max:500';
                break;
            case 'edit-info':
                $condUserName   = "bail|required|between:5,100|unique:$this->table,username,$id";
                $condFullname   = 'bail|required|min:5';
                $condAvatar     = 'bail|image|max:500';
                $condStatus     = 'bail|in:active,inactive';
                $condEmail      = "bail|required|email|unique:$this->table,email,$id";
                break;
            case 'change-password':
                $condPassword   = 'bail|required|between:5,100|confirmed';
                break;
            case 'change-level':
                $condLevel      = 'bail|in:admin,member';
                break;
            case 'change-logged-password':
                $condOldPassword = "bail|required|between:5,100";
                $condPassword    = 'bail|required|between:5,100|confirmed';
                break;
            default:
                break;
        }

        return [
            'username'      => $condUserName,
            'email'         => $condEmail,
            'fullname'      => $condFullname,
            'level'         => $condLevel,
            'status'        => $condStatus,
            'password'      => $condPassword,   
            'old_password'  => $condOldPassword,
            'avatar'        => $condAvatar
        ];
    }

    public function messages()
    {
        return [
            // 'name.required' => 'Name không được rỗng',
            // 'name.min' => 'Name :input chiều dài phải có ít nhất :min ký tự'
        ];
    }

    public function attributes()
{
    return [
        // 'description' => 'Field Description: '
    ];
}
}
