<?php
    require_once("../db/config.php");
    require_once("../db/dbhelper.php");
    require_once("./classes/users.php");
    switch($_SERVER["REQUEST_METHOD"]){
        case "GET":
            if(isset($_GET["id"])){
                $id=htmlspecialchars(strip_tags($_GET["id"]));
                $response = Users::readItem($id);
                if($response){
                    http_response_code(200);
                    echo json_encode($response);
                }else{
                    http_response_code(200);
                    echo json_encode([]);
                }
            }else if(isset($_GET["page"])||isset($_GET["limit"])){
                $limit=5;
                $page=1;
                if(isset($_GET["limit"])){
                    $limit=htmlspecialchars(strip_tags($_GET["limit"]));
                }
                if(isset($_GET["page"])){
                    $page=htmlspecialchars(strip_tags($_GET["page"]));
                }
                $response=Users::readPage($page,$limit);
                if($response){
                    http_response_code(200);
                    echo json_encode($response);
                }
                else{
                    http_response_code(200);
                    echo json_encode([]);
                }
            }else{
                $response = Users::readAll();
                if($response){
                    echo json_encode($response);
                }
                else{
                    echo json_encode([]);
                }
                
            }
            break;
        case "POST":
            $params = json_decode(file_get_contents("php://input"),true);
            $user= new Users($params["name"],$params["phoneNumber"],$params["birthday"]);
            $user->createItem();
            http_response_code(201);
            break;
        case "PUT":
            if(isset($_GET["id"])){
                $params = json_decode(file_get_contents("php://input"),true);
                $id=$_GET["id"];
                $user= new Users($params["name"],$params["phoneNumber"],$params["birthday"]);
                $user->updateItem($id);
                http_response_code(201);
            }
            break;
        case "DELETE":
            if(isset($_GET["id"])){
                Users::deleteItem($_GET["id"]);
                http_response_code(200);
            }
            break;
    }
