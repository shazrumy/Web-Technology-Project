<!DOCTYPE html>  
<html lang="en">  
<?php
    include 'header.inc';
?>  
<body class="page-general">
    
 <header>   
            <?php
                include 'nav.inc';
             ?>   
    </header>  

<main>
    <h2>Job Application Form</h2>
    <form action="process_eoi.php" method="POST" class="apply-form">

        <fieldset>
            <legend>Personal Details</legend>
            <label for="jobRef">Job Reference Number</label>
            <select id="jobRef" name="jobRef" required>
                <option value="">-- Select a job --</option>
                <option value="G04C1">G04C1 - Cloud Engineer</option>
                <option value="G04X7">G04X7 - Cyber Security Specialist</option>
            </select>

            <label for="firstName">First Name</label>
            <input type="text" id="firstName" name="firstName" required placeholder="Enter your First name"/>

            <label for="lastName">Last Name</label>
            <input type="text" id="lastName" name="lastName" required placeholder="Enter your Last name"/>
        </fieldset>

        <fieldset>
            <legend>Address</legend>
            <label for="street">Street Address</label>
            <input type="text" id="street" name="street" required placeholder="Enter your Street address"/>

            <label for="suburb">Suburb/Town</label>
            <input type="text" id="suburb" name="suburb" required placeholder="Enter your Suburb"/>

            <label for="state">State</label>
            <input type="text" id="state" name="state" required placeholder="Enter your State"/>

            <label for="postcode">Postcode</label>
            <input type="text" id="postcode" name="postcode" required pattern="\d{4}" title="Please enter a 4-digit postcode" placeholder="Please enter a 4 digit postcode" />
        </fieldset>

        <fieldset>
            <legend>Contact Info</legend>
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required placeholder="Enter your email" />

            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" required pattern="[\d\s\-\+\(\)]+" title="Please enter a valid phone number"  placeholder="Enter your phone number"/>
        </fieldset>

        <fieldset>
            <legend>Skills</legend>
            <div class="skills-checkbox-group">
                <label>Select your skills:</label>
                <div class="checkbox-options">
                    <label><input type="checkbox" name="skills[]" value="HTML"> HTML</label>
                    <label><input type="checkbox" name="skills[]" value="CSS"> CSS</label>
                    <label><input type="checkbox" name="skills[]" value="JavaScript"> JavaScript</label>
                    <label><input type="checkbox" name="skills[]" value="Python"> Python</label>
                </div>
            </div>

            <label>
                <input type="checkbox" id="otherSkillsCheckbox"> Other Skills
            </label>

            <div id="otherSkillsContainer" style="display: none;">
                <label for="otherSkills">Describe Other Skills</label>
                <textarea id="otherSkills" name="otherSkills" placeholder="Describe any other relevant skills..."></textarea>
            </div>
        </fieldset>

        <button type="submit">Submit Application</button>
    </form>
</main>

<?php include('footer.inc'); ?>

<script>
    const checkbox = document.getElementById('otherSkillsCheckbox');
    const container = document.getElementById('otherSkillsContainer');
    const textarea = document.getElementById('otherSkills');

    checkbox.addEventListener('change', function () {
        if (this.checked) {
            container.style.display = 'block';
        } else {
            container.style.display = 'none';
            textarea.value = '';
        }
    });
</script>
</body>
</html>

<!-- i would like to acknowldge the use of CHAT GPT in order to assist me in finising this task -->
