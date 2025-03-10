<?php
// va permettre de nettoyer les données

function sanitize($data){
    return htmlentities(strip_tags(stripslashes(trim($data))));
}






?>