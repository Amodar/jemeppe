<?php
session_start();
include( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/loader.php' );
includeFile('backend/model/cookie.php');
includeFile('backend/model/Country.class.php');

$country = new Country($mysqli);
$countryName = $country->getCountryName();
?>

<html>
    <head>
        <?php includeFile('frontend/standard.php'); ?>
         <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/css/datepicker.min.css">
    
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/css/datepicker3.min.css">
    
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/js/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/js/locales/bootstrap-datepicker.en-GB.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/js/locales/bootstrap-datepicker.nl.min.js"></script>
        
        <script>
            $(function() {
                $('#datepicker input').datepicker({
                    format: "yyyy-mm-dd",
                    startView: 2,
                    startDate: "-110y",
                    endDate: "-16y"
                });
            });
        </script>
    </head>
    <body>
        <?php 
            includeFile('frontend/navigation.php');
        ?>
        <?php 
        if (isset($_GET['error'])) {
            if ($_GET['error'] == 1) {
                $error = "<h3>Sorry, something went wrong, try again.</h3>";
            }
        }
            
        ?>
        <div class="container">
            <?php
                if (isset($_GET['error'])) {
                    echo $error;
                }        
            ?>
            <br>
            <form action="en/registration/process" method="POST" role="form">
                <div class="form-group col-md-6">
                    <label for="email">Email</label> <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email adres" required autofocus>
                </div>
                <div class="form-group col-md-6">
                    <label for="password">Password</label> <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>
                
                <div class="form-group col-md-4">
                    <label for="firstname">First name</label> <input type="text" id="firstname" name="firstname"  class="form-control" placeholder="Enter your first name" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="middlename">Middle name</label> <input type="text" id="middlename" name="middlename"  class="form-control" placeholder="Enter your middle name">
                </div>
                <div class="form-group col-md-4">
                    <label for="lastname">Last name</label> <input type="text" id="lastname" name="lastname"  class="form-control" placeholder="Enter your last name" required>
                </div>
                <div class="form-group col-md-12">
                    <div class="checkbox">
                        <label>
                          <input type="radio" name="gender" value="male" required> <b>Male</b>
                        </label>
                        <label>
                          <input type="radio" name="gender" value="female" required> <b>Female</b>
                        </label>
                    </div>
                </div>
                
                <div class="form-group col-md-12 ">
                    <label>Birthdate</label>
                    <div class="input-group date" id="datepicker">
                        <input type="text" name="dob" id="dob" placeholder="Enter your birthdate" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                    </div>
                </div>
                
                <div class="form-group col-md-4">
                    <label for="houseNumber">Telephone no.</label> <input type="text" id="houseNumber" name="houseNumber"  class="form-control" placeholder="Enter your middle name">
                </div>
                <div class="form-group col-md-4">
                    <label for="mobileNumber">Mobile no.</label> <input type="text" id="mobileNumber" name="mobileNumber"  class="form-control" placeholder="Enter your middle name">
                </div>
                <div class="form-group col-md-4">
                    <label for="additionalNumber">Additional no.</label> <input type="text" id="additionalNumber" name="additionalNumber"  class="form-control" placeholder="Enter your middle name">
                </div>
                <div class="form-group col-md-3">
                    <label for="Country">Country</label> 
                    <select name="country" id="country" class="form-control" required>
                        <?php
                        foreach($countryName as $countryName) {
                            echo $countryName == "Netherlands" ? "<option selected value='$countryName'>" : "<option value='$countryName'>";
                            echo "$countryName</option>";
                        }
                        ?>
                        <option value="Netherlands">Netherlands</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="city">City</label> <input type="text" id="city" name="city" class="form-control" placeholder="Enter your city" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="zipcode">Zipcode</label> <input type="text" id="zipcode" name="zipcode"  class="form-control" placeholder="Enter your middle name" required>
                </div>
                
                <div class="form-group col-md-3">
                    <label for="adres">Adres</label> <input type="text" id="adres" name="adres"  class="form-control" placeholder="Enter your middle name" required>
                </div>
                <div class="form-group col-md-12 ">
                    <input type="submit" value="Create account" class="btn btn-default" class="form-control">
                </div>
            </form>
        </div>
    </body>
</html>