<?php

namespace Tests\Feature;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationCourseTest extends TestCase
{

    /* test para crear un curso
    * @return void
    */
    public function testCreateCourse()
    {
        // Registramos un docente
        $this->postJson(
            '/registerUser',
            [
                'identification' => '434243242234',
                'document_type' => 'C.C',
                'names' => 'juliana torres',
                'surnames' => 'montoya',
                'email' => 'july123@gmail.com',
                'phone' => '4324223443',
                'id_category' => 3 // Docente
            ]
        );

        $infoTeacher = User::where('email', '=', 'july123@gmail.com')->first();
        // Registramos la asignatura
        $response = $this->postJson(
            '/registerSubject',
            [
                'description' => 'Desarrollo web con angular',
                'end_date' => '2023-07-08',
                'id_category_subject' => 1,
                'id_teacher' => $infoTeacher->id,
                'initial_date' => '2023-07-01',
                'name' => 'Desarrollo web con angular'
            ]
        );
        $response->assertStatus(200);
    }

    /** test para obtener cursos disponibles
     *
     * @return void
     */
    public function testGetCoursesAvailable()
    {
        // Nos autenticamos en el sistema
        $this->get('/login')->assertSee('Login');
        $credentials = [
            "email" => "admin@gmail.com",
            "password" => "Admin12345"
        ];

        $this->post('/login', $credentials);
        // Obtenemos cursos disponibles
        $response = $this->get('/course-available');
        $response->assertStatus(200);
    }

    /** test para obtener cursos recomendados
     *
     * @return void
     */
    public function testGetCoursesRecommendations()
    {
        // Nos autenticamos en el sistema
        $this->get('/login')->assertSee('Login');
        $credentials = [
            "email" => "admin@gmail.com",
            "password" => "Admin12345"
        ];

        $this->post('/login', $credentials);
        // Obtenemos cursos recomendados
        $response = $this->get('/course-recommendations');
        $response->assertStatus(200);
    }

    /* eliminamos el docente y curso que creamos
    *  @return void
    */
    public function  testDeleteTeacherAndCourse()
    {
        $userDelete = User::where('email', '=', 'july123@gmail.com')->first();

        // Eliminamos curso
        $courseDelete = Subject::where('description', '=', 'Desarrollo web con angular')
            ->where('id_teacher', '=', $userDelete->id)
            ->first();
        $response = $this->delete('/subject/' . $courseDelete->id);
        $response->assertStatus(200);

        // Eliminamos docente en la BD
        $response = $this->delete('/user/' . $userDelete->id);
        $response->assertStatus(200);
    }
}
