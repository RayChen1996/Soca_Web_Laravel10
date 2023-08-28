<!-- resources/views/swagger.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>API Documentation</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/swagger-ui.css') }}">
</head>
<body>
    <div id="swagger-ui"></div>
    <script src="{{ asset('js/swagger-ui-bundle.js') }}"></script>
    <script>
        const ui = SwaggerUIBundle({
            url: "/api-docs.json", // 或者是您的Swagger规范文件的URL
            dom_id: "#swagger-ui",
        });
    </script>
</body>
</html>
