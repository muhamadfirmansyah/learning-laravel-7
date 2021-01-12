@extends('layout')


@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center mt-5">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Kategori</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse( $categories as $key => $category )
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-id="{{ $category->id }}" data-target="#detail">{{ $category->name }}</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="2">Tidak ada data</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Kategori</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('kategori.store') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" class="form-control">
                            </div>
    
                            <button class="btn btn-primary btn-sm">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Modal Detail</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <td>Nama</td>
                            <td class="px-2">:</td>
                            <td id="detailName"></td>
                        </tr>
                    </table>
                    <hr>
                    <p>List Barang : </p>
                    <ul>
                        
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    $('#detail').on('show.bs.modal', (e) => {

        $.ajax({
            type: "GET",
            url: "{{ url('kategori') }}/" + $(e.relatedTarget).data('id'),
            dataType: "JSON",
            success: function (response) {
                $(e.currentTarget).find('#detailName').text(response.name);

                var html = ``;
                response.barangs.forEach((val, ind) => {
                    html += `<li>${val.name}</li>`;
                });
                $(e.currentTarget).find('ul').html(html);
            }
        });

    });
</script>
@endpush