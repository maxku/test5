<h1 class="page-header">My Cars
    <div class="pull-right">
        <a href="javascript:ajaxLoad('record/create')" class="btn btn-success pull-right"><i
                    class="glyphicon glyphicon-plus-sign"></i> New</a>
    </div>
</h1>

<table class="table table-bordered table-striped">
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
        <tr>
            <td>{{$record->mark}}</td>
            <td>{{$record->color}}</td>
            <td>{{$record->number}}</td>

            <td style="text-align: center">
                <a class="btn btn-danger btn-xs" title="Delete"
                   href="javascript:if(confirm('Are you sure want to delete?')) ajaxLoad('/record/delete/{{$record->id}}')">
                    <i class="glyphicon glyphicon-trash"></i> Delete
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    $('.pagination a').on('click', function (event) {
        event.preventDefault();
        ajaxLoad($(this).attr('href'));
    });
</script>