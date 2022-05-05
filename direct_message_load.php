

<?php
$database = new PDO('mysql:host=localhost; dbname=direct_message_system; charset=utf8;', 'root'); 
$msg_get = $database->query('SELECT * FROM messages'); //here we try to load all the messages in the table messages from MySQL 
while($msg = $msg_get->fetch()){ //we compare both variables and while they correspond we go fetch every single data in a table
?>
    <div class = "msg"> 
        <h3><?php echo $msg['nickname'];?></h3> <!--here echo is just like a print from python or something to a document.write() in js -->
        <p><?php echo $msg['msg'];?></p>
    </div>
    <?php
}
?>