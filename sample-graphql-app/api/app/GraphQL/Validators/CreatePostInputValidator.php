<?php

namespace App\GraphQL\Validators;

use Nuwave\Lighthouse\Validation\Validator;

final class CreatePostInputValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:20'],
            'content' => ['required', 'string', 'max:50'],
            'author_id' => ['required', 'integer', 'exists:users,id']
        ];
    }
}
