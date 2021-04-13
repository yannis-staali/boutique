<?php

namespace Core\Alert;

class Alert
{

    static function setAlert($type, $messages)
    {
        $_SESSION['alert'][$type] = [];
        foreach ($messages as $message) {
            $_SESSION['alert'] = [$type => $messages];
        }
        return $_SESSION['alert'];
    }

    static function viewAlert()
    {
        if (!empty($_SESSION['alert'])) {
            $alerts = $_SESSION['alert'];
            unset($_SESSION['alert']);
            $html = '';
            $html .= '<ul class="' . key($alerts) . '">';
            foreach ($alerts as $alert) {
                foreach ($alert as $message) {
                    $html .= '<li>' . $message . '</li>';
                }
            }
            $html .= '</ul>';
            return $html;
        }
        return null;
    }
}