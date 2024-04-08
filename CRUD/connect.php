<?php

// Parameters
$host = 'localhost';
$brukernavn = 'root';
$passord = '';
$database = 'bedriftsportalen_db';

// Creating connection
$conn = mysqli_connect($host, $brukernavn, $passord, $database);

// Checking connection

if (!$conn) {
  die('Feil med forbindelsen' . mysqli_connect_error());
} else {
  //   echo "Databasen er tilkoblet";
}
