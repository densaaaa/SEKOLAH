<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Not Found</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        
        .error-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 30px 40px;
            text-align: center;
            max-width: 500px;
            width: 90%;
        }
        
        .error-icon {
            font-size: 60px;
            color: #e74c3c;
            margin-bottom: 20px;
        }
        
        h1 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #e74c3c;
        }
        
        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 25px;
        }
        
        .back-button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        
        .back-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-icon">&#9888;</div>
        <h1>User Not Found</h1>
        <p>Username atau NISN/NIP tidak ditemukan!</p>
        <a href="javascript:history.back()" class="back-button">Kembali</a>
    </div>
</body>
</html>