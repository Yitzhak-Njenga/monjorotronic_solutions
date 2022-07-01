<?php

namespace App\Http\Controllers;

use AfricasTalking\SDK\AfricasTalking;
use App\Models\BulkSms;
use App\Models\Sms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SmsController extends Controller
{
    public function uploadFile(Request $request)
    {

        $file = $request->file('file');
        if ($file){
            $filename = $file->getClientOriginalName();
            $fileExtension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();

            $this->checkUploadedFileProperties($fileExtension, $fileSize);

            $location = 'uploads';

            $file->move($location, $filename);

            $filePath = public_path($location . "/" . $filename);
            $file = fopen($filePath, "r");
            $importData_arr = array();
            $i = 0;

            //reading the conntent of the csv file
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($filedata);
                // Skip first row (Remove below comment if you want to skip the first row)
                if ($i == 0) {
                    $i++;
                    continue;
                }
                for ($c = 0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata[$c];
                }
                $i++;
            }
            fclose($file); //Close after reading

            $j = 0;
            foreach ($importData_arr as $importData) {
                $name = $importData[0];
                $phone = $importData[1];
                $j++;

                $message = $request->message;

//            return$request->message;

                $this->broadcastProper(array($phone), $message);

                try {
                    DB::beginTransaction();
                    Sms::create([
                        'name' => $importData[1],
                        'phone' => $importData[2]
                    ]);
                } catch (\Exception $e) {
                    DB::rollBack();
                }
            }

            return response()->json([
                'message' => "$j uloaded succesfull"
            ]);
        }

    }

    public function checkUploadedFileProperties($fileExtension, $fileSize)
    {
        $valid_extension = array("csv", "xlsx"); //Only want csv and excel files
        $maxFileSize = 2097152; // Uploaded file size limit is 2mb

        if (in_array(strtolower($fileExtension,), $valid_extension)) {
            if ($fileSize <= $maxFileSize) {
            } else {
                throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
            }
        } else {
            throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE);
        }
    }
    public function broadcastProper(array $phones , string $message)
    {
        $recipients = [];
        foreach ($phones as $phone) {
            if (Str::startsWith($phone, "07")) {
                $phone = '+254' . (substr(($phone), 1));
            } elseif (Str::startsWith($phone, "7")) {
                $phone = Str::start($phone, '+254');
            } elseif (Str::startsWith($phone, "254")) {
                $phone = Str::start($phone, '+');
            }
            array_push($recipients, $phone);
        }
        $apiKey = env('AT_API_KEY', 'KEY');
        $username = env('AT_USERNAME');
        $AT = new AfricasTalking($username, $apiKey);
        $sms = $AT->sms();
        $result = $sms->send([
            'from' => 'mCarFix',
            'to' => $recipients,
            'message' => $message
        ]);
    }

}
