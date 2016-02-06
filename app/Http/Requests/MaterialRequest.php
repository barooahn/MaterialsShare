<?php

namespace App\Http\Requests;

class MaterialRequest extends Request
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
        $rules = [
            'title' => 'sometimes|required|unique:materials|max:255',
            'objective' => 'sometimes|required',
            'target_language' => 'sometimes|required|max:200',
            'time_needed_prep' => 'sometimes|required|numeric|max:200',
            'time_needed_class' => 'sometimes|required|numeric|max:200',
            'materials' => 'sometimes|required',
            'procedure_before' => 'sometimes|required',
            'procedure_in' => 'sometimes|required',
            'activity_use' => 'sometimes|required|array|max:55',
            'pupil_task' => 'sometimes|required|array|max:55',
            'images' => 'sometimes|required|array|min:1',
            'category_list' => 'sometimes|required|array|min:1',
            'level' => 'sometimes|required|array|max:55',
            'language_focus' => 'sometimes|required|array|max:55',
            'book' => 'sometimes|required|array|max:155',
            'page' => 'sometimes|numeric|required|max:1000',
            'follow_up' => 'sometimes|required',
            'variations' => 'sometimes|required',
            'tips' => 'sometimes|required',
            'notes' => 'sometimes|required',
        ];

        if (null !== ($this->input('category_list'))) {
            $rules['category_list'] = 'required';
        }

        return $rules;
    }
}