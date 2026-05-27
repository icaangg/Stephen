<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
  <title>Lame Ass Shooting Game 💘</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Lato:wght@300;400;700&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --rose:  #f43f5e;
      --blush: #fda4af;
      --petal: #fff1f2;
      --cream: #fffbf7;
      --brown: #4a1c2a;
      --muted: #a1748c;
      --soft:  #fbcfe8;
    }
    html, body {
      height: 100%; background: #1a0510;
      font-family: 'Lato', sans-serif;
      overflow: hidden; user-select: none;
    }

    /* ── top bar ── */
    #topBar {
      position: fixed; top: 0; left: 0; right: 0;
      height: 52px;
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 1rem;
      background: rgba(26,5,16,.85);
      backdrop-filter: blur(8px);
      border-bottom: 1px solid rgba(244,63,94,.2);
      z-index: 20;
    }
    .back-btn {
      color: var(--blush); font-size: .8rem; text-decoration: none;
      display: flex; align-items: center; gap: .3rem;
      transition: color .15s;
    }
    .back-btn:hover { color: var(--rose); }
    #scoreDisplay {
      font-family: 'Playfair Display', serif;
      color: #fff; font-size: 1.05rem;
    }
    #scoreDisplay span { color: var(--blush); }
    #livesDisplay { display: flex; gap: .3rem; font-size: 1.2rem; }
    #levelDisplay {
      color: var(--blush); font-size: .8rem;
      letter-spacing: .1em; text-transform: uppercase;
    }

    /* ── canvas ── */
    #gameCanvas {
      display: block;
      position: fixed;
      top: 52px; left: 0; right: 0; bottom: 0;
      width: 100%; height: calc(100vh - 52px);
      cursor: crosshair;
      touch-action: none;
    }

    /* ── overlays ── */
    .overlay {
      position: fixed; inset: 0; top: 52px;
      display: flex; flex-direction: column;
      align-items: center; justify-content: center;
      background: rgba(26,5,16,.92);
      z-index: 30; text-align: center; padding: 2rem;
    }
    .overlay h2 {
      font-family: 'Playfair Display', serif;
      font-size: clamp(1.8rem, 5vw, 2.8rem);
      color: #fff; margin-bottom: .5rem;
    }
    .overlay h2 em { color: var(--rose); font-style: italic; }
    .overlay p { color: var(--blush); font-size: .92rem; line-height: 1.6; margin-bottom: 1.4rem; max-width: 380px; }
    .overlay .big-emoji { font-size: 3.5rem; margin-bottom: 1rem; }
    .play-btn {
      background: var(--rose); color: #fff; border: none;
      border-radius: 50px; padding: .9rem 2.4rem;
      font-family: 'Lato', sans-serif; font-size: 1rem;
      font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
      cursor: pointer; box-shadow: 0 6px 24px rgba(244,63,94,.5);
      transition: transform .16s, box-shadow .16s; margin: .4rem;
    }
    .play-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 32px rgba(244,63,94,.6); }
    .play-btn.secondary { background: transparent; border: 2px solid var(--blush); color: var(--blush); box-shadow: none; }
    .play-btn.secondary:hover { border-color: var(--rose); color: var(--rose); }
    .score-grid {
      display: flex; gap: 1.4rem; margin: 1rem 0 1.6rem; flex-wrap: wrap; justify-content: center;
    }
    .score-box { text-align: center; }
    .score-box .num {
      font-family: 'Playfair Display', serif;
      font-size: 2.2rem; color: var(--rose); line-height: 1;
    }
    .score-box .lbl { font-size: .72rem; color: var(--muted); letter-spacing: .1em; text-transform: uppercase; margin-top: .2rem; }
    .controls-hint { color: var(--muted); font-size: .78rem; margin-top: 1rem; }

    /* ── mobile controls ── */
    #mobileControls {
      display: none;
      position: fixed; bottom: 0; left: 0; right: 0;
      height: 90px;
      align-items: center; justify-content: space-between;
      padding: 0 1.5rem;
      z-index: 15;
      background: rgba(26,5,16,.7);
      backdrop-filter: blur(6px);
      border-top: 1px solid rgba(244,63,94,.15);
    }
    .mobile-move { display: flex; gap: .8rem; }
    .mctl {
      width: 54px; height: 54px;
      background: rgba(244,63,94,.15);
      border: 2px solid rgba(244,63,94,.35);
      border-radius: 50%; display: flex; align-items: center; justify-content: center;
      font-size: 1.4rem; cursor: pointer;
      transition: background .12s;
      -webkit-tap-highlight-color: transparent;
    }
    .mctl:active { background: rgba(244,63,94,.4); }
    #mFireBtn {
      width: 68px; height: 68px;
      background: linear-gradient(135deg, var(--rose), #fb7185);
      font-size: 1.8rem;
      box-shadow: 0 4px 20px rgba(244,63,94,.5);
    }
  </style>
