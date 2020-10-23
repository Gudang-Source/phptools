<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'part/meta.php' ?>
</head>
<body>

  <?php include 'part/theme.php' ?>
  <?php $code = !empty($_POST['code']) ? $_POST['code'] : ''; ?>
  <form action="" method="post">
    <textarea id="code" name="code"><?php echo $code ?></textarea>
    <button type="submit">Run</button>
  </form>
  <script>
    var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
      lineNumbers: true,
      styleActiveLine: true,
      matchBrackets: true,
      autocomplete: true,
    });
    var input = document.getElementById("select");
    function selectTheme() {
      var theme = input.options[input.selectedIndex].textContent;
      editor.setOption("theme", theme);
      location.hash = "#" + theme;
    }
    var choice = (location.hash && location.hash.slice(1)) ||
                 (document.location.search &&
                  decodeURIComponent(document.location.search.slice(1)));
    if (choice) {
      input.value = choice;
      editor.setOption("theme", choice);
    }
    CodeMirror.on(window, "hashchange", function() {
      var theme = location.hash.slice(1);
      if (theme) { input.value = theme; selectTheme(); }
    });
  </script>
  <?php

  if(!empty($code))
  {
    echo '<pre>';
    echo '<code>';
    eval($code);
    echo '</code>';
    echo '</pre>';
  }?>
</body>
</html>