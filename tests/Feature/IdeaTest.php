<?php
use App\Models\Idea;
use App\Models\Categoria;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->categoriaCiencia = Categoria::create([
        'nombre' => 'Ciencia',
        'descripcion' => 'Ideas de ciencias',
    ]);

    $this->categoriaTecnologia = Categoria::create([
        'nombre' => 'Tecnología',
        'descripcion' => 'Ideas de tecnología',
    ]);
});

/******************************************/ 
/*********** Casos de Prueba **************/
/******************************************/ 

//Modificar el estado de una idea
test('Modificar el estado de una idea', function () {
    $idea = Idea::create([
        'titulo' => 'Aplicación de Registro de Especies',
        'descripcion' => 'Aplicación en la que el usuario podrá registrar las especies que se encuentre.',
        'estado' => 'registrada',
        'autor' => 'Juan Pérez',
        'categoria_id' => $this->categoriaCiencia->id,
    ]);

    $idea->update([
        'estado' => 'en revisión',
    ]);

    $this->assertDatabaseHas('ideas', [
    'id' => $idea->id,
    'titulo' => 'Aplicación de Registro de Especies',
    'estado' => 'en revisión',
    ]);

    $this->assertDatabaseMissing('ideas', [
        'id' => $idea->id,
        'estado' => 'registrada',
    ]);
});

//Cambiar la categoría de una idea
test('Modificar la categoría de una idea', function () {
    $idea = Idea::create([
        'titulo' => 'Aplicación de Registro de Especies',
        'descripcion' => 'Aplicación en la que el usuario podrá registrar las especies que se encuentre.',
        'estado' => 'registrada',
        'autor' => 'Juan Pérez',
        'categoria_id' => $this->categoriaCiencia->id,
    ]);

    $idea->update([
        'categoria_id' => $this->categoriaTecnologia->id,
    ]);

    $this->assertDatabaseHas('ideas', [
        'id' => $idea->id,
        'titulo' => 'Aplicación de Registro de Especies',
        'descripcion' => 'Aplicación en la que el usuario podrá registrar las especies que se encuentre.',
        'estado' => 'registrada',
        'autor' => 'Juan Pérez',
        'categoria_id' => $this->categoriaTecnologia->id,
    ]);

    $this->assertDatabaseMissing('ideas', [
    'id' => $idea->id,
    'categoria_id' => $this->categoriaCiencia->id,
    ]);
});


//Eliminar lógicamente una idea
test('Eliminar lógicamente una idea', function () {
    $idea = Idea::create([
        'titulo' => 'Aplicación de Registro de Especies',
        'descripcion' => 'Aplicación en la que el usuario podrá registrar las especies que se encuentre.',
        'estado' => 'registrada',
        'autor' => 'Juan Pérez',
        'categoria_id' => $this->categoriaCiencia->id,
    ]);

    $idea->delete();

    expect(Idea::find($idea->id))->toBeNull();

    $this->assertSoftDeleted('ideas', [
        'id' => $idea->id
    ]);

    $eliminada = Idea::withTrashed() -> find($idea->id);

    expect($eliminada)->not->toBeNull()
        ->and($eliminada->deleted_at)->not->toBeNull();
});



//Registrar una idea con una categoría inexistente
test('Registrar una idea con una categoría inexistente', function () {
    $huboError = false;

    try{
    $idea = Idea::create([
        'titulo' => 'Aplicación de Registro de Especies',
        'descripcion' => 'Aplicación en la que el usuario podrá registrar las especies que se encuentre.',
        'estado' => 'registrada',
        'autor' => 'Juan Pérez',
        'categoria_id' => 9999,
    ]);
    } catch (QueryException $e) {
        $huboError = true;
    }

    expect($huboError)->ToBeTrue();

    $this->assertDatabaseMissing('ideas', [
        'categoria_id' =>  9999,
    ]);
  });

