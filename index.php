<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>For You 💌</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Lato:wght@300;400&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --rose:    #f43f5e;
      --blush:   #fda4af;
      --petal:   #fff1f2;
      --cream:   #fffbf7;
      --brown:   #4a1c2a;
      --soft:    #fbcfe8;
    }

    html, body {
      height: 100%;
      background: var(--cream);
      font-family: 'Lato', sans-serif;
      overflow: hidden;
    }

    /* ── floating hearts ── */
    .hearts-bg {
      position: fixed; inset: 0; pointer-events: none; z-index: 0;
    }
    .heart {
      position: absolute;
      font-size: clamp(14px, 2vw, 22px);
      animation: floatUp linear infinite;
      opacity: 0;
      user-select: none;
    }
    @keyframes floatUp {
      0%   { transform: translateY(110vh) rotate(0deg); opacity: 0; }
      10%  { opacity: .45; }
      90%  { opacity: .3; }
      100% { transform: translateY(-10vh) rotate(25deg); opacity: 0; }
    }

    /* ── center card ── */
    .card {
      position: relative; z-index: 1;
      display: flex; flex-direction: column;
      align-items: center; justify-content: center;
      height: 100vh;
      text-align: center;
      padding: 2rem;
    }

    .envelope {
      font-size: 4.5rem;
      margin-bottom: 1.4rem;
      animation: wiggle 3s ease-in-out infinite;
      filter: drop-shadow(0 8px 18px rgba(244,63,94,.22));
    }
    @keyframes wiggle {
      0%,100% { transform: rotate(-4deg) scale(1); }
      50%      { transform: rotate(4deg)  scale(1.06); }
    }

    h1 {
      font-family: 'Playfair Display', serif;
      font-size: clamp(2rem, 5vw, 3.2rem);
      color: var(--brown);
      line-height: 1.25;
      margin-bottom: .6rem;
    }
    h1 em { color: var(--rose); font-style: italic; }

    p.sub {
      font-size: .95rem;
      color: #a1748c;
      letter-spacing: .08em;
      text-transform: uppercase;
      margin-bottom: 2.6rem;
    }

    .btn {
      position: relative;
      background: var(--rose);
      color: #fff;
      border: none;
      border-radius: 50px;
      padding: 1rem 2.8rem;
      font-family: 'Lato', sans-serif;
      font-size: 1.05rem;
      font-weight: 400;
      letter-spacing: .12em;
      text-transform: uppercase;
      cursor: pointer;
      box-shadow: 0 8px 28px rgba(244,63,94,.38);
      transition: transform .18s, box-shadow .18s;
      text-decoration: none;
      display: inline-block;
    }
    .btn:hover  { transform: translateY(-3px); box-shadow: 0 14px 36px rgba(244,63,94,.46); }
    .btn:active { transform: scale(.97); }

    .btn::after {
      content: '→';
      display: inline-block;
      margin-left: .55rem;
      transition: transform .2s;
    }
    .btn:hover::after { transform: translateX(4px); }

    .note {
      margin-top: 2.2rem;
      font-size: .8rem;
      color: #c49aaf;
      font-style: italic;
    }
  </style>
</head>
<body>

<div class="hearts-bg" id="heartsContainer"></div>

<div class="card">
  <div class="envelope">💌</div>
  <h1>Hi <em>baby</em>,<br>please click the button.</h1>
  <p class="sub">Something special is waiting for you, or not lol face ass ✨</p>
  <a class="btn" href="dashboard.php">Open it</a>
</div>

<script>
  const emojis = ['🩷','💕','💗','💓','💝','🌸','✨'];
  const container = document.getElementById('heartsContainer');

  function spawnHeart() {
    const el = document.createElement('span');
    el.className = 'heart';
    el.textContent = emojis[Math.floor(Math.random() * emojis.length)];
    el.style.left = Math.random() * 100 + 'vw';
    const dur = 7 + Math.random() * 8;
    el.style.animationDuration = dur + 's';
    el.style.animationDelay    = (Math.random() * 4) + 's';
    el.style.fontSize = (12 + Math.random() * 18) + 'px';
    container.appendChild(el);
    setTimeout(() => el.remove(), (dur + 5) * 1000);
  }

  // initial burst
  for (let i = 0; i < 22; i++) spawnHeart();
  setInterval(spawnHeart, 700);
</script>
</body>
</html>
