<?php

/**
 * Компонент роутинг простых страниц.
 * Функция route($uri).
 * Принимает адрес, сравнивает его с маршрутами и выводит нужный нам маршрут.
 */

class Router {
    
     /**
     * string $uri 
     * return string
    */
    public static function route($uri) {
        if($uri === '/') {
            $route = 'Home page';
        } elseif($uri === '/about') {
            $route = 'About page';
        } else {
            $route = '404';
        }
        return $route;            
    }

}