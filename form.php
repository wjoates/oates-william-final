<?php 
include 'top.php';


$dataIsGood = false;
$message = '';

$fullName = '';
$email = '';
$phone = '';
$position = '';
$availability = '';
$experience = '';

function getData($field) {
    if (!empty($_POST[$field])) {
        return htmlspecialchars(trim($_POST[$field]));
    } else {
        return '';
    }
}

if($_SERVER["REQUEST_METHOD"] == 'POST') {
    // Sanitize and validate form data
    $fullName = getData('txtFullName');
    $email = filter_var(getData('txtEmail'), FILTER_SANITIZE_EMAIL);
    $phone = getData('txtPhone');
    $position = getData('position');
    $availability = getData('availability');
    $experience = getData('experience');

    // Validation
    $dataIsGood = true;

    if(empty($fullName) || empty($email) || empty($phone) || empty($position) || empty($availability) || empty($experience)){
        $message .= '<p class="mistake">Please fill out all required fields.</p>';
        $dataIsGood = false;       
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $message .= '<p class="mistake">Email contains invalid characters.</p>';    
        $dataIsGood = false;   
    }

    // If data is valid, proceed to process
    if($dataIsGood) {
        // Prepare SQL insert statement
        $sql = "INSERT INTO job_applications (full_name, email, phone, position, availability, experience) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $success = $stmt->execute([$fullName, $email, $phone, $position, $availability, $experience]);

        if ($success) {
            // Email content
            $to = $email; // Send email to the form submitter
            $subject = "Thank You for Your Application";
            $body = "Hello $fullName,\n\nThank you for applying for a position at Ahli Baba's Kabob Shop. We have received your application for the $position position. We will review your application and contact you shortly!\n\nBest Regards,\nAhli Baba's Kabob Shop";
            $headers = "From: woates@uvm.edu" . "\r\n" .
                       "Reply-To: woates@uvm.edu" . "\r\n" .
                       "X-Mailer: PHP/" . phpversion();

            mail($to, $subject, $body, $headers);

            $message .= '<h2>Thank You</h2>';
            $message .= '<p>Your application was successfully submitted and a confirmation email has been sent to your address.</p>';
        } else {
            $message .= '<p class="mistake">An error occurred while submitting your application. Please try again later.</p>';
        }
    }
}
?>

<main>
    <section id="job-description">
        <h2>Join Ahli Baba's Kabob Shop Team!</h2>
        <p>We're excited to hear from you! Please fill out the job application form below to apply for a position at Ahli Babas!</p>
    </section>

    <section id="application-form">
        <h2>Job Application Form</h2>
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="#" id="jobApplicationForm" method="post">
            <fieldset class="contact">
                <legend>Your Information</legend>
                <p>
                    <label class="required" for="txtFullName">Full Name:</label>
                    <input id="txtFullName" name="txtFullName" type="text" class="txtLabel" value="<?php echo $fullName; ?>" required>
                </p>
                <p>
                    <label class="required" for="txtEmail">Email:</label>
                    <input id="txtEmail" name="txtEmail" type="email" class="txtLabel" value="<?php echo $email; ?>" required>
                </p>
                <p>
                    <label class="required" for="txtPhone">Phone:</label>
                    <input id="txtPhone" name="txtPhone" type="tel" class="txtLabel" value="<?php echo $phone; ?>" required>
                </p>
            </fieldset>

            <fieldset>
                <legend>Position Applying For</legend>
                <p>
                    <input id="restaurantPosition" name="position" type="radio" value="Restaurant Position" <?php echo ($position == 'Restaurant Position') ? 'checked' : ''; ?> required>
                    <label for="restaurantPosition">Restaurant Position</label>
                </p>
                <p>
                    <input id="localVendingPosition" name="position" type="radio" value="Local Vending Position" <?php echo ($position == 'Local Vending Position') ? 'checked' : ''; ?> required>
                    <label for="localVendingPosition">Local Vending Position</label>
                </p>
                <p>
                    <input id="travelingVendingPosition" name="position" type="radio" value="Traveling Vending Position" <?php echo ($position == 'Traveling Vending Position') ? 'checked' : ''; ?> required>
                    <label for="travelingVendingPosition">Traveling Vending Position</label>
                </p>
            </fieldset>

            <fieldset>
                <legend>Availability</legend>
                <p>
                    <label for="availability">Enter your Soonest Start Date:</label><br>
                    <input id="availability" name="availability" type="text" class="txtLabel" value="<?php echo $availability; ?>" required>
                </p>
            </fieldset>

            <fieldset>
                <legend>Previous Experience</legend>
                <p>
                    <label for="experience">Briefly describe any relevant experience:</label><br>
                    <textarea id="experience" name="experience" rows="4" cols="50" required><?php echo $experience; ?></textarea>
                </p>
            </fieldset>

            <fieldset class="buttons">
                <input id="btnSubmit" name="btnSubmit" type="submit" value="Submit">
            </fieldset>
        </form>
    </section>

</main>
<?php include 'footer.php'; ?>
