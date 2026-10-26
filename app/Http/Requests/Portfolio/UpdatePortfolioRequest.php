<?php

namespace App\Http\Requests\Portfolio;

use App\Models\Portfolio;
use Illuminate\Validation\Rule;

class UpdatePortfolioRequest extends StorePortfolioRequest
{
    public function authorize(): bool
    {
        $routePortfolio = $this->route('portfolio') ?? $this->route('id');
        $portfolioId = $routePortfolio instanceof Portfolio ? $routePortfolio->getKey() : $routePortfolio;

        return $this->user() !== null
            && (is_int($portfolioId) || is_string($portfolioId))
            && $this->user()->portfolios()->whereKey($portfolioId)->exists();
    }

    public function rules(): array
    {
        $rules = parent::rules();
        $rules['title'] = ['sometimes', 'required', 'string', 'max:255'];
        $rules['slug'] = [
            'sometimes',
            'required',
            'string',
            'max:100',
            'alpha_dash',
            Rule::unique('portfolios', 'slug')->ignore($this->route('portfolio') ?? $this->route('id')),
        ];
        $rules['custom_domain'] = [
            'sometimes',
            'nullable',
            'string',
            'max:255',
            Rule::unique('portfolios', 'custom_domain')->ignore($this->route('portfolio') ?? $this->route('id')),
        ];

        return $rules;
    }
}
