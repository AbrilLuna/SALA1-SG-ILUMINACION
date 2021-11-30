<?php
//Obtener el ID del vendedor desde el URL
function url(){
    if(isset($_SESSION['id_Ven']))
        return $_SESSION['id_Ven']; 
}
?>