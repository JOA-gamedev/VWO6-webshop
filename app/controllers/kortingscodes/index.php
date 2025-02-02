<?


$db = new Database();

$result = $db->query("SELECT * FROM kortingcodes")->fetchAll();

view("kortingscodes/index", [
    "kortingscodes" => $result
]);


//show alle kortingscodes
//met + icoon