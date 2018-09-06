<?php
session_start();
require_once('model/model_pictures.php');
require_once('./controller/filter_inputs.php');

if (isset($_POST['raw'], $_POST['f']) && !empty($_POST['raw']) && !empty($_POST['f'])) {
    if (isset($_POST['src'])) {
        merge($_POST['raw'], $_POST['f'], $_POST['src']);
    } else {
        merge($_POST['raw'], $_POST['f']);
    }
} else {
    echo "Error ...";
}

function merge($raw, $filter, $src=null)
{
    $raw = check_input($raw);
    $filter = check_input($filter);

    date_default_timezone_set('Europe/Paris');
    $timestamp = date("YmdHis");
    $picture = new model_pictures();

    if (!file_exists('./masterpiece')) {
        mkdir('./masterpiece', 0777, true);
    }

    if ($raw && ($filter > 0) || ($filter < 20)) {
        $tmp_raw = $raw;
        $tmp_raw = str_replace('data:image/png;base64,', '', $tmp_raw);
        $tmp_raw = str_replace(' ', '+', $tmp_raw);
        $raw = $tmp_raw;

        file_put_contents('./masterpiece/IMG_' . $timestamp . '.png', base64_decode($raw));
        $photo = imagecreatefrompng('./masterpiece/IMG_' . $timestamp . '.png');

        switch ($filter) {
            case 1:
                $filter = imagecreatefrompng('./view/filters/bulbizard.png');
                break;
            case 2:
                $filter = imagecreatefrompng('./view/filters/salameche.png');
                break;
            case 3:
                $filter = imagecreatefrompng('./view/filters/carapuce.png');
                break;
            case 4:
                $filter = imagecreatefrompng('./view/filters/pikachu.png');
                break;
            case 5:
                $filter = imagecreatefrompng('./view/filters/mannequin.png');
                break;
            case 6:
                $filter = imagecreatefrompng('./view/filters/mannequin2.png');
                break;
            case 7:
                $filter = imagecreatefrompng('./view/filters/baby.png');
                break;
            case 8:
                $filter = imagecreatefrompng('./view/filters/bodybuilder.png');
                break;
            case 9:
                $filter = imagecreatefrompng('./view/filters/brain.png');
                break;
            case 10:
                $filter = imagecreatefrompng('./view/filters/brian.png');
                break;
            case 11:
                $filter = imagecreatefrompng('./view/filters/cat.png');
                break;
            case 12:
                $filter = imagecreatefrompng('./view/filters/dog.png');
                break;
            case 13:
                $filter = imagecreatefrompng('./view/filters/martymcfly.png');
                break;
            case 14:
                $filter = imagecreatefrompng('./view/filters/meme.png');
                break;
            case 15:
                $filter = imagecreatefrompng('./view/filters/rainbow.png');
                break;
            case 16:
                $filter = imagecreatefrompng('./view/filters/salt.png');
                break;
            case 17:
                $filter = imagecreatefrompng('./view/filters/shia.png');
                break;
            case 18:
                $filter = imagecreatefrompng('./view/filters/shia2.png');
                break;
            case 19:
                $filter = imagecreatefrompng('./view/filters/swag.png');
                break;
            default:
                echo "An error occured, please select a filter";
        }

        imagealphablending($filter, true);
        imagesavealpha($filter, true);

        imagecopy($photo, $filter, 100,120,0,0,200,200);

        imagepng($photo, './masterpiece/IMG_' . $timestamp . '.png');
        $path = './masterpiece/IMG_' . $timestamp . '.png';

        imagedestroy($photo);
        imagedestroy($filter);

        $id = $picture->getUserID($_SESSION['username']);
        $picture->saveMerging($id['ID'], $path, $timestamp);
        echo './masterpiece/IMG_' . $timestamp . '.png';

        if ($src !== null) {
            $src = explode("/uploads/", $src);
            unlink("./uploads/".$src[1]);
        }
    }
}