<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Spin Wheel</title>
    <style>

@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Plus Jakarta Sans',sans-serif;
}

body{

    min-height:100vh;

    display:flex;
    flex-direction:column;

    justify-content:center;
    align-items:center;

    overflow:hidden;

    background:
        linear-gradient(
            135deg,
            #071120 0%,
            #0f172a 45%,
            #111827 100%
        );
}

/*
=========================
BACKGROUND EFFECT
=========================
*/

body::before{

    content:'';

    position:absolute;

    width:550px;
    height:550px;

    background:#ff5f1f;

    top:-220px;
    left:-180px;

    border-radius:50%;

    filter:blur(140px);

    opacity:0.12;
}

body::after{

    content:'';

    position:absolute;

    width:500px;
    height:500px;

    background:#ff1744;

    bottom:-220px;
    right:-180px;

    border-radius:50%;

    filter:blur(150px);

    opacity:0.08;
}

/*
=========================
TITLE
=========================
*/

.page-title{

    color:white;

    font-size:58px;

    font-weight:800;

    letter-spacing:-2px;

    margin-bottom:8px;

    z-index:2;
}

.page-subtitle{

    color:#94a3b8;

    font-size:16px;

    margin-bottom:40px;

    z-index:2;
}

/*
=========================
WHEEL CARD
=========================
*/

.wheel-container{

    position:relative;

    width:600px;
    height:600px;

    display:flex;
    justify-content:center;
    align-items:center;

    border-radius:40px;

    background:
        rgba(255,255,255,0.04);

    border:
        1px solid rgba(255,255,255,0.06);

    backdrop-filter:blur(20px);

    box-shadow:
        0 30px 80px rgba(0,0,0,0.45);

    z-index:2;
}

/*
=========================
CANVAS
=========================
*/

canvas{

    border-radius:50%;

    border:14px solid rgba(255,255,255,0.92);

    box-shadow:
        0 0 40px rgba(255,95,31,0.18),
        0 0 90px rgba(255,95,31,0.12);

    transition:
        transform 5s cubic-bezier(0.17,0.67,0.2,1);
}

/*
=========================
CENTER CIRCLE
=========================
*/

.wheel-container::before{

    content:'SPIN';

    position:absolute;

    width:130px;
    height:130px;

    background:
        linear-gradient(
            135deg,
            #ffffff,
            #f3f4f6
        );

    border-radius:50%;

    display:flex;
    justify-content:center;
    align-items:center;

    color:#0f172a;

    font-size:24px;

    font-weight:800;

    z-index:20;

    box-shadow:
        0 10px 35px rgba(0,0,0,0.35);
}

/*
=========================
ARROW
=========================
*/

.arrow{

    position:absolute;

    top:18px;

    left:50%;

    transform:translateX(-50%);

    width:0;
    height:0;

    border-left:24px solid transparent;
    border-right:24px solid transparent;
    border-top:46px solid #ff6b00;

    z-index:25;

    filter:
        drop-shadow(0 10px 15px rgba(0,0,0,0.35));
}

/*
=========================
BUTTON
=========================
*/

button{

    margin-top:35px;

    padding:18px 42px;

    border:none;

    border-radius:999px;

    background:
        linear-gradient(
            135deg,
            #ff5f1f,
            #ff7b00
        );

    color:white;

    font-size:18px;

    font-weight:700;

    letter-spacing:0.5px;

    cursor:pointer;

    transition:0.35s;

    box-shadow:
        0 15px 40px rgba(255,95,31,0.35);

    z-index:2;
}

button:hover{

    transform:
        translateY(-4px)
        scale(1.04);
}

button:disabled{

    opacity:0.6;

    cursor:not-allowed;
}

/*
=========================
RESULT
=========================
*/

#result{

    margin-top:28px;

    color:white;

    font-size:26px;

    font-weight:700;

    text-align:center;

    z-index:2;
}

/*
=========================
AREA BADGE
=========================
*/

.area-badge{

    position:fixed;

    top:25px;
    right:25px;

    z-index:999;

    padding:18px 24px;

    border-radius:28px;

    background:
        rgba(255,255,255,0.05);

    border:
        1px solid rgba(255,255,255,0.08);

    backdrop-filter:blur(16px);

    box-shadow:
        0 15px 40px rgba(0,0,0,0.35);
}

.badge-label{

    color:#94a3b8;

    font-size:11px;

    letter-spacing:4px;

    font-weight:700;
}

