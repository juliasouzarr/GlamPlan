<?php
class Alertas
{
    public static function success($message)
    {
        echo "<div class='alert text-center alert-success' role='alert'>
                $message
            </div>";
    }

    public static function danger($message)
    {
        echo "<div class='alert text-center alert-danger' role='alert'>
            $message
        </div>";
    }
}
