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
$error=false;
if(isset($_POST['submit'])){
   $doctor=$_POST['doctor'] ;
    if(isset($_POST['pname']) && !empty($_POST['pname']))
    {
        $patient=$_POST['pname'];
    }
    else
    {
        $error=true;
        $patient_error="Please fill patient name";
    }
    if(isset($_POST['phone']) && !empty($_POST['phone']))
    {
        $phone=$_POST['phone'];
    }
    else
    {
        $error=true;
        $phone_error="Please fill your phone number";
    }
    if(isset($_POST['date']) && !empty($_POST['date']))
    {
        $date=$_POST['date'];
    }
    else
    {
        $error=true;
        $date_error="Choose Appointment date";
    }

    if($error==false)
    {
        $sql="insert into appointments(doctor_id,patient_name,phone,date) values(:did,:pname,:phone,:date)";
        $statement=$con1->prepare($sql);
        $statement->bindParam(":did",$doctor);
        $statement->bindParam(":pname",$patient);
        $statement->bindParam(":phone",$phone);
        $statement->bindParam(":date",$date);
        if($statement->execute())
        {
            echo "Successfully added appointment";
        }
    }

}
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-2">

            </div>
            <div class="col-md-8">
                <form action="" method='post'>
                    <div class="mt-5">
                        <label for="" class='form-label'>Choose Doctor</label> <br>
                        <select name="doctor" id="" class='form-select w-100'>
                            <?php
                                for($count=0;$count<sizeof($result);$count++)
                                {
                                    echo '<option value='.$result[$count]['id'].'>'.$result[$count]['name'].":".$result[$count]['speciality'].'</option>';
                                }
                            ?>
                            
                        </select>
                        <br>
                    </div>
                    <div class='my-3'>
                        <br>
                        <label for="" class="form-label">Enter Patient Name</label>
                        <input type="text" name="pname" id="" class='form-control' value="<?php if(isset($patient)) echo $patient;?>">
                        <span class='text-danger'><?php if(isset($patient_error)) echo $patient_error; ?></span>
                    </div>
                    <div class='my-3'>
                        <br>
                        <label for="" class="form-label">Enter Patient Phone number</label>
                        <input type="text" name="phone" id="" class='form-control'>
                        <span class='text-danger'><?php if(isset($phone_error)) echo $phone_error; ?></span>
                    </div>
                    <div class='my-3'>
                        <br>
                        <label for="" class="form-label">Appointment Date</label>
                        <input type="date" name="date" id="" class='form-control'>
                        <span class='text-danger'><?php if(isset($date_error)) echo $date_error; ?></span>
                    </div>
                    <div class="my-3">
                        <button class='btn btn-primary' name='submit'>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
include_once 'layout/footer.php';
?>