</head>
<body>

<!-- Top Bar -->
<div id="topBar">
  <a class="back-btn" href="dashboard.php">← Home</a>
  <div id="scoreDisplay">Score: <span id="scoreNum">0</span></div>
  <div id="livesDisplay">🩷🩷🩷</div>
  <div id="levelDisplay">Level <span id="levelNum">1</span></div>
</div>

<!-- Canvas -->
<canvas id="gameCanvas"></canvas>

<!-- Mobile Controls -->
<div id="mobileControls">
  <div class="mobile-move">
    <div class="mctl" id="mLeftBtn">◀</div>
    <div class="mctl" id="mRightBtn">▶</div>
  </div>
  <div class="mctl" id="mFireBtn">💘</div>
</div>

<!-- Start Screen -->
<div class="overlay" id="startScreen">
  <div class="big-emoji">💘</div>
  <h2>Heart <em>Shooter</em></h2>
  <p>Shoot the pink hearts 💕 to earn points. Dodge the broken hearts 💔 — they steal your lives! Every 10 kills = next level 🔥</p>
  <div>
    <button class="play-btn" onclick="startGame()">Play 🩷</button>
  </div>
  <p class="controls-hint">🖱 Mouse / tap to aim & shoot &nbsp;·&nbsp; A/D or ← → to move</p>
</div>

<!-- Game Over Screen -->
<div class="overlay" id="gameOverScreen" style="display:none;">
  <div class="big-emoji" id="goEmoji">😭</div>
  <h2 id="goTitle">Game Over</h2>
  <div class="score-grid">
    <div class="score-box"><div class="num" id="finalScore">0</div><div class="lbl">Score</div></div>
    <div class="score-box"><div class="num" id="finalLevel">1</div><div class="lbl">Level</div></div>
    <div class="score-box"><div class="num" id="finalKills">0</div><div class="lbl">Hearts Shot</div></div>
  </div>
  <p id="goMsg">You'll get them next time, babe. 🩷</p>
  <div>
    <button class="play-btn" onclick="startGame()">Try Again 🩷</button>
    <a class="play-btn secondary" href="dashboard.php">Go Home</a>
  </div>
</div>

<script>
const canvas = document.getElementById('gameCanvas');
const ctx    = canvas.getContext('2d');

// ─── Resize ───
function resize() {
  canvas.width  = window.innerWidth;
  canvas.height = window.innerHeight - 52;
}
resize();
window.addEventListener('resize', () => { resize(); if(state === 'playing') initPlayer(); });

// ─── State ───
let state = 'start'; // start | playing | over
let score, lives, level, kills, combo, comboTimer;
let player, bullets, enemies, particles, powerups;
let keys = {};
let mouseX = 0, mobileLeft = false, mobileRight = false, mobileFire = false;
let lastTime = 0, enemySpawnTimer = 0, powerupSpawnTimer = 0;
let highScore = parseInt(localStorage.getItem('hs_shooter') || '0');
let fireTimer = 0, bossActive = false;
let shake = 0;
let bgStars = [];

// ─── Init ───
function initPlayer() {
  player = {
    x: canvas.width / 2, y: canvas.height - 80,
    w: 44, h: 44, speed: 320,
    invincible: 0, blinkTimer: 0
  };
}

function initBgStars() {
  bgStars = [];
  for (let i = 0; i < 80; i++) {
    bgStars.push({
      x: Math.random() * canvas.width,
      y: Math.random() * canvas.height,
      r: Math.random() * 1.5 + .5,
      speed: Math.random() * 0.4 + 0.1,
      opacity: Math.random() * .6 + .2
    });
  }
}

function startGame() {
  document.getElementById('startScreen').style.display = 'none';
  document.getElementById('gameOverScreen').style.display = 'none';
  score = 0; lives = 3; level = 1; kills = 0; combo = 0; comboTimer = 0;
  bullets = []; enemies = []; particles = []; powerups = [];
  enemySpawnTimer = 0; powerupSpawnTimer = 0;
  fireTimer = 0; bossActive = false; shake = 0;
  initPlayer(); initBgStars();
  updateHUD();
  state = 'playing';

  // show mobile controls on touch devices
  if ('ontouchstart' in window) {
    document.getElementById('mobileControls').style.display = 'flex';
  }

  requestAnimationFrame(loop);
}

