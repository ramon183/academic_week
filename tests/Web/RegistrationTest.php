<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use AcademicDirectory\Domains\Users\DefaultUserRepository;
use AcademicDirectory\Domains\People\PeopleRepository;
use AcademicDirectory\Domains\Users\InstituitionRepository;

class RegistrationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegisterDefaultUser()
    {
        $defaultUserRepository = new DefaultUserRepository();
        $peopleRepository = new PeopleRepository();
        $data = [
            'email' => 'rodrigog@gmail.com',
            'password' => '12345',
            'rg' => '87987546',
            'name' => 'Rodrigo',
            'role_id' => 3,
        ];
        $User = $defaultUserRepository->create($data);
        $data['user_id'] = $User['id'];
        $peopleRepository->create($data);
        $this->seeInDatabase('users', [
            'email' => 'rodrigog@gmail.com',
        ]);
        $this->seeInDatabase('people', [
            'name' => 'Rodrigo',
        ]);
    }

    public function testRegisterDefaultUserWithInstituition()
    {
        $defaultUserRepository = new DefaultUserRepository();
        $peopleRepository = new PeopleRepository();
        $instituitionRepository = new InstituitionRepository();
        $data = [
            'email' => 'joazinho@gmail.com',
            'password' => '123456',
            'rg' => '87987546',
            'name' => 'João Almeida Rodrigues',
            'role_id' => 3,
        ];
        $User = $defaultUserRepository->create($data);
        $data['user_id'] = $User['id'];
        $Person = $peopleRepository->create($data);
        $data['registry_number'] = '12345645';
        $data['person_id'] = $Person['id'];
        $instituitionRepository->addPerson($data);

        $this->seeInDatabase('users', [
            'email' => $data['email'],
        ]);
        $this->seeInDatabase('people', [
            'name' => $data['name'],
        ]);
        $this->seeInDatabase('instituition_people', [
            'person_id'=>$data['person_id']
        ]);
    }
}
