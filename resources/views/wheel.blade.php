<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Spin Wheel</title>
    <style>
        body { font-family: arial; display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 100vh; background-color: #1e1c1c; margin: 0; }
        .wheel-container { position: relative; width: 500px; height: 500px; margin-bottom: 20px; }
        canvas { border-radius: 50%; box-shadow: 0 0 20px rgba(0,0,0,0.2); transition: transform 4s cubic-bezier(0.25, 0.1, 0.25, 1); }
        .arrow { position: absolute; top: -10px; left: 50%; transform: translateX(-50%); width: 0; height: 0; border-left: 15px solid transparent; border-right: 15px solid transparent; border-top: 25px solid #f9cd1f; z-index: 10; }
        button { padding: 12px 30px; font-size: 18px; cursor: pointer; background-color: #28a745; color: white; border: none; border-radius: 50px; transition: 0.3s; }
        button:hover { background-color: #218838; }
        button:disabled { background-color: #2f2828; cursor: not-allowed; }
        #result { margin-top: 20px; font-size: 20px; font-weight: bold; color: #f8f8f8; }
    </style>
</head>
<body>

    <div class="wheel-container">
        <div class="arrow"></div>
        <canvas id="wheelCanvas" width="500" height="500"></canvas>
    </div>

    <button id="spinBtn">PUTAR RODA!</button>
    <div id="result"></div>

    <script>
        const canvas = document.getElementById('wheelCanvas');
        const ctx = canvas.getContext('2d');
        const spinBtn = document.getElementById('spinBtn');
        const resultDiv = document.getElementById('result');
        
        let prizes = [];
        let currentRotation = 0;
        const centerX = canvas.width / 2;
        const centerY = canvas.height / 2;
        const radius = canvas.width / 2;

        // Load Data dari Server
        async function loadPrizes() {
            try {
                const response = await fetch('/api/prizes');
                prizes = await response.json();
                console.log("hadiah:", prizes);
                drawWheel();
            } catch (error) {
                console.error("Gagal muat data:", error);
            }
        }

        // Gambar Roda Canvas
        function drawWheel() {
            if (prizes.length === 0) return;
            const arcSize = (2 * Math.PI) / prizes.length;

            prizes.forEach((prize, i) => {
                const angle = i * arcSize;
                
                // Gambar Slice
                ctx.beginPath();
                ctx.moveTo(centerX, centerY);
                ctx.arc(centerX, centerY, radius, angle, angle + arcSize);
                ctx.fillStyle = prize.warna;
                ctx.fill();
                ctx.stroke();

                // Gambar Text
                ctx.save();
                ctx.translate(centerX, centerY);
                ctx.rotate(angle + arcSize / 2);
                ctx.textAlign = "right";
                ctx.fillStyle = "#f9f9f9";
                ctx.font = "bold 16px arial";
                ctx.fillText(prize.nama_hadiah, radius - 10, 5);
                ctx.restore();
            });
        }

        // Handle Klik Tombol
        spinBtn.addEventListener('click', async () => {
            spinBtn.disabled = true;
            resultDiv.textContent = "Memutar...";

            try {
                const response = await fetch('/api/spin', { method: 'POST' });
                const data = await response.json();

                if (data.success) {
                    animateSpin(data.winner_id);
                } else {
                    alert(data.message || "Terjadi kesalahan");
                    spinBtn.disabled = false;
                }
            } catch (error) {
                console.error(error);
                spinBtn.disabled = false;
            }
        });

        // Animasi Putar
function animateSpin(winnerId) {

    const winnerIndex =
        prizes.findIndex(
            p => p.id === winnerId
        );

    /*
    =========================
    TOTAL SUDUT PER SLICE
    =========================
    */

    const arcDeg =
        360 / prizes.length;

    /*
    =========================
    POSISI POINTER DI ATAS
    =========================
    */

    const pointerAngle = 270;

    /*
    =========================
    POSISI TARGET PEMENANG
    =========================
    */

    const targetAngle =
        pointerAngle -
        (winnerIndex * arcDeg) -
        (arcDeg / 2);

    /*
    =========================
    EXTRA PUTARAN
    =========================
    */

    const extraSpins = 360 * 5;

    /*
    =========================
    TOTAL ROTASI BARU
    =========================
    */

    const newRotation =
        currentRotation +
        extraSpins +
        (
            targetAngle -
            (currentRotation % 360)
        );

    /*
    =========================
    ANIMASI
    =========================
    */

    canvas.style.transform =
        `rotate(${newRotation}deg)`;

    currentRotation =
        newRotation;

    /*
    =========================
    HASIL PEMENANG
    =========================
    */

    setTimeout(() => {

        resultDiv.textContent =
            "🎉 Selamat! Kamu dapat: "
            + prizes[winnerIndex].nama_hadiah;

        spinBtn.disabled = false;

    },4000);

}

        loadPrizes();
    </script>
</body>
</html>