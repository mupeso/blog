<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Button Example</title>
    <style>
        /* CSS لتصميم البوتون */
        .custom-button {
            background-color:rgb(163, 180, 88);
            color: white;
            border: none;
            padding: 3px 43.6%;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .custom-button:hover {
            background-color:rgb(96, 141, 37);
        }
    </style>
</head>
<body>
    <!-- زر -->

    <a href="./?page=create-comment" class="custom-button" onclick="buttonClicked()">comment </a>
</body>
</html>