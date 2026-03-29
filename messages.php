<?php
// Customize your message here (edit the text between the quotes):
$secret_message = "hi baby, being with you for a month has made me realize so many things, that i can be loved deeply, and still be seen, heard, and valued all at once.

some might say that it's too early for all this, but when i know, i know. with you, i can be soft. i can be myself, even the messy, silly parts of me, and you still choose me, just as i am.

you make the smallest things feel big, like they matter, like i matter. you remember (but you forget sometimes lol) the little details, the things i say, what i like, what i don't, and somehow, that means everything.

the way you love me is gentle, it makes me feel whole in ways i didn't expect. and now, even on ordinary days, i feel something warm just knowing you exist in my life.";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>messages</title>
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

    body {
      min-height: 100vh;
      background: var(--cream);
      font-family: 'Lato', sans-serif;
      color: var(--brown);
    }

    .page {
      max-width: 560px;
      margin: 0 auto;
      padding: 2.5rem 1.25rem 3rem;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .back {
      align-self: flex-start;
      margin-bottom: 1.5rem;
      font-size: .85rem;
      color: var(--rose);
      text-decoration: none;
    }
    .back:hover { text-decoration: underline; }

    h1 {
      font-family: 'Playfair Display', serif;
      font-size: clamp(1.75rem, 5vw, 2.25rem);
      font-weight: 400;
      text-align: center;
      width: 100%;
      margin-bottom: 2rem;
      letter-spacing: .02em;
    }

    .msg-card {
      width: 100%;
      background: var(--card-bg);
      border: 1.5px solid #f9d4dc;
      border-radius: 20px;
      padding: 1.5rem 1.4rem;
      box-shadow: 0 4px 24px rgba(244,63,94,.07);
      cursor: pointer;
      transition: transform .2s, box-shadow .2s;
      text-align: center;
    }
    .msg-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 32px rgba(244,63,94,.13);
    }
    .msg-card:focus {
      outline: 2px solid var(--rose);
      outline-offset: 3px;
    }

    .msg-card-teaser {
      font-family: 'Playfair Display', serif;
      font-size: 1.05rem;
      color: var(--brown);
    }
    .msg-card-hint {
      font-size: .78rem;
      color: var(--muted);
      margin-top: .75rem;
      letter-spacing: .06em;
      text-transform: uppercase;
    }

    .msg-card-body {
      display: none;
      margin-top: 1rem;
      padding-top: 1rem;
      border-top: 1px dashed #fce7f3;
      font-size: .95rem;
      line-height: 1.7;
      color: var(--muted);
      text-align: left;
      white-space: pre-wrap;
    }
    .msg-card.is-open .msg-card-body {
      display: block;
    }
    .msg-card.is-open .msg-card-hint {
      display: none;
    }

    @media (max-width: 430px) {
      .page { padding: 1.2rem .9rem 2rem; }
      .msg-card { padding: 1.25rem 1rem; border-radius: 16px; }
      .msg-card:hover { transform: none; }
    }
  </style>
</head>
<body>

<div class="page">
  <a class="back" href="dashboard.php">← Back</a>
  <h1>daily messages for you</h1>

  <div class="msg-card" id="msgCard" role="button" tabindex="0" aria-expanded="false" aria-label="Tap to read message">
    <div class="msg-card-teaser">message one</div>
    <p class="msg-card-hint">Click to open</p>
    <div class="msg-card-body"><?php echo htmlspecialchars($secret_message, ENT_QUOTES, 'UTF-8'); ?></div>
  </div>
</div>

<script>
  (function () {
    var card = document.getElementById('msgCard');
    function toggle() {
      var open = card.classList.toggle('is-open');
      card.setAttribute('aria-expanded', open ? 'true' : 'false');
    }
    card.addEventListener('click', toggle);
    card.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        toggle();
      }
    });
  })();
</script>

</body>
</html>