.badge-title{

    margin-top:5px;

    color:white;

    font-size:30px;

    font-weight:800;
}

/*
=========================
LOGOUT
=========================
*/

.logout-container{

    position:fixed;

    top:25px;
    left:25px;

    z-index:999;
}

.logout-btn{

    background:
        rgba(255,255,255,0.05);

    border:
        1px solid rgba(255,255,255,0.08);

    backdrop-filter:blur(16px);

    color:white;

    padding:14px 28px;

    border-radius:20px;

    font-size:14px;

    font-weight:700;

    transition:0.3s;
}

.logout-btn:hover{

    background:
        linear-gradient(
            135deg,
            #dc2626,
            #ef4444
        );
}

/*
=========================
RESPONSIVE
=========================
*/

@media(max-width:768px){

    .page-title{

        font-size:38px;

        text-align:center;
    }

    .wheel-container{

        width:95%;
        height:auto;

        padding:20px;
    }

    canvas{

        width:100%;
        height:auto;
    }

}

/*
=========================
SUPER POPUP
=========================
*/

.winner-popup{

    position:fixed;

    inset:0;

    background:
        radial-gradient(
            circle,
            rgba(255,95,31,0.15),
            rgba(0,0,0,0.88)
        );

    display:flex;

    justify-content:center;
    align-items:center;

    z-index:99999;

    opacity:0;

    visibility:hidden;

    overflow:hidden;

    transition:0.4s;
}

.winner-popup.active{

    opacity:1;

    visibility:visible;
}

/*
=========================
FLASH EFFECT
=========================
*/

.flash{

    position:absolute;

    width:100%;
    height:100%;

    background:white;

    opacity:0;

    animation:flashAnim 0.8s ease;
}

@keyframes flashAnim{

    0%{
        opacity:0;
    }

    20%{
        opacity:0.9;
    }

    100%{
        opacity:0;
    }
}

/*
=========================
POPUP CARD
=========================
*/

.popup-card{

    position:relative;

    width:500px;

    padding:70px 50px;

    border-radius:42px;

    overflow:hidden;

    text-align:center;

    background:
        linear-gradient(
            145deg,
            #0f172a,
            #111827,
            #1e293b
        );

    border:
        2px solid rgba(255,255,255,0.08);

    box-shadow:
        0 0 40px rgba(255,95,31,0.35),
        0 0 100px rgba(255,95,31,0.15),
        0 30px 80px rgba(0,0,0,0.55);

    transform:
        scale(0.5)
        rotate(-10deg);

    transition:0.45s;
}

.winner-popup.active .popup-card{

    transform:
        scale(1)
        rotate(0deg);

    animation:
        shakeCard 0.6s ease;
}

@keyframes shakeCard{

    0%{
        transform:scale(1) rotate(0);
    }

    25%{
        transform:scale(1.03) rotate(-2deg);
    }

    50%{
        transform:scale(1.03) rotate(2deg);
    }

    75%{
        transform:scale(1.02) rotate(-1deg);
    }

    100%{
        transform:scale(1) rotate(0);
    }
}

/*
=========================
GLOW
=========================
*/

.popup-glow{

    position:absolute;

    width:320px;
    height:320px;

    background:#ff5f1f;

    border-radius:50%;

    top:-150px;
    right:-120px;

    filter:blur(120px);

    opacity:0.4;
}

/*
=========================
TROPHY
=========================
*/

.popup-icon{

    font-size:110px;

    animation:
        trophyJump 1s infinite;

    position:relative;

    z-index:5;

    filter:
        drop-shadow(0 0 25px rgba(255,215,0,0.6));
}

@keyframes trophyJump{

    0%{
        transform:translateY(0) scale(1);
    }

    50%{
        transform:translateY(-18px) scale(1.08);
    }

    100%{
        transform:translateY(0) scale(1);
    }
}

/*
=========================
TEXT
=========================
*/

.popup-title{

    color:white;

    font-size:52px;

    font-weight:900;

    margin-top:12px;

    letter-spacing:2px;

    text-shadow:
        0 0 25px rgba(255,255,255,0.2);

    position:relative;

    z-index:5;
}

.popup-sub{

    color:#cbd5e1;

    margin-top:12px;

    font-size:16px;

    position:relative;

    z-index:5;
}

