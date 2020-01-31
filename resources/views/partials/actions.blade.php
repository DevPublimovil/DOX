<div class="btn-group">
    <a href="{{route('excluidos.edit', $id)}}" class="btn btn-sm btn-warning">Editar</a>
    <form action="{{route('excluidos.destroy', $id)}}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" class="btn btn-sm btn-danger ml-1">Eliminar</button>
    </form>
</div>