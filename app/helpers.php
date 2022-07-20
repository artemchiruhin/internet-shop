<?php

if(!function_exists('get_image_path')) {
    function get_image_path($path) {
        if($path === null || !file_exists(public_path('/storage/' . $path))) {
            return 'https://thumbs.dreamstime.com/b/no-image-available-icon-photo-camera-flat-vector-illustration-132483097.jpg';
        }
        return asset('/storage/' . $path);
    }
}
