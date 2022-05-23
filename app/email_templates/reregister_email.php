<div style="font-family: Arial, Helvetica, sans-serif">
    <h1>Someone tried to re-register this email</h1>

    <p>
        You (or someone else) tried to register this email for
        <a href="<?php echo ABS_URL ?>"><?php echo htmlspecialchars($_ENV["AIRPORT_NAME"]) ?></a>
        , but it's already registered. Click
        <a href="<?php echo htmlspecialchars(ABS_URL . 'auth/login') ?>">here</a>
        to go to the login page
    </p>
</div>
