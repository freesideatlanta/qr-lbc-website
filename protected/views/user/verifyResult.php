<?php
/**
 * Reports the result of an attempt to verify an email
 * @uses UserController $this
 * @uses boolean $success If verification was successful
 * @uses string $email Email app tried to verify
 */


if ($success): ?>

<h1>Thank You!</h1>
<p><?php echo $email; ?> is now verified.</p>

<?php else: ?>

<h1>Verification Error</h1>
<p>There was a problem verifying <?php echo $email; ?>.
Either the address does not exist in our records or an
internal error was encountered.</p> 

<?php endif; ?>