<?php

include realpath(__DIR__ . '/app/layout/header.php');

// Check if the form has been submitted
if (isset($_POST["submit"])) {
    // Retrieve the submitted data from the form
    $data = $_POST["data"];

    // Validate that the data is not empty
    if (empty($data)) {
        // If the data is empty, add an error message to the $invalid array
        array_push($invalid, "Data should not be empty.");
    } else {
        // Attempt to create a new entry with the provided data
        $create = $modelsFacade->create($data);
        // Check if the creation was successful
        if ($create) {
            // If successful, add a success message to the $success array
            array_push($success, "Data has been inserted successfully.");
        }
    }
}

?>

<?php include realpath(__DIR__ . '/errors.php') ?>
<form action="create.php" method="post">
    <input type="text" placeholder="Data" name="data">
    <button type="submit" name="submit">Submit</button>
</form>

<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>