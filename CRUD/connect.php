<?php

// Parametere til databasen
$host = 'localhost';
$brukernavn = 'root';
$passord = '';
$database = 'bedriftsportalen_db';

// Lag en forindelses-streng
$conn = mysqli_connect($host, $brukernavn, $passord, $database);

// Sjekk Forbindelse

if(!$conn)
  {
    die('Feil med forbindelsen'. mysqli_connect_error());
  }
else
  {
 //   echo "Databasen er tilkoblet";
  }