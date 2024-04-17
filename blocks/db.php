<?php 
	//local connect
	R::setup( 'mysql:host=localhost;port=3307;dbname=teststogo-db','root','root' ); //for both mysql or mariaDB

	//sprinthost connect
	// try{
 //        $db = new PDO('mysql:host=localhost;dbname=f0610890_teststogo-db','f0610890_teststogo-db','root');
 //    } catch(PDOException $e){
 //        echo $e->getmessage();
 //    }
	
	// R::setup( 'mysql:host=localhost;dbname=f0610890_teststogo-db','f0610890_teststogo-db','root' ); //for both mysql or mariaDB
	// if(!R::testConnection()) echo 'Не удалось подключиться к бд...';
?>