// ─── HUD ───
function updateHUD() {
  document.getElementById('scoreNum').textContent = score;
  document.getElementById('levelNum').textContent = level;
  const liveStr = '🩷'.repeat(Math.max(0,lives)) + '🖤'.repeat(Math.max(0,3-lives));
  document.getElementById('livesDisplay').textContent = liveStr;
}

// ─── Spawning ───
function spawnEnemy() {
  const types = ['good','good','good','bad','bad'];
  if (level >= 3) types.push('bad','zigzag');
  if (level >= 5) types.push('fast','tanky');
  const t = types[Math.floor(Math.random() * types.length)];
  const x = 30 + Math.random() * (canvas.width - 60);
  let e = { x, y: -30, type: t, hp: 1, maxHp: 1, size: 28, dir: 1 };
  switch (t) {
    case 'good':    e.speed = 90 + level*12; e.emoji = '💕'; break;
    case 'bad':     e.speed = 80 + level*10; e.emoji = '💔'; e.size = 30; break;
    case 'zigzag':  e.speed = 100 + level*10; e.emoji = '💜'; e.zigzag=true; e.phase=Math.random()*Math.PI*2; break;
    case 'fast':    e.speed = 190 + level*15; e.emoji = '⚡'; e.size = 22; break;
    case 'tanky':   e.speed = 60; e.emoji = '🖤'; e.hp = 3; e.maxHp = 3; e.size = 36; break;
  }
  enemies.push(e);
}

function spawnPowerup() {
  powerups.push({
    x: 40 + Math.random() * (canvas.width - 80),
    y: -20,
    speed: 70,
    type: Math.random() < .6 ? 'heart' : 'rapid',
    t: 0
  });
}

function spawnParticle(x, y, color = '#f43f5e', count = 8) {
  for (let i = 0; i < count; i++) {
    const ang = (Math.PI * 2 * i) / count + Math.random() * .5;
    const spd = 80 + Math.random() * 140;
    particles.push({
      x, y, vx: Math.cos(ang)*spd, vy: Math.sin(ang)*spd,
      color, r: 3 + Math.random()*4, life: 1, decay: .8 + Math.random()*.6
    });
  }
}

// ─── Draw helpers ───
function drawEmoji(emoji, x, y, size) {
  ctx.font = `${size}px serif`;
  ctx.textAlign = 'center';
  ctx.textBaseline = 'middle';
  ctx.fillText(emoji, x, y);
}

function drawPlayer(p) {
  if (p.invincible > 0 && Math.floor(p.blinkTimer * 8) % 2 === 0) return;
  // glow
  ctx.save();
  ctx.shadowColor = '#f43f5e';
  ctx.shadowBlur = 18;
  drawEmoji('🚀', p.x, p.y, 38);
  ctx.restore();
  // shield indicator
  if (p.invincible > 0) {
    ctx.save();
    ctx.globalAlpha = .3;
    ctx.strokeStyle = '#fda4af';
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(p.x, p.y, 28, 0, Math.PI*2);
    ctx.stroke();
    ctx.restore();
  }
}

// ─── Main loop ───
function loop(ts) {
  if (state !== 'playing') return;
  const dt = Math.min((ts - lastTime) / 1000, .05);
  lastTime = ts;

  update(dt);
  draw();
  requestAnimationFrame(loop);
}

let rapidFire = 0;

