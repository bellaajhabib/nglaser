<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Component;

use AppBundle\Factory\S3ClientFactory;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use AppBundle\Helpers\FileHelper;
use JMS\DiExtraBundle\Annotation as JMS;
use AppBundle\Helper\StringHelper;
use Aws\S3\S3Client;
/**
 * Description of S3Manager
 * @JMS\Service("app.component.s3manager")
 * @author student
 */
class S3Manager 
{
    const PUBLIC_READ = 'public-read';
    
    /** 
     * @var S3Client 
     */
    protected $s3;
    
    /** 
     * @var string
     */
    private $bucket;
    
    /** 
     * @var StringHelper 
     */
    private $stringHelper;
    
    
    /**
     * @JMS\InjectParams({
     *     "s3Client"         = @JMS\Inject("app.factory.s3Client"),
     *     "stringHelper"     = @JMS\Inject("app.helper.stringhelper"), 
     *     "bucket"           = @JMS\Inject("%amazon_s3_bucket%")
     * })
     */
    public function __construct(S3Client $s3Client, StringHelper $stringHelper, $bucket) 
    {
        $this->bucket = $bucket;
        $this->stringHelper = $stringHelper;
        $this->s3 = $s3Client;
    }
    
    /** 
     * Uplaods the file and return the key for amazon
     * @param UploadedFile $uploaded
     * @return string
     */
    public function upload(UploadedFile $uploaded)
    {
        $key =  $this->stringHelper->randomString() . ".".  $uploaded->getClientOriginalExtension();
        $this->s3->putObject([
            'Key' => $key, 
            'SourceFile' => $uploaded->getPathname(),
            'Bucket' => $this->bucket,
            'ACL'  => self::PUBLIC_READ,
        ]);
        return $key;
    }
    
    /** 
     * Get url the object
     * @param type $key
     * @return string
     */
    public function getUrlForObject($key)
    {
        return $this->s3->getObjectUrl($this->bucket, $key);
    }
    
    /** 
     * Remove Object From s3
     * @param string $key
     */
    public function removeObjectFromS3($key)
    {
        $this->s3->deleteObject([
            'Bucket' => $this->bucket,
            'Key' => $key
        ]);
    }
    
    
}
