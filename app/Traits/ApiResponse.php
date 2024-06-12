<?php

namespace App\Traits;

trait ApiResponse
{
    public function ApiResponse($data = [] , $message = null, $code = 200)
    {
            $array =
            [
                'data'    => $data,
                'message' => $message,
                'status'  => in_array($code ,$this->successCode())? true : false
            ];

            return response()->json($array,$code);
    } // end of api response

    public function notFound()
    {
        return response([
            'success' => false,
            'data' => [],
            'message' => transWord('هذا العنصر غير موجود'),
        ], 404);
    }

    public function successCode()
    {

        return [
            200, 201, 202
        ];
    } // end of success code
}
