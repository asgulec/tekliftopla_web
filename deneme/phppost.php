<?php
function postAndkullan() {

        $userName = $_POST["userName"];
        $email = $_POST["email"];
        $countryId = $_POST["countryId"];
        $cityId = $_POST["cityId"];
        $text=$_POST["text"];
        // Make database connection
        $con=mysqli_connect("localhost","teklifto_nadeem", "q1w2e3e3!!", "teklifto_ttdeneme");


        if (is_null($userName) || is_null($email) || is_null($countryId) || is_null($cityId) || is_null($text) || mysqli_connect_errno())
        { // validate data
             $response->isSuccess = false;
             $response->message = "Missing data";
             $response->code = 200;

            echo json_encode($response);
        } else {
            // insert data in DB
            $query = "INSERT INTO andkullan(akeposta, akisim, aksehir, akulke, akmetin) VALUES ($email,'$userName','$cityId','$countryId', '$text');";
            $result = mysqli_query($con,$query);
            
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