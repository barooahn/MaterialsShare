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
            'target_language' => 'max:200',
            'time_needed_prep' => 'numeric|max:200',
            'time_needed_class' => 'numeric|max:200',
            'materials' => '',
            'procedure_before' => '',
            'procedure_in' => '',
            'activity_use' => 'array|max:55',
            'pupil_task' => 'array|max:55',
            'images' => 'array|min:1',
            'category_list' => 'array|min:1',
            'level' => 'array|max:55',
            'language_focus' => 'array|max:55',
            'book' => 'array|max:155',
            'page' => 'sometimes|numeric|required|max:1000',
            'follow_up' => '',
            'variations' => '',
            'tips' => '',
            'notes' => '',
        ];

        $numEmails = count($this->get('upload_files'));
        foreach (range(0, $numEmails) as $index) {
            $rules['upload_files.' . $index] = 'max:60000|mimes:png,gif,jpg,jpeg,txt,pdf,doc,docx,mp4,avi,mov,ogg,qt,ppt,pptx,wmv,mp3,mpga';
        }

        $numEmails = count($this->request->get('category_list'));
        foreach (range(0, $numEmails) as $index) {
            $rules['category_list' . $index] = 'max:55';
        }

        $numEmails = count($this->get('level'));
        foreach (range(0, $numEmails) as $index) {
            $rules['level' . $index] = 'max:55';
        }

        $numEmails = count($this->get('language_focus'));
        foreach (range(0, $numEmails) as $index) {
            $rules['language_focus' . $index] = 'max:55';
        }

        $numEmails = count($this->get('activityUses'));
        foreach (range(0, $numEmails) as $index) {
            $rules['activityUses' . $index] = 'max:55';
        }

        $numEmails = count($this->get('pupilTasks'));
        foreach (range(0, $numEmails) as $index) {
            $rules['pupilTasks' . $index] = 'max:55';
        }

        return $rules;
    }
}