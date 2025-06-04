<!DOCTYPE html>
<html lang="en">
<?php
    include 'header.inc'; 
?>  

<body class="page-general">
    <header>   
        <p>We would like to acknowledge that the logo, key responsibilities, and qualifications used on this 
            page were created and assisted by ChatGPT.</p>  
        <?php include 'nav.inc'; ?>   
    </header>  
    
<main>
    <h1 id="page-title">Job Opportunities</h1>

    <?php
        require_once("settings.php");

        // Establish a connection to the database
        $dbconn = mysqli_connect($host, $user, $password, $database);

        if (!$dbconn) {
            die("<p>Connection failed: " . mysqli_connect_error() . "</p>"); // Better error handling message 
        }

        // Define the SQL query
        $sql = "SELECT job_ref, title, salary_range, reports_to, description, key_responsibilities, education, experience FROM jobs_database";
        $result = $dbconn->query($sql);

        if ($result && $result->num_rows > 0) {
            $positionCounter = 0;

            echo '<div class="job-wrapper">';
            echo '<div class="job-listings">';

            while ($row = $result->fetch_assoc()) {
                $ref = htmlspecialchars($row['job_ref']);
                $title = htmlspecialchars($row['title']);
                $sal = htmlspecialchars($row['salary_range']);
                $report = htmlspecialchars($row['reports_to']);
                $desc = htmlspecialchars($row['description']);
                $key_rsp = htmlspecialchars($row['key_responsibilities']);
                $edu = htmlspecialchars($row['education']);
                $exp = htmlspecialchars($row['experience']);

                $key_rsp_items = array_filter(array_map('trim', explode('.', $key_rsp))); // Out put dot points after .
                $edu_items = array_filter(array_map('trim', explode('|', $edu))); // Out put dot points after |
                $exp_items = array_filter(array_map('trim', explode('|', $exp))); // Out put dot points after |
                $positionCounter++;

                echo <<<HTML
                <h2 class="job-title">Position $positionCounter: $title</h2>
                <section>
                    <div class="job-details">
                        <p><strong>Reference Number:</strong> $ref</p>
                        <p><strong>Position Title:</strong> $title</p>
                        <p><strong>Salary Range:</strong> $sal</p>
                        <p><strong>Reports To:</strong> $report</p>
                        <p><strong>Description:</strong> $desc</p>
                        
                        <h3>Key Responsibilities</h3>
                        <ul>
                HTML;

                foreach ($key_rsp_items as $item) {
                    echo "<li>$item.</li>"; // Gives dot points
                }

                echo <<<HTML
                        </ul>
                        <h3>Qualification and Skills</h3>
                        <ol>
                            <li><strong>Education:</strong>
                                <ul>
                HTML;

                foreach ($edu_items as $item) {
                    echo "<li>$item.</li>"; // Gives dot points 
                }

                echo <<<HTML
                                </ul>
                            </li>
                            <li><strong>Experience:</strong>
                                <ul>
                HTML;

                foreach ($exp_items as $item) {
                    echo "<li>$item.</li>"; // Gives dot points 
                }

                echo <<<HTML
                                </ul>
                            </li>
                        </ol>
                    </div>
                </section>
                HTML;
            }

            echo '</div>'; // .job-listings

            echo <<<HTML
            <aside class="why-it-matters">
                <h3>Why IT Careers Matter</h3>
                <p>The IT industry shapes the future—whether through securing digital environments or developing intelligent systems. Careers in IT are not just jobs—they’re opportunities to create impact, solve real-world problems, and drive innovation.</p>
                <p>Whether you protect networks or teach machines to think, there's a place for your passion in tech.</p>
            </aside>
            HTML;

            echo '</div>'; // .job-wrapper
        } else {
            echo "<p>No job listings available at the moment.</p>";
        }

        $dbconn->close();
    ?>

    <div>
        <a href="apply.php" id="applyBtn">Apply Now</a>
    </div>
</main>

<?php include 'footer.inc'; ?>
</body>
</html>
