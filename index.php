<?php
session_start();
require 'Qbuilder.php';
require 'Validator.php';
require 'Flash.php';
require 'Router.php';

// Роутинг
$myRoute = Router::route($_SERVER['REQUEST_URI']);
//var_dump($myRoute);



// Query Builder
$object = new Qbuilder(new PDO('mysql:host=localhost;dbname=app3', 'root', 'root'));

$posts = $object->getAllRecords('posts');
//var_dump($posts);

// Validate, Flash, Query Builder
$name = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {    
    
   $name = Validator::validate($_POST["name"]);   
  
   if(Validator::checkLength($name)) {
       $object->insertRecord('posts', [
            'title' => $name,  
        ]);
        Flash::outputMessage('Данные добавлены');
   } else {
        Flash::outputMessage('Заполние поле');
   }
   
    header("Location: index.php"); 
    exit;    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conponents</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <input type="text" name="name">
        <input type="submit" value="submit">
    </form>
    <?php if(isset($_SESSION['message'])) : ?>
        <p><?php echo $_SESSION['message']; ?></p>
        <?php unset($_SESSION['message']); exit();?>
    <?php endif;?>
</body>
</html>