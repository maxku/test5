<div class="form-group required" id="form-user-error">
    {!! Form::label("user","User",["class"=>"control-label col-md-3"]) !!}
    <div class="col-md-6">
        {!! Form::select("user", $users, null, ["placeholder"=>"Select...", "class"=>"form-control required"]) !!}
        <span id="user-error" class="help-block"></span>
    </div>
</div>
<div class="form-group required" id="form-mark-error">
    {!! Form::label("mark","Mark",["class"=>"control-label col-md-3"]) !!}
    <div class="col-md-6">
        {!! Form::select("mark",[
            "BMW"=>"BMW",
            "Mercedes"=>"Mercedes",
            "Opel"=>"Opel",
            "Honda"=>"Honda"], null, ["placeholder"=>"Select...", "class"=>"form-control required"]) !!}
        <span id="mark-error" class="help-block"></span>
    </div>
</div>
<div class="form-group required" id="form-color-error">
    {!! Form::label("color","Color",["class"=>"control-label col-md-3"]) !!}
    <div class="col-md-6">
        {!! Form::select("color",[
            "Red"=>"Red",
            "Blue"=>"Blue",
            "White"=>"White",
            "Black"=>"Black"], null, ["placeholder"=>"Select...", "class"=>"form-control required"]) !!}
        <span id="color-error" class="help-block"></span>
    </div>
</div>
<div class="form-group required" id="form-number-error">
    {!! Form::label("number","Number",["class"=>"control-label col-md-3"]) !!}
    <div class="col-md-6">
        {!! Form::text("number",null,["class"=>"form-control required"]) !!}
        <span id="number-error" class="help-block"></span>
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-push-3">
        <a href="javascript:ajaxLoad('/admin/list')" class="btn btn-danger"><i
                    class="glyphicon glyphicon-backward"></i>
            Back</a>
        {!! Form::button("<i class='glyphicon glyphicon-floppy-disk'></i> Save",["type" => "submit","class"=>"btn
    btn-primary"])!!}
    </div>
</div>
<script>
    $("#frm").submit(function (event) {
        event.preventDefault();
        var form = $(this);
        var data = new FormData($(this)[0]);
        var url = form.attr("action");
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.fail) {
                    $('#frm input.required, #frm textarea.required').each(function () {
                        index = $(this).attr('id');
                        if (index in data.errors) {
                            $("#form-" + index + "-error").addClass("has-error");
                            $("#" + index + "-error").html(data.errors[index]);
                        }
                        else {
                            $("#form-" + index + "-error").removeClass("has-error");
                            $("#" + index + "-error").empty();
                        }
                    });
                    $('#focus').focus().select();
                } else {
                    $(".has-error").removeClass("has-error");
                    $(".help-block").empty();
                    ajaxLoad(data.url, data.content);
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
        return false;
    });
</script>