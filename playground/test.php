<?php

// create a generic query function

function query($pdo, $sql, $parameters=[]){
    $query = $pdo->prepare($sql);

    foreach($parameters as $name => $value){
        $query->bindValue($name, $value);

    }
    $query->execute();
    return $query;
}

//another way of writing this function
// the execute function can take an argument of parameters
// to be bound exactly the same way.

function query($pdo, $sql, $parameters = []){
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}


// an example in a generic function

function deleteItem($pdo, $id){
    $parameters = [':id' => $id];
    query($pdo, 'DELETE FROM `table` WHERE `id` = :id', $parameters);
}

//then call the function

deleteItem($pdo, 2);

// making the function generic allowing flexibility for query values

// adding an array as a parameter in the function :->

updateItem($pdo, [
    'id' => 1,
    'joketext' => 'text text text'
]);

//edit or create generic function

function save($pdo, $table, $primaryKey, $record){
    try{
        if($record[$primaryKey] == ''){
            $record[$primaryKey] = null;

        }
        insert($pdo, $table, $record);

    }catch(PDOException $e) {
        update($pdo, $table, $primaryKey, $record);

    }
}

// example being

save($pdo, 'joke', 'id', ['id' => $_POST['jokeid'],
                                            'jokedate' => new DateTime(),
                                            'authorId' => 1]);
