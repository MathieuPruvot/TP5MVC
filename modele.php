
<?php
function ()
{

}

function ()
{
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
    $sql=''//requete sql
    $req = $db->prepare($sql);
    $req->execute();
    $result = $req->fetchall();

    return $result;
}

function ()
{
   
    return $comments;
}
