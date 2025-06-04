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


    <main id="about-us">  
        <h1 id="page-title">About Us</h1>
        <img src="../project2/images/group.jpg" id="group-pic" alt="group picture">
        <p>in order, from left to right; Shakila, Pal, Mak, Denura</p>
        <div class="group-info"> 
            <h3 class="about-header">Group Information</h3>  
                <p>Class time: Monday 10:30 AM to 12:30 PM</p>
                <p><strong>Student Details</strong></p>
                <p>Mak: 105920860</p>
                <p>Pal Patel: 105923966</p>
                <p>Denura: 105562893</p>
                <p>Shakila Hazrumy: 104100247</p>
        </div>  

        <div class="group-info">  
            <h3 class="about-header">Tutor</h3>  
            <p>Tutor: Rahul Raghavan</p>  
        </div>  

        <div class="group-info">  
            <h3 class="about-header">Members Contributions</h3>  
            <dl>  
                <dt>Mak(Software developer)</dt>  
                <dd>Created the jobs_db.php and connect_jobsdb.php.</dd>  
                <dt>Pal patel(Product Owner)</dt>  
                <dd>Created job descriptions, application page, and manager login page in manage.php.</dd>  
                <dt>Denura(Software developer)</dt>  
                <dd>Developed the About page, settings.php and added ascending or descending order in manage.php</dd>
                <dt>Shakila Hazrumy(Scrum Master)</dt>  
                <dd>Developed the Home page, manage.php, register.php, and did the CSS styles for the mentioned files.</dd>  
            </dl>  
        </div>  

        <!-- Members' Interests Table -->  
        <div class="group-info">  
            <h3 class="about-header">Members' Interests</h3>  
            <table>  
                    <tr>  
                        <th>Name</th>  
                        <th>Interests</th>  
                    </tr>    
                    <tr>  
                        <td>Mak</td>  
                        <td>Gaming, Programming, Music</td>  
                    </tr>  
                    <tr>  
                        <td>Pal patel</td>  
                        <td>Reading, Sports, Travel</td>  
                    </tr>  
                    <tr>  
                        <td>Denura</td>  
                        <td>Programming, Travel, Gaming</td>  
                    </tr>  
                    <tr>  
                        <td>Shakila Hazrumy</td>  
                        <td>Design, Photography</td>  
                    </tr>   
            </table>  
        </div>
        <div class="group-info">  
            <h3 class="about-header">Group Profile</h3>  
            <p>We are a diverse team of individuals with a passion for web development. Our common goal is to create an engaging project using modern web technologies.</p>  
        </div>  

        <div class="group-info">  
            <h3 class="about-header">Demographic Information</h3>  
            <ul>  
                <li>Mak: 21, from Melbourne, studying Computer Science</li>  
                <li>Pal patel: 22, from Sydney, studying Web Design</li>  
                <li>Denura: 20, from Victoria, studying Computer Science</li>
                <li>Shakila Hazrumy: 21, from Melbourne, studying Computer Science</li>  
            </ul>  
        </div>  

        <div class="group-info">  
            <h3 class="about-header">Hometown Descriptions</h3>  
            <p>Mak: Melbourne is known for its vibrant arts scene and coffee culture.</p>  
            <p>Pal patel: Sydney boasts iconic landmarks like the Sydney Opera House and beautiful beaches.</p>  
            <p>Denura: Victoria is recognized for its stunning landscapes, vineyards, and cultural festivals.</p>
            <p>Shakila Hazrumy: Melbourne is known for its vibrant arts scene and coffee culture.</p>  
        </div>  

        <div class="group-info">  
            <h3 class="about-header">Favorite Books, Music, and Films</h3>  
            <ul>  
                <li>Mak: Favorite Book - "1984", Music - Rock, Film - "Inception"</li>  
                <li>Pal patel: Favorite Book - "The Great Gatsby", Music - Jazz, Film - "The Shawshank Redemption"</li>  
                <li>Denura: Favorite Book - "To Kill a Mockingbird", Music - Pop, Film - "The Matrix"</li>
                <li>Shakila Hazrumy: Favorite Book - "1984", Music - Rock, Film - "Inception"</li>   
            </ul>  
        </div>    
    </main>  

    <?php
        include 'footer.inc';
    ?>

</body>
</html>
