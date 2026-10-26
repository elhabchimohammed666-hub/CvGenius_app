<?php

namespace App\Http\Requests\Cv;

use App\Models\Cv;
use Illuminate\Validation\Rule;

class UpdateCvRequest extends StoreCvRequest
{
    public function authorize(): bool
    {
        $routeCv = $this->route('cv') ?? $this->route('id');
        $cvId = $routeCv instanceof Cv ? $routeCv->getKey() : $routeCv;

        return $this->user() !== null
            && (is_int($cvId) || is_string($cvId))
            && $this->user()->cvs()->whereKey($cvId)->exists();
    }

    public function rules(): array
    {
        $rules = parent::rules();
        $rules['title'] = ['sometimes', 'required', 'string', 'max:255'];
        $rules['public_slug'] = [
            'sometimes',
            'nullable',
            'string',
            'max:100',
            'alpha_dash',
            Rule::unique('cvs', 'public_slug')->ignore($this->route('cv') ?? $this->route('id')),
        ];

        return $rules;
    }
}
