<?php

require_once 'dbConfig.php';

function getAllApplicant($pdo) {
    $sql = "SELECT * FROM applicant_info
            ORDER BY applicantID ASC";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();

    if($executeQuery) {
        $response = array(
            "statusCode" => "200",
            "querySet" => $stmt -> fetchAll()
        );
    } else {
        $response = array(
            "statusCode" => "400",
            "message" => "Failed to get applicant!"
        );
    }
    return $response;
}


function getApplicantByID($pdo, $applicantID){
    $sql = "SELECT * FROM applicant_info WHERE applicantID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$applicantID]);

    if($executeQuery) {
        $response = array(
            "statusCode" => "200",
            "querySet" => $stmt -> fetch()
        );
    } else {
        $response = array(
            "statusCode" => "400",
            "message" => "Failed to get applicant " . $applicantID . "!"
        );
    }
    return $response;
}

function searchForApplicant($pdo, $searchQuery) {

    $sql = "SELECT * FROM applicant_info WHERE
            CONCAT(firstName, lastName, age, gender, a_birthday,a_email, contact_number, a_status, date_added)
            LIKE ?";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute(["%".$searchQuery."%"]);
    if($executeQuery) {
        $response = array(
            "statusCode" => "200",
            "querySet" => $stmt -> fetchAll()
    );
        } else {
        $response = array(
            "statusCode" => "400",
            "message" => "Failed to search applicant!"
        );
    }
    return $response;
}

function editApplicant($pdo, $firstName, $lastName, $age, $gender, $a_birthday, $a_email, $contact_number, $a_status, $applicantID) {
    $response = array();

    $query = "UPDATE applicant_info
            SET firstName = ?,
                lastName =?,
                age = ?,
                gender = ?,
                a_birthday = ?,
                a_email = ?,
                contact_number = ?,
                a_status = ?
            WHERE applicantID = ?
        ";
    $stmt = $pdo->prepare($query);
    $executeQuery = $stmt->execute([$firstName, $lastName, $age, $gender, $a_birthday, $a_email, $contact_number, $a_status, $applicantID]);

    if($executeQuery) {
        $response = array(
            "statusCode" => "200",
            "message" => "Application " . $applicantID . " edited successfully!"
        );
    } else {
        $response = array(
            "statusCode" => "400",
            "message" => "Failed to edit application " . $applicantID . "!"
        );
    }
    return $response;
}

function deleteApplicantByID($pdo, $applicantID) {
    $sql = "DELETE FROM applicant_info
            WHERE applicantID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$applicantID]);

    if($executeQuery) {
        $response = array(
            "statusCode" => "200",
            "message" => "Applicant " . $applicantID . " has been deleted!"
        );
    } else {
        $response = array(
            "statusCode" => "400",
            "message" => "Failed to delete applicant info " . $applicantID . "!"
        );
    }
    return $response;
}

function addApplicant($pdo, $firstName, $lastName, $age, $gender, $a_birthday, $a_email, $contact_number, $a_status) {
    $response = array();
    $query = "INSERT INTO applicant_info (firstName, lastName, age, gender, a_birthday, a_email, contact_number, a_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $statement = $pdo -> prepare($query);
    $executeQuery = $statement -> execute([$firstName, $lastName, $age, $gender, $a_birthday, $a_email, $contact_number, $a_status]);

    if($executeQuery) {
        $response = array(
            "statusCode" => "200",
            "message" => "Application submitted successfully!"
        );
    } else {
        $response = array(
            "statusCode" => "400",
            "message" => "Failed to submit application!"
        );
    }
    return $response;
}