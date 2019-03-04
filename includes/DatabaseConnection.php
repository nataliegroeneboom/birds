<?php
$pdo= new PDO('mysql:host=db;dbname=db;charset=utf8', 'db', 'db');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);