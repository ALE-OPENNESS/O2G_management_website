<script>
    if ("<?php echo $_SESSION['<?php echo ($query); ?>'] ?>" != "") {
        setTimeout(function() { window.Materialize.toast("<?php echo $_SESSION['<?php echo ($query); ?>'] ?>", 5000) }, 500);
        <?php echo $_SESSION['<?php echo ($query); ?>'] = "" ;?>
    }
</script>