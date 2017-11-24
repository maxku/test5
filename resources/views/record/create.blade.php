<h2 class="page-header">New record</h2>
{!! Form::open(["id"=>"frm","class"=>"form-horizontal"]) !!}
@include("record/_form")
{!! Form::close() !!}