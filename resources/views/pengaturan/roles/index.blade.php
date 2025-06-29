@extends('layouts.main')
@section('title', 'Pengaturan Role')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-end align-items-center">
        <button class="btn btn-sm btn-success btn-sm btn-add">Add Role</button>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="rolesTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Role Label</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="roleModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="roleForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                </div>
                <div class="modal-body">
                    <input id="role_id" type="hidden">
                    <div class="mb-3">
                        <label>Role Label</label>
                        <input class="form-control" id="role_name" type="text" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-sm" type="submit">Save</button>
                    <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal" type="button">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
    let table_roles = initTable();

    // open modal add
    $('.btn-add').on('click', function () {
        $('#roleForm')[0].reset();
        $('#role_id').val('');
        $('.modal-title').text('Tambah Role');
        $('#roleModal').modal('show');
    });

    // submit form
    $('#roleForm').on('submit', function (e) {
        e.preventDefault();

        let id = $('#role_id').val();
        let url = id ? "{{ route('pengaturan.roles.update', ':id') }}".replace(':id', id) : "{{ route('pengaturan.roles.store') }}";
        let method = id ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            method: method,
            data: {
                'role_name': $('#role_name').val()
            },
            success: function (response) {
                $('#roleModal').modal('hide');
                Swal.fire('Sukses', response.message, 'success');
                table_roles.ajax.reload(null, false); // reload tanpa reset paging
            },
            error: function (xhr) {
                Swal.fire('Gagal', 'Terjadi kesalahan saat menyimpan data.', 'error');
            }
        });
    });

    // edit
    $(document).on('click', '.btn-edit', function () {
        let id = $(this).data('id');
        let url = "{{ route('pengaturan.roles.edit', ':id') }}".replace(':id', id);

        $.get(url, function (data) {
            $('#role_id').val(data.id);
            $('#role_name').val(data.role_name);
            $('.modal-title').text('Edit Role');
            $('#roleModal').modal('show');
        });
    });

    // delete
    $(document).on('click', '.btn-delete', function () {
        let id = $(this).data('id');
        let url = "{{ route('pengaturan.roles.destroy', ':id') }}".replace(':id', id);

        Swal.fire({
            title: 'Yakin hapus?',
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    success: function (response) {
                        Swal.fire('Terhapus!', response.message, 'success');
                        table_roles.ajax.reload(null, false);
                    },
                    error: function () {
                        Swal.fire('Gagal', 'Data gagal dihapus.', 'error');
                    }
                });
            }
        });
    });
});

    function initTable()
    {
        table = $('#rolesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('pengaturan.roles.datatables') }}",
                type: "GET",
            },
            order: [],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'role_name', name: 'role_name' },
                { data: 'action', name: 'action', orderable: false, searchable: false, width: '15%' }
            ]
        });

        return table;
    }
</script>
@endsection
