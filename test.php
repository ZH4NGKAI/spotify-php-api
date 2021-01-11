<?php

include "Spotify.php";

$spotify = new \SpotifyAPI\Spotify();

$spotify->getToken();
$params = array(
    'market' => 'US',
    'limit' => '3'
);
header('Content-Type: application/json');
echo $spotify->getArtistAlbum("06HL4z0CvFAxyc27GXpf02", $params);
