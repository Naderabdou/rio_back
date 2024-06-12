<?php

namespace App\Traits;

trait Firebase
{

    public function sendFcmNotification($tokens, $data, $lang = 'ar' , $type)
    {

        $SERVER_API_KEY = 'AAAAoxfrg6A:APA91bHUhfHC1_EJ1eLW5P2qTk3zTGQ2S7pMT-zZoTBRGgaAZ05VQBhGJY2ExoAGYHYi0q9ocwr_dq4toO8CzjdgsgpuWVzScz4FkYHC-zSg1m3WtNhp-S2Jd133YevpaPI5Kgb9_Sct	';
      //  dd($data);

        $data = [
            "registration_ids" => $tokens,
            "notification" => [
                "title"    => 'تطبيق زاد',
                "body"     => $this->getBody($data, $lang)  . '|||||||' . $type,
                "mutable_content" => true,
                'sound'    => 'nadernader',
            ],
            // 'data'  => isset($data->url) ? $data->url : ''
        ];
        $dataString = json_encode($data);


        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $response = curl_exec($ch);

      //   dd($response);
    }

    public function getTitle(array $data, $local = 'ar')
    {
        return $data['name_' . $local];
    }

    public function getBody(array $data, $local = 'ar')
    {
        return  $data['body_' . $local];
    }
}
