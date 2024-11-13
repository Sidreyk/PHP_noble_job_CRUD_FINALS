<?php 
require_once "core/dbConfig.php";
require_once "core/models.php";
?>

<html>
    <head>
        <title>Police Applicant Form</title>
        <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    </head>
    <body>
        <h2>Teacher Job Application</h2>

        <?php if (isset($_SESSION['message'])) { ?>
            <h3 style="color: red;">	
                <?php echo $_SESSION['message']; ?>
            </h3>
	    <?php } unset($_SESSION['message']); ?>

        Would you like to add new applicant?
        <input type="submit" value="Submit New Applicant" onclick="window.location.href='insertinfo.php'">
        <br>
        
        <hr style="width: 99%; height: 2px; color: black; background-color: black;">

        <div style="display: flex; align-items: center;">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
                <label for="searchBar">Search</label>
                <input type="text" name="searchBar">
                <input type="submit" name="searchButton" value="Search application">
                <input type="submit" name="clearButton" value="Clear search query" onclick="window.location.href='index.php'">
            </form>
        </div>

        <table>
            <tr>
                <th colspan="12", style="font-size: 18px;">Police Applicant</th>
            </tr>

            <tr>
                <th>Applicant ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Email Address</th>
                <th>Contact Number</th>
                <th>Status</th>
                <th>Date Added</th>
                <th>Actions</th>
            </tr>

            <?php
            if(isset($_GET['searchButton'])) {
                $searchedApplicationsData = searchForApplicant($pdo, $_GET['searchBar'])['querySet'];
                foreach($searchedApplicationsData as $row) {
            ?>
            <tr>
                <td><?php echo $row['applicantID']?></td>
                <td><?php echo $row['firstName']?></td>
                <td><?php echo $row['lastName']?></td>
                <td><?php echo $row['age']?></td>
                <td><?php echo $row['gender']?></td>
                <td><?php echo $row['a_birthday']?></td>
                <td><?php echo $row['a_email']?></td>
                <td><?php echo $row['contact_number']?></td>
                <td><?php echo $row['a_status']?></td>
                <td><?php echo $row['date_added']?></td>
                <td>
                    <input type="submit" value="EDIT" onclick="window.location.href='editinfo.php?applicantID=<?php echo $row['applicantID']; ?>';">
                    <input type="submit" value="DELETE" onclick="window.location.href='deleteinfo.php?applicantID=<?php echo $row['applicantID']; ?>';">
                </td>
            </tr>

            <?php }} else {
            $applicantData = getAllApplicant($pdo)['querySet'];
            foreach($applicantData as $row) {
            ?>
            <tr>
                <td><?php echo $row['applicantID']?></td>
                <td><?php echo $row['firstName']?></td>
                <td><?php echo $row['lastName']?></td>
                <td><?php echo $row['age']?></td>
                <td><?php echo $row['gender']?></td>
                <td><?php echo $row['a_birthday']?></td>
                <td><?php echo $row['a_email']?></td>
                <td><?php echo $row['contact_number']?></td>
                <td><?php echo $row['a_status']?></td>
                <td><?php echo $row['date_added']?></td>
                <td>
                    <input type="submit" value="EDIT" onclick="window.location.href='editinfo.php?applicantID=<?php echo $row['applicantID']; ?>';">
                    <input type="submit" value="DELETE" onclick="window.location.href='deleteinfo.php?applicantID=<?php echo $row['applicantID']; ?>';">
                </td>
            </tr>
            <?php }} ?>
        </table>
    </body>
</html>