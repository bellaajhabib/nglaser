<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Tests\Component;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use AppBundle\Component\S3Manager;

/**
 * Description of S3ManagerTest
 *
 * @author student
 */
class S3ManagerTest extends WebTestCase
{
    
   
    public function testS3Upload()
    {
        
        $uploadedFile = $this->getMockBuilder('Symfony\Component\HttpFoundation\File\UploadedFile')->disableOriginalConstructor()->getMock();
        $uploadedFile->expects($this->once())->method('getClientOriginalExtension')->willReturn('jpg');
        $uploadedFile->expects($this->once())->method('getPathname')->willReturn('random/path/file.jpg');
        $stringHelper = $this->getMockBuilder('AppBundle\Helper\StringHelper')->disableOriginalConstructor()->getMock();
        $stringHelper->expects($this->once())->method('randomString')->willReturn('random_string');
        $bucketName = 'mrbucket';
        $s3Client = $this->getMockBuilder('Aws\S3\S3Client')->disableOriginalConstructor()->setMethods(['putObject', 'getObjectUrl', 'deleteObject'])->getMock();
        $s3Client->expects($this->once())->method('putObject')->with([ 
                'Key' => 'random_string.jpg', 
                'SourceFile' => 'random/path/file.jpg',
                'Bucket' => $bucketName,
                'ACL'  => S3Manager::PUBLIC_READ
            ]);
        
        $s3Manager = new S3Manager($s3Client, $stringHelper, $bucketName);
        $s3Manager->upload($uploadedFile);
    }
    
    public function testS3GetURL()
    {
        $stringHelper = $this->getMockBuilder('AppBundle\Helper\StringHelper')->disableOriginalConstructor()->getMock();
        $bucketName = 'mrbucket';
        $s3Client = $this->getMockBuilder('Aws\S3\S3Client')->disableOriginalConstructor()->setMethods(['putObject', 'getObjectUrl', 'deleteObject'])->getMock();
        $s3Client->expects($this->once())->method('getObjectUrl')->with( $bucketName, 'random_key.png');
        $s3Manager = new S3Manager($s3Client, $stringHelper, $bucketName);
        $s3Manager->getUrlForObject('random_key.png');
    }
    
    public function testDeleteObject()
    {
        $stringHelper = $this->getMockBuilder('AppBundle\Helper\StringHelper')->disableOriginalConstructor()->getMock();
        $bucketName = 'mrbucket';
        $s3Client = $this->getMockBuilder('Aws\S3\S3Client')->disableOriginalConstructor()->setMethods(['putObject', 'getObjectUrl', 'deleteObject'])->getMock();
        $s3Client->expects($this->once())->method('deleteObject')->with(['Bucket' => $bucketName,'Key' => 'random_key.jpg' ]);
        $s3Manager = new S3Manager($s3Client, $stringHelper, $bucketName);
        $s3Manager->removeObjectFromS3('random_key.jpg');

    }
}
