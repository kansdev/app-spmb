<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Jeda Tes</title>
        <!-- Bootstrap 5.3 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body { background-color: #f8f9fa; }
            .break-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; }
            .break-card { max-width: 600px; width: 100%; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        </style>
    </head>
    <body>

        <div class="container break-container">
            <div class="card break-card text-center p-5">
                <div class="card-body">
                    <!-- Ikon Jeda -->
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-pause-circle text-primary" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M5 6.5A1.5 1.5 0 0 1 6.5 5h3A1.5 1.5 0 0 1 11 6.5v3A1.5 1.5 0 0 1 9.5 5h-3A1.5 1.5 0 0 1 5 9.5v-3z"/>
                        </svg>
                    </div>
                    
                    <h2 class="card-title fw-bold mb-3">Sesi Jeda Tes</h2>
                    <p class="card-text text-muted mb-4">
                        Anda telah menyelesaikan sesi ini. Silakan istirahat sejenak. 
                        Sesi berikutnya akan dimulai dalam <strong id="timer">60</strong> detik. 
                    </p>
                </div>
            </div>
        </div>

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
<!-- Bootstrap 5.3 JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>