function update(dt) {
  // move player
  const moveLeft  = keys['ArrowLeft'] || keys['a'] || keys['A'] || mobileLeft;
  const moveRight = keys['ArrowRight'] || keys['d'] || keys['D'] || mobileRight;
  if (moveLeft)  player.x -= player.speed * dt;
  if (moveRight) player.x += player.speed * dt;
  player.x = Math.max(player.w/2, Math.min(canvas.width - player.w/2, player.x));

  // auto aim toward mouseX on desktop
  if (!('ontouchstart' in window)) {
    const diff = mouseX - player.x;
    player.x += diff * dt * 4;
    player.x = Math.max(player.w/2, Math.min(canvas.width - player.w/2, player.x));
  }

  // fire
  fireTimer -= dt;
  rapidFire  -= dt;
  const fireRate = rapidFire > 0 ? .12 : .28;
  if ((keys[' '] || mobileFire || (!('ontouchstart' in window) && mouseDown)) && fireTimer <= 0) {
    fireTimer = fireRate;
    bullets.push({ x: player.x, y: player.y - 22, vy: -680, t: 0 });
    if (rapidFire > 0) {
      bullets.push({ x: player.x - 12, y: player.y - 14, vy: -650, vx: -40, t: 0 });
      bullets.push({ x: player.x + 12, y: player.y - 14, vy: -650, vx:  40, t: 0 });
    }
  }

  // bullets
  bullets = bullets.filter(b => {
    b.x += (b.vx||0) * dt;
    b.y += b.vy * dt;
    b.t += dt;
    return b.y > -20;
  });

  // enemies
  enemySpawnTimer -= dt;
  const spawnRate = Math.max(0.28, 1.1 - level * .07);
  if (enemySpawnTimer <= 0) {
    spawnEnemy();
    if (level >= 4 && Math.random() < .3) spawnEnemy();
    enemySpawnTimer = spawnRate;
  }

  // powerups
  powerupSpawnTimer -= dt;
  if (powerupSpawnTimer <= 0) {
    spawnPowerup();
    powerupSpawnTimer = 12 + Math.random() * 8;
  }

  powerups = powerups.filter(pu => {
    pu.y += pu.speed * dt;
    pu.t += dt;
    const hit = Math.hypot(pu.x - player.x, pu.y - player.y) < 32;
    if (hit) {
      spawnParticle(pu.x, pu.y, '#fda4af', 12);
      if (pu.type === 'heart') { lives = Math.min(5, lives + 1); updateHUD(); }
      else { rapidFire = 5; }
    }
    return pu.y < canvas.height + 30 && !hit;
  });

  // combo timer
  if (comboTimer > 0) { comboTimer -= dt; if (comboTimer <= 0) combo = 0; }

  enemies = enemies.filter(e => {
    e.y += e.speed * dt;
    if (e.zigzag) e.x += Math.sin(e.y * .04 + e.phase) * 2.2;

    // bullet hits
    let hit = false;
    bullets = bullets.filter(b => {
      const d = Math.hypot(b.x - e.x, b.y - e.y);
      if (d < e.size * .65) { hit = true; return false; }
      return true;
    });
    if (hit) {
      e.hp--;
      if (e.hp <= 0) {
        kills++;
        combo++;
        comboTimer = 2.5;
        const pts = e.type === 'tanky' ? 30 : e.type === 'fast' ? 20 : e.type === 'zigzag' ? 15 : e.type === 'bad' ? 5 : 10;
        score += pts * Math.min(combo, 5);
        if (kills % 10 === 0) { level = Math.min(10, level + 1); }
        spawnParticle(e.x, e.y, e.type === 'bad' ? '#7f1d1d' : '#f43f5e', 10);
        updateHUD();
        return false;
      }
      spawnParticle(e.x, e.y, '#fda4af', 3);
    }

    // passed bottom / player hit
    if (e.y > canvas.height + 30) {
      if (e.type !== 'bad') { // missed good heart
        lives--;
        shake = .25;
        spawnParticle(e.x, canvas.height - 10, '#7f1d1d', 5);
      } else {
        score += 2; // dodged bad heart
      }
      updateHUD();
      if (lives <= 0) { endGame(); return false; }
      return false;
    }

    // player collision with bad heart
    if (e.type === 'bad' && player.invincible <= 0) {
      const d = Math.hypot(e.x - player.x, e.y - player.y);
      if (d < 28) {
        lives--;
        player.invincible = 2.2;
        shake = .35;
        spawnParticle(player.x, player.y, '#7f1d1d', 12);
        updateHUD();
        if (lives <= 0) { endGame(); return false; }
        enemies = enemies.filter(en => en !== e);
        return false;
      }
    }
    return true;
  });

  if (player.invincible > 0) { player.invincible -= dt; player.blinkTimer += dt; }
  if (shake > 0) shake -= dt * 2;

  // star scroll
  bgStars.forEach(s => {
    s.y += s.speed;
    if (s.y > canvas.height) s.y = 0;
  });

  // particles
  particles = particles.filter(p => {
    p.x += p.vx * dt; p.y += p.vy * dt;
    p.vy += 200 * dt;
    p.life -= p.decay * dt;
    return p.life > 0;
  });
}

let mouseDown = false;
canvas.addEventListener('mousemove', e => { mouseX = e.clientX; });
canvas.addEventListener('mousedown', () => mouseDown = true);
canvas.addEventListener('mouseup',   () => mouseDown = false);
canvas.addEventListener('touchmove', e => {
  e.preventDefault();
  mouseX = e.touches[0].clientX;
}, { passive: false });

document.addEventListener('keydown', e => { keys[e.key] = true; });
document.addEventListener('keyup',   e => { keys[e.key] = false; });

