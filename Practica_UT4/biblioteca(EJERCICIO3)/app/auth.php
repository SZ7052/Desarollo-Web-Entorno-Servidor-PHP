<?php

function getUsers():array{
    return require __DIR__ . "/../data/users.php";
}

function getUserByEmail(String $email):?array{
    $users=getUsers();
    foreach($users as $user){
        if($email===$user["email"]){
            return $user;
        }
    }
    return null;
}

function login(Array $user):void{
    session_regenerate_id(true);
    $_SESSION['user']=[
        "id"=>$user["id"],
        "name"=>$user["name"],
        "email"=>$user["email"],
        "role"=>$user["role"]
    ];
    $_SESSION["last_activity"] = time();
}
function isAuthenticated():bool{
    return isset($_SESSION['user']) && is_array($_SESSION['user']);
}
function currentUser():?array{
    if(!isAuthenticated()){
        return null;
    }
    return $_SESSION['user'];
}

function requireRole(string $role):void{
    $user = currentUser();
    if(!$user || $user["role"]!==$role){
        http_response_code(403);
        exit("403 - Acceso no autorizado");
    }
}


function logout():void{
    //unset($_SESSION['user']);

    session_destroy();
}