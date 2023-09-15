<footer class="main-footer">
        <div class="pull-right hidden-xs">
         <!-- <b>Version</b> 2.3.0---->
        </div>
        <strong>Copyright &copy; <?php echo date('Y'); ?> </strong> All rights reserved.
 </footer>
<script>
$(function()   {
	
	
	$(document).on('click', '.toggle_button', function(e) {
    e.preventDefault();
    e.stopPropagation();
    if($(this).next('.para').is(":visible"))
{
$('.para').hide();
}
else{
$('.para').hide();
$(this).next('.para').show();
}

    $(document).one('click', function closeMenu (e){
        if($(this).next('.para').is(":visible"))
{
$('.para').hide();
}
else{
$('.para').hide();
$(this).next('.para').show();
}
    });
});


	
});
 function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

</script>