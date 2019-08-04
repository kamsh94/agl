<?php

function TextResponse($text){
    return response($text)->header('Content-Type', 'text/plain');
}
