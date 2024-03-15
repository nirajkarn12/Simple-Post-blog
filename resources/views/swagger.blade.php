<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Swagger UI</title>
    <!-- Load Swagger UI CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/3.52.1/swagger-ui.css" />
</head>
<body>
    <div id="swagger-ui"></div>

    <!-- Load Swagger UI JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/3.52.1/swagger-ui-bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/3.52.1/swagger-ui-standalone-preset.js"></script>

    <script>
        // Load Swagger UI with the specified Swagger JSON file URL
        window.onload = function() {
            const ui = SwaggerUIBundle({
                url: "/swagger.json",
                dom_id: '#swagger-ui',
                presets: [
                    SwaggerUIBundle.presets.apis,
                    SwaggerUIStandalonePreset
                ],
                layout: "BaseLayout",
            })
        }
    </script>
</body>
</html>
