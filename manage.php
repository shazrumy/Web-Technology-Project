<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'settings.php';



// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Show login form if not logged in
if (!isset($_SESSION['manager'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>  
<html lang="en">  
<?php
    include 'header.inc';
?>  

<body class="page-manage bg-light">
     
    <header> 
      <p>We would like to acknowledge that the logo, key responsibilities, and qualifications used in this page 
        was created and assisted by ChatGPT</p>  
        <?php  include 'nav.inc';?>    
    </header> 
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Welcome, <?php echo $_SESSION['manager']; ?></h2>
        <a href="?logout=true" class="btn btn-danger btn-sm">Logout</a>
    </div>

    <div class="card p-4 mb-4 shadow-sm">
        <h4>Query EOIs</h4>
        <form method="post" class="row g-3 mt-2">
            <div class="col-md-4">
                <input type="text" name="jobRef" class="form-control" placeholder="Job Reference">
            </div>
            <div class="col-md-4">
                <button type="submit" name="listByJob" class="btn btn-outline-primary w-100">List EOIs by Job Ref</button>
            </div>
        </form>
        <form method="post" class="row g-3 mt-2">
            <div class="col-md-3"><input type="text" name="firstName" class="form-control" placeholder="First Name"></div>
            <div class="col-md-3"><input type="text" name="lastName" class="form-control" placeholder="Last Name"></div>
           <div class="col-md-3">
                <select name="sortBy" class="form-select">
                    <option value="">Sort By</option>
                    <option value="FirstName">First Name</option>
                    <option value="LastName">Last Name</option>
                    <option value="EOInumber">EOI Number</option>
                    <option value="JobReferenceNumber">Job Ref</option>
                    <option value="Status">Status</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" name="listByName" class="btn btn-outline-primary w-100">List EOIs by Name</button>
            </div>
        </form>
        <form method="post" class="row g-3 mt-4">
            <div class="col-md-4">
                <input type="text" name="deleteJobRef" class="form-control" placeholder="Job Ref to Delete">
            </div>
            <div class="col-md-4">
                <button type="submit" name="deleteByJob" class="btn btn-outline-danger w-100">Delete EOIs by Job Ref</button>
            </div>
        </form>
        <form method="post" class="row g-3 mt-4">
            <div class="col-md-3"><input type="number" name="eoiNumber" class="form-control" placeholder="EOI Number"></div>
            <div class="col-md-3">
                <select name="newStatus" class="form-select">
                    <option value="New">New</option>
                    <option value="Current">Current</option>
                    <option value="Final">Final</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" name="updateStatus" class="btn btn-outline-warning w-100">Update Status</button>
            </div>
        </form>
    </div>

    <?php
    // Utility to show results
    function showResults($results) {
        if ($results->num_rows > 0) {
            echo "<div class='table-responsive'><table class='table table-bordered table-striped'><thead><tr>";
            while ($field = $results->fetch_field()) {
                echo "<th>" . htmlspecialchars($field->name) . "</th>";
            }
            echo "</tr></thead><tbody>";
            while ($row = $results->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $val) {
                    echo "<td>" . htmlspecialchars($val) . "</td>";
                }
                echo "</tr>";
            }
            echo "</tbody></table></div>";
        } else {
            echo "<div class='alert alert-info'>No results found.</div>";
        }
    }

    // Logic handling
    // list EOI by job reference input
    if (isset($_POST['listByJob']) && !empty($_POST['jobRef'])) {
        $stmt = $conn->prepare("SELECT * FROM eoi WHERE JobReferenceNumber = ?");
        $stmt->bind_param("s", $_POST['jobRef']);
        $stmt->execute();
        $results = $stmt->get_result();
        echo "<h5>EOIs for Job Reference: " . htmlspecialchars($_POST['jobRef']) . "</h5>";
        showResults($results);
        $stmt->close();
    }
    // list EOI by name input
    if (isset($_POST['listByName'])) {
        $first = isset($_POST['firstName']) ? "%" . $_POST['firstName'] . "%" : "%";
        $last = isset($_POST['lastName']) ? "%" . $_POST['lastName'] . "%" : "%";

        // Define allowed columns for sorting
        $allowedSortFields = ['FirstName', 'LastName', 'EOInumber', 'JobReferenceNumber', 'Status'];
        $sortBy = isset($_POST['sortBy']) ? $_POST['sortBy'] : '';        
        // Use default sort or validate user input
        $orderClause = "";
        if (in_array($sortBy, $allowedSortFields)) {
            $orderClause = " ORDER BY $sortBy";
        }

        // Build full query
        $query = "SELECT * FROM eoi WHERE FirstName LIKE ? OR LastName LIKE ?" . $orderClause;

        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $first, $last);
        $stmt->execute();
        $results = $stmt->get_result();
        
        echo "<h5>EOIs for Applicant: " . htmlspecialchars($_POST['firstName']) . " " . htmlspecialchars($_POST['lastName']) . "</h5>";
        showResults($results);
        $stmt->close();
    }
    //delete EOIs by job reference input
    if (isset($_POST['deleteByJob']) && !empty($_POST['deleteJobRef'])) {
        $stmt = $conn->prepare("DELETE FROM eoi WHERE JobReferenceNumber = ?");
        $stmt->bind_param("s", $_POST['deleteJobRef']);
        $stmt->execute();
        echo "<div class='alert alert-success'>Deleted EOIs for job reference: " . htmlspecialchars($_POST['deleteJobRef']) . "</div>";
        $stmt->close();
    }
    // update status of applicant
    if (isset($_POST['updateStatus']) && !empty($_POST['eoiNumber']) && !empty($_POST['newStatus'])) {
        $stmt = $conn->prepare("UPDATE eoi SET Status = ? WHERE EOInumber = ?");
        $stmt->bind_param("si", $_POST['newStatus'], $_POST['eoiNumber']);
        $stmt->execute();
        echo "<div class='alert alert-warning'>Updated EOI #" . htmlspecialchars($_POST['eoiNumber']) . " to status " . htmlspecialchars($_POST['newStatus']) . "</div>";
        $stmt->close();
    }
    ?>
</div>
</body>
</html>


<?php
        include 'footer.inc';
?>