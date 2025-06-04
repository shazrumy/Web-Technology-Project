<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'settings.php';

?>
<!DOCTYPE html>  
<html lang="en">  
<?php
    include 'header.inc';
?>  
<body class="page-general enhancement">
    
 <header>   
        <header>
    <h1>Process EOI</h1>
            <?php
                include 'nav.inc';
             ?>   
    </header>  

<?php
function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$jobReferenceNumber = isset($_POST['jobRef']) ? clean_input($_POST['jobRef']) : '';
$firstName = isset($_POST['firstName']) ? clean_input($_POST['firstName']) : '';
$lastName = isset($_POST['lastName']) ? clean_input($_POST['lastName']) : '';
$streetAddress = isset($_POST['street']) ? clean_input($_POST['street']) : '';
$suburbTown = isset($_POST['suburb']) ? clean_input($_POST['suburb']) : '';
$state = isset($_POST['state']) ? strtoupper(clean_input($_POST['state'])) : '';
$postcode = isset($_POST['postcode']) ? clean_input($_POST['postcode']) : '';
$emailAddress = isset($_POST['email']) ? clean_input($_POST['email']) : '';
$phoneNumber = isset($_POST['phone']) ? clean_input($_POST['phone']) : '';

// Skills - check if selected in skills[] array
$skills = isset($_POST['skills']) ? $_POST['skills'] : [];
$html = in_array('HTML', $skills) ? "Yes" : NULL;
$css = in_array('CSS', $skills) ? "Yes" : NULL;
$javaScript = in_array('JavaScript', $skills) ? "Yes" : NULL;
$python = in_array('Python', $skills) ? "Yes" : NULL;

// Other skills only if user typed something
$otherSkills = (isset($_POST['otherSkills']) && !empty(trim($_POST['otherSkills']))) ? clean_input($_POST['otherSkills']) : NULL;

// State and postcode validation
$statePostcodeStart = [
    "VIC" => ["3"],
    "NSW" => ["1", "2"],
    "QLD" => ["4"],
    "NT"  => ["0"],
    "WA"  => ["6"],
    "SA"  => ["5"],
    "TAS" => ["7"],
    "ACT" => ["0"]
];

if (empty($state) || empty($postcode)) {
    die("State and postcode are required.");
}

if (!array_key_exists($state, $statePostcodeStart)) {
    die("Invalid state selected.");
}

if (!preg_match('/^\d{4}$/', $postcode)) {
    die("Postcode must be exactly 4 digits.");
}

$postcodeStart = substr($postcode, 0, 1);
if (!in_array($postcodeStart, $statePostcodeStart[$state])) {
    die("Postcode does not match the selected state.");
}

$sql = "INSERT INTO eoi 
    (JobReferenceNumber, FirstName, LastName, StreetAddress, SuburbTown, State, Postcode, EmailAddress, PhoneNumber, HTML, CSS, JavaScript, Python, OtherSkills)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param(
    "ssssssssssssss",
    $jobReferenceNumber,
    $firstName,
    $lastName,
    $streetAddress,
    $suburbTown,
    $state,
    $postcode,
    $emailAddress,
    $phoneNumber,
    $html,
    $css,
    $javaScript,
    $python,
    $otherSkills
);

if ($stmt->execute()) {
    echo "<h2>Application submitted successfully!</h2>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
// i would like to acknowldge the use of CHAT GPT 
// in order to assist me in finising this task
?>



</body>
</html>

<?php include('footer.inc'); ?>