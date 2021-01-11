<?php
namespace SpotifyAPI;

Class Spotify
{

    private $access_token;
    private $client_id = '38bcc29fde5f43e0bf14c924b4cc8687';
    private $client_secret = '49fe725cf1db4ce9b51907ef907066ac';


    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
    }


    public function getToken()
    {

        $url = 'https://accounts.spotify.com/api/token';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: Basic ' . base64_encode($this->client_id . ':' . $this->client_secret),
            'Content-Type: application/x-www-form-urlencoded'
        ]);

        $response = curl_exec($curl);
        $response = json_decode($response,true);

        $this->setAccessToken($response['access_token']);
    }



    public function getArtistAlbum($artist_id, $params)
    {

        $url = 'https://api.spotify.com/v1/artists/' . $artist_id .'/albums' . '?' . http_build_query($params);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Bearer ' . $this->access_token
        ]);
        $response = curl_exec($curl);
        return $response;
    }
}
