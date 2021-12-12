<?php 
    include "./cors.php";
    include "./db.php";

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }; //checks if session has been started

    if ($_POST["selectedSortValue"] == "allClinics" || $_SESSION["selectedSortValue"] == "allClinics") {
        allClinics($connection);
    } else {
        lowMedClinics($connection);
    };

    function allClinics($connection) {
        for ($clinicNumber = 1; $clinicNumber <= 10; $clinicNumber++) {
            $ourQueryString = "SELECT * FROM clinic_$clinicNumber"; 
            $dbresult = mysqli_query($connection, $ourQueryString);
            $rows = mysqli_fetch_all($dbresult, MYSQLI_ASSOC); //returns an array
            if (mysqli_num_rows($dbresult) > 0) {
                $count_Nev = 0;
                $count_Stav = 0;
                $count_Zid = 0;
                foreach($rows as $row) {
                    if ($row["medication"] == "NEVIRAPINE") {
                        $count_Nev = $count_Nev + 1;
                    };
                    if ($row["medication"] == "STAVUDINE") {
                        $count_Stav = $count_Stav + 1;
                    };
                    if ($row["medication"] == "ZIDOTABINE") {
                        $count_Zid = $count_Zid + 1;
                    };
                };
    
                echo "<h2>Clinic $clinicNumber Medication</h2>";
                    if ($count_Nev < 5) {
                        echo "<small>Low on NEVIRAPINE</small>";
                    };
                    if ($count_Stav < 5) {
                        echo "<small>Low on STAVUDINE</small>";
                    };
                    if ($count_Zid < 5) {
                        echo "<small>Low on ZIDOTABINE</small>";
                    };
                echo   "<div class='meds'>
                        <div class='med'>
                            <p>NEVIRAPINE</p>
                            <p>$count_Nev items</p>
                            <button id='NevAdd' name=$clinicNumber>Add</button>
                            <button id='NevRemove' name=$clinicNumber>Remove</button>
                        </div>
                        <div class='med'>
                            <p>STAVUDINE</p>
                            <p>$count_Stav items</p>
                            <button id='StavAdd' name=$clinicNumber>Add</button>
                            <button id='StavRemove' name=$clinicNumber>Remove</button>
                        </div>
                        <div class='med'>
                            <p>ZIDOTABINE</p>
                            <p>$count_Zid items</p>
                            <button id='ZidAdd' name=$clinicNumber>Add</button>
                            <button id='ZidRemove' name=$clinicNumber>Remove</button>
                        </div>
                    </div>";
            } else {
                echo "<p>No medication for Clinic $clinicNumber</p>";
            };
        };
    };
    
    function lowMedClinics($connection) {
        for ($clinicNumber = 1; $clinicNumber <= 10; $clinicNumber++) {
            $ourQueryString = "SELECT * FROM clinic_$clinicNumber"; 
            $dbresult = mysqli_query($connection, $ourQueryString);
            $rows = mysqli_fetch_all($dbresult, MYSQLI_ASSOC); //returns an array
            if (mysqli_num_rows($dbresult) > 0) {
                $count_Nev = 0;
                $count_Stav = 0;
                $count_Zid = 0;
                foreach($rows as $row) {
                    if ($row["medication"] == "NEVIRAPINE") {
                        $count_Nev = $count_Nev + 1;
                    }
                    if ($row["medication"] == "STAVUDINE") {
                        $count_Stav = $count_Stav + 1;
                    }
                    if ($row["medication"] == "ZIDOTABINE") {
                        $count_Zid = $count_Zid + 1;
                    }
                };
    
                if ($count_Nev < 5 || $count_Stav < 5 || $count_Zid < 5) {
                    echo "<h2>Clinic $clinicNumber Medication</h2>";
                    if ($count_Nev < 5) {
                        echo "<small>Low on NEVIRAPINE</small>";
                    };
                    if ($count_Stav < 5) {
                        echo "<small>Low on STAVUDINE</small>";
                    };
                    if ($count_Zid < 5) {
                        echo "<small>Low on ZIDOTABINE</small>";
                    };
                    echo   "<div class='meds'>
                                <div class='med'>
                                    <p>NEVIRAPINE</p>
                                    <p>$count_Nev items</p>
                                    <button id='NevAdd' name=$clinicNumber>Add</button>
                                    <button id='NevRemove' name=$clinicNumber>Remove</button>
                                </div>
                                <div class='med'>
                                    <p>STAVUDINE</p>
                                    <p>$count_Stav items</p>
                                    <button id='StavAdd' name=$clinicNumber>Add</button>
                                    <button id='StavRemove' name=$clinicNumber>Remove</button>
                                </div>
                                <div class='med'>
                                    <p>ZIDOTABINE</p>
                                    <p>$count_Zid items</p>
                                    <button id='ZidAdd' name=$clinicNumber>Add</button>
                                    <button id='ZidRemove' name=$clinicNumber>Remove</button>
                                </div>
                            </div>";
                };
            } else {
                echo "<p>No medication for Clinic $clinicNumber</p>";
            };
        };
    };
    


?>