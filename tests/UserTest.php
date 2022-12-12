<?php
namespace App;

use LDAP\Result;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase{

    /** @test */
    public function addNewUserTest(){
        
        //Setup
        $userRepository = new UserRepository();
        $newUser = new User();
        $newUser->setId("1");
        $newUser->setName("Samuel");
        $newUser->setLastname("EA");
        $newUser->setEmail("samuel.ea19@gmail.com");
        $newUser->setPassword("123");
        $result = null;
        
        //Action
        $result = $userRepository->add($newUser);

        //Assertions
        $this->assertIsString($result);
        $this->assertIsInt((int) $result);
    }

    /** @test */
    public function findUserByIdTest(){

        //Setup
        $userRepository = new UserRepository();
        $result = null;
        
        //Action
        $result = $userRepository->find("1");

        //Assertions
        $this->assertEquals("1",$result->getId());
        $this->assertEquals("Samuel",$result->getName());
        $this->assertEquals("EA",$result->getLastname());
        $this->assertEquals("samuel.ea19@gmail.com",$result->getEmail());
        $this->assertEquals("123",$result->getPassword());
        $this->assertIsObject($result);
    }

    /** @test */
    public function updateUserByTest(){
        
        //Setup
        $userRepository = new UserRepository();
        $updateUser = new User();
        $updateUser->setId("1");
        $updateUser->setName("Carlos");
        $updateUser->setLastname("Garcia");
        $updateUser->setEmail("carlos.garcia199@gmail.com");
        $updateUser->setPassword("456");
        $result = null;
        
        //Action
        $result = $userRepository->update($updateUser);

        //Assertions
        $this->assertEquals($updateUser->getId(),$result->getId());
        $this->assertEquals($updateUser->getName(), $result->getName());
        $this->assertEquals($updateUser->getLastname(), $result->getLastname());
        $this->assertEquals($updateUser->getEmail(), $result->getEmail());
        $this->assertEquals($updateUser->getPassword(), $result->getPassword());
        $this->assertIsObject($result);
    }

    /** @test */
    public function deleteUserByIdTest(){
        
        //Setup
        $userRepository = new UserRepository();
        $result = null;
        
        //Action
        $result = $userRepository->delete("1");

        //Assertions
        $this->assertTrue($result);
    }

}