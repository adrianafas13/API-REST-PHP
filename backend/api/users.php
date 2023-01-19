<?php
    
    header("Content-Type: application/json");
    include_once("../class/class-user.php");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST'://save
            $_POST = json_decode(file_get_contents('php://input'), true);
            $user = new User($_POST["name"], $_POST["lastName"], $_POST["birthday"], $_POST["country"]);
            $user->createUser();
            $result["messaje"] = "Save user, information: " . json_encode($_POST);
            echo json_encode($result);
        break;
        case 'GET':
            if (isset($_GET['id'])){ 
                User::getUser($_GET['id']);
            }else{ 
                User::readUser();
            }
        break;
        case 'PUT':
            $_PUT = json_decode(file_get_contents('php://input'), true);
            $user = new User($_PUT['name'], $_PUT['lastName'], $_PUT['birthday'], $_PUT['country']);
            $user->updateUser($_GET['id']);
            $result["messaje"] = "Update User with id: " . $_GET['id'].
                                ", Information to update: " . json_encode($_PUT);
            echo json_encode($result);
        break;
        case 'DELETE':
            User::deleteUser($_GET['id']);
            $result["messaje"] = "Delete User with id: " .$_GET['id'];
            echo json_encode($result);
        break;
    }

?>