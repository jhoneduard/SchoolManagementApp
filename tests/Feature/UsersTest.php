<?php

namespace Tests\Feature;

use App\Models\User;

use Tests\TestCase;

class UsersTest extends TestCase
{
    /**
     * prueba unitaria para verificar la obtencion del servicio de obtener usuarios
     *
     * @return void
     */
    public function testGetUsers()
    {
        $response = $this->get('/users');
        $response->assertStatus(200);
    }

    /**
     * prueba unitaria para verificar la obtencion de un usuario en particular
     * @return void
     */
    public function testGetUserById()
    {
        $user = User::findOrFail(1);
        $this->assertEquals('admin@gmail.com', $user->email);
    }

    /*
    Vamos a realizar la prueba en la creacion de un usuario 
    * @return void
    */
    public function testCreateUser()
    {
        $response = $this->postJson(
            '/registerUser',
            [
                'identification' => '1069763864',
                'document_type' => 'C.C',
                'names' => 'Jhon',
                'surnames' => 'Triana',
                'email' => 'eduardtriana15@gmail.com',
                'phone' => 3102249912,
                'id_category' => 2 // Estudiante
            ]
        );
        $response->assertStatus(200);
    }

    /* Vamos a realizar la modificacion de un dato del registro anterior...
    * @return void
    */
    public function testUpdateUser()
    {
        $userUpdate = User::where('email', '=', 'eduardtriana15@gmail.com')->first();
        $response = $this->putJson(
            '/user/update',
            [
                'id' => $userUpdate->id,
                'names' => 'Jhon Eduard',
                'surnames' => 'Triana Vargas',
                'phone' => 3102249912,
            ]
        );
        $response->assertStatus(200);
    }

    /*  vamos a inactivar el usuario creado con anterioridad
    * @return void
    */
    public function testChangeStateByUser()
    {
        $userUpdate = User::where('email', '=', 'eduardtriana15@gmail.com')->first();
        $response = $this->putJson(
            '/user/chanceState/' . $userUpdate->id,
            [
                'accion' => 0, // inactivar el usuario
            ]
        );
        $response->assertStatus(200);
    }

    /*
        Vamos a eliminar un usuario que este registrado en el sistema, por ejemplo existe un usuario con id 2, al eliminarlo debemos eliminarlo sin problemas....
        * @return void
    */
    public function testDeleteUserById()
    {
        $userDelete = User::where('email', '=', 'eduardtriana15@gmail.com')->first();
        $response = $this->delete('/user/' . $userDelete->id);
        $response->assertStatus(200);
    }
}
