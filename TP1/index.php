<?php

use App\model\Database;
use App\model\TaskRepository;

require 'vendor/autoload.php';
define("DATABASE_FILE", "./data.db");

//$taskRepository = new TaskRepository();
//$taskRepository->initialize();

$table = "tasks";
$tasks = [];
Database::initialize(__DIR__ . DIRECTORY_SEPARATOR. DATABASE_FILE);

$taskRepository = new TaskRepository();
$taskRepository->initialize();

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "uncheck":
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                $taskRepository->update($id);
            }
            header("Location: /");
            break;
        case "check":
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                $taskRepository->update($id, true);
            }
            header("Location: /");
            break;
        case "delete":
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                $taskRepository->delete($id);
            }
            header("Location: /");
            break;
        case "add":
            if (isset($_GET["name"])) {
                $name = $_GET["name"];
                $name = addslashes($name);
                $taskRepository->add($name);
            }
            header("Location: /");
            break;
        default:
            echo "An error has occured";
            die();
    }
}


$query = $taskRepository->getAll();
if (!$query)
    die("Impossible to execute query.");

while ($row = $query->fetch()) {
    $tasks[] = $row;
}

require 'view/template.php';
