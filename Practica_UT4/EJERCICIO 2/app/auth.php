<?php

function getUsers():array{
    return require __DIR__ . "/../data/users.php";
}

function getUserByName(String $alias):?array{
    $users=getUsers();
    foreach($users as $user){
        if($alias===$user["name"]){
            return $user;
        }
    }
    return null;
}

function login(string $alias):void{
    $_SESSION['alias'] = $alias;
    $_SESSION['last_activity'] = time();
    
}
function isAuthenticated():bool{
    return isset($_SESSION['alias']) && is_string($_SESSION['alias']) && $_SESSION['alias'] !== '';
}
function currentUser():?array{
    if(!isAuthenticated()){
        return null;
    }
    return ['name' => $_SESSION['alias']];
}




function logout():void{
    //unset($_SESSION['user']);


    
    session_destroy();
}