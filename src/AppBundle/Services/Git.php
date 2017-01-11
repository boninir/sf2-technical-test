<?php

namespace AppBundle\Services;

use GuzzleHttp\Client;

class Git
{
    const GITHUB_API_URL = 'https://api.github.com/';
    const GITHUB_USER_REPOS = 'users/%s/repos';

    /**
     * @param string $gitUserName
     *
     * @return mixed
     */
    public function getRepos($gitUserName)
    {
        $url = self::GITHUB_API_URL . sprintf(self::GITHUB_USER_REPOS,$gitUserName);
        $client = new Client();

        $res = $client->request('GET', $url);
        $repos = json_decode($res->getBody()->getContents());

        return $repos;
    }

}