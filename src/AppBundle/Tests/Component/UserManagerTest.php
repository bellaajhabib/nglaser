<?php 
namespace AppBundle\Tests\Component;

use AppBundle\Component\UserManager;
use AppBundle\Entity\User;
use Liip\FunctionalTestBundle\Test\WebTestCase;


/**
 * Description of UserManagerTest
 *
 * @author student
 */
class UserManagerTest extends WebTestCase
{
    /** 
     * @var UserManager
     */
    private $usermanager;
    
    public function setUp()
    {
        parent::setUp();
        $this->loadFixtures(['AppBundle\DataFixtures\ORM\LoadUserData']);

        // you can now run your functional tests with a populated database
        $this->usermanager = $this->getContainer()->get('app.component.usermanager');
    }
    
    public function testRandomPasswordLength()
    {
        $this->assertEquals(8, strlen($this->usermanager->generateRandomPassword()));
        $this->assertNotEquals($this->usermanager->generateRandomPassword(), $this->usermanager->generateRandomPassword());
    }
    
    public function testSetUserPassword()
    {
        $user = $this->getContainer()->get('app.repository.user')->findOneBy(['email' => 'glaserpowssser@gmail.com']);
        $this->usermanager->resetUserPassword($user, 'bluemoo');
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'glaserpowssser@gmail.com',
            'PHP_AUTH_PW'   => 'bluemoo',
        ]);
        $client->request('GET', 'admin/dashboard');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('bluemoo', $this->usermanager->getPassword());
    }   
    
    public function testSetNewUser()
    {
        $user = new User();
        $this->usermanager->setNewUser($user);
        $this->assertTrue($user->getIsActive());
        $this->assertEquals(['ROLE_ADMIN'], $user->getRoles());
        $this->assertTrue(strlen($user->getPassword()) > 8);
        $this->assertEquals(8, strlen($this->usermanager->getPassword()));

    }
    
}
