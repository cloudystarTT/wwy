<?php

include realpath(__DIR__ . '/app/layout/header.php');

if (isset($_POST["register"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $address = $_POST["address"];

    if (empty($email)) {
        array_push($invalid, "Email should not be empty.");
    }
    if (empty($password)) {
        array_push($invalid, "Password should not be empty.");
    }
    if (empty($name)) {
        array_push($invalid, "Name should not be empty.");
    }
    if (empty($address)) {
        array_push($invalid, "Address should not be empty.");
    }

    if (count($invalid) == 0) {
        $verifyEmail = $usersFacade->verifyEmail($email);
        if ($verifyEmail == 0) {
            $password = md5($password);
            $addUser = $usersFacade->addUser($name, $address, $email, $password);
            if ($addUser) {
                header("Location: login.php?userAdded");
            }
        } else {
            array_push($invalid, "Email already been taken.");
        }
    }
}

?>

<style>
    html,
    body {
        height: 100%;
    }

    body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #8A5082;
    }

    .form {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }

    .form .checkbox {
        font-weight: 400;
    }

    .form .form-floating:focus-within {
        z-index: 2;
    }

</style>


<main class="form">
    <form action="register.php" method="post">
        <h1 class="h3 mb-3 fw-normal text-light">Register</h1>
        <?php include realpath(__DIR__ . '/errors.php') ?>
        <div class="form-floating">
            <input type="text" class="form-control" id="name" placeholder="Name" name="name">
            <label for="firstName"> Enter your Name:</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="address" name="address" placeholder="Address" autocomplete="off">
            <label for="address">Enter your Address:</label> 
        </div>
        <div class="form-floating">
            <input type="email" class="form-control" id="email" placeholder="Email" name="email">
            <label for="email">Email</label>
        </div>
        <div class="form-floating mb-4">
            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
            <label for="password">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-warning text-light" type="submit" name="register">Register</button>
        <p class="text-light mt-2">Already had an account? <a href="login.php" class="text-decoration-none text-warning">Login Now</a></p>
    </form>
</main>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcX-e3_IzAQX0oFYEblWVOh6izY8m6rk4&libraries=places&callback=initAutocomplete" async defer></script>
<script>
    function initAutocomplete() {
        const input = document.getElementById('address');
        const autocomplete = new google.maps.places.Autocomplete(input);
    }
</script>


<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>