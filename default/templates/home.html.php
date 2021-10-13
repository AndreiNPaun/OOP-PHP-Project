<p>Welcome to Jo's Jobs, we're a recruitment agency based in Northampton. We offer a range of different office jobs. Get in touch if you'd like to list a job with us.</a></p>

<h2>List of soon to close jobs; deadline below for each job.</h2>
<ul>
            
    <?php
    foreach ($jobs as $job) { 
    ?>
        <ul>
        <li>Job title: <b><?=$job['title']?></b></li>
        <li>Salary: <b><?=$job['salary']?></b></li>
        <li>Deadline: <b><?=$job['closingDate']?></b></li>
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['user_type'] === 'basic'){#
            ?>
            <a href="/category?id=  <?=$job['categoryId']?>">Check Job</a>
            <?php
        }
        ?>
        </ul>
        <hr>
        </br>
    <?php
    }
    ?>

</ul>