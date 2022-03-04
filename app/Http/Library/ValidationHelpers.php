<?php 

namespace App\Http\Library;


trait ValidationHelpers
{

    /** validates add user form */
    protected function userValidatedRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
        ];
    }

    /** validates add category form */
    protected function categoryValidatedRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
        ];
    }

    /** validates add product form */
    protected function productValidatedRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'category_id' => ['required'],
            'tags' => ['required'],
            'picture' => ['required'],
        ];
    }

}