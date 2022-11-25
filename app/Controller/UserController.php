<?php

namespace Controller;

use Models\Task\UserTask;
use Models\User;
use Src\Request;
use Src\Validator\Validator;
use Src\View;

class UserController
{
    public function registration(Request $request): void{
        if ($request->method === "POST"){
            $validator = new Validator($request->all(), [
                'fio'=>['required'],
                'email'=>['required', 'unique:task.users,email'],
                'password'=>['required']], [
                'required'=>'Field :field is empty',
                'unique'=>'User with email :field already exist'
            ]);

            if ($validator->fails()){
                (new View())->toJSON($this->errorData($validator), 422);
                return;
            }

            UserTask::create($request);
            (new View())->toJSON(["data"=>["message"=>"Registration successful"]]);
        }
    }

    public function authorization(Request $request): void{
        if ($request->method === "POST"){
            $validator = new Validator($request->all(),[
                'email'=>['required'],
                'password'=>['required']], [
                    'required'=>"Field :field is empty"
            ]);

            if ($validator->fails()){
                (new View())->toJSON($this->errorData($validator), 401);
                return;
            }

            if (UserTask::check($request->get("email"), $request->get("password"))){
                (new View())->toJSON(["data"=>["message"=>"Auth successful"]]);
            }
            else
                (new View)->toJSON(["error"=>["code"=>401, "message"=>"Auth failed"]]);
        }
    }

    private function errorData(Validator $validator): array{
        return [
            "code"=>422,
            "message"=>"Validation error",
            "errors"=>$validator->errors()
        ];
    }
}