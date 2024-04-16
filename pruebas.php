<body>
 
<form action="" method="get" name="prueba" id="prueba">
    <input name="campo1" type="text" id="campo1" onfocus="javascript:highlight(this.name)" onblur="javascript:nohighlight(this.name)" />
    <input name="campo2" type="text" id="campo2" onfocus="javascript:highlight(this.name)" onblur="javascript:nohighlight(this.name)" />
	<a href="prueba1.php">ir....</a>
</form>
 
<script type="text/javascript">
document.prueba.campo1.focus();
 
        function highlight(nombre) {
             document.getElementById(nombre).style.background='#bc9b6a';
             document.getElementById(nombre).style.color='#fff';
            }   
        
        function nohighlight(nombre) {
            document.getElementById(nombre).style.background='#FFF';
            document.getElementById(nombre).style.color='#000';
            }   
</script>
</body>