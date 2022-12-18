<?php

use Illuminate\Support\Str;

define("PAGELIST", "liste");
define("PAGECREATEFORM", "create");
define("PAGEEDITFORM", "edit");

define("DEFAULTPASSOWRD", "password");


function userFullName(){
    return auth()->user()->prenom . " " . auth()->user()->nom;
}

function setMenuClass($route, $classe){
    $routeActuel = request()->route()->getName();

    if(contains($routeActuel, $route) ){
        return $classe;
    }
    return "";
}

function contains($container, $contenu){
    return Str::contains($container, $contenu);
}

function setMenuActive($route){
    $routeActuel = request()->route()->getName();

    if($routeActuel === $route ){
        return "active";
    }
    return "";
}

function getRolesName(){
    $rolesName = "";
    $i = 0;
    foreach(auth()->user()->role as $role){
        $rolesName .= $role->nom;

        //
        if($i < sizeof(auth()->user()->role) - 1 ){
            $rolesName .= ",";
        }

        $i++;

    }

    return $rolesName;
}
?>