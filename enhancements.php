<!DOCTYPE html>  
<html lang="en">  
<?php
    include 'header.inc';
?>  
<body class="page-general enhancement">
    
 <header>   
        <header>
            <?php
                include 'nav.inc';
             ?>   
    </header>  

<?php
// Define each enhancement as an array for clarity and potential reuse
$enhancements = [
    [
        "title" => "1. Create manager registration page",
        "code" => "The register.php file handles manager account creation by validating 
        username and password requirements, securely hashing the password, and storing the information in the existing 'manager' table inside the 'Job_Application' database 
        table using prepared statements.",
    ],
    [
        "title" => "2. Allowed managers to view EOIs based on what order they'd want",
        "code" => "On top of allowing managers to look through the database based on what information they have. Managers have the option to list
        the EOIs based on their preference. The drop list allows managers to list it based on first name, last name, EOI number, job reference number, and status",

    ],
    [
        "title" => "3. Disable Website Access on Multiple Invalid Login Attempts",
        "description" => "Implemented logic to track failed login attempts and temporarily disable access for a user after three or more invalid login attempts. This improves security by mitigating brute-force attacks.",
        "code" => "// Pseudocode Example (login.php):\nif (failed_attempts >= 3) {\n    disable_access_for(time_period);\n} else {\n    proceed_with_login();\n}"
    ],
    [
        "title" => "4. Added a manager login form to control access to manage.php",
        "code" => "Users would have to login first when trying to access features provided by the manage.php"
    ],
    [
        "title" => "5. Locks out users with 3 failed login attempts",
        "code" => "In manage.php, users that fail to login with the correct credentials will be locked out for a certain period of time"
    ],

    
];

// Output each enhancement as a section
foreach ($enhancements as $enhancement) {
    echo "<section>";
    echo "<h2>{$enhancement['title']}</h2>";
    echo "<p>{$enhancement['description']}</p>";
    echo "<code>{$enhancement['code']}</code>";
    echo "</section>";
}
?>

</body>
</html>

