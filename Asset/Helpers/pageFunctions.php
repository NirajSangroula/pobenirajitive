<?php
function isPost(){
	return $_SERVER['REQUEST_METHOD'] == 'POST';
}
function isGet(){
	return $_SERVER['REQUEST_METHOD'] == 'GET';
}
function getPost($name){
	return $_POST[$name];
}
function getGet($name){
	return $_GET[$name];
}
function sendToHomepage(){
	header("location: index.php");
}
function sendToLoginPage(){
	header("location: login.php");
}