<div style="font-family: Arial, Helvetica, sans-serif">
    <h1>Verify your email address</h1>

    <p>
        You (or someone else) registered this email for
        <a href="<?php echo ABS_URL ?>"><?php echo htmlspecialchars($_ENV["AIRPORT_NAME"]) ?></a>
    </p>
    <p>Click the link below to verify your email:</p>

    <a href="<?php echo ABS_URL . 'auth/verify-email/' . $token ?>">Verify email</a>
</div>
