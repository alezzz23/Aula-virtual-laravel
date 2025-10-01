<?php

use App\Http\Controllers\{
    AuthController,
    DashboardController,
    CursoController,
    MateriaController,
    AsistenciaController,
    NotaController,
    UsuarioController,
    TareaController,
    EventoController,
    ArchivoController,
    ReporteController,
    PersonalizarController,
    PeriodoClaseController,
    FechaController
};
use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::get('/', function () {
    return redirect()->route('login');
});

// Autenticación
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Rutas protegidas
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/estudiante', [DashboardController::class, 'estudiante'])->name('dashboard.estudiante');

    // Rutas para Admin
    Route::middleware('check.role:Admin')->group(function () {
        
        // Usuarios
        Route::resource('usuarios', UsuarioController::class);
        Route::get('/estudiantes', [UsuarioController::class, 'estudiantes'])->name('estudiantes.index');
        Route::get('/profesores', [UsuarioController::class, 'profesores'])->name('profesores.index');
        Route::get('/docentes', [UsuarioController::class, 'docentes'])->name('docentes.index');

        // Cursos
        Route::resource('cursos', CursoController::class);
        Route::get('/cursos/{curso}/alumnos', [CursoController::class, 'alumnos'])->name('cursos.alumnos');
        Route::post('/cursos/{curso}/profesor-guia', [CursoController::class, 'asignarProfesorGuia'])->name('cursos.asignar-profesor-guia');
        Route::delete('/prof-guia/{profGuia}', [CursoController::class, 'eliminarProfesorGuia'])->name('prof-guia.destroy');

        // Materias
        Route::resource('materias', MateriaController::class);

        // Periodos
        Route::get('/periodos', [PeriodoClaseController::class, 'index'])->name('periodos.index');
        Route::post('/periodos', [PeriodoClaseController::class, 'store'])->name('periodos.store');
        Route::delete('/periodos/{periodo}', [PeriodoClaseController::class, 'destroy'])->name('periodos.destroy');

        // Fechas/Eventos del calendario
        Route::get('/fechas', [FechaController::class, 'index'])->name('fechas.index');
        Route::post('/fechas', [FechaController::class, 'store'])->name('fechas.store');
        Route::put('/fechas/{fecha}', [FechaController::class, 'update'])->name('fechas.update');
        Route::delete('/fechas/{fecha}', [FechaController::class, 'destroy'])->name('fechas.destroy');

        // Eventos/Publicaciones
        Route::resource('eventos', EventoController::class);

        // Personalización
        Route::get('/personalizar', [PersonalizarController::class, 'index'])->name('personalizar.index');
        Route::post('/personalizar', [PersonalizarController::class, 'update'])->name('personalizar.update');
    });

    // Rutas para Admin y Profesor
    Route::middleware('check.role:Admin,Profesor/a')->group(function () {
        
        // Asistencia
        Route::get('/asistencia', [AsistenciaController::class, 'index'])->name('asistencia.index');
        Route::get('/asistencia/curso/{curso}', [AsistenciaController::class, 'porCurso'])->name('asistencia.curso');
        Route::get('/asistencia/materia/{materia}', [AsistenciaController::class, 'porMateria'])->name('asistencia.materia');
        Route::post('/asistencia', [AsistenciaController::class, 'store'])->name('asistencia.store');
        Route::get('/asistencia/ver/{materia}', [AsistenciaController::class, 'ver'])->name('asistencia.ver');
        Route::put('/asistencia/{asistencia}', [AsistenciaController::class, 'editar'])->name('asistencia.editar');
        Route::delete('/asistencia/{asistencia}', [AsistenciaController::class, 'eliminar'])->name('asistencia.eliminar');

        // Notas
        Route::get('/notas', [NotaController::class, 'index'])->name('notas.index');
        Route::get('/notas/curso/{curso}', [NotaController::class, 'porCurso'])->name('notas.curso');
        Route::get('/notas/materia/{materia}', [NotaController::class, 'porMateria'])->name('notas.materia');
        Route::post('/notas', [NotaController::class, 'store'])->name('notas.store');
        Route::put('/notas/{nota}', [NotaController::class, 'update'])->name('notas.update');
        Route::delete('/notas/{nota}', [NotaController::class, 'destroy'])->name('notas.destroy');
        Route::get('/notas/promedios/{curso}/{periodo}', [NotaController::class, 'promedios'])->name('notas.promedios');
        Route::get('/notas/deficientes/{curso}', [NotaController::class, 'deficientes'])->name('notas.deficientes');

        // Tareas
        Route::resource('tareas', TareaController::class);
        Route::get('/materias/{materia}/tareas', [TareaController::class, 'verTareas'])->name('materias.tareas');
        Route::get('/materias/{materia}/tareas-enviadas', [TareaController::class, 'tareasEnviadas'])->name('materias.tareas-enviadas');

        // Archivos
        Route::get('/materias/{materia}/clases', [ArchivoController::class, 'indexClases'])->name('materias.clases');
        Route::post('/materias/{materia}/clases', [ArchivoController::class, 'storeClase'])->name('materias.clases.store');
        Route::delete('/clases/{clase}', [ArchivoController::class, 'destroyClase'])->name('clases.destroy');

        Route::get('/materias/{materia}/videos', [ArchivoController::class, 'indexVideos'])->name('materias.videos');
        Route::post('/materias/{materia}/videos', [ArchivoController::class, 'storeVideo'])->name('materias.videos.store');
        Route::delete('/videos/{video}', [ArchivoController::class, 'destroyVideo'])->name('videos.destroy');

        Route::get('/materias/{materia}/enlaces', [ArchivoController::class, 'indexEnlaces'])->name('materias.enlaces');
        Route::post('/materias/{materia}/enlaces', [ArchivoController::class, 'storeEnlace'])->name('materias.enlaces.store');
        Route::delete('/enlaces/{enlace}', [ArchivoController::class, 'destroyEnlace'])->name('enlaces.destroy');

        Route::get('/materias/{materia}/guias', [ArchivoController::class, 'indexGuias'])->name('materias.guias');
        Route::post('/materias/{materia}/guias', [ArchivoController::class, 'storeGuia'])->name('materias.guias.store');
        Route::delete('/guias/{guia}', [ArchivoController::class, 'destroyGuia'])->name('guias.destroy');

        Route::get('/materias/{materia}/planes', [ArchivoController::class, 'indexPlanes'])->name('materias.planes');
        Route::post('/materias/{materia}/planes', [ArchivoController::class, 'storePlan'])->name('materias.planes.store');
        Route::delete('/planes/{plan}', [ArchivoController::class, 'destroyPlan'])->name('planes.destroy');
    });

    // Rutas para todos los usuarios autenticados
    Route::get('/materias/{materia}', [MateriaController::class, 'show'])->name('materias.show');
    Route::get('/materias/{materia}/actividades', [MateriaController::class, 'actividades'])->name('materias.actividades');
    
    // Reportes/Comentarios
    Route::get('/materias/{materia}/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::post('/reportes', [ReporteController::class, 'store'])->name('reportes.store');
    Route::delete('/reportes/{reporte}', [ReporteController::class, 'destroy'])->name('reportes.destroy');

    // Boleta de notas
    Route::get('/usuarios/{usuario}/boleta', [NotaController::class, 'boleta'])->name('usuarios.boleta');
    
    // Certificado de notas
    Route::get('/usuarios/{usuario}/certificado', [NotaController::class, 'certificado'])->name('usuarios.certificado');

    // Reporte de asistencia por alumno
    Route::get('/usuarios/{usuario}/asistencia', [AsistenciaController::class, 'reportePorAlumno'])->name('usuarios.asistencia');
    
    // Reportes adicionales de asistencia
    Route::get('/asistencia/total', [AsistenciaController::class, 'reporteTotal'])->name('asistencia.total');
    Route::get('/asistencia/pases', [AsistenciaController::class, 'reportePases'])->name('asistencia.pases');
    
    // Configuración personal del usuario
    Route::get('/configuracion', [UsuarioController::class, 'configuracion'])->name('usuarios.configuracion');
    Route::put('/configuracion', [UsuarioController::class, 'actualizarConfiguracion'])->name('usuarios.configuracion.update');

    // Enviar tareas (estudiantes con permiso)
    Route::post('/tareas/enviar', [TareaController::class, 'enviarTarea'])->name('tareas.enviar')
        ->middleware(\App\Http\Middleware\CheckTareaPermission::class);
});
