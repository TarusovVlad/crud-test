<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'content' => 'required',
        ];
    }

    /**
     * @return string
     */
    public function getPostTitle(): string
    {
        return $this->get('title');
    }

    /**
     * @return string
     */
    public function getPostContent(): string
    {
        return $this->get('content');
    }
}
