@extends('layouts.admin.app')

@section('content-header',)
<h1>pasien</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">DataTable with default features</h3>

    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <button type='button' data-toggle='modal' data-target='#modal-tambah' class='ml-auto col-2 btn btn-block btn-default'>Tambah</button>
                <tr>
                    <th>no</th>
                    <th>nama</th>
                    <th>no rekamedik</th>
                    <th>gender</th>
                    <th>no ktp</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Bachtiar Arya Habibie</td>
                    <td>xxx-xxx-xxx</td>
                    <td>laki laki</td>
                    <th>351xxxxxxxxxx</th>
                    <th>
                        <div class="row">
                            <div class="col"><button type="button" class="col btn btn-block btn-primary">Detail</button></div>
                            <div class="col"><button type="button" class=" col btn btn-block btn-danger">Danger</button></div>
                        </div>
                    </th>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>no</th>
                    <th>nama</th>
                    <th>no rekamedik</th>
                    <th>gender</th>
                    <th>no ktp</th>
                    <th>aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog  modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt magnam rem consequuntur incidunt eligendi dignissimos neque, dolorem unde nihil, voluptatibus velit totam! Quaerat quo vel odio doloribus! Laborum, ipsum saepe?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@endsection


@section('datatable-script')
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true
            , "lengthChange": false
            , "autoWidth": false
            , "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0) ');

    });

</script>

@endsection
