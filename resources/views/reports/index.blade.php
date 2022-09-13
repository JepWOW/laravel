@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">ITEM TYPE</div>
                <table id="dtBasicExample" class="table table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">ITEM CODE</th>
                            <th class="th-sm">ITEM CODE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($types as $type)
                        <tr>
                            <td class="th-sm">{{$type->code}}</th>
                            <td class="th-sm">{{$type->description}}</th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
        <div class="card">
                <div class="card-body">
                    <div class="card-title">ITEM MASTER</div>
                <table id="dtBasicExample" class="table table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">ITEM TYPE</th>
                            <th class="th-sm">ITEM CODE</th>
                            <th class="th-sm">ITEM DESCRIPTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($masters as $master)
                        <tr>
                            <td class="th-sm">{{$master->type->code}}</th>
                            <td class="th-sm">{{$master->code}}</th>
                            <td class="th-sm">{{$master->description}}</th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    $('#dtBasicExample').DataTable();
    $('.dataTables_length').addClass('bs-select');
});
</script>
@endsection
