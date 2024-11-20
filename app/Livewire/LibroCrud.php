<?php

namespace App\Http\Livewire;

use App\Models\Libro;
use Livewire\Component;

class LibroCrud extends Component
{
    public $libros, $titulo, $autor, $genero, $anio_publicacion, $estado, $libro_id;
    public $isEditMode = false;

    public function mount()
    {
        $this->libros = Libro::all();
    }

    public function saveLibro()
    {
        $this->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'genero' => 'required|string|max:100',
            'anio_publicacion' => 'required|digits:4',
            'estado' => 'required|string|max:45',
        ]);

        if ($this->isEditMode) {
            $libro = Libro::find($this->libro_id);
            $libro->update([
                'titulo' => $this->titulo,
                'autor' => $this->autor,
                'genero' => $this->genero,
                'anio_publicacion' => $this->anio_publicacion,
                'estado' => $this->estado,
            ]);
        } else {
            Libro::create([
                'titulo' => $this->titulo,
                'autor' => $this->autor,
                'genero' => $this->genero,
                'anio_publicacion' => $this->anio_publicacion,
                'estado' => $this->estado,
            ]);
        }

        $this->resetInputs();

        $this->libros = Libro::all();
    }

    public function editLibro($id)
    {
        $this->isEditMode = true;
        $libro = Libro::find($id);
        $this->libro_id = $libro->id;
        $this->titulo = $libro->titulo;
        $this->autor = $libro->autor;
        $this->genero = $libro->genero;
        $this->anio_publicacion = $libro->anio_publicacion;
        $this->estado = $libro->estado;
    }

    public function deleteLibro($id)
    {
        $libro = Libro::find($id);
        $libro->delete();
        $this->libros = Libro::all();
    }

    public function resetInputs()
    {
        $this->titulo = '';
        $this->autor = '';
        $this->genero = '';
        $this->anio_publicacion = '';
        $this->estado = 'disponible';
        $this->libro_id = null;
        $this->isEditMode = false;
    }

    public function render()
    {
        return view('livewire.libro-crud', [
            'isEditMode' => $this->isEditMode,
            'libros' => $this->libros,
        ]);;
    }
}
