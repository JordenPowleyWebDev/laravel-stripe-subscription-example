<?php

namespace App\Http\Requests\Admin\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

/**
 * Class UpdateUserRequest
 * @package App\Http\Requests\Admin\Management
 */
class UpdateUserRequest extends FormRequest
{
    /**
     * UpdateUserRequest::authorize()
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * UpdateUserRequest::rules()
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request): array
    {
        /** @var User $user */
        $user = $request->user;

        return [
            'first_name' => [
                'required',
                'string',
                'max:255',
            ],
            'last_name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email,'.$user->id,
                'max:255',
            ],
            'role' => [
                'required',
                'numeric',
                'exists:roles,id'
            ],
            'password' => array_merge(
                PasswordRules::optionallyChangePassword($this->input('email')),
                [
                    'confirmed',
                ]
            ),
        ];
    }
}
