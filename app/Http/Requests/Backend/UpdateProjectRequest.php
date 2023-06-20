<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:projects,slug,' . $this->route('project') . ',id'],
            'url' => ['required', 'url', 'max:255'],
            'image' => ['image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'short_description' => ['required'],
            'description' => ['required']
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => __('content.backend.projects.labels.name'),
            'slug' => __('content.backend.projects.labels.slug'),
            'url' => __('content.backend.projects.labels.url'),
            'image' => __('content.backend.projects.labels.slug'),
            'short_description' => __('content.backend.projects.labels.short_description'),
            'description' => __('content.backend.projects.labels.description')
        ];
    }
}
