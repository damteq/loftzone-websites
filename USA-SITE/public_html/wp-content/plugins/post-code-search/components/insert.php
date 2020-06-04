<?php

header('content-type: application/json');

require_once 'class.Postcode.php';

$data = [];

if (!isset($_POST['postcode']) || $_POST['postcode'] == '') :
    $data['result'] = 'Postcode not found.';
    $post_data = json_encode($data);
    print_r($post_data);
    exit();
else :
    $postcode = $_POST['postcode'];
endif;


$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);

require_once($parse_uri[0] . 'wp-config.php');

// Create connection

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$postcode = mysqli_real_escape_string($conn, $postcode);

// Check connection
if (!$conn) :
    die("Connection failed: " . mysqli_connect_error());
endif;
// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS postcodes (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
		postcode VARCHAR(15) NOT NULL,
		time datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		UNIQUE KEY id (id)
)";

$conn->query($sql);

$sql = "INSERT INTO postcodes (postcode) VALUES ('$postcode')";


// validate the format of a postcode
if (Postcode::isValidFormat($postcode)) :
    $postTown = Postcode::getPostTown($postcode);
    $unit = Postcode::getUnit($postcode);
    $area = Postcode::getArea($postcode);
    $district = Postcode::getDistrict($postcode);
    $nc = get_field('not_covered', 'options');
    $nc_array = explode(" ", $nc);
    $error = get_field('error_message', 'options');


    if (mysqli_query($conn, $sql)) :
        $data['result'] = "New postcode added successfully";
        $data['id'] = mysqli_insert_id($conn);
        $data['postcode'] = $postcode;
        $data['tracking'] = 'AW-995359367' ;
    else :
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    endif;

    mysqli_close($conn);


    if (in_array($area, $nc_array)) :
        $pagetitle = '<h4>' . $error . '</h4>';
    else :
        $pagetitle = '<h3>Your local installers</h3>';
        if (have_rows('array_repeater', 'options')):
            while (have_rows('array_repeater', 'options')): the_row();
                $acronym = get_sub_field('acronym');
                $postcodes = get_sub_field('postcodes');
                $tel = get_sub_field('telephone');
                $email = get_sub_field('email');
                $array = explode(" ", $postcodes);
                $name = get_sub_field('name');
                $link = get_sub_field('url');
                
                if (in_array($area, $array)) :
                    $data['suppliers'][$name]['name'] = $name;
                    $data['suppliers'][$name]['url'] = $link;
                    $data['suppliers'][$name]['acronym'] = $acronym;
                    $data['suppliers'][$name]['tel'] = $tel;
                    $data['suppliers'][$name]['email'] = $email;
                    $data['suppliers'][$name]['postcodes'] = $array;
                endif;
            endwhile;
        endif;
    endif;
    $data['title'] = $pagetitle;

else :
    $data['title'] = '<h4>You have entered an incorrect postcode.</h4>';
endif;

$post_data = json_encode($data);
print_r($post_data);