<?php 
    session_start();
    if(isset($_POST) && isset($_GET["action"])){
        
        $act=$_GET["action"];
        switch($act){
            case "add":
                $id=$_POST["new-task"];
                add($id);
                break;
            case "edit":
                $_SESSION["add"]=$_GET["name"];
                header("Location:todo.php");
                break;
            case "update":
                $id=$_GET["name"];
                unset($_SESSION["add"]);
                update($id, $_POST["new-task"]);
                header("Location:todo.php");
                break;
            case "updateStatus":
                $id=$_GET["name"];
                updateStatus($id, $_GET["status"]);
                header("Location:todo.php");
                break;
            case "delete":
                $id=$_GET["name"];
                deleteToDo($id);
                break;
        }
    }


    function checkTodo($name){
        foreach($_SESSION["todo"] as $key=> $val){
            if($_SESSION["todo"][$key]["name"] == $name){
                return 1;
            }
        }
        return 0;
    }

    function add($name){
        $todo=array("name"=>$name, "status"=>"0");
        if(!checkTodo($name)){
            array_push($_SESSION["todo"],$todo);
        }
        header("Location:todo.php");
    }


    function update($name, $newname){
        foreach($_SESSION["todo"] as $key=> $val){
            if($_SESSION["todo"][$key]["name"] == $name){
                $_SESSION["todo"][$key]["name"] = $newname;
                break;
            }
        }  
    }


    function updateStatus($name, $status){
        foreach($_SESSION["todo"] as $key=> $val){
            if($_SESSION["todo"][$key]["name"] == $name){
                $_SESSION["todo"][$key]["status"] = $status;
                break;
            }
        }  
    }


    function deleteToDo($name){
        foreach($_SESSION["todo"] as $key=> $val){
            if($_SESSION["todo"][$key]["name"] == $name){
                array_splice($_SESSION["todo"],$key,1);
                break;
            }
        }
        header("Location:todo.php");
    }


?>