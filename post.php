<?php 
    include "./cors.php";
    include "./db.php";
    
    $medicationType = $_POST["medicationType"];
    $clinicNumber = $_POST["clinicNumber"];
    $selectedSortValue = $_POST["selectedSortValue"];
    
    $ourQueryString = "INSERT INTO clinic_$clinicNumber (medication) VALUES ('$medicationType')"; 
    $dbresult = mysqli_query($connection, $ourQueryString);
    if($dbresult) {
        session_start();
        $_SESSION["selectedSortValue"] = $selectedSortValue;
        include "./get.php";
    } else {
        echo "<p>There's been an error adding the stock. Please try again.</p>";
        console.log(mysqli_error($connection));
    }
        
?>