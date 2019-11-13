$(document).ready(function(){
        $(".btnNewInstruction").click(function(){
            $("#modal-default").modal("show");
            $(".btnSaveAddInfo, .btnUpdateInfo").html("Save Changes").removeClass("btnUpdateInfo").addClass("btnSaveAddInfo");
            CKEDITOR.instances['editor'].setData("")
        })
})