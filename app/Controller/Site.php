<?php

namespace Controller;

use Models\Post;
use Models\User;
use Src\Auth\Auth;
use Src\Request;
use Src\Validator\Validator;
use Src\View;

class Site
{
    private View $view;

    public function __construct()
    {
        $this->view = new View();
    }

    /**
     * @throws \Exception
     */
    public function index(): string{

        $posts = Post::all();
        return (new View())->render("site.post", ["posts"=>$posts]);
    }

    /**
     * @throws \Exception
     */
    public function hello():void{
        echo $this->view->render("site.hello", ["message"=>"Bruh"]);
    }

    public function signUp(Request $request): string{
        if ($request->method === 'POST'){
            $validator = new Validator($request->all(), [
                'name'=>['required'],
                'login'=>['required', 'unique:users,login'],
                'password'=>['required']], [
                    'required'=>'Поле :field пустое',
                    'unique'=>'Поле :field должно быть уникально'
            ]);

            if ($validator->fails())
                return new View('site.signUp', ["message"=>json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);


            if (User::create($request->all()))
                app()->route->redirect('/login');
            return false;
        }

        return new View('site.signUp');
    }

    public function login(Request $request):string{
        if ($request->method === "GET")
            return new View('site.login');

        if (Auth::attempt($request->all()))
            app()->route->redirect('/hello');

        return new View('site.login', ['message'=>"Неверный логин или пароль"]);
    }

    public function logout():void{
        Auth::logout();
        app()->route->redirect('/hello');
    }
}