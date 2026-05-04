<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Anti-Hacker Lab</title>
    <meta name="description" content="Security Lab - CSRF and XSS Protection">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }
        .container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 600px;
            width: 100%;
            padding: 3rem;
            text-align: center;
        }
        h1 {
            font-size: 2.5rem;
            color: #667eea;
            margin-bottom: 1rem;
        }
        h2 {
            font-size: 1.3rem;
            color: #333;
            margin: 2rem 0 1.5rem;
        }
        p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            font-size: 1rem;
        }
        form {
            background-color: #f9f9f9;
            padding: 2rem;
            border-radius: 8px;
            border: 2px solid #e0e0e0;
        }
        label {
            display: block;
            text-align: left;
            margin-bottom: 0.75rem;
            color: #333;
            font-weight: 500;
        }
        input[type="text"] {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1.5rem;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            font-size: 1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
        }
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔒 Anti-Hacker Lab</h1>
        <p>Learn about CSRF and XSS vulnerabilities through hands-on testing</p>

        <section>
            <h2>Test CSRF & XSS Protection</h2>
            <p>Enter text below to test how the application protects against attacks. Try entering HTML or JavaScript code!</p>
            
            <form method="post" action="<?= site_url('results') ?>">
                <?= csrf_field() ?>
                <label for="userInput">Enter your test input:</label>
                <input type="text" id="userInput" name="user_input" placeholder="Try: &lt;b&gt;John&lt;/b&gt; or &lt;script&gt;alert('xss')&lt;/script&gt;" required>
                <button type="submit">Submit</button>
            </form>
            <p style="margin-top: 1rem; color: #666;">After submitting, you will be redirected to the results page.</p>
        </section>
    </div>
</body>
</html>
