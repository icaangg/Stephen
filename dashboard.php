<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Our Little World 🌸</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Lato:wght@300;400;700&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --rose:   #f43f5e;
      --blush:  #fda4af;
      --petal:  #fff1f2;
      --cream:  #fffbf7;
      --brown:  #4a1c2a;
      --muted:  #a1748c;
      --soft:   #fbcfe8;
      --card-bg:#fff8f9;
    }

    html { scroll-behavior: smooth; }
    body {
      min-height: 100vh;
      background: var(--cream);
      font-family: 'Lato', sans-serif;
      color: var(--brown);
    }

    /* ── hearts bg ── */
    .hearts-bg { position: fixed; inset: 0; pointer-events: none; z-index: 0; }
    .heart { position: absolute; animation: floatUp linear infinite; opacity: 0; user-select: none; }
    @keyframes floatUp {
      0%   { transform: translateY(110vh); opacity: 0; }
      10%  { opacity: .3; }
      90%  { opacity: .2; }
      100% { transform: translateY(-10vh); opacity: 0; }
    }

    /* ── layout ── */
    .page { position: relative; z-index: 1; max-width: 860px; margin: 0 auto; padding: 3rem 1.4rem 5rem; }

    /* ── header ── */
    header { text-align: center; margin-bottom: 3rem; }
    header .tag {
      display: inline-block;
      background: var(--soft);
      color: var(--rose);
      font-size: .75rem;
      letter-spacing: .15em;
      text-transform: uppercase;
      padding: .35rem 1.1rem;
      border-radius: 50px;
      margin-bottom: 1rem;
    }
    header h1 {
      font-family: 'Playfair Display', serif;
      font-size: clamp(2rem, 5vw, 3rem);
      line-height: 1.2;
    }
    header h1 em { color: var(--rose); font-style: italic; }
    header p { margin-top: .6rem; color: var(--muted); font-size: .95rem; }

    /* ── grid ── */
    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 1.4rem;
    }

    /* ── card base ── */
    .card {
      background: var(--card-bg);
      border: 1.5px solid #f9d4dc;
      border-radius: 20px;
      padding: 1.6rem 1.8rem;
      box-shadow: 0 4px 24px rgba(244,63,94,.07);
      transition: transform .2s, box-shadow .2s;
      animation: fadeUp .6s ease both;
    }
    .card:hover { transform: translateY(-4px); box-shadow: 0 10px 32px rgba(244,63,94,.13); }
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(22px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .card:nth-child(1) { animation-delay: .05s; }
    .card:nth-child(2) { animation-delay: .12s; }
    .card:nth-child(3) { animation-delay: .19s; }
    .card:nth-child(4) { animation-delay: .26s; }
    .card:nth-child(5) { animation-delay: .33s; }
    .card:nth-child(6) { animation-delay: .40s; }

    .card-icon { font-size: 2.2rem; margin-bottom: .8rem; }
    .card-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.05rem;
      margin-bottom: .5rem;
    }
    .card-body { color: var(--muted); font-size: .88rem; line-height: 1.65; }

    /* ── love meter ── */
    .love-meter { grid-column: 1 / -1; }
    .meter-label {
      display: flex;
      justify-content: space-between;
      align-items: baseline;
      margin-bottom: .7rem;
    }
    .meter-label span:last-child {
      font-family: 'Playfair Display', serif;
      font-size: 2.2rem;
      color: var(--rose);
    }
    .bar-track {
      background: #fce7f3;
      border-radius: 50px;
      height: 22px;
      overflow: hidden;
    }
    .bar-fill {
      height: 100%;
      width: 0%;
      border-radius: 50px;
      background: linear-gradient(90deg, var(--blush), var(--rose));
      transition: width 1.8s cubic-bezier(.22,1,.36,1);
      position: relative;
    }
    .bar-fill::after {
      content: '';
      position: absolute; right: 0; top: 0; bottom: 0; width: 60px;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,.3));
      animation: shimmer 2s linear infinite;
    }
    @keyframes shimmer { from { transform: translateX(-60px); } to { transform: translateX(60px); } }

    /* ── reasons card ── */
    .reasons-list { list-style: none; }
    .reasons-list li {
      padding: .4rem 0;
      border-bottom: 1px dashed #fce7f3;
      font-size: .87rem;
      color: var(--muted);
      display: flex; align-items: flex-start; gap: .5rem;
    }
    .reasons-list li:last-child { border-bottom: none; }
    .reasons-list li::before { content: '🌸'; flex-shrink: 0; }

    /* ── mood tracker ── */
    .mood-grid { display: flex; gap: .55rem; flex-wrap: wrap; margin-top: .5rem; }
    .mood-btn {
      background: var(--petal);
      border: 1.5px solid #fce7f3;
      border-radius: 50px;
      padding: .4rem .9rem;
      font-size: .85rem;
      cursor: pointer;
      transition: background .15s, border-color .15s, transform .15s;
    }
    .mood-btn:hover, .mood-btn.active {
      background: var(--rose); color: #fff;
      border-color: var(--rose); transform: scale(1.05);
    }

    /* ── countdown ── */
    .countdown-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: .6rem;
      margin-top: .8rem;
    }
    .days-together {
      grid-column: span 2;
    }
    @media (max-width: 700px) {
      .days-together {
        grid-column: auto;
      }
    }
    .cd-box {
      background: var(--petal);
      border-radius: 12px;
      padding: .7rem .4rem;
      text-align: center;
    }
    .cd-num {
      font-family: 'Playfair Display', serif;
      font-size: 1.8rem;
      color: var(--rose);
      line-height: 1;
    }
    .cd-lbl { font-size: .7rem; color: var(--muted); letter-spacing: .08em; text-transform: uppercase; }

    /* ── love note ── */
    .love-note {
      background: linear-gradient(135deg, #fff0f3, #fff8fb);
      border-left: 4px solid var(--rose);
      border-radius: 0 16px 16px 0;
      padding: 1.2rem 1.4rem;
      font-family: 'Playfair Display', serif;
      font-style: italic;
      font-size: 1rem;
      color: var(--brown);
      line-height: 1.7;
      cursor: pointer;
      position: relative;
    }
    .love-note .refresh-hint {
      font-size: .72rem;
      font-family: 'Lato', sans-serif;
      font-style: normal;
      color: var(--muted);
      margin-top: .6rem;
      display: block;
    }

    /* ── stats strip ── */
    .stats-strip {
      display: flex; gap: 1rem; flex-wrap: wrap;
      background: linear-gradient(135deg, var(--rose), #fb7185);
      border-radius: 20px;
      padding: 1.4rem 2rem;
      color: #fff;
      grid-column: 1 / -1;
      margin-top: .2rem;
      box-shadow: 0 8px 28px rgba(244,63,94,.28);
    }
    .stat { flex: 1; min-width: 120px; text-align: center; }
    .stat-num {
      font-family: 'Playfair Display', serif;
      font-size: 2rem;
      line-height: 1;
    }
    .stat-lbl { font-size: .75rem; opacity: .85; letter-spacing: .1em; text-transform: uppercase; margin-top: .25rem; }

    /* ── mobile (iPhone 15 Pro Max and similar) ── */
    @media (max-width: 430px) {
      .page {
        padding: 1.2rem .9rem 2.2rem;
      }

      header {
        margin-bottom: 1.5rem;
      }

      header .tag {
        font-size: .68rem;
        letter-spacing: .1em;
        padding: .3rem .8rem;
      }

      header p {
        font-size: .86rem;
      }

      .grid {
        grid-template-columns: 1fr;
        gap: .9rem;
      }

      .card {
        padding: 1.15rem 1rem;
        border-radius: 16px;
      }

      .card:hover {
        transform: none;
      }

      .days-together {
        grid-column: auto;
      }

      .meter-label span:last-child {
        font-size: 1.7rem;
      }

      .countdown-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: .5rem;
      }

      .cd-box {
        padding: .65rem .35rem;
      }

      .cd-num {
        font-size: 1.5rem;
      }

      .stats-strip {
        padding: 1rem .9rem;
        gap: .6rem;
      }

      .stat {
        flex: 1 1 calc(50% - .3rem);
        min-width: 0;
      }

      .stat-num {
        font-size: 1.55rem;
      }

      .stat-lbl {
        font-size: .66rem;
      }
    }
  </style>
</head>
<body>

<div class="hearts-bg" id="heartsContainer"></div>

<div class="page">

  <header>
    <div class="tag">💌 A message just for you</div>
    <h1>This is our little <em>world</em>, babe</h1>
    <p>everything here is made with love — just for you ( gaaaay lol ) 🩷</p>
  </header>

  <div class="grid">

    <!-- Love Meter -->
    <div class="card love-meter">
      <div class="card-icon">💗</div>
      <div class="card-title" style="font-size:1.1rem; margin-bottom:.9rem;">How much I love you</div>
      <div class="meter-label">
        <span style="color:var(--muted); font-size:.85rem;">Love level</span>
        <span id="pctLabel">0%</span>
      </div>
      <div class="bar-track">
        <div class="bar-fill" id="barFill"></div>
      </div>
      <p class="card-body" style="margin-top:.9rem;">The bar doesn't go higher than 100%, I hope it dooes lol but honestly, my love for you does. 💕</p>
    </div>

    <!-- Reasons I Love You -->
    <div class="card">
      <div class="card-icon">📝</div>
      <div class="card-title">Reasons I love you</div>
      <ul class="reasons-list">
        <li>You're annoying but I love it</li>
        <li>You're incredibly perfect</li>
        <li>How you notices the little things aww</li>
        <li>The way you make me feel safe, secure and loved</li>
        <li>You're my favorite person. And you're gay.</li>
      </ul>
    </div>

    <!-- Love Note of the Day -->
    <div class="card">
      <div class="card-icon">✉️</div>
      <div class="card-title">Today's love note</div>
      <div class="love-note" id="loveNote">
        Loading something sweet...
        <span class="refresh-hint">tap to get a new one 🩷</span>
      </div>
    </div>

    <div class="card">
      <div class="card-icon">🌤</div>
      <div class="card-title">How are you feeling?</div>
      <p class="card-body" style="margin-bottom:.8rem;">Tell me your vibe today, I wanna know or just click everything to see a message lol💬</p>
      <div class="mood-grid" id="moodGrid">
        <button class="mood-btn">😊 Happy</button>
        <button class="mood-btn">🥰 Loved</button>
        <button class="mood-btn">😴 Tired</button>
        <button class="mood-btn">🤩 Excited</button>
        <button class="mood-btn">🥺 Soft</button>
        <button class="mood-btn">😌 Chill</button>
      </div>
      <p class="card-body" id="moodMsg" style="margin-top:.8rem; min-height:1.4rem;"></p>
    </div>

    <div class="card days-together">
      <div class="card-icon">📅</div>
      <div class="card-title">Days we've been together</div>
      <p class="card-body">Every single day with you is a gift 💝</p>
      <div class="countdown-grid" id="cdGrid">
        <div class="cd-box"><div class="cd-num" id="cdYears">–</div><div class="cd-lbl">Years</div></div>
        <div class="cd-box"><div class="cd-num" id="cdMonths">–</div><div class="cd-lbl">Months</div></div>
        <div class="cd-box"><div class="cd-num" id="cdDays">–</div><div class="cd-lbl">Days</div></div>
        <div class="cd-box"><div class="cd-num" id="cdTotal">–</div><div class="cd-lbl">Total days</div></div>
      </div>
    </div>


    <!-- Stats Strip -->
    <div class="stats-strip">
      <div class="stat">
        <div class="stat-num" id="statHugs">∞</div>
        <div class="stat-lbl">Hugs deserved</div>
      </div>
      <div class="stat">
        <div class="stat-num">100%</div>
        <div class="stat-lbl">My heart = yours</div>
      </div>
      <div class="stat">
        <div class="stat-num" id="statSmiles">∞</div>
        <div class="stat-lbl">Smiles you give me</div>
      </div>
      <div class="stat">
        <div class="stat-num">1</div>
        <div class="stat-lbl">Person for me</div>
      </div>
    </div>

  </div><!-- /grid -->
</div><!-- /page -->

<script>
  /* ── floating hearts ── */
  const emojis = ['🩷','💕','💗','💓','💝','🌸','✨','🫶'];
  const hc = document.getElementById('heartsContainer');
  function spawnHeart() {
    const el = document.createElement('span');
    el.className = 'heart';
    el.textContent = emojis[Math.floor(Math.random() * emojis.length)];
    el.style.left = Math.random() * 100 + 'vw';
    const dur = 9 + Math.random() * 9;
    el.style.animationDuration = dur + 's';
    el.style.animationDelay = (Math.random() * 3) + 's';
    el.style.fontSize = (12 + Math.random() * 14) + 'px';
    hc.appendChild(el);
    setTimeout(() => el.remove(), (dur + 4) * 1000);
  }
  for (let i = 0; i < 18; i++) spawnHeart();
  setInterval(spawnHeart, 900);

  /* ── love meter animation ── */
  window.addEventListener('load', () => {
    setTimeout(() => {
      document.getElementById('barFill').style.width = '100%';
      let n = 0;
      const iv = setInterval(() => {
        n++;
        document.getElementById('pctLabel').textContent = n + '%';
        if (n >= 100) clearInterval(iv);
      }, 18);
    }, 400);
  });

  /* ── love notes ── */
  const notes = [
    "Pussy Booooy",
    "I didn't know what home felt like until I met you.",
    "Loving you is the easiest thing I've ever done.",
    "You make ordinary moments feel like magic.",
    "I choose you. Every single day. Always.",
    "You are more than enough, you are everything.",
    "Isn't this cute? Lol face ass",
    "Thank you for being the reason I smile everyday",
    "I love you always babe",
    "You are my sunshine on the cloudiest of days, lol that's gay",
  ];
  function showNote() {
    const idx = Math.floor(Math.random() * notes.length);
    document.getElementById('loveNote').childNodes[0].textContent = notes[idx] + ' ';
  }
  showNote();
  document.getElementById('loveNote').addEventListener('click', showNote);

  /* ── mood messages ── */
  const moodMsgs = {
    '😊 Happy':   "Seeing you happy makes my whole day 💛",
    '🥰 Loved':   "Good boy. Because you are SO loved 🫶",
    '😴 Tired':   "Rest, baby. You deserve it. I got you 🌙",
    '🤩 Excited': "And what are you excited about? Hmm",
    '🥺 Soft':    "Come here. I just want to hold you 🤍",
    '😌 Chill':   "Perfect. Let's just exist together 🍃",
  };
  document.getElementById('moodGrid').addEventListener('click', e => {
    if (!e.target.classList.contains('mood-btn')) return;
    document.querySelectorAll('.mood-btn').forEach(b => b.classList.remove('active'));
    e.target.classList.add('active');
    document.getElementById('moodMsg').textContent = moodMsgs[e.target.textContent] || '';
  });

  /* ── days together ── */
  // Set this to the exact number you want to show:
  const daysTogether = 34;
  document.getElementById('cdYears').textContent = '0';
  document.getElementById('cdMonths').textContent = '1';
  document.getElementById('cdDays').textContent = '4';
  document.getElementById('cdTotal').textContent = daysTogether.toLocaleString();

</script>
</body>
</html>
