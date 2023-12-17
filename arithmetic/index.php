<?php
  // Initialize variables
  $initial_value = "";
  $common_difference = "";
  $error = "";

  // Process form data
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $initial_value = filter_input(INPUT_POST, "initial_value", FILTER_SANITIZE_NUMBER_FLOAT);
    $common_difference = filter_input(INPUT_POST, "common_difference", FILTER_SANITIZE_NUMBER_FLOAT);

    // Validate input
    if (!is_numeric($initial_value) || !is_numeric($common_difference)) {
      $error = "Please enter valid numbers.";
    } else {
      // Calculate sequence details
      $explicit_formula = "a(n) = " . $initial_value . " + (" . $common_difference . ") * (n - 1)";
      $nth_term = isset($_POST["nth_term"]) ? (int) $_POST["nth_term"] : 0;
      $nth_term_value = $initial_value + ($common_difference * ($nth_term - 1));
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Arithmetic Sequence</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Arithmetic Sequence Calculator</h1>

  <?php if ($error): ?>
    <p class="error"><?php echo $error; ?></p>
  <?php endif; ?>

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="initial_value">Initial Value:</label>
    <input type="number" step="0.01" name="initial_value" id="initial_value" value="<?php echo $initial_value; ?>">

    <label for="common_difference">Common Difference:</label>
    <input type="number" step="0.01" name="common_difference" id="common_difference" value="<?php echo $common_difference; ?>">

    <button type="submit">Calculate</button>

    <label for="nth_term">Get the nth Term (optional):</label>
    <input type="number" name="nth_term" id="nth_term" placeholder="e.g., 5">
  </form>

  <?php if (!empty($explicit_formula)): ?>
    <h2>Explicit Formula:</h2>
    <p><?php echo $explicit_formula; ?></p>
  <?php endif; ?>

  <?php if (!empty($nth_term_value)): ?>
    <h2><?php echo $nth_term; ?>th Term Value:</h2>
    <p><?php echo $nth_term_value; ?></p>
  <?php endif; ?>

  <script src="script.js"></script>
</body>
</html>
