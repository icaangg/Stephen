<?php
// Customize messages here — add more entries to the array as needed.
$messages = [
  [
    'title' => 'message one',
    'body'  => "hi baby, being with you for a month has made me realize so many things, that i can be loved deeply, and still be seen, heard, and valued all at once.

some might say that it's too early for all this, but when i know, i know. with you, i can be soft. i can be myself, even the messy, silly parts of me, and you still choose me, just as i am.

you make the smallest things feel big, like they matter, like i matter. you remember (but you forget sometimes lol) the little details, the things i say, what i like, what i don't, and somehow, that means everything.

the way you love me is gentle, it makes me feel whole in ways i didn't expect. and now, even on ordinary days, i feel something warm just knowing you exist in my life.",
  ],
  [
    'title' => 'message two',
    'body'  => "hey, baby! it's been 3 months!! can you believe it? it honestly feels like it's been so much longer lol.

over the past three months, i've noticed that we've had our fair share of fights which is completely normal. despite that, you've remained consistent with all the little things you've been doing since day one. well maybe some things have changed, sure, but that's okay. so far, i think we're still doing great.

there was that one thing that happened that still sticks with me, and i honestly don't think i'll ever forget it. but i've been learning to control myself and avoid saying things that i know would only lead to arguments. looking back, i think i've outgrown some of those toxic habits. these days, i just want peace. i want to focus on our relationship, our growth, our connection, and the future we've been talking about.

you're slowly earning my trust again, and i'm allowing myself to trust you naturally instead of forcing it. i think that's a good sign.

overall, i really think we're doing well. we haven't broken up or chosen to let each other go over arguments, and i think that's something worth appreciating. of course, we still have a lot of things to work on, but i believe we'll continue to grow together through all of it.

i'm also working on myself, not just for me, but for us. being with you makes me wanna become a better person and a better partner. i wanna keep learning how to love you the way you deserve to be loved, and i'll continue putting effort into this relationship that i always pray will last forever.

honestly, life hasn't been the same since i met you. it became more beautiful in ways i can't explain. thank you for all the memories, the lessons, the patience, and the love you've given me these past three months.

i love you always and i'm looking forward to all the moments, milestones, adventures, and memories we'll get to share together in the future.",
  ],
];
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

    .msg-list {
      width: 100%;
      display: flex;
      flex-direction: column;
      gap: 1rem;
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

  <div class="msg-list">
    <?php foreach ($messages as $msg): ?>
    <div class="msg-card" role="button" tabindex="0" aria-expanded="false" aria-label="Tap to read <?php echo htmlspecialchars($msg['title'], ENT_QUOTES, 'UTF-8'); ?>">
      <div class="msg-card-teaser"><?php echo htmlspecialchars($msg['title'], ENT_QUOTES, 'UTF-8'); ?></div>
      <p class="msg-card-hint">Click to open</p>
      <div class="msg-card-body"><?php echo htmlspecialchars($msg['body'], ENT_QUOTES, 'UTF-8'); ?></div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<script>
  (function () {
    document.querySelectorAll('.msg-card').forEach(function (card) {
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
    });
  })();
</script>

</body>
</html>
