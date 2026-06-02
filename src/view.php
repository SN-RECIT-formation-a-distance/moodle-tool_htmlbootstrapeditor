<?php 

require('../../../config.php');
require_login();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="referrer" content="strict-origin-when-cross-origin" />
    </head>
    <body>
        <div id="editor"></div>
        <script type="text/javascript" src="<?php echo s($CFG->wwwroot); ?>/admin/tool/htmlbootstrapeditor/editor/htmlbootstrapeditor.js"></script>
        <script>
            HTMLBootstrapEditor.render("#editor", {wrapper: window.IWrapper});
        </script>
    </body>
</html>