// mobile controls
document.getElementById('mLeftBtn').addEventListener('touchstart',  () => mobileLeft = true);
document.getElementById('mLeftBtn').addEventListener('touchend',    () => mobileLeft = false);
document.getElementById('mRightBtn').addEventListener('touchstart', () => mobileRight = true);
document.getElementById('mRightBtn').addEventListener('touchend',   () => mobileRight = false);
document.getElementById('mFireBtn').addEventListener('touchstart',  () => mobileFire = true);
document.getElementById('mFireBtn').addEventListener('touchend',    () => mobileFire = false);

function draw() {
  ctx.save();
  if (shake > 0) {
    ctx.translate((Math.random()-.5)*shake*16, (Math.random()-.5)*shake*16);
  }

  // background
  ctx.fillStyle = '#1a0510';
  ctx.fillRect(0, 0, canvas.width, canvas.height);

  // stars
  bgStars.forEach(s => {
    ctx.save();
    ctx.globalAlpha = s.opacity;
    ctx.fillStyle = '#fda4af';
    ctx.beginPath();
    ctx.arc(s.x, s.y, s.r, 0, Math.PI*2);
    ctx.fill();
    ctx.restore();
  });

  // particles
  particles.forEach(p => {
    ctx.save();
    ctx.globalAlpha = p.life;
    ctx.fillStyle = p.color;
    ctx.beginPath();
    ctx.arc(p.x, p.y, p.r * p.life, 0, Math.PI*2);
    ctx.fill();
    ctx.restore();
  });

  // powerups
  powerups.forEach(pu => {
    ctx.save();
    ctx.globalAlpha = .8 + Math.sin(pu.t * 4) * .15;
    drawEmoji(pu.type === 'heart' ? '💖' : '⚡', pu.x, pu.y, 26);
    ctx.restore();
  });

  // enemies
  enemies.forEach(e => {
    // hp bar for tanky
    if (e.type === 'tanky' && e.hp < e.maxHp) {
      ctx.fillStyle = '#444';
      ctx.fillRect(e.x - 18, e.y - e.size - 6, 36, 5);
      ctx.fillStyle = '#f43f5e';
      ctx.fillRect(e.x - 18, e.y - e.size - 6, 36 * (e.hp/e.maxHp), 5);
    }
    drawEmoji(e.emoji, e.x, e.y, e.size * 1.4);
  });

  // bullets
  bullets.forEach(b => {
    ctx.save();
    ctx.shadowColor = '#fda4af';
    ctx.shadowBlur = 12;
    drawEmoji('💘', b.x, b.y, 16);
    ctx.restore();
  });

  // player
  drawPlayer(player);

  // combo
  if (combo >= 2 && comboTimer > 0) {
    ctx.save();
    ctx.globalAlpha = Math.min(1, comboTimer);
    ctx.font = `bold ${14 + Math.min(combo,5)*2}px Lato`;
    ctx.fillStyle = combo >= 5 ? '#fbbf24' : '#fda4af';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText(`${combo}x COMBO! 🔥`, canvas.width/2, 40);
    ctx.restore();
  }

  // rapid fire indicator
  if (rapidFire > 0) {
    ctx.save();
    ctx.globalAlpha = .7 + Math.sin(Date.now()*.01)*.2;
    ctx.font = '13px Lato';
    ctx.fillStyle = '#fbbf24';
    ctx.textAlign = 'center';
    ctx.fillText(`⚡ RAPID FIRE ${rapidFire.toFixed(1)}s`, canvas.width/2, 64);
    ctx.restore();
  }

  ctx.restore();
}

function endGame() {
  state = 'over';
  if (score > highScore) { highScore = score; localStorage.setItem('hs_shooter', score); }
  document.getElementById('finalScore').textContent = score;
  document.getElementById('finalLevel').textContent = level;
  document.getElementById('finalKills').textContent = kills;

  let emoji, title, msg;
  if (score >= 500) { emoji='🏆'; title="You're Amazing!"; msg="High score babe! You're literally unstoppable. 🩷"; }
  else if (score >= 200) { emoji='🌸'; title='Nice Shooting!'; msg="Pretty good! You're getting better every time. 💕"; }
  else if (score >= 100) { emoji='💝'; title='Not Bad!'; msg="You'll get there. Come on, try again! 🎮"; }
  else { emoji='😭'; title='Game Over'; msg="Babe... we need to practice. I still love you though. 🩷"; }

  document.getElementById('goEmoji').textContent = emoji;
  document.getElementById('goTitle').textContent = title;
  document.getElementById('goMsg').textContent = msg;
  document.getElementById('gameOverScreen').style.display = 'flex';
}
</script>
</body>
</html>
