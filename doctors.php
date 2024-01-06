<?php
include_once 'layout/header.php';
include_once 'includes/db.php';

$con1=Database::connect(); //connection
if($con1!=null)
{
    $sql="select * from doctors"; //string
    $statement=$con1->prepare($sql); // prepare statement
    //$statement->execute(); //run
    if($statement->execute())
    {
        $result=$statement->fetchAll(PDO::FETCH_ASSOC); //associative array
        
    }
    
}
else
{
    echo "Connect Again";
}
?>
<section class='doctors'>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-10">
                <table class='table table-stripped'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Speciality</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                for($count=0;$count<sizeof($result);$count++)
                {
                    echo '<tr>';
                    echo '<td>'.$result[$count]['id'].'</td>';
                    echo '<td>'.$result[$count]['name'].'</td>';
                    echo '<td>'.$result[$count]['phone'].'</td>';
                    echo '<td>'.$result[$count]['speciality'].'</td>';
                    echo '<td><a class="btn btn-danger">View</a></td>';
                    echo '</tr>';
                }
                ?>
                </table>
                
                
            </div>
        </div>
    </div>
</section>
<?php

include_once 'layout/footer.php';
?>