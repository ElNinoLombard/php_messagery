<?php
//here I created a new object PDO for a SQL request using localhost, then the database name in MySQL website and then both 'root's are for username and password
//but both can be replaced by something given by another host if we have one
$database = new PDO('mysql:host=localhost; dbname=direct_message_system; charset=utf8;', 'root');  
if(isset($_POST['send'])){ //down in the html part we created a button called "send" that we call here, when we press the button the following commands will execute using var POST
    if(empty($_POST['nickname']) and empty($_POST['msg'])){
        echo "Please fill all fields"; //if they are empty, this will ask them to "Please fill all the fields" 
    }elseif(empty($_POST['msg'])){
        echo "Please write a message to send";
    }elseif(empty($_POST['nickname'])){
        echo 'Please set a nickname';
    }elseif(!empty($_POST['nickname']) && (!empty($_POST['msg']))){
        $nickname = htmlspecialchars($_POST['nickname']); //here setting the variable nickname with only special chars of html declaring nickname with $_POST without being able to execute html codes
        $msg = nl2br(htmlspecialchars($_POST['msg'])); //here same thing as before but only letting the user to "jumplines"
        $insert_msg = $database -> prepare('INSERT INTO direct_message_system(nickname, msg) VALUES(?,?)'); //ordering the program to stock the message in the database we created giving values to each variable
        $insert_msg->execute(array($nickname, $msg)); //we execute the request inserting a table and setting the two variables previously created in l.7 and l.8  //if the text box for nickname and msg are BOTH not empty
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src = "http://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Direct Message</title>
</head>
<body>
    <form method="POST" action="" align = "center">
        <input type="text" name="nickname">
        <br><br>
        <textarea type="message" name="msg"></textarea>
        <br>
        <input type="submit" name="send">
    </form>
    <section id="messages"></section>

    <script> //here we can write in js to import the message to refresh all instantly
        setInterval('load_msgs()', 500);//every 500ms we refresh
        function load_msgs(){
            $('#messages').load('direct_message_load.php'); //just so we can refresh HERE IN THIS PART OF THE CODE while loading the php file that it's supposed to load the messages in the table
        } 
    </script> 
</body>
</html>
