/* ==========================================================
   JURUFIND - Tes Minat Bakat
   ==========================================================
   File ini dipakai oleh dua halaman:
   - jurufind.blade.php       (dashboard/landing: heksagon maskot + render ikon Lucide)
   - jurufind/test.blade.php  (kuis + halaman hasil, satu halaman tanpa reload)

   Semua logic scoring & prompt AI ada di server (app/Services/Jurufind).
   JS di sini hanya: render pertanyaan, kumpulkan jawaban mentah, POST ke
   /jurufind/analyze, lalu render hasilnya. Tidak ada API key di sini.
   ========================================================== */

// Render semua ikon Lucide setelah DOM siap (dipakai halaman landing)
document.addEventListener('DOMContentLoaded', function () {
  if (window.lucide) lucide.createIcons();
});

/* ==========================================================
   Bagian kuis — hanya jalan kalau #jurufind-app ada
   ========================================================== */
(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    const app = document.getElementById('jurufind-app');
    if (!app) return;

    const questions = Array.isArray(window.JURUFIND_QUESTIONS) ? window.JURUFIND_QUESTIONS : [];
    if (!questions.length) return;

    const dimensionLabels = window.JURUFIND_DIMENSION_LABELS || {};
    const majors = window.JURUFIND_MAJORS || {};

    const quizStage = document.getElementById('jurufind-quiz-stage');
    const resultStage = document.getElementById('jurufind-result-stage');
    const resultRoot = document.getElementById('jf-result-root');
    const questionRoot = document.getElementById('jf-question-root');
    const progressText = document.getElementById('jf-progress-text');
    const progressPct = document.getElementById('jf-progress-pct');
    const progressTrack = document.getElementById('jf-progress-track');
    const prevBtn = document.getElementById('jf-prev-btn');
    const nextBtn = document.getElementById('jf-next-btn');

    const LETTERS = ['A', 'B', 'C', 'D', 'E'];
    // { [question_id]: option_id } — jawaban mentah, bukan skor
    const answers = {};
    let currentIndex = 0;
    let submitting = false;

    /* ---------- Progress bar ---------- */
    const segments = [];
    for (let i = 0; i < questions.length; i++) {
      const seg = document.createElement('div');
      progressTrack.appendChild(seg);
      segments.push(seg);
    }

    function renderProgress() {
      const answered = questions.filter((q) => answers[q.id]).length;
      const pct = Math.round((answered / questions.length) * 100);

      progressText.textContent = 'Pertanyaan ' + (currentIndex + 1) + ' dari ' + questions.length;
      progressPct.textContent = pct + '%';

      segments.forEach((seg, i) => {
        seg.className = i <= currentIndex ? 'filled' : '';
      });
    }

    /* ---------- Render pertanyaan aktif ---------- */
    function renderQuestion() {
      const question = questions[currentIndex];
      const selected = answers[question.id] || null;

      questionRoot.textContent = '';

      const card = document.createElement('div');
      card.className = 'jf-card';

      const meta = document.createElement('div');
      meta.className = 'jf-card__meta';
      const chip = document.createElement('span');
      chip.className = 'jf-chip';
      chip.textContent = 'Soal ' + (currentIndex + 1) + ' / ' + questions.length;
      meta.appendChild(chip);
      card.appendChild(meta);

      const heading = document.createElement('h2');
      heading.className = 'jf-question';
      heading.textContent = question.question;
      card.appendChild(heading);

      const list = document.createElement('div');
      list.className = 'jf-options' + (question.type === 'image' ? ' jf-options--grid' : '');

      question.options.forEach(function (option, i) {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'jf-option' + (selected === option.id ? ' is-selected' : '');
        btn.setAttribute('aria-pressed', selected === option.id ? 'true' : 'false');

        if (option.image) {
          const img = document.createElement('img');
          img.className = 'jf-option__thumb';
          img.src = option.image;
          img.alt = '';
          img.loading = 'lazy';
          btn.appendChild(img);
        }

        const letter = document.createElement('span');
        letter.className = 'jf-option__letter';
        letter.textContent = LETTERS[i] || String(i + 1);
        btn.appendChild(letter);

        const label = document.createElement('span');
        label.className = 'jf-option__label';
        label.textContent = option.label;
        btn.appendChild(label);

        btn.addEventListener('click', function () {
          answers[question.id] = option.id;
          renderQuestion();
          renderProgress();
        });

        list.appendChild(btn);
      });

      card.appendChild(list);
      questionRoot.appendChild(card);

      prevBtn.disabled = currentIndex === 0;
      nextBtn.disabled = !answers[question.id];
      nextBtn.textContent = currentIndex === questions.length - 1 ? 'Selesai' : 'Berikutnya';
      renderProgress();
    }

    /* ---------- Error helper ---------- */
    function showError(message) {
      const existing = document.getElementById('jf-error');
      if (existing) existing.remove();

      const box = document.createElement('p');
      box.id = 'jf-error';
      box.className = 'jf-error';
      box.textContent = message;
      questionRoot.parentNode.insertBefore(box, questionRoot.nextSibling);
    }

    function clearError() {
      const existing = document.getElementById('jf-error');
      if (existing) existing.remove();
    }

    /* ---------- Submit ke server ---------- */
    function submit() {
      if (submitting) return;
      submitting = true;
      clearError();

      nextBtn.disabled = true;
      prevBtn.disabled = true;
      nextBtn.textContent = 'Memproses...';

      const meta = document.querySelector('meta[name="csrf-token"]');
      const csrfToken = meta ? meta.getAttribute('content') : '';

      fetch(app.dataset.analyzeUrl, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
          Accept: 'application/json',
        },
        body: JSON.stringify({ answers: answers }),
      })
        .then(function (response) {
          return response.json().then(function (data) {
            return { ok: response.ok, data: data };
          });
        })
        .then(function (result) {
          if (!result.ok) {
            throw new Error((result.data && result.data.error) || 'Terjadi kesalahan saat memproses jawabanmu.');
          }
          if (!result.data || !result.data.scoring || !result.data.explanation) {
            throw new Error('Respons dari server tidak lengkap.');
          }

          renderResult(result.data.scoring, result.data.explanation);
          quizStage.hidden = true;
          resultStage.hidden = false;
          window.scrollTo({ top: 0, behavior: 'smooth' });
        })
        .catch(function (error) {
          showError('Gagal memproses hasil tes: ' + error.message + ' Coba klik "Selesai" lagi.');
          nextBtn.textContent = 'Selesai';
          submitting = false;
          prevBtn.disabled = currentIndex === 0;
          nextBtn.disabled = !answers[questions[currentIndex].id];
        });
    }

    nextBtn.addEventListener('click', function () {
      if (currentIndex < questions.length - 1) {
        currentIndex += 1;
        clearError();
        renderQuestion();
        return;
      }
      submit();
    });

    prevBtn.addEventListener('click', function () {
      if (currentIndex > 0) {
        currentIndex -= 1;
        clearError();
        renderQuestion();
      }
    });

    renderQuestion();

    /* ==========================================================
       Halaman hasil — dirender ke #jf-result-root
       ========================================================== */
    function majorClass(major) {
      return major === 'TJAT' ? 'jf-major--tjat' : 'jf-major--sija';
    }

    function majorName(major) {
      const info = majors[major];
      return info ? info.shortName : major;
    }

    function el(tag, className, text) {
      const node = document.createElement(tag);
      if (className) node.className = className;
      if (text !== undefined && text !== null) node.textContent = text;
      return node;
    }

    function buildScoreBars(scoring) {
      const wrap = el('div', 'jf-bars');
      const percentages = scoring.majorPercentages || {};

      ['SIJA', 'TJAT'].forEach(function (major) {
        const value = Number(percentages[major] || 0);

        const item = el('div', 'jf-bar');
        const head = el('div', 'jf-bar__head');
        head.appendChild(el('span', 'jf-bar__label', majorName(major)));
        head.appendChild(el('span', 'jf-bar__value', value + '%'));
        item.appendChild(head);

        const track = el('div', 'jf-bar__track');
        const fill = el('div', 'jf-bar__fill jf-bar__fill--' + major.toLowerCase());
        fill.style.width = value + '%';
        track.appendChild(fill);
        item.appendChild(track);

        wrap.appendChild(item);
      });

      return wrap;
    }

    function buildDimensions(scoring) {
      const top = Array.isArray(scoring.topDimensions) ? scoring.topDimensions : [];
      if (!top.length) return null;

      const max = top.reduce(function (acc, item) {
        return Math.max(acc, Number(item.score) || 0);
      }, 0) || 1;

      const wrap = el('div', 'jf-dimensions');

      top.forEach(function (item) {
        const score = Number(item.score) || 0;

        const row = el('div', 'jf-dimension');
        const head = el('div', 'jf-dimension__head');
        head.appendChild(el('span', 'jf-dimension__label', dimensionLabels[item.dimension] || item.dimension));
        head.appendChild(el('span', 'jf-dimension__value', String(score)));
        row.appendChild(head);

        const track = el('div', 'jf-dimension__track');
        const fill = el('div', 'jf-dimension__fill');
        fill.style.width = Math.round((score / max) * 100) + '%';
        track.appendChild(fill);
        row.appendChild(track);

        wrap.appendChild(row);
      });

      return wrap;
    }

    function buildActions(scoring) {
      const actions = el('div', 'jf-actions');
      const primary = scoring.primaryMajor;

      // Halaman detail jurusan belum ada di repo ini, jadi tombol diarahkan
      // ke seksi #jurusan pada halaman beranda (bukan link mati).
      if (scoring.tier === 'close') {
        ['SIJA', 'TJAT'].forEach(function (major) {
          const link = el('a', 'jf-btn jf-btn--' + major.toLowerCase(), 'Pelajari ' + majorName(major));
          link.href = '/#jurusan';
          actions.appendChild(link);
        });
      } else {
        const link = el('a', 'jf-btn jf-btn--' + primary.toLowerCase(), 'Pelajari ' + majorName(primary));
        link.href = '/#jurusan';
        actions.appendChild(link);
      }

      const retry = el('button', 'jf-btn jf-btn--ghost', 'Ulangi Kuis');
      retry.type = 'button';
      retry.addEventListener('click', function () {
        window.location.reload();
      });
      actions.appendChild(retry);

      return actions;
    }

    function renderResult(scoring, explanation) {
      resultRoot.textContent = '';

      const wrap = el('div', 'jf-result');
      const primary = scoring.primaryMajor;

      /* 1 & 2. Judul + dua score bar */
      const head = el('div', 'jf-result__head');
      head.appendChild(el('p', 'jf-eyebrow', 'Hasil eksplorasi minat'));
      const title = el('h1', 'jf-result__title ' + majorClass(primary));
      title.textContent = 'Lebih condong ke ' + majorName(primary);
      head.appendChild(title);
      head.appendChild(buildScoreBars(scoring));
      wrap.appendChild(head);

      /* 3. Kenapa {primaryMajor}? */
      const why = el('section', 'jf-section');
      why.appendChild(el('h2', 'jf-section__title', 'Kenapa ' + majorName(primary) + '?'));
      why.appendChild(el('p', null, explanation.summary));

      const reasons = Array.isArray(explanation.reasons) ? explanation.reasons : [];
      if (reasons.length) {
        const list = el('ul', 'jf-reasons');
        reasons.forEach(function (reason) {
          list.appendChild(el('li', null, reason));
        });
        why.appendChild(list);
      }

      if (explanation.comparison) {
        why.appendChild(el('p', null, explanation.comparison));
      }

      if (explanation.fallback === true) {
        why.appendChild(el(
          'p',
          'jf-fallback-note',
          'Penjelasan AI sementara tidak tersedia. Persentase di atas tetap dihitung secara deterministik dari jawabanmu.'
        ));
      }
      wrap.appendChild(why);

      /* 4. Minat kamu */
      const dimensions = buildDimensions(scoring);
      if (dimensions) {
        const interests = el('section', 'jf-section');
        interests.appendChild(el('h2', 'jf-section__title', 'Minat kamu'));
        interests.appendChild(dimensions);
        wrap.appendChild(interests);
      }

      /* 5. Disclaimer */
      wrap.appendChild(el('p', 'jf-disclaimer', 'Ini hasil eksplorasi minat, bukan penentu jurusan yang pasti.'));

      /* 6. Tombol aksi */
      wrap.appendChild(buildActions(scoring));

      resultRoot.appendChild(wrap);
    }
  });
})();
