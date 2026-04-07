<!DOCTYPE html>
<html>
    <head>
        <title>Jeda</title>
    </head>
    <body class="text-center">

        <h2>Silakan istirahat sejenak</h2>
        <h3>Soal berikutnya akan dimulai dalam:</h3>

        <h1 id="timer">60</h1>

        <script>
            let waktu = 60;

            let interval = setInterval(() => {
                waktu--;
                document.getElementById('timer').innerText = waktu;

                if (waktu <= 0) {
                    clearInterval(interval);
                    location.reload();
                }
            }, 1000);
        </script>

    </body>
</html>