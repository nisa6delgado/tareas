<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	<link rel="stylesheet" href="<?php asset('css/prism.css'); ?>">
	<style>
		:not(pre) > code[class*="language-"], pre[class*="language-"] {
			background-color: white;
		}
	</style>
</head>
<body>
	<pre><code class="language-<?php echo $ext; ?>"><?php echo str_replace('<?php
<br>
<br>', '', $content); ?></code></pre>

	<script src="<?php asset('js/prism.js'); ?>"></script>
</body>
</html>