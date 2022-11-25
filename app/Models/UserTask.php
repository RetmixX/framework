<?php

namespace Models\Task;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Request;


/**
 * @property $id
 * @property $fio
 * @property $email
 * @property $password
 * @property $role_user
 * @mixin Builder
 */
class UserTask extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $incrementing = false;
    public $table = "task.users";

    public static function create(Request $request):void{
        $user = new UserTask();
        $user->fio = $request->get("fio");
        $user->email = $request->get("email");
        $user->password = md5($request->get("password"));
        $user->role_user = "CLIENT";
        $user->save();
    }

    public static function check(string $email, string $password):bool{
        $user = UserTask::query()->firstWhere('email', '=', $email);
        if ($user!==null)
            if ($user->password === md5($password)) return true;

        return false;
    }


}