<div>
    <h2>Gestionar Libros</h2>

    <form wire:submit.prevent="saveLibro">
        <input type="hidden" wire:model="libro_id">

        <div>
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" wire:model="titulo" required>
        </div>

        <div>
            <label for="autor">Autor:</label>
            <input type="text" id="autor" wire:model="autor" required>
        </div>

        <div>
            <label for="genero">Género:</label>
            <input type="text" id="genero" wire:model="genero" required>
        </div>

        <div>
            <label for="anio_publicacion">Año de Publicación:</label>
            <input type="number" id="anio_publicacion" wire:model="anio_publicacion" required>
        </div>

        <div>
            <label for="estado">Estado:</label>
            <input type="text" id="estado" wire:model="estado" required>
        </div>

        <div>
            <button type="submit">{{ $isEditMode ? 'Actualizar' : 'Guardar' }} Libro</button>
        </div>
    </form>

    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Género</th>
                <th>Año</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($libros as $libro)
                <tr>
                    <td>{{ $libro->titulo }}</td>
                    <td>{{ $libro->autor }}</td>
                    <td>{{ $libro->genero }}</td>
                    <td>{{ $libro->anio_publicacion }}</td>
                    <td>{{ $libro->estado }}</td>
                    <td>
                        <button wire:click="editLibro({{ $libro->id }})">Editar</button>
                        <button wire:click="deleteLibro({{ $libro->id }})">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

