<div style="font-family: Arial, Helvetica, sans-serif">
    <h1>Someone tried to reset the password</h1>

    <p>
        Someone tried to reset the password for this email at
        <a href="<?php echo ABS_URL ?>"><?php echo htmlspecialchars($_ENV["AIRPORT_NAME"]) ?></a>,
        but it is not registered. If this wasn't you, you can ignore this email.
    </p>

    <p>
        If it was you, click <a href="<?php echo htmlspecialchars(ABS_URL . 'auth/register') ?>">here</a>
        to go to the registration page.
    </p>
</div>
