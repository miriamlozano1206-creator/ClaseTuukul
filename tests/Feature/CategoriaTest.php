<?php
use App\Models\Categoria;
use App\Models\Idea;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;

uses(RefreshDatabase::class);

/*test('Utilizar BD de prueba', function(){
    expect(config('database.default'))->toBe('sqlite');

    expect(config('database.connections.sqlite.database'))->toBe(':memory:')
}); */

test('Registrar una Categoría', function () {
    Categoria::create([
        'nombre' => 'Ciencia',
        'descripcion' => 'Ideas de ciencias',
    ]);

//dd(Categoria::all());

    $this->assertDatabaseHas('categorias', [
         'nombre' => 'Ciencia',
        'descripcion' => 'Ideas de ciencias',
    ]);
});


test('Consultar una Categoría', function () {
    $categoria = Categoria::create([
        'nombre' => 'Ciencia',
        'descripcion' => 'Ideas de ciencias',
    ]);


    $encontrada = Categoria::find($categoria->id);

    expect($encontrada->nombre)->toBe('Ciencia');
});


test('Modificar una Categoría', function () {
    $categoria = Categoria::create([
        'nombre' => 'Ciencia',
        'descripcion' => 'Ideas de ciencias',
    ]);


    $categoria->update([
        'nombre' => 'Innovación',
    ]);

    $this->assertDatabaseHas('categorias', [
        'id' => $categoria->id,
        'descripcion' => 'Ideas de ciencias',
    ]);

    $this->assertDatabaseMissing('categorias', [
        'id' => $categoria->id,
        'nombre' => 'Ciencias',
    ]);
});




test('Eliminar una Categoría', function () {
    $categoria = Categoria::create([
        'nombre' => 'Ciencia',
        'descripcion' => 'Ideas de ciencias',
    ]);

    $categoria->delete();

    $this->assertDatabaseMissing('categorias', [
        'id' => $categoria->id
    ]);
});


test('una categoría puede tener varias ideas', function () {
  $categoria = Categoria::create([
    'nombre' => 'Tecnología',
    'descripcion' => 'Ideas tecnológicas'
  ]);

  Idea::create([
    'titulo' => 'Aplicación de transporte',
    'descripcion' => 'Aplicación para compartir viajes',
    'autor' => 'Ana',
    'estado' => 'registrada',
    'categoria_id' => $categoria->id
  ]);

  Idea::create([
    'titulo' => 'Sistema de inventario',
    'descripcion' => 'Control de productos',
    'autor' => 'Luis',
    'estado' => 'registrada',
    'categoria_id' => $categoria->id
  ]);

 	expect($categoria->ideas)->toHaveCount(2);
});


test('no se puede borrar una categoría con ideas asociadas', function () {
  $categoria = Categoria::create([
    'nombre' => 'Tecnología',
    'descripcion' => 'Ideas tecnológicas'
  ]);

  Idea::create([
    'titulo' => 'Aplicación de transporte',
    'descripcion' => 'Aplicación para compartir viajes',
    'autor' => 'Ana',
    'estado' => 'registrada',
    'categoria_id' => $categoria->id
  ]);

  Idea::create([
    'titulo' => 'Sistema de inventario',
    'descripcion' => 'Control de productos',
    'autor' => 'Luis',
    'estado' => 'registrada',
    'categoria_id' => $categoria->id
  ]);

    $seRechazo = false;
    try{
        $categoria->delete();
    }catch (QueryException $e){
        $seRechazo = true;
    }

    expect($seRechazo)->ToBeTrue();

    $this->assertDatabaseHas('categorias', [
        'id' => $categoria->id
    ]);
  });

