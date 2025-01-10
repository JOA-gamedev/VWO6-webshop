<?php

//CSRF protection
if ($_SERVER["REQUEST_METHOD"] =='POST') {
    if (!validateToken()) {
        http_response_code(401);
        view('401',['error'=>"CSRF-token mismatch error."]);
        die();
    }
}