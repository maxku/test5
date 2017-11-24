<h1 class="page-header">Users and Cars
    <div class="pull-right">
        <a href="javascript:ajaxLoad('admin/create')" class="btn btn-success pull-right"><i
                    class="glyphicon glyphicon-plus-sign"></i> New</a>
    </div>
</h1>

@foreach($users as $user)
    <p>User:</p>
    <table class="table table-bordered">
        <tbody>
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        </tbody>
    </table>
    <p>Cars:</p>
    <table class="table table-bordered table-striped" style="margin-bottom: 50px;">
        <thead>
        <tr>
            <th>Mark</th>
            <th>Color</th>
            <th>Number</th>
            <th width="140px"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($records as $key=>$record)
            @if($record->user_id == $user->id)
                <tr>
                    <td>{{$record->mark}}</td>
                    <td>{{$record->color}}</td>
                    <td>{{$record->number}}</td>

                    <td style="text-align: center">
                        <a class="btn btn-danger btn-xs" title="Delete"
                           href="javascript:if(confirm('Are you sure want to delete?')) ajaxLoad('/admin/delete/{{$record->id}}')">
                            <i class="glyphicon glyphicon-trash"></i> Delete
                        </a>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
@endforeach
<script>
    $('.pagination a').on('click', function (event) {
        event.preventDefault();
        ajaxLoad($(this).attr('href'));
    });
</script>