<?php

// API endpoint URL
$url = 'https://api.nameapi.org/rest/v5.3/genderizer/persongenderizer?apiKey=14b0238d98a0ae633c5d1abbf6742156-user1';

// Retrieve full name from POST data
$fullname = isset($_POST['full_name']) ? $_POST['full_name'] : '';

// Check if full name is provided
if (!empty($fullname)) {
    // Prepare input data
    $inputData = array(
        'inputPerson' => array(
            'type' => 'NaturalInputPerson',
            'personName' => array(
                'nameFields' => array(
                    array(
                        'string' => $fullname,
                        'fieldType' => 'FULLNAME'
                    )
                )
            )
        )
    );

    // Convert data to JSON format
    $data = json_encode($inputData);

    $headers = array(
        'Content-Type: application/json'
    );

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);

    // Check for error
    if ($response === false) {
        http_response_code(500);
        echo json_encode(array('error' => 'Unable to fetch gender.'));
    } else {
        // Decode the JSON response
        $responseData = json_decode($response, true);

        // Extract gender from response
        $gender = isset($responseData['gender']) ? $responseData['gender'] : 'Unknown';

        // Send success response with gender
        echo json_encode(array('gender' => $gender));
    }

    curl_close($curl);
    
} else {
    // Send error response if full name is not provided
    http_response_code(400);
    echo json_encode(array('error' => 'Full name is required.'));
}

?>
