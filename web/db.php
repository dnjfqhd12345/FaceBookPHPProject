<?php
//load .env file
require_once __DIR__ . '/vendor/autoload.php'; // Composer autoload
	
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();






function db_get_pdo()
{
    $host = $_ENV['DB_HOST'];
    $port = '3306';
    $dbname = $_ENV['DB_NAME'];
    $charset = 'utf8';
    $username = $_ENV['DB_USER'];
    $db_pw = $_ENV['DB_PASSWORD'];
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;";
    $pdo = new PDO($dsn, $username, $db_pw);
    return $pdo;
}

function db_select($query, $param=array()){
    $pdo = db_get_pdo();
    try{
        $st = $pdo->prepare($query);
        $st->execute($param);
        $result = $st->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;
        return $result;
    } catch (PDOException $ex) {
        return false;
    } finally {
        $pdo = null;
    }
}


function db_select_no_param($query){
    $pdo = db_get_pdo();
    try{
        $st = $pdo->prepare($query);
        $result = $st->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;
        return $result;
    } catch (PDOException $ex) {
        return false;
    } finally {
        $pdo = null;
    }
}

function db_insert($query, $param = array()) {
    $pdo = db_get_pdo();
    try{
        $st = $pdo->prepare($query);
        $result = $st->execute($param);
        $last_id = $pdo->lastInsertId();
        $pdo = null;
        if($result){
            return $last_id;
        } else {
            return false;
        }
    } catch (PDOException $ex){
        return false;
    } finally {
        $pdo = null;
    }
}

function db_update_delete($query, $param = array()){
    $pdo = db_get_pdo();
    try{
        $st = $pdo->prepare($query);
        $result = $st->execute($param);
        $pdo = null;
        return $result;
    } catch (PDOException $ex){
        return false;
    } finally {
        $pdo = null;
    }
}

?>