.popup-prize{

    color:#ff7b00;

    font-size:42px;

    font-weight:900;

    margin-top:24px;

    text-transform:uppercase;

    text-shadow:
        0 0 30px rgba(255,123,0,0.75);

    animation:
        glowPrize 1s infinite alternate;

    position:relative;

    z-index:5;
}

@keyframes glowPrize{

    from{
        text-shadow:
            0 0 20px rgba(255,123,0,0.4);
    }

    to{
        text-shadow:
            0 0 40px rgba(255,123,0,1);
    }
}

/*
=========================
BUTTON
=========================
*/

.popup-card button{

    margin-top:35px;

    width:100%;

    padding:18px;

    border:none;

    border-radius:999px;

    background:
        linear-gradient(
            135deg,
            #ff5f1f,
            #ff1744
        );

    color:white;

    font-size:18px;

    font-weight:800;

    cursor:pointer;

    box-shadow:
        0 15px 40px rgba(255,95,31,0.35);
}

/*
=========================
CONFETTI
=========================
*/

.confetti{

    position:absolute;

    width:14px;
    height:14px;

    background:red;

    top:-20px;

    animation:
        confettiFall linear forwards;
}

@keyframes confettiFall{

    to{

        transform:
            translateY(110vh)
            rotate(720deg);

        opacity:0;
    }

}
</style>
</head>
<body>

<div class="logout-container">

    <form method="POST" action="{{ route('logout') }}">

        @csrf

        <button type="submit" class="logout-btn">

            Logout

        </button>

    </form>

</div>

<div class="area-badge">

    <div class="badge-glow"></div>

    <div class="badge-content">

        <div class="badge-dot"></div>

        <div>

            <p class="badge-label">
                ACTIVE AREA
            </p>

            <h2 class="badge-title">
                {{ auth()->user()->area->name ?? '-' }}
            </h2>

        </div>

    </div>

</div>
<h1 class="page-title">
    SPIN WHEEL EVENT
</h1>

<p class="page-subtitle">
    Putar roda keberuntungan dan dapatkan hadiah menarik
</p>

    <div class="wheel-container">
        <div class="arrow"></div>
        <canvas id="wheelCanvas" width="500" height="500"></canvas>
    </div>

    <button id="spinBtn">PUTAR RODA!</button>
    <div id="result"></div>

<div class="winner-popup" id="winnerPopup">

    <div class="flash"></div>

    <div class="popup-card">

        <div class="popup-glow"></div>

        <div class="popup-icon">
            🏆
        </div>

        <h2 class="popup-title">
            JACKPOT!
        </h2>

        <p class="popup-sub">
            Kamu berhasil memenangkan hadiah
        </p>

        <h1 class="popup-prize" id="popupPrize">
            HADIAH
        </h1>

        <button onclick="closePopup()">
            CLAIM HADIAH
        </button>

    </div>

</div>

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

    const hadiah =
        prizes[winnerIndex].nama_hadiah;

    resultDiv.textContent =
        "🎉 Selamat! Kamu dapat: "
        + hadiah;

    /*
    =========================
    SHOW POPUP
    =========================
    */

    document
        .getElementById('popupPrize')
        .innerText = hadiah;

    document
        .getElementById('winnerPopup')
        .classList
        .add('active');

    /*
    =========================
    SOUND EFFECT
    =========================
    */

    const audio =
        new Audio(
            'https://assets.mixkit.co/active_storage/sfx/2013/2013-preview.mp3'
        );

    audio.play();

    /*
    =========================
    ENABLE BUTTON
    =========================
    */

    spinBtn.disabled = false;

},4000);

function createConfetti(){

    for(let i=0;i<120;i++){

        const confetti =
            document.createElement('div');

        confetti.classList.add('confetti');

        confetti.style.left =
            Math.random() * 100 + 'vw';

        confetti.style.background =
            [
                '#ff1744',
                '#ff7b00',
                '#ffd700',
                '#00e5ff',
                '#ffffff'
            ][Math.floor(Math.random()*5)];

        confetti.style.animationDuration =
            (Math.random()*3+2)+'s';

        confetti.style.opacity =
            Math.random();

        confetti.style.transform =
            `rotate(${Math.random()*360}deg)`;

        document.body.appendChild(confetti);

        setTimeout(()=>{
            confetti.remove();
        },5000);
    }
}

}

        loadPrizes();

        function closePopup(){

    document
        .getElementById('winnerPopup')
        .classList
        .remove('active');
}
createConfetti();

navigator.vibrate?.([300,100,300]);
    </script>


</body>
</html>