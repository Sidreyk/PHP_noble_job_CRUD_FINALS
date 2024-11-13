<?php
require_once 'dbConfig.php';
require_once 'models.php';

if (isset($_POST['insertApplicantBtn'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $a_birthday = $_POST['a_birthday'];
    $a_email = $_POST['a_email'];
    $contact_number = $_POST['contact_number'];
    $a_status = $_POST['a_status'];
 
    $function = addApplicant($pdo, $firstName, $lastName, $age, $gender, $a_birthday, $a_email, $contact_number, $a_status);

    if($function){
        $_SESSION['message'] = "Successfully inserted applicant!";
            header("Location: ../index.php");

            if($function['statusCode'] == "200") {
                $_SESSION['message'] = $function['message'];
                header('Location: ../index.php');
            } else {
                $_SESSION['message'] = "Error " . $function['statusCode'] . ": " . $function['message'];
                header('Location: ../index.php');
        }
    }
}

if(isset($_POST['editApplicantBtn'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $a_birthday = $_POST['a_birthday'];
    $a_email = $_POST['a_email'];
    $contact_number = $_POST['contact_number'];
    $a_status = $_POST['a_status'];
    $applicantID = $_GET['applicantID'];

    $function = editApplicant($pdo, $firstName, $lastName, $age, $gender, $a_birthday, $a_email, $contact_number, $a_status, $applicantID);

    if($function['statusCode'] == "200") {
        $_SESSION['message'] = $function['message'];
        header('Location: ../index.php');
    } else {
        $_SESSION['message'] = "Error " . $function['statusCode'] . ": " . $function['message'];
        header('Location: ../index.php');
    }
}

if(isset($_POST['deleteApplicantBtn'])) {
    $function = deleteApplicantByID($pdo, $_GET['applicantID']);

    if($function['statusCode'] == "200") {
        $_SESSION['message'] = $function['message'];
        header('Location: ../index.php');
    } else {
        $_SESSION['message'] = "Successfully Deleted " . $function['statusCode'] . ": " . $function['message'];
        header('Location: ../index.php');
    }
}

if (isset($_GET['searchBtn'])) {
    $searchForApplicant = searchForApplicant($pdo, $_GET['searchInput']);
    foreach ($searchForApplicant as $row) {
        echo "<try>
                <td>{$row['applicantID']}</td>
				<td>{$row['firstName']}</td>
				<td>{$row['lastName']}</td>
				<td>{$row['age']}</td>
				<td>{$row['gender']}</td>
				<td>{$row['a_birthday']}</td>
				<td>{$row['a_email']}</td>
				<td>{$row['contact_number']}</td>
				<td>{$row['a_status']}</td>
                </tr>";
    }
}
?>