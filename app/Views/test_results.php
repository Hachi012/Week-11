<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test Results - Anti-Hacker Lab</title>
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
            max-width: 900px;
            width: 100%;
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2.5rem 2rem;
            text-align: center;
        }
        .header h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        .header p {
            font-size: 1rem;
            opacity: 0.9;
        }
        .content {
            padding: 2rem;
        }
        .result-item {
            margin-bottom: 2rem;
            padding: 1.5rem;
            background-color: #f9f9f9;
            border-left: 5px solid #667eea;
            border-radius: 4px;
        }
        .result-item:last-child {
            margin-bottom: 0;
        }
        .result-item h3 {
            color: #667eea;
            margin-bottom: 0.75rem;
            font-size: 1.1rem;
        }
        .result-item p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 0.75rem;
        }
        .input-box {
            background: #fff;
            border: 1px solid #ddd;
            padding: 1rem;
            border-radius: 6px;
            font-family: 'Courier New', monospace;
            font-size: 0.95rem;
            word-break: break-all;
            color: #333;
            margin: 0.75rem 0;
        }
        .input-box b,
        .input-box strong {
            font-weight: 700;
            color: #111;
        }
        .csrf-pass {
            background-color: #d4edda;
            border-left-color: #28a745;
            color: #155724;
        }
        .csrf-pass h3 {
            color: #155724;
        }
        .xss-test {
            background-color: #fff3cd;
            border-left-color: #ffc107;
        }
        .xss-test h3 {
            color: #856404;
        }
        .explain {
            background-color: #d1ecf1;
            border-left-color: #0c5460;
        }
        .explain h3 {
            color: #0c5460;
        }
        .footer {
            padding: 1.5rem 2rem;
            background-color: #f5f5f5;
            border-top: 1px solid #eee;
            display: flex;
            gap: 1rem;
            justify-content: center;
        }
        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 6px;
            font-size: 0.95rem;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }
        .btn-primary {
            background-color: #667eea;
            color: white;
        }
        .btn-primary:hover {
            background-color: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .label {
            display: block;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔒 Security Test Results</h1>
            <p>The Anti-Hacker Lab</p>
        </div>

        <div class="content">
            <?php if (isset($submitted_text)): ?>
                <!-- CSRF Test Result -->
                <div class="result-item csrf-pass">
                    <h3>✅ CSRF Protection Test: PASSED</h3>
                    <p>Your form submission was successful! The CSRF token was validated correctly because you included <code>&lt;?= csrf_field() ?&gt;</code> in your form.</p>
                    <p>Without CSRF protection, this request would have been rejected with a <strong>403 Forbidden</strong> error.</p>
                </div>

                <!-- XSS Test Result -->
                <div class="result-item xss-test">
                    <h3>🛡️ XSS Protection Test</h3>
                    
                    <div>
                        <span class="label">Rendered Output (Unsafe demo):</span>
                        <div class="input-box">
                            <?= $submitted_text ?>
                        </div>
                    </div>

                    <?php $escapedOnce = esc((string) $submitted_text, 'html'); ?>

                    <div>
                        <span class="label">After esc() (safe — inserted into HTML as entities):</span>
                        <div class="input-box">
                            <?= $escapedOnce ?>
                        </div>
                    </div>

                    <div>
                        <span class="label">Escaped twice (lab demo — so you visibly see &amp;lt; and &amp;gt;):</span>
                        <div class="input-box">
                            <?= esc($escapedOnce, 'html') ?>
                        </div>
                    </div>

                    <p><strong>What happened?</strong> In the first box, the browser parses your string as HTML, so <code>&lt;b&gt;John&lt;/b&gt;</code> becomes real <code>&lt;b&gt;</code> tags and “John” looks bold. One <code>esc(..., 'html')</code> turns <code>&lt;</code> into <code>&amp;lt;</code> in the <em>HTML source</em>, so the browser shows the characters <code>&lt;</code> and <code>&gt;</code> as text and does not treat them as tags. Because the browser then decodes entities for display, you do not normally see the words <code>&amp;lt;</code> on the page—so this page adds the <strong>double-escaped</strong> box if you want to read the entity codes as plain text.</p>
                </div>

                <!-- Explanation -->
                <div class="result-item explain">
                    <h3>💡 Why This Matters</h3>
                    <p>This comparison shows why output escaping matters: rendering raw user input can change the page, while escaped output keeps the original characters visible without executing them.</p>
                    <p>Always use <code>esc()</code> when displaying user input in HTML to prevent XSS attacks.</p>
                </div>

            <?php else: ?>
                <div style="text-align: center; padding: 2rem;">
                    <p style="color: #666; font-size: 1.1rem;">No data to display. Submit the form to see the results.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="footer">
            <a href="<?= base_url('/') ?>" class="btn btn-secondary">← Back to Lab</a>
        </div>
    </div>
</body>
</html>
