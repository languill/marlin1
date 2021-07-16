<?php
/**
 * Компонент валидации входящих данных.
 * I. Функция validate($data).
 * Валидация означает проверку данных, вводимых пользователем.
 * Обеспечивает: 
 * 1. защиту от эксплойта,
 * 2. удаление ненужных символов (пробелы, табуляции, переходы на новую строку),
 * 3. из данных, вводимых пользователем, удаляется обратная косая черта (\).
 * 
 * Для использования: Validator::validate($_POST['field']); 
 * 
 * II. Функция checkLength($data).
 * Проверяет заполнено ли поле. Поле должно быть не пустым. 
 * Для использования: Validator::checkLength($_POST['field']); 
 */

class Validator {

    /**
     * string $data 
     * return string
    */
    public static function validate($data) { 
        return htmlspecialchars(stripslashes(trim($data)));        
    }

    /**
     * string $data 
     * return boolean
    */
    public static function checkLength($data) {
        $result = !empty($data) ? true : false;
        return $result;
    }
}

