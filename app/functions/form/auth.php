<?php

/**
 * Function checks if user is logged in
 *
 * @return bool
 */
function is_logged_in(): bool
{
    if ($_SESSION) {
        $fileDB = new FileDB(DB_FILE);
        $fileDB->load();

        return (bool) $fileDB->getRowWhere('users', [
            'email' => $_SESSION['email'],
            'password' => $_SESSION['password']
        ]);
    }

    return false;
}

/**
 * Ends session.
 * Makes session data clean and destroys server side cookie
 * If it is written redirects to location
 *
 * @param string|null $redirect
 */
function logout(string $redirect = null): void
{
    session_unset();
    session_destroy();
    header("Location: /$redirect");
}
