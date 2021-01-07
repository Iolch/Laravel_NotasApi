<?php

namespace App\Services;


use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Models\Forum;

class ForumService
{
    public function __construct()
    {}  
    public function save(array $data) : Forum
    {
        $validator = Validator::make($data, $this->rules());
        
        if($validator->fails()){
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        // Would be better to move this elsewhere
        $forum = new Forum();
        $forum->user_id = $data['user_id'];
        $forum->title = $data['title'];
        if(array_key_exists('description', $data)){
            $forum->description = $data['description'];
        }
        $forum->save();
        return $forum;
        
    }

    public function update(array $data, Forum $forum): bool
    {
        $validator = Validator::make($data, $this->rules());
        
        if($validator->fails()){
            throw ValidationException::withMessages($validator->errors()->toArray());
        }
       
        return  $forum->update(Arr::except($data, ['id', 'user_id']));
    }

    public function delete(Forum $forum): bool
    {
        return  $forum->delete();
    }

    protected function rules(): array
    {
        return [
                'user_id' => 'required|exists:users,id',
                'title' => 'required',
        ];
    }

}
