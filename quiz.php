<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Love Quiz 🧠💕</title>
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
    }
    html, body {
      min-height: 100vh;
      background: var(--cream);
      font-family: 'Lato', sans-serif;
      color: var(--brown);
    }
    .hearts-bg { position: fixed; inset: 0; pointer-events: none; z-index: 0; }
    .heart { position: absolute; animation: floatUp linear infinite; opacity: 0; user-select: none; }
    @keyframes floatUp {
      0%   { transform: translateY(110vh); opacity: 0; }
      10%  { opacity: .3; }
      90%  { opacity: .2; }
      100% { transform: translateY(-10vh); opacity: 0; }
    }

    .page {
      position: relative; z-index: 1;
      max-width: 640px; margin: 0 auto;
      padding: 2.5rem 1.4rem 5rem;
    }

    .back-btn {
      display: inline-flex; align-items: center; gap: .4rem;
      color: var(--muted); font-size: .85rem; text-decoration: none;
      margin-bottom: 1.8rem; transition: color .15s;
    }
    .back-btn:hover { color: var(--rose); }

    header { text-align: center; margin-bottom: 2.2rem; }
    header .tag {
      display: inline-block;
      background: var(--soft); color: var(--rose);
      font-size: .75rem; letter-spacing: .15em; text-transform: uppercase;
      padding: .35rem 1.1rem; border-radius: 50px; margin-bottom: .9rem;
    }
    header h1 {
      font-family: 'Playfair Display', serif;
      font-size: clamp(1.7rem, 4vw, 2.4rem); line-height: 1.2;
    }
    header h1 em { color: var(--rose); font-style: italic; }
    header p { margin-top: .5rem; color: var(--muted); font-size: .9rem; }

    /* ── quiz card ── */
    .quiz-card {
      background: #fff8f9;
      border: 1.5px solid #f9d4dc;
      border-radius: 24px;
      padding: 2rem 2rem 1.6rem;
      box-shadow: 0 4px 28px rgba(244,63,94,.08);
      animation: fadeUp .5s ease both;
    }
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(18px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .progress-bar-wrap {
      height: 7px; background: #fce7f3; border-radius: 50px; margin-bottom: 1.6rem; overflow: hidden;
    }
    .progress-bar-fill {
      height: 100%; border-radius: 50px;
      background: linear-gradient(90deg, var(--blush), var(--rose));
      transition: width .5s cubic-bezier(.22,1,.36,1);
    }

    .q-counter {
      font-size: .75rem; color: var(--muted); letter-spacing: .1em;
      text-transform: uppercase; margin-bottom: .7rem;
    }
    .q-text {
      font-family: 'Playfair Display', serif;
      font-size: 1.25rem; line-height: 1.45; margin-bottom: 1.4rem;
      color: var(--brown);
    }
    .options { display: flex; flex-direction: column; gap: .65rem; }
    .opt-btn {
      width: 100%; text-align: left;
      background: var(--petal); border: 1.5px solid #fce7f3;
      border-radius: 14px; padding: .85rem 1.1rem;
      font-size: .93rem; color: var(--brown); cursor: pointer;
      transition: background .15s, border-color .15s, transform .13s;
      font-family: 'Lato', sans-serif;
    }
    .opt-btn:hover:not(:disabled) {
      background: var(--soft); border-color: var(--blush);
      transform: translateX(3px);
    }
    .opt-btn.correct  { background: #d1fae5; border-color: #6ee7b7; color: #064e3b; }
    .opt-btn.wrong    { background: #ffe4e6; border-color: #fca5a5; color: #7f1d1d; }

    .feedback {
      margin-top: 1.2rem; padding: .8rem 1rem;
      border-radius: 12px; font-size: .9rem; line-height: 1.5;
      display: none;
    }
    .feedback.show { display: block; }
    .feedback.correct { background: #d1fae5; color: #065f46; }
    .feedback.wrong   { background: #ffe4e6; color: #9f1239; }

    .next-btn {
      display: none; margin-top: 1.2rem; width: 100%;
      background: var(--rose); color: #fff; border: none;
      border-radius: 50px; padding: .85rem 2rem;
      font-family: 'Lato', sans-serif; font-size: .95rem;
      font-weight: 700; letter-spacing: .08em; text-transform: uppercase;
      cursor: pointer; box-shadow: 0 6px 20px rgba(244,63,94,.3);
      transition: transform .16s, box-shadow .16s;
    }
    .next-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(244,63,94,.38); }
    .next-btn.show { display: block; }

    /* ── result screen ── */
    #resultScreen {
      display: none; text-align: center;
      background: #fff8f9; border: 1.5px solid #f9d4dc;
      border-radius: 24px; padding: 2.5rem 2rem;
      box-shadow: 0 4px 28px rgba(244,63,94,.08);
      animation: fadeUp .5s ease both;
    }
    #resultScreen.show { display: block; }
    .result-emoji { font-size: 4rem; margin-bottom: 1rem; }
    .result-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.8rem; color: var(--brown); margin-bottom: .5rem;
    }
    .result-score {
      font-size: 3.5rem; font-family: 'Playfair Display', serif;
      color: var(--rose); line-height: 1; margin: .8rem 0;
    }
    .result-msg { color: var(--muted); font-size: .95rem; line-height: 1.6; margin-bottom: 1.8rem; }
    .replay-btn {
      display: inline-block;
      background: var(--rose); color: #fff; border: none; border-radius: 50px;
      padding: .85rem 2.2rem; font-family: 'Lato', sans-serif;
      font-size: .95rem; font-weight: 700; letter-spacing: .08em;
      text-transform: uppercase; cursor: pointer;
      box-shadow: 0 6px 20px rgba(244,63,94,.3);
      transition: transform .16s, box-shadow .16s; text-decoration: none;
    }
    .replay-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(244,63,94,.38); }

    @media (max-width: 430px) {
      .quiz-card { padding: 1.4rem 1rem 1.2rem; }
      .q-text { font-size: 1.05rem; }
    }
  </style>
</head>
<body>

<div class="hearts-bg" id="heartsContainer"></div>

<div class="page">
  <a class="back-btn" href="dashboard.php">← Back to our world</a>

  <header>
    <div class="tag">🧠 Quiz Time</div>
    <h1>The <em>Love</em> Quiz</h1>
    <p>How well do you actually know us? Let's find out 💕</p>
  </header>

  <div class="quiz-card" id="quizCard">
    <div class="progress-bar-wrap">
      <div class="progress-bar-fill" id="progressBar" style="width:0%"></div>
    </div>
    <div class="q-counter" id="qCounter">Question 1 of 10</div>
    <div class="q-text" id="qText"></div>
    <div class="options" id="options"></div>
    <div class="feedback" id="feedback"></div>
    <button class="next-btn" id="nextBtn">Next →</button>
  </div>

  <div id="resultScreen">
    <div class="result-emoji" id="resultEmoji">🎉</div>
    <div class="result-title">Quiz Complete!</div>
    <div class="result-score" id="resultScore">0/10</div>
    <div class="result-msg" id="resultMsg"></div>
    <button class="replay-btn" onclick="startQuiz()">Play Again 🩷</button>
    &nbsp;
    <a class="replay-btn" href="dashboard.php" style="background:#fda4af;">Back Home</a>
  </div>
</div>

<script>
  /* ── hearts bg ── */
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
  for (let i = 0; i < 12; i++) spawnHeart();
  setInterval(spawnHeart, 1200);

  /* ── quiz data ── */
  // Edit these questions anytime!
  const allQuestions = [
    {
      q: "What's my favorite thing about you?",
      options: ["Your laugh", "Your eyes", "Your heart", "Everything about you"],
      correct: 3,
      feedback: "It's literally everything about you. No competition. 🩷"
    },
    {
      q: "If we could go anywhere together right now, where would I pick?",
      options: ["Paris, France", "Tokyo, Japan", "Maldives", "Anywhere, as long as it's with you"],
      correct: 3,
      feedback: "The destination doesn't matter. You are the destination. 💕"
    },
    {
      q: "What's the first thing I think about when I wake up?",
      options: ["Food", "My phone", "You", "Going back to sleep"],
      correct: 2,
      feedback: "You, always you. It's embarrassing honestly. 🌸"
    },
    {
      q: "How would I describe our relationship in one word?",
      options: ["Complicated", "Perfect", "Home", "Gay"],
      correct: 2,
      feedback: "Home. You feel like home. (Also yes, very gay.) 🏠🩷"
    },
    {
      q: "What's my love language?",
      options: ["Acts of Service", "Quality Time", "Words of Affirmation", "All of the above with you"],
      correct: 3,
      feedback: "When it comes to you, I want to do everything. 🫶"
    },
    {
      q: "How many times a day do I think about you?",
      options: ["A few times", "A lot", "Too many to count", "Every single second"],
      correct: 3,
      feedback: "Every. Single. Second. It's a problem. 💗"
    },
    {
      q: "What do I love most about our conversations?",
      options: ["The jokes", "The deep talks", "The silence that's comfortable", "All of it, even the dumb ones"],
      correct: 3,
      feedback: "Even when we're being chaotic idiots — I love it all. 😂🩷"
    },
    {
      q: "If I had to pick one song that describes us, what genre would it be?",
      options: ["A love ballad", "A happy pop song", "Something soft and cozy", "A song that doesn't exist yet because we're unique"],
      correct: 3,
      feedback: "We're too special for existing songs. Someone needs to write one for us. 🎵"
    },
    {
      q: "What's my biggest fear in this relationship?",
      options: ["Losing you", "You getting tired of me", "Not being enough for you", "All of the above, I'm scared of losing you"],
      correct: 3,
      feedback: "But I know we'll be okay. I really do. 💝"
    },
    {
      q: "How long am I planning to love you?",
      options: ["For now", "For a long time", "Until further notice", "Always. No expiration date."],
      correct: 3,
      feedback: "Always. Duh. Did you even have to think about that? 🩷"
    },
  ];

  let currentQ = 0;
  let score = 0;
  let answered = false;
  let questions = [];

  function shuffle(arr) {
    return [...arr].sort(() => Math.random() - .5);
  }

  function startQuiz() {
    questions = shuffle(allQuestions).slice(0, 10);
    currentQ = 0; score = 0; answered = false;
    document.getElementById('quizCard').style.display = 'block';
    document.getElementById('resultScreen').classList.remove('show');
    loadQuestion();
  }

  function loadQuestion() {
    answered = false;
    const q = questions[currentQ];
    document.getElementById('qCounter').textContent = `Question ${currentQ + 1} of ${questions.length}`;
    document.getElementById('progressBar').style.width = (currentQ / questions.length * 100) + '%';
    document.getElementById('qText').textContent = q.q;

    const fb = document.getElementById('feedback');
    fb.className = 'feedback'; fb.textContent = '';

    const nb = document.getElementById('nextBtn');
    nb.className = 'next-btn';

    const opts = document.getElementById('options');
    opts.innerHTML = '';
    q.options.forEach((opt, i) => {
      const btn = document.createElement('button');
      btn.className = 'opt-btn';
      btn.textContent = opt;
      btn.addEventListener('click', () => selectAnswer(i));
      opts.appendChild(btn);
    });
  }

  function selectAnswer(idx) {
    if (answered) return;
    answered = true;
    const q = questions[currentQ];
    const btns = document.querySelectorAll('.opt-btn');
    btns.forEach(b => b.disabled = true);

    const fb = document.getElementById('feedback');
    if (idx === q.correct) {
      score++;
      btns[idx].classList.add('correct');
      fb.className = 'feedback correct show';
      fb.textContent = '✓ ' + q.feedback;
    } else {
      btns[idx].classList.add('wrong');
      btns[q.correct].classList.add('correct');
      fb.className = 'feedback wrong show';
      fb.textContent = '✗ ' + q.feedback;
    }

    document.getElementById('nextBtn').className = 'next-btn show';
  }

  document.getElementById('nextBtn').addEventListener('click', () => {
    currentQ++;
    if (currentQ >= questions.length) {
      showResult();
    } else {
      loadQuestion();
    }
  });

  function showResult() {
    document.getElementById('progressBar').style.width = '100%';
    document.getElementById('quizCard').style.display = 'none';
    const rs = document.getElementById('resultScreen');
    rs.classList.add('show');
    document.getElementById('resultScore').textContent = `${score}/${questions.length}`;

    let emoji, msg;
    const pct = score / questions.length;
    if (pct === 1) {
      emoji = '🥇'; msg = "Perfect score! You know us so well. Or you cheated. I choose to believe the first one. 🩷";
    } else if (pct >= .8) {
      emoji = '🌸'; msg = "So close to perfect! You really do pay attention, huh? That's so cute. 💕";
    } else if (pct >= .6) {
      emoji = '💝'; msg = "Not bad! But maybe we need to spend more time together so you learn more about us. 😏";
    } else if (pct >= .4) {
      emoji = '😅'; msg = "Ummm... babe. We need to talk. And by talk I mean cuddle and try again. 🩷";
    } else {
      emoji = '😂'; msg = "This is embarrassing for you. Just kidding. I love you anyway. Let's try again. 💗";
    }
    document.getElementById('resultEmoji').textContent = emoji;
    document.getElementById('resultMsg').textContent = msg;
  }

  startQuiz();
</script>
</body>
</html>
