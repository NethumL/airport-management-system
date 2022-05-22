<div style="font-family: Arial, Helvetica, sans-serif">
    <h1>Reset your password</h1>

    <p>
        You (or someone else) tried to reset the password for this email at
        <a href="<?php echo ABS_URL ?>"><?php echo htmlspecialchars($_ENV["AIRPORT_NAME"]) ?></a>
        If it was you, click the link below to reset your password.
    </p>
    <p>If this wasn't you, you can ignore this email.</p>

    <a href="<?php echo ABS_URL . 'auth/reset-password/' . $token ?>">Reset your password</a>
</div>
