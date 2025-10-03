<?php

class Feedback
{
    private static function ensureSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function setSuccess(string $message): void
    {
        self::ensureSession();
        $_SESSION['success_message'] = $message;
    }

    public static function setError(string $message): void
    {
        self::ensureSession();
        $_SESSION['error_message'] = $message;
    }

    public static function setSuccessAndRedirect(string $message, string $location): void
    {
        self::setSuccess($message);
        header('Location: ' . $location);
        exit;
    }

    public static function setErrorAndRedirect(string $message, string $location): void
    {
        self::setError($message);
        header('Location: ' . $location);
        exit;
    }
}
