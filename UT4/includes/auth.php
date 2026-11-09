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

/*
//Saber si hay alguien autenticado

function auten(Array $user):bool{
    if(isset($_SESSION["user"])){
        return true;
    }
    return false;
}

//Saber el usuario autenticado

function whoauten(Array $user):?string{
    if(isset($_SESSION["user"])){
        $who=getUserByEmail($user);
    }
    return null;
}
*/