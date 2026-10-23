<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Gui email bang PHP</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f4f7;
            padding: 30px;
        }

        .container {
            width: 600px;
            max-width: 100%;
            box-sizing: border-box;
            margin: auto;
            padding: 25px;
            background: white;
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #0d6efd;
        }

        label {
            display: block;
            margin-top: 15px;
        }

        input, textarea {
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
            margin-top: 5px;
        }

        textarea {
            height: 150px;
        }

        button {
            margin-top: 20px;
            padding: 12px 25px;
            color: white;
            background: #0d6efd;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>GỬI EMAIL BẰNG PHP</h2>

    <form action="mail.php"
          method="POST"
          enctype="multipart/form-data">

        <label>Email người nhận:</label>
        <input type="email"
               name="email"
               placeholder="Nhập email"
               required>

        <label>Tiêu đề:</label>
        <input type="text"
               name="tieude"
               placeholder="Nhập tiêu đề"
               required>

        <label>Nội dung:</label>
        <textarea name="content"
                  placeholder="Nhập nội dung email"
                  required></textarea>

        <label>Tệp đính kèm:</label>
        <input type="file" name="file">

        <button type="submit">Gửi email</button>

    </form>

</div>

</body>
</html>