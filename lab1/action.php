<?php
require_once './User.php';
require_once './Comment.php';

$send = array();

for ($i = 0; $i < 5; ++$i) {
    $u = new User("192.168.1.1$i", 'good@miet.ru', '02112000alK'); 
    $send[$i] = new Comment($u, "msg #$i");
    sleep($i + 1);
}

$date = $_POST['date'];

echo "Entered date: $date<br>";

foreach ($send as $comment) {
    $commetn_user_date = $comment->getUser()->getCunstDate();
    if (strtotime($commetn_user_date) > strtotime($date))
        echo $comment->getMsg() . ' user time:' . $comment->getUser()->getCunstDate() . '<br>';
}
