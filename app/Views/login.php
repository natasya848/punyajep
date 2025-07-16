<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login - AMB</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <style>
        body {background: url('assets/dash/img/hero-bg.jpg') center center / cover no-repeat fixed; min-height: 100vh; 
            display: flex; justify-content: center; align-items: center; font-family: 'Nunito', sans-serif;}
        #auth {background: rgba(0,0,0,0.7); backdrop-filter: blur(6px); border-radius: 15px; padding: 40px 30px; max-width: 400px; 
            width: 100%; color: #fff; box-shadow: 0 8px 25px rgba(0,0,0,0.35);}
        #auth h3 {text-align: center; margin-bottom: 30px; font-weight: 800; color: #fff;}
        .form-group {margin-bottom: 1.5rem;}
        .form-control {width: 90%; padding: 0.9rem 1rem; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.3);
            color: #fff; border-radius: 8px; transition: all 0.3s ease; font-size: 1rem;}
        .form-control:focus {background: rgba(255,255,255,0.2); border-color: rgb(7, 151, 108);
            box-shadow: 0 0 0 0.25rem rgba(7,151,108,0.3); outline: none;}
        .form-control::placeholder {color: rgba(255,255,255,0.7)}
        .g-recaptcha {display: flex; justify-content: center; margin-bottom: 1.5rem;}
        #math-captcha label {font-weight: 700; margin-bottom: 0.5rem; display: block; color: #eee;}
        .btn-primary {background: rgb(7, 151, 108); border: none; width: 100%; padding: 0.9rem; font-weight: 700; border-radius: 8px;
            color: #fff; cursor: pointer; transition: background 0.3s ease, transform 0.2s ease;}
        .btn-primary:hover {background: #055e49; transform: translateY(-2px);}
    </style>
</head>
<body>

    <div id="auth">
        <h3>Sistem Manajemen Showroom</h3>
        <form id="login-form" action="login/aksi_login" method="post">
            <input type="hidden" name="correct_answer" id="correct-answer">
            <input type="hidden" name="math_answer" id="user-answer">

            <div class="form-group">
                <input type="text" name="usn" class="form-control" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="pswd" class="form-control" placeholder="Password" required>
            </div>

            <div class="g-recaptcha" data-sitekey="6Lcqf3ErAAAAAC8c1wMwKRe7cNh0dNccmOhJ80kY"></div>

            <div id="math-captcha" style="display:none;">
                <label id="math-question"></label>
                <input type="number" id="math-answer" class="form-control" placeholder="Jawaban Anda">
            </div>

            <button type="button" onclick="validateCaptcha()" class="btn btn-primary mt-4">Login</button>
        </form>
    </div>

    <script>
        let questions = [
            { a: 2, b: 3, op: '+' },
            { a: 5, b: 2, op: '-' },
            { a: 1, b: 6, op: '+' },
            { a: 8, b: 4, op: '-' }
        ];
        let correctAnswer;

        function generateMathCaptcha() {
            const soal = questions[Math.floor(Math.random() * questions.length)];
            const question = `Berapa hasil dari ${soal.a} ${soal.op} ${soal.b}?`;
            document.getElementById('math-question').innerText = question;
            correctAnswer = soal.op === '+' ? soal.a + soal.b : soal.a - soal.b;
            document.getElementById('correct-answer').value = correctAnswer;
        }

        function validateCaptcha() {
            if (!navigator.onLine) {
                document.getElementById('user-answer').value = document.getElementById('math-answer').value;
                const userAnswer = parseInt(document.getElementById('math-answer').value);
                if (isNaN(userAnswer) || userAnswer !== correctAnswer) {
                    alert("Jawaban salah. Silakan coba lagi.");
                    generateMathCaptcha();
                } else {
                    document.getElementById('login-form').submit();
                }
            } else {
                const response = grecaptcha.getResponse();
                if (!response) {
                    alert("Silakan selesaikan reCAPTCHA.");
                } else {
                    document.getElementById('login-form').submit();
                }
            }
        }

        window.addEventListener('load', () => {
            if (!navigator.onLine) {
                document.getElementById('math-captcha').style.display = 'block';
                generateMathCaptcha();
            }
        });
    </script>

</body>
</html>
