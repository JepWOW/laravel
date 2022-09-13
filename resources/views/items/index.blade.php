@extends('layouts.app')

@section('content')
@if(Session::get('success'))
           <div class="alert alert-success">
               {{session::get('success')}}
           </div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">ITEM TYPE 
                        <button class="action btn btn-primary btn-sm float-right" method="insert" data-item="type">Add New</button>
                    </div>
                    <table id="dtBasicExample" class="table table-bordered table-sm" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="th-sm" width="45%">ITEM CODE</th>
                                <th class="th-sm" width="45%">ITEM DESCRIPTION</th>
                                <th class="th-sm" width="10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($types as $type)
                            <tr>
                                <td class="th-sm">{{$type->code}}</td>
                                <td class="th-sm">{{$type->description}}</td>
                                <td class="th-sm">
                                    <span class="action" style="cursor:pointer;" title="edit" data-id="{{$type->id}}" method="update" data-item="type"><i class="fas fa-edit"></i></span>  
                                    <span class="action" style="cursor:pointer;" title="delete" data-id="{{$type->id}}" method="delete" data-item="type"><i class="fas fa-trash"></i></span>      
                                </td>
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
                    <div class="card-title">ITEM MASTER
                        <button class="action btn btn-primary btn-sm float-right" method="insert" data-item="master">Add New</button>
                    </div>
                <table id="dtBasicExample" class="table table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm" width="30%">ITEM TYPE</th>
                            <th class="th-sm" width="30%">ITEM CODE</th>
                            <th class="th-sm" width="30%">ITEM DESCRIPTION</th>
                            <th class="th-sm" width="15%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($masters as $master)
                        <tr>
                            <td class="th-sm">{{$master->type->code}}</td>
                            <td class="th-sm">{{$master->code}}</td>
                            <td class="th-sm">{{$master->description}}</td>
                            <td>
                                <span class="action" style="cursor:pointer;" title="edit" data-id="{{$master->id}}" method="update" data-item="master"><i class="fas fa-edit"></i></span>  
                                    <span class="action" style="cursor:pointer;" title="delete" data-id="{{$master->id}}" method="delete" data-item="master"><i class="fas fa-trash"></i></span>   
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="{{ url('types')}}" id="form_id" method="post">
      {{ csrf_field() }}
      <div class="modal-body">
      <input type="hidden" name="id" id="form_item_id" value="{{ old('id') }}">
      <input type="hidden" name="item" id="form_item" value="{{ old('item') }}">
      <input type="hidden" name="data_item" id="form_data_item" value="{{ old('data_item') }}">
      <input type="hidden" name="form_action" id="form_action" value="{{ old('form_action') }}">
        <div class="form-group">
            <div class="row">
                <div class="col-8" id="form_type">
                <label for="type">Item Type:</label>
                <select class="form-control" id="select_form_type" name="type">
                    <option value="{{ old('type') }}">Select Type</option>
                </select>
                @if($errors->has('code'))
                    <div class="error text-danger">{{ $errors->first('type') }}</div>
                @endif
                </div>
                <div class="col-8">
                    <label for="code">Code:</label>
                    <input type="input" id="form_code" class="form-control" name="code" value="{{ old('code') }}">
                    @if($errors->has('code'))
                    <div class="error text-danger">{{ $errors->first('code') }}</div>
                    @endif
                </div>
                <div class="col-8">
                    <label for="description">Description:</label>
                    <input type="input" id="form_description" class="form-control" name="description" value="{{ old('description') }}">
                    @if($errors->has('description'))
                    <div class="error text-danger">{{ $errors->first('description') }}</div>
                    @endif
                </div>
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
@stop



@section('scripts')

<script>
$(document).ready(function () {
    

    $('.action').on('click',function(){
        var form_method = '';
        var url = '';
        var id = '';
        $('#form_id').val('');
        $('#form_item_id').val('');
        $('#form_type').show();
        $('#form_type').val('');
        $('#form_code').val('');
        $('#form_description').val('');
        $('.error').hide();
        data = {
            id: $(this).attr('data-id'),
            item: $(this).attr('data-item')
        };

        console.log(data);
        
        item_name = 'select_'+$(this).attr('data-item');
        url = '{{ url("/get-type")}}';

        if ($(this).attr('method') == 'insert'){
            runAjax('POST', url, data, item_name);
            $('#modal').modal("show");
            $('#form_item').val(item_name);
            $("#form_id").prop("action", '{{ url("/")}}/'+$(this).attr('data-item'));
            form_action = '{{ url("/")}}/'+$(this).attr('data-item');
            $('#form_data_item').val($(this).attr('data-item'));
            $('#form_action').val(form_action);

        }else if ($(this).attr('method') == 'update'){
            runAjax('POST', url, data, item_name);
            $('#modal').modal("show");
            $("#form_id").prop("action", '{{ url("/")}}/'+$(this).attr('data-item')+'/'+$(this).attr('data-id'));
            $('#form_data_item').val($(this).attr('data-item'));
            form_action = '{{ url("/")}}/'+$(this).attr('data-item')+'/'+$(this).attr('data-id');
            $('#form_action').val(form_action);

        }else if($(this).attr('method') == 'delete'){
            data = {
                id: $(this).attr('data-id')
            };
            url = '{{ url("/")}}/'+$(this).attr('data-item')+'/delete/'+$(this).attr('data-id');
            var ask = confirm("Delete this Item?");
            if( ask == true){
                runAjax('POST', url, data, item_name);
            }
        }
    });

    function runAjax(form_method, url, data, item){
        $.ajax({
            method: form_method,
            url: url,
            headers: {
              "X-Requested-With": 'XMLHttpRequest',
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
          success: function(data) {
              $('#select_form_type option:not(:first)').remove();
              if(data.result == 'delete'){
                if(data.items == 'has_master'){
                    alert('this item type cannot be deleted because it still has an active master');
                }else{
                    window.location.reload();
                }
                
              }else{
                if(data.items.length > 0){
                Object.values(data.items).forEach(val => {                    
                    $('#select_form_type').append(`<option value="`+val.id+`">`+val.code+`</option>`);
                    if(item == 'select_type'){
                        $('#form_type').hide();
                        if(data.selected.id == val.id){  
                            $('#form_item_id').val(data.selected.id);
                            $('#form_code').val(data.selected.code);
                            $('#form_description').val(data.selected.description);
                        }
                    }else if(item == 'select_master'){
                        if(data.selected.type_id == val.id){
                            $('#form_item_id').val(data.selected.id);
                            $('#select_form_type').val(val.id);
                            $('#form_code').val(data.selected.code);
                            $('#form_description').val(data.selected.description);
                        }
                    }

                });
              }
            }
          }
        });
    }

    @if($errors->any())
        $('#modal').modal("show");
        @if(old('item') == 'select_type')
            $('#form_type').hide();
            get_url = '{{ url("/get-type")}}';
            old_item = '{{ old("data_item") }}';
            form_url = '{[ old("form_action") }}';
            $("#form_id").prop("action", form_url);
            runAjax('POST', get_url, {}, old_item);
        @endif
        get_url = '{{ url("/get-type")}}';
        old_item = '{{ old("data_item") }}';
        form_url = '{{ old("form_action") }}';
        $("#form_id").prop("action", form_url);
        runAjax('POST', get_url, {}, old_item);
    @endif
    
});
</script>
@stop
