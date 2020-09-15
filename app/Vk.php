<?php
    
    namespace App;

	class Vk {
		
        private $main_token;
        private $secret_token;
        private $return_string;
        private $version;

        public $full_data;
        public $user;

        public $message;
        public $from_id;
        public $files;

        public function __construct($main, $secret, $return, $v) {
            $this->main_token = $main;
            $this->secret_token = $secret;
            $this->return_string = $return;
            $this->version = $v;
        }

        public function data($data) {
            $this->full_data = $data;
            $this->message = $data->object->message->text;
            $this->from_id = $data->object->message->peer_id;
            $this->files = $data->object->message->attachments;

            $this->getUserData($this->from_id);
        }

        public function confirm() {
            echo $this->return_string;
        }

        public function compareSecret() {
            if ($this->full_data->secret === $this->secret_token)
                return true;
            return false;
        }

        public function getUserData($user_id = null, $fields = 'sex') {
            $user_id = $user_id === null ? $this->from_id : $user_id;
            $data = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_id=" . $user_id . "&fields=" . $fields . "&access_token=" . $this->main_token . "&v=" . $this->version));
            if ($data->response[0]->sex == 1)
                $data->response[0]->sex = 'ж';
            else
                $data->response[0]->sex = 'м';
            $this->user = $data->response[0];
        }
        
        private function uploadFile($peer_id, $file, $file_type) {
            $res = file_get_contents("https://api.vk.com/method/docs.getMessagesUploadServer?type=doc&peer_id=" . $peer_id . "&v=" . $this->version . "&access_token=" . $this->main_token); 
            $res = json_decode($res, true)['response'];
            $upload_url = $res['upload_url'];
            
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $upload_url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, [$file_type => new CURLFile($file)]);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $upload = curl_exec($curl);
            curl_close($curl);
            $res = json_decode($upload, true);
            
            if (isset($res[$file_type]))
                return $res[$file_type];
            return $res;
        }
        
        public function loadFile($peer_id, $file) {
            $upload = $this->uploadFile($peer_id, $file, 'file');
            
            $res = json_decode(file_get_contents("https://api.vk.com/method/docs.save?file=" . $upload . "&v=" . $this->version . "&access_token=" . $this->main_token));
            return 'doc' . $res->response->doc->owner_id . '_' . $res->response->doc->id;
        }
        
        public function loadPhoto($peer_id, $file) {
            $upload = $this->uploadFile($peer_id, $file, 'photo');
            $photo = $upload['photo'];
            $server = $upload['server'];
            $hash = addslashes($upload['hash']);
            
            $res = json_decode(file_get_contents("https://api.vk.com/method/photos.saveMessagesPhoto?photo=" . $photo . "&server=" . $server . "&hash=" . $hash . "&v=" . $this->version . "&access_token=" . $this->main_token), true);
            return 'photo' . $res['response'][0]['owner_id'] . '_' . $res['response'][0]['id'];
        }
        
        public function sendMessage($users, $message, $keyboard = null, $attachment = null) {
            $request = array(
                'message' => $message,
                'access_token' => $this->main_token,
                'attachment' => $attachment,
                'v' => $this->version,
                'user_ids' => $users,
                'random_id' => 0
            );
            if ($keyboard !== null)
                $request['keyboard'] = json_encode($keyboard, JSON_UNESCAPED_UNICODE);
            
            file_get_contents('https://api.vk.com/method/messages.send?' . http_build_query($request));
        }
    
    }
    
?>