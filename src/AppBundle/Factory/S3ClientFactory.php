<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Factory;

use JMS\DiExtraBundle\Annotation as JMS;
use Aws\S3\S3Client;

/**
 * Description of S3Client
 * @JMS\Service("app.factory.s3clientfactory")
 * @author student
 */
class S3ClientFactory 
{

    static public function getS3Client($key, $secret, $region, $version)
    {
        return S3Client::factory([
            'version'     => 'latest',
            'region'      => 'us-west-2',
            'credentials' => [
                'key'    => 'abc',
                'secret' => '123'
            ]
        ]);
    }
}
