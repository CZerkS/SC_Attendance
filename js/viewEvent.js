$(document).ready( function () {
    $('#addu').DataTable();
} );
$(document).ready( function () {
    $('#guest').DataTable();
} );
$(document).ready(function(){
    var date_input=$('input[name="date"]');
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    date_input.datepicker({
        format: 'mm-dd-yyyy',
        container: container,
        todayHighlight: true,
      autoclose: true,
    })
})

//Button Event Handler
$(document).ready(function(){
    $("#guestSection").hide();

    $("#btnAdduSection").click(function(){
        $("#adduSection").show();
        $("#guestSection").hide();
    });
    $("#btnGuestSection").click(function(){
        $("#adduSection").hide();
        $("#guestSection").show();
    });
});
