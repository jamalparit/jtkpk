<?php
/*
#############################################################################
#  
#  Developed & Published by:
#  Copyright (c) 2008 by ZULMD DOT COM (IP0445886-X). All right reserved.
#  Hakcipta Terpelihara (c) 2008 oleh ZULMD DOT COM (IP0445886-X)
#   
#  Website : http://www.zulmd.com
#  E-mail : enquiry@zulmd.com
#  Phone : +6013 500 9007 (Zulkifli Mohamed)
#
############################################################################
*/

defined('_WEB') or die('No Access');

function ValidImageType($data) {
    if (!preg_match('/(jpg|png|jpeg|gif)$/i', $data)) {
        return false;
    } else {
        return true;
    }   
}

function AllowedMediaType($thefile, $type) {
    $type = strtolower($type);
    if (preg_match("/$type/i", strtolower($thefile))) {
        return true;
    } else {
        return false;
    }
}

function compress_image($src, $dest , $quality)
{
    $info = getimagesize($src);
  
    if ($info['mime'] == 'image/jpeg' || $info['mime'] == 'image/jpg') 
    {
        $image = imagecreatefromjpeg($src);
    }
    elseif ($info['mime'] == 'image/gif') 
    {
        $image = imagecreatefromgif($src);
    }
    elseif ($info['mime'] == 'image/png') 
    {
        $image = imagecreatefrompng($src);
    }
    else
    {
        return false;
        die();
    }
  
    $jpgq = (100 - ($quality*10));
    imagejpeg($image, $dest, $jpgq);
    return true;
}

function compress_image_watermark($src, $dest , $stmimg, $quality, $watermark_loc) 
{
    $info = getimagesize($src);
  
    if ($info['mime'] == 'image/jpeg' || $info['mime'] == 'image/jpg') 
    {
        $im = imagecreatefromjpeg($src);
    }
    elseif ($info['mime'] == 'image/gif') 
    {
        $im = imagecreatefromgif($src);
    }
    elseif ($info['mime'] == 'image/png') 
    {
        $im = imagecreatefrompng($src);
    }
    else
    {
        return false;
        exit();
    }

    $stamp = imagecreatefrompng($stmimg);

    $sx = imagesx($stamp);
    $sy = imagesy($stamp);
    $imWidth=imagesx($im);
    $imHeight=imagesy($im);


    # Bottom Right
    if ($watermark_loc == "bottom-right") {
        $marge_right = 10;
        $marge_bottom = 10;
        imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
    }
    else
    {
        # Center
        imagecopy($im, $stamp, ($imWidth-$sx)/2, ($imHeight-$xy)/2, 0, 0, $sx, $sy);
    }
    
    imagepng($im, $dest, $quality); // Quality 0-9 | 0 = no compression
    $image = imagecreatefrompng($dest);
    $jpgq = (100 - ($quality*10));
    imagejpeg($image, $dest, $jpgq);

    return true;
}
?>