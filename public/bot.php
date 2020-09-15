<?php
    $sql = mysqli_connect('localhost', 'theocean_labshop', 'theocean_labshop', 'theocean_labshop');
    $input = json_decode(file_get_contents('php://input'));
    $vk = new Vk('c4bc4755c350c97eebac56291608b61530b3b136928f05c458ba294b927cc34522f44288cf05b77fdf3c2', 'ejh547feb4nd74Wer74', 'bc5ce1cd', '5.103');
    $vk->data($input);

    if (!$vk->compareSecret())
        die('Ключи не совпадают');

    switch ($vk->full_data->type) {
        case 'confirmation':
            return $vk->confirm();
        break;
            
        case 'message_new':
            $message = mb_strtolower($vk->message);

            if ($message == 'начать') {
                if ($user = mysqli_fetch_assoc(mysqli_query($sql, "select `id`, `is_activated` from `users` where `id` = " . $vk->from_id))) {
                    if ($user['id_activated'] === 0)
                        break;
                    mysqli_query($sql, "update `users` set `is_activated` = 1 where `id` = " . $vk->from_id);
                    $vk->sendMessage($vk->from_id, 'Ваша запись успешно активирована!');
                } else {
                    $vk->getUserData($vk->from_id, 'photo_50,photo_200,first_name,last_name');
                    $user = $vk->user;
                    mysqli_query($sql, "insert into `users` (`id`, `first_name`, `last_name`, `photo`, `photo_rec`, `is_activated`) values ($vk->from_id, '$user->first_name', '$user->last_name', '$user->photo_200', '$user->photo_50', 1)");
                    $vk->sendMessage($vk->from_id, 'Ваша запись успешно активирована!');
                }
            }
        break;
    }
    echo 'ok';

?>