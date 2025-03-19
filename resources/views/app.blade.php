<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>React inside Laravel</title>
    @viteReactRefresh
    @vite('resources/js/app.jsx') <!-- This will load your React JS code -->
    @vite('resources/css/app.css')
</head>
<body>
    <div id="app"></div> <!-- React will mount here -->
</body>
</html>
