<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evento;

class EventosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventos = [
            [
                'titulo' => 'Página Web del Colegio Madre Emilia',
                'descripcion' => 'Los estudiantes de 6to Año "U" crearon una pagina web, donde los estudiantes, profesores y administradores puedan flexibilizar sus tareas; los estudiantes pueden ver las actividades de las materias donde el profesor es quien las manda y en algunos casos los estudiantes pueden utilizar la plataforma para enviar tareas si es que tienen permisos por problemas de salud o deporte, además de poder enviar actividades, también puede registrar las notas del estudiante, así el estudiante puede ver sus notas y su promedio.

Mientras el administrador puede agregar los cursos, profesores, materias y estudiantes; e incluso puede subir publicaciones como esta en la plataforma y también tiene el el control total de las materias y poder gestionar las notas.

Y por ultimo tienen un apartado de chats, que son para enviar comentarios en las materias para comunicarse con los estudiantes y profesores.',
                'archivo' => 'hola.png',
                'tipoArchivo' => 'image/jpeg',
                'fecha' => '2025-01-11 00:59:19',
            ],
        ];

        foreach ($eventos as $evento) {
            Evento::create($evento);
        }
    }
}
