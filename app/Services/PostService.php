<?php

namespace App\Services;


use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;

class PostService
{
    public function __construct()
    {}  
    public function save(array $data) : Post
    {
        $validator = Validator::make($data, $this->rules());
        
        if($validator->fails()){
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        // Would be better to move this elsewhere
        $post = new Post();
        $post->user_id = $data['user_id'];
        $post->forum_id = $data['forum_id'];
        $post->content = $data['content'];
        $post->save();
        return $post;
        
    }

    public function update(array $data, Post $post): bool
    {
        $validator = Validator::make($data, $this->rules());
        
        if($validator->fails()){
            throw ValidationException::withMessages($validator->errors()->toArray());
        }
       
        return  $post->update(Arr::except($data, ['id', 'user_id', 'forum_id']));
    }

    public function delete(Post $post): bool
    {
        return  $post->delete();
    }

    protected function rules(): array
    {
        return [
                'user_id' => 'required|exists:users,id',
                'forum_id' => 'required|exists:forums,id',
                'content' => 'required',
        ];
    }

}
