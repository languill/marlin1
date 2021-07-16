<?php

/**
 * Компонент флеш-сообщений.
 * Компонент записывает нужное сообщение в сессию.
 * 
 * Для использования: Flash::outputMessage('Нужное сообщение');
 */

class Flash {
    /**
     * string $message 
     * return string
    */
    public static function outputMessage($message) {        
        $_SESSION['message'] = $message; 
        return $_SESSION['message'];     
    }
}