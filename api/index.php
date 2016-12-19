<?php
    header("content-type: application/json");
    $config = json_decode(file_get_contents("../config.json"),true);
    $include_path = realpath($_SERVER["DOCUMENT_ROOT"]).$config["root"]."/api/includes/";
    $include_path_vendors = realpath($_SERVER["DOCUMENT_ROOT"]).$config["root"]."/api/";
    
    if(isset($_REQUEST['action'])) {
        $request = $_REQUEST;
    } else {
        $requestJSON = file_get_contents('php://input');
        if($requestJSON) {
            $request = json_decode($requestJSON, true);
        } else {
            $request = array();
        }
    }

    if(isset($request['action'])) {
        $action = $request['action'];
    } else {
        $action = "home";
    }

    $site_root = realpath($_SERVER["DOCUMENT_ROOT"]).$config["root"]."/";
    $file = $site_root."api/".$action.".php";
    require $file;
?>