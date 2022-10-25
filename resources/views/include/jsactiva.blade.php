<script>
function jsactiva() {
    // SIempre es activa en el HTML aunque en la base sea activo.
     var IDr1 = document.getElementById("activa").checked;     
     var IDr2 = document.getElementById("activao");
     IDr2.value = "0";
     if (IDr1) 
     {
        IDr2.value = "1";
     }
}
</script>