<?php

namespace App\Http\Requests\Portfolio;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePortfolioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return array_merge([
            'title' => ['required', 'string', 'max:255'],
            'template_id' => ['sometimes', 'nullable', Rule::exists('templates', 'id')->where('type', 'portfolio')],
            'theme' => ['sometimes', 'nullable', 'array'],
            'theme.*' => ['string', 'max:100'],
            'slug' => ['required', 'string', 'max:100', 'alpha_dash', 'unique:portfolios,slug'],
            'custom_domain' => ['sometimes', 'nullable', 'string', 'max:255', 'unique:portfolios,custom_domain'],
            'bio' => ['sometimes', 'nullable', 'string', 'max:10000'],
            'is_published' => ['sometimes', 'boolean'],
            'personal_info' => ['sometimes', 'array:full_name,job_title,email,phone,address,website,linkedin,github,summary'],
            'personal_info.full_name' => ['required_with:personal_info', 'string', 'max:255'],
            'personal_info.job_title' => ['sometimes', 'nullable', 'string', 'max:255'],
            'personal_info.email' => ['sometimes', 'nullable', 'email:rfc', 'max:255'],
            'personal_info.phone' => ['sometimes', 'nullable', 'string', 'max:50'],
            'personal_info.address' => ['sometimes', 'nullable', 'string', 'max:255'],
            'personal_info.website' => ['sometimes', 'nullable', 'url', 'max:2048'],
            'personal_info.linkedin' => ['sometimes', 'nullable', 'url', 'max:2048'],
            'personal_info.github' => ['sometimes', 'nullable', 'url', 'max:2048'],
            'personal_info.summary' => ['sometimes', 'nullable', 'string', 'max:10000'],
            'experiences' => ['sometimes', 'array', 'max:50'],
            'experiences.*' => ['required', 'array:company,position,location,start_date,end_date,is_current,description'],
            'experiences.*.company' => ['required', 'string', 'max:255'],
            'experiences.*.position' => ['required', 'string', 'max:255'],
            'experiences.*.location' => ['sometimes', 'nullable', 'string', 'max:255'],
            'experiences.*.start_date' => ['required', 'date'],
            'experiences.*.end_date' => ['sometimes', 'nullable', 'date'],
            'experiences.*.is_current' => ['sometimes', 'boolean'],
            'experiences.*.description' => ['sometimes', 'nullable', 'string', 'max:10000'],
            'educations' => ['sometimes', 'array', 'max:50'],
            'educations.*' => ['required', 'array:institution,degree,field_of_study,start_date,end_date,description'],
            'educations.*.institution' => ['required', 'string', 'max:255'],
            'educations.*.degree' => ['required', 'string', 'max:255'],
            'educations.*.field_of_study' => ['sometimes', 'nullable', 'string', 'max:255'],
            'educations.*.start_date' => ['sometimes', 'nullable', 'date'],
            'educations.*.end_date' => ['sometimes', 'nullable', 'date'],
            'educations.*.description' => ['sometimes', 'nullable', 'string', 'max:10000'],
            'skills' => ['sometimes', 'array', 'max:100'],
            'skills.*' => ['required', 'array:name,category,level'],
            'skills.*.name' => ['required', 'string', 'max:100'],
            'skills.*.category' => ['sometimes', 'nullable', 'string', 'max:100'],
            'skills.*.level' => ['sometimes', 'nullable', 'integer', 'between:1,5'],
            'projects' => ['sometimes', 'array', 'max:50'],
            'projects.*' => ['required', 'array:title,description,image_url,project_url,github_url,technologies'],
            'projects.*.title' => ['required', 'string', 'max:255'],
            'projects.*.description' => ['sometimes', 'nullable', 'string', 'max:10000'],
            'projects.*.image_url' => ['sometimes', 'nullable', 'url', 'max:2048'],
            'projects.*.project_url' => ['sometimes', 'nullable', 'url', 'max:2048'],
            'projects.*.github_url' => ['sometimes', 'nullable', 'url', 'max:2048'],
            'projects.*.technologies' => ['sometimes', 'array', 'max:30'],
            'projects.*.technologies.*' => ['string', 'max:100'],
        ]);
    }
}
