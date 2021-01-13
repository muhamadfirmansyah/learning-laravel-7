@extends('layout')


@section('content')

<div class="container-fluid">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="m-0">Barang - {{ request()->trash === 'true' ? 'Sampah' : 'Semua' }}</h4>
                        <div>
                            <form class="d-inline">
                                <input type="hidden" name="trash" value="{{ request()->trash === 'true' ? 'false' : 'true' }}">
                                <button class="btn btn-secondary btn-sm">Tampilkan {{ request()->trash === 'true' ? 'Semua' : 'Sampah' }}</button>
                            </form>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modelId">Tambah</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse( $barangs as $key => $barang )
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $barang->name }}</td>
                                    <td>{{ $barang->category->name ?? '-' }}</td>
                                    <td>
                                        @if (!$barang->deleted_at)
                                        <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit" data-id="{{ $barang->id }}" data-url="{{ route('barang.show', $barang->id) }}">Edit</button>
                                        @else
                                        <form action="{{ route('barang.restore', $barang->id) }}" class="d-inline" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-warning btn-sm" type="submit">Restore</button>
                                        </form>
                                        <form action="{{ route('barang.forceDelete', $barang->id) }}" class="d-inline" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-light btn-sm" type="submit">Delete Permanently</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal Create -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <form action="{{ route('barang.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Modal Create</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" name="name" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Kategori</label>
                                    <select name="category_id" id="category_id" class="custom-select">
                                        <option value=""></option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <form action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Modal Edit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" name="name" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Kategori</label>
                                    <select name="category_id" id="category_id" class="custom-select">
                                        <option value=""></option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
$('#edit').on('show.bs.modal', (e) => {
    const id = $(e.relatedTarget).data('id');
    const url = $(e.relatedTarget).data('url');

    $(e.currentTarget).find('form').attr('action', url);

    $.ajax({
        type: "GET",
        url: url,
        dataType: "JSON",
        success: function (response) {
            $(e.currentTarget).find('input[name="name"]').val(response.name);
            $(e.currentTarget).find('select[name="category_id"]').val(response.category_id);
        }
    });
});
</script>
@endpush