#PDO PHP Persistence Class

#####Exemple of use:

 
ATTENTION: The parameters must be in the associative array
     In PHP 5.4 there is a short syntax stating: ["key" => "value"];
    In previous versions should be used the old format: array("key" => "value");
    $bd = new bd;
EXECUTE QUERY (SELECT) WITHOUT PARAMETERS

    $data = $bd->ExecuteQuery("SELECT * FROM table");
EXECUTE QUERY (SELECT) WITH PARAMETERS

    $data = $bd->ExecuteQuery("SELECT * FROM table WHERE col1 = :par1 OR col2 = :col2",["col1" => $var1,"col2" => "valor"]);
     
GETTING DATA

    foreach($data as $row){
            $value1 = $row["column1"];
            $value2 = $row["column2"];
    }
     
EXECUTE NON QUERY- RETURN TRUE OR FALSE
   
    $ret = $bd->ExecuteNonQuery("UPDATE table SET col1 = 'new value' WHERE col3 = :val",[":val"] => $id);
     
TRANSACTION

    $bd->beginTransaction();
    try{
            $bd->ExecuteNonQuery("UPDATE table SET col1 = 'new value' WHERE col3 = :val",["val"] => $id);
            $bd->ExecuteNonQuery("INSERT INTO table VALUES ('0','dasdasd','dasdasd')");
            $bd->Commit();
    } catch(Exeption $e){
            $bd->Rollback();
    }
