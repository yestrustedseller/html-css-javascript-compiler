<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online PHP Compiler</title>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/919/919830.png" type="image/png">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            text-align: center;
            background-color: #1e1e1e;
            margin: 0;
            padding: 0;
            color: #fff;
        }
        nav {
            background-color: #222;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        .sections {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }
        .sections label {
            font-weight: bold;
            margin-top: 10px;
            font-size: 16px;
        }
        textarea {
            width: 90%;
            max-width: 600px;
            height: 200px;
            margin: 5px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #444;
            border-radius: 5px;
            background: #2d2d2d;
            color: #fff;
            resize: none;
            font-family: monospace;
        }
        button {
            padding: 12px 24px;
            font-size: 18px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        iframe {
            width: 100%;
            height: 400px;
            border: 2px solid #444;
            background: white;
            margin-top: 20px;
        }
        @media (max-width: 768px) {
            textarea {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <nav>Online PHP Compiler</nav>
    <div class="container">
        <h2>Code Your PHP</h2>
        <div class="sections">
            <label for="php">PHP</label>
            <textarea id="php" placeholder="Write PHP code here..."></textarea>
        </div>
        <button onclick="compilePHP()">Run Code</button>
        <iframe id="output"></iframe>
    </div>
    
    <script>
        function compilePHP() {
            const phpCode = document.getElementById("php").value;
            
            fetch("server.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `code=${encodeURIComponent(phpCode)}`
            })
            .then(response => response.text())
            .then(data => {
                const outputFrame = document.getElementById("output").contentWindow.document;
                outputFrame.open();
                outputFrame.write(`<pre>${data}</pre>`);
                outputFrame.close();
            })
            .catch(error => {
                console.error("Error executing PHP code:", error);
                const outputFrame = document.getElementById("output").contentWindow.document;
                outputFrame.open();
                outputFrame.write(`<pre style='color: red;'>Execution Error: ${error.message}</pre>`);
                outputFrame.close();
            });
        }
    </script>
</body>
</html>
