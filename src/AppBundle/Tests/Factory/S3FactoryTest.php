<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Tests\Factory;

use AppBundle\Component\EmailManager;
use AppBundle\Entity\User;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Aws\S3\S3Client;

/**
 * Description of testS3Factory
 *
 * @author student
 */
class S3FactoryTest extends WebTestCase
{
    /** 
     * @group s3
     */
    public function testGetS3ClientReturnS3Client()
    {
       $s3Client = $this->getContainer()->get('app.factory.s3Client');
       $this->assertTrue($s3Client instanceof S3Client);      
    }
}
