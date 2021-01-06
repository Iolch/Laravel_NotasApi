<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserService
{
    public function __construct()
    {}  
    public function save(array $data) : User
    {
        $validator = Validator::make($data, $this->rules());
        
        if($validator->fails()){
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        // Would be better to move this elsewhere
        $user = new User();
        $user->spotify_id = $data['spotify_id'];
        $user->save();
        return $user;
        
    }
    // public function update(Setting $settings, array $data) : Setting
    // {
        
    //     $validator = Validator::make($data, $this->rules());
        
    //     if($validator->fails()){
    //         throw ValidationException::withMessages($validator->errors()->toArray());
    //     }

    //     return $this->settingRepository->update($settings, $data);
    // }
    protected function rules(): array
    {
        return [
                'spotify_id' => 'required',
        ];
    }

}
