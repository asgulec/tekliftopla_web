<?php
include __DIR__ . '/../ayar.php';

function postAndkullan() {

    $response = new stdClass();
    $userData = new stdClass();

    $userName = $_POST["userName"] ?? null;
    $email = $_POST["email"] ?? null;
    $countryId = $_POST["countryId"] ?? null;
    $cityId = $_POST["cityId"] ?? null;
    $text = $_POST["text"] ?? null;
        // Make database connection
    global $host, $user, $password, $db;
    $con = mysqli_connect($host, $user, $password, $db);


    if (is_null($userName) || is_null($email) || is_null($countryId) || is_null($cityId) || is_null($text) || !$con)
        { // validate data
             $response->isSuccess = false;
             $response->message = "Missing data";
             $response->code = 200;

            echo json_encode($response);
        } else {
            // insert data in DB
            mysqli_set_charset($con, 'utf8');
            $statement = mysqli_prepare($con, "INSERT INTO andkullan (akeposta, akisim, aksehir, akulke, akmetin) VALUES (?, ?, ?, ?, ?)");
            $result = false;
            if ($statement) {
                mysqli_stmt_bind_param($statement, 'sssss', $email, $userName, $cityId, $countryId, $text);
                $result = mysqli_stmt_execute($statement);
                mysqli_stmt_close($statement);
            }
            
            if ($result) {
                // Success
                $response->isSuccess = true;
                $response->message = "Post Successfully";
                $response->code = 200;
             
                $userData->userName = $userName;
                $userData->email = $email;
                $userData->cityId = $cityId;
                $userData->countryId = $countryId;
                $userData->text = $text;
             
                $response->data = $userData;
             

                echo json_encode($response);
            } else {
                $response->isSuccess = false;
                $response->message = "Problem Occured in saving data";
                $response->code = 200;

                echo json_encode($response);
            }
        }

   

}
postAndkullan();
?>