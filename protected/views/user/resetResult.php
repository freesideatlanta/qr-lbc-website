<?php
/**
 * Reports result of a password reset attempt
 * @uses UserController $this
 */

$this->pageTitle = "!solate - Password Reset"; ?>
<?php if ($success): ?>
<h1>Reset Success!</h1>
<p>Your password has been reset.</p>
<?php else: ?>
<h1>Reset Error</h1>
<p>There was a problem resetting your password. Our staff has been
alerted of this problem. Please try again later.</p>
<?php endif; ?>