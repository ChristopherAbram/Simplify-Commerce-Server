<?php

/*
 * Copyright (c) 2013, MasterCard International Incorporated
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are
 * permitted provided that the following conditions are met:
 *
 * Redistributions of source code must retain the above copyright notice, this list of
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list of
 * conditions and the following disclaimer in the documentation and/or other materials
 * provided with the distribution.
 * Neither the name of the MasterCard International Incorporated nor the names of its
 * contributors may be used to endorse or promote products derived from this software
 * without specific prior written permission.
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES
 * OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT
 * SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
 * TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS;
 * OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER
 * IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING
 * IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF
 * SUCH DAMAGE.
 */

header('Content-Type: application/json');

if (!isset($_POST["amount"]) || !isset($_POST['simplifyToken'])) {
    echo json_encode(array('error' => "Please submit POST values with amount & simplifyToken params!"));
    return;
}

$token = $_POST['simplifyToken'];
$payment = $_POST["amount"];
$currency = isset($_POST["currency"]) ? $_POST["currency"] : 'USD';
$description = isset($_POST["description"]) ? $_POST["description"] : 'Awesome Shop Payment';
$cardName = isset($_POST["cardName"]) ? $_POST["cardName"] : 'Unknown';
$addressCountry = isset($_POST["addressCountry"]) ? $_POST["addressCountry"] : 'US';
$customerId = isset($_POST["customerId"]) ? $_POST["customerId"] : '';
$customerName = isset($_POST["customerName"]) ? $_POST["customerName"] : '';
$customerEmail = isset($_POST["customerEmail"]) ? $_POST["customerEmail"] : '';

$paymentPayload = array(
    'amount' => $payment,
    'token' => $token,
    'description' => $description,
    'currency' => $currency,
    'card' => array(
        'name' => $cardName,
        'addressCountry' => $addressCountry
    ),
    'customer' => 'e7RGzkoGX',
    'order' => array(
        //'customer'  => 'e7RGzkoGX',
        //'customerName' => $customerName,
        //'customerEmail' => $customerEmail
    )
);

$response = array();
try {
    $payment = Simplify_Payment::createPayment($paymentPayload);
    if ($payment->paymentStatus == 'APPROVED') {
        $response["id"] = $payment->{'id'};
    }
    $response["status"] = $payment->paymentStatus;
    
} catch (Exception $e) {
    $response['status'] = 'error';
    //error handling
    if ($e instanceof Simplify_ApiException) {
        $response["reference"] = $e->getReference();
        $response["message"] = $e->getMessage();
        $response["errorCode"] = $e->getErrorCode();
    }
    
    if ($e instanceof Simplify_BadRequestException && $e->hasFieldErrors()) {
        $fieldErrors = '';
        foreach ($e->getFieldErrors() as $fieldError) {
            $fieldErrors = $fieldErrors . $fieldError->getFieldName()
                . ": '" . $fieldError->getMessage()
                . "' (" . $fieldError->getErrorCode()
                . ")";
        }
        $response["fieldErrors"] = $fieldErrors;
    }
    $response["error"] = $e->getMessage();
}

// Send response:
echo json_encode($response);