/* ==========================================================
   JURUFIND - Tes Minat Bakat
   Kuis: render pertanyaan pill + radio, POST /jurufind/analyze
   Hasil: render ala mockup (hero, kartu skor, perbandingan,
   detail jurusan, simpan bukti).
   ========================================================== */

// PLACEHOLDER: ganti path ini dengan foto siswa aslimu
var JURUFIND_SISWA_IMG = '/assets/img/jurufind-siswa.png';

document.addEventListener('DOMContentLoaded', function () {
  if (window.lucide) lucide.createIcons();
});

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    const app = document.getElementById('jurufind-app');
    if (!app) return;

    const questions = Array.isArray(window.JURUFIND_QUESTIONS) ? window.JURUFIND_QUESTIONS : [];
    if (!questions.length) return;

    const majors = window.JURUFIND_MAJORS || {};

    const quizStage = document.getElementById('jurufind-quiz-stage');
    const resultStage = document.getElementById('jurufind-result-stage');
    const resultRoot = document.getElementById('jf-result-root');

    const stepText = document.getElementById('jf-progress-text');
    const pctBox = document.getElementById('jf-progress-pct');
    const trackFill = document.getElementById('jf-track-fill');
    const dotsRoot = document.getElementById('jf-progress-track');
    const qNum = document.getElementById('jf-qnum');
    const qType = document.getElementById('jf-qtype');
    const qText = document.getElementById('jf-question-text');
    const qSub = document.getElementById('jf-question-sub');
    const optionsRoot = document.getElementById('jf-options-root');
    const errorRoot = document.getElementById('jf-error-root');
    const prevBtn = document.getElementById('jf-prev-btn');
    const nextBtn = document.getElementById('jf-next-btn');
    const hint = document.getElementById('jf-hint');

    const answers = {};
    let currentIndex = 0;
    let submitting = false;

    /* ---------- Dots progress ---------- */
    const dots = [];
    for (let i = 0; i < questions.length; i++) {
      const dot = document.createElement('span');
      dotsRoot.appendChild(dot);
      dots.push(dot);
    }

    function renderProgress() {
      const answered = questions.filter((q) => answers[q.id]).length;
      const pct = Math.round((answered / questions.length) * 100);
      const from = currentIndex + 1;
      const to = Math.min(currentIndex + 2, questions.length);

      stepText.textContent = 'Pertanyaan ' + from + '–' + to + ' dari ' + questions.length;
      pctBox.textContent = pct + '%';
      trackFill.style.width = pct + '%';

      dots.forEach((dot, i) => {
        dot.className = i === currentIndex ? 'current' : (answers[questions[i].id] ? 'filled' : '');
      });
    }

    /* ---------- Render soal aktif ---------- */
    function renderQuestion() {
      const question = questions[currentIndex];
      const selected = answers[question.id] || null;
      const isImage = question.type === 'image';

      qNum.textContent = currentIndex + 1;
      qType.textContent = 'Pertanyaan ' + (currentIndex + 1) + ' - Pilih ' + (isImage ? 'Gambar' : 'Tulisan');
      qText.textContent = question.question;
      qSub.textContent = isImage
        ? 'Pilih gambar yang paling menggambarkan minatmu saat ini.'
        : 'Pilih jawaban yang paling menggambarkan minatmu saat ini.';

      optionsRoot.textContent = '';
      optionsRoot.className = 'jf-options' + (isImage ? ' jf-options--grid' : '');

      question.options.forEach(function (option) {
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

        const radio = document.createElement('span');
        radio.className = 'jf-option__radio';
        btn.appendChild(radio);

        const label = document.createElement('span');
        label.className = 'jf-option__label';
        label.textContent = option.label;
        btn.appendChild(label);

        btn.addEventListener('click', function () {
          answers[question.id] = option.id;
          clearError();
          renderQuestion();
        });

        optionsRoot.appendChild(btn);
      });

      prevBtn.disabled = currentIndex === 0;
      nextBtn.disabled = !answers[question.id];
      nextBtn.innerHTML = currentIndex === questions.length - 1 ? 'Selesai ✓' : 'Selanjutnya →';
      hint.classList.toggle('is-ok', !!answers[question.id]);

      renderProgress();
    }

    /* ---------- Error ---------- */
    function showError(message) {
      errorRoot.textContent = '';
      const box = document.createElement('p');
      box.className = 'jf-error';
      box.textContent = message;
      errorRoot.appendChild(box);
    }

    function clearError() {
      errorRoot.textContent = '';
    }

    /* ---------- Submit ---------- */
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

          // Ganti URL ke halaman hasil (tanpa reload) supaya tombol "back"
          // dari halaman detail jurusan/silabus kembali ke hasil ini,
          // bukan mengulang tes dari awal.
          if (window.JURUFIND_RESULT_URL && window.history && window.history.replaceState) {
            window.history.replaceState({ jurufind: 'result' }, '', window.JURUFIND_RESULT_URL);
          }

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

    // Kalau ada hasil tersimpan di session (mis. user kembali dari halaman detail
    // jurusan / silabus), langsung tampilkan halaman hasil tanpa mengulang tes.
    if (window.JURUFIND_SAVED_RESULT && window.JURUFIND_SAVED_RESULT.scoring && window.JURUFIND_SAVED_RESULT.explanation) {
      renderResult(window.JURUFIND_SAVED_RESULT.scoring, window.JURUFIND_SAVED_RESULT.explanation);
      quizStage.hidden = true;
      resultStage.hidden = false;
    } else {
      renderQuestion();
    }

    /* ==========================================================
       HALAMAN HASIL
       ========================================================= */
    function el(tag, className, text) {
      const node = document.createElement(tag);
      if (className) node.className = className;
      if (text !== undefined && text !== null) node.textContent = text;
      return node;
    }

    function iconSvg(path) {
      const span = el('span', 'jf-reasons__icon');
      span.innerHTML =
        '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">' +
        path + '</svg>';
      return span;
    }

    function majorShort(major) {
      const info = majors[major];
      return info ? (info.shortName || major) : major;
    }

    function majorFull(major) {
      const info = majors[major];
      return info ? (info.fullName || info.shortName || major) : major;
    }

    /* ---- Ring lingkaran persentase ---- */
    function buildRing(pct) {
      const wrap = el('div', 'jf-ring');
      wrap.style.setProperty('--p', String(pct));
      wrap.innerHTML =
        '<svg viewBox="0 0 112 112">' +
        '<circle class="jf-ring__bg" cx="56" cy="56" r="50"></circle>' +
        '<circle class="jf-ring__fg" cx="56" cy="56" r="50"></circle>' +
        '</svg>' +
        '<span class="jf-ring__pct">' + pct + '%</span>';
      return wrap;
    }

    /* ---- Panel kiri kartu skor ---- */
    function buildScorePanel(scoring) {
      const primary = scoring.primaryMajor;
      const pct = Math.round(Number((scoring.majorPercentages || {})[primary] || 0));

      const panel = el('div', 'jf-scorecard__panel');
      panel.appendChild(el('div', 'jf-scorecard__blob'));

      const row = el('div', 'jf-scorecard__row');
      row.appendChild(buildRing(pct));

      const major = el('div', 'jf-scorecard__major');
      major.appendChild(el('h2', 'jf-scorecard__short', majorShort(primary)));
      major.appendChild(el('p', 'jf-scorecard__full', majorFull(primary)));
      row.appendChild(major);
      panel.appendChild(row);

      return panel;
    }

    /* ---- Panel kanan: perbandingan hasil ---- */
    function buildComparison(scoring) {
      const wrap = el('div', 'jf-cmp');
      wrap.appendChild(el('h3', 'jf-cmp__title', 'Perbandingan Hasil'));

      const primary = scoring.primaryMajor;
      const percentages = scoring.majorPercentages || {};

      ['SIJA', 'TJAT'].forEach(function (major) {
        const pct = Math.round(Number(percentages[major] || 0));
        const isPrimary = major === primary;

        const item = el('div', 'jf-cmp__item' + (isPrimary ? '' : ' jf-cmp__item--secondary'));
        const fill = el('div', 'jf-cmp__fill');
        fill.style.width = pct + '%';
        item.appendChild(fill);

        item.appendChild(el('p', 'jf-cmp__name', majorShort(major)));
        item.appendChild(el('p', 'jf-cmp__desc', majorFull(major)));
        wrap.appendChild(item);
      });

      return wrap;
    }

    /* ---- Seksi detail jurusan (DIPERBARUI: MENGARAH KE SILABUS JURUSAN) ---- */
    function buildDetail(scoring, explanation) {
      const primary = scoring.primaryMajor;
      const section = el('section', 'jf-detail');

      // Media: Foto siswa
      const media = el('div', 'jf-detail__media');
      media.appendChild(el('div', 'jf-detail__blob'));
      const img = document.createElement('img');
      img.className = 'jf-detail__img';
      img.src = JURUFIND_SISWA_IMG;
      img.alt = 'Ilustrasi siswa ' + majorShort(primary);
      // Belum ada foto final: kalau gambar gagal dimuat, sembunyikan kolom media
      // agar layout tidak kolaps jadi blob kosong.
      img.addEventListener('error', function () {
        media.hidden = true;
        section.classList.add('jf-detail--no-media');
      });
      media.appendChild(img);
      section.appendChild(media);

      const body = el('div', 'jf-detail__body');
      const title = el('h2', 'jf-detail__title');
      title.innerHTML = '<em>' + majorShort(primary) + '</em> ' + escapeHtml(stripShort(majorFull(primary), majorShort(primary)));
      body.appendChild(title);

      body.appendChild(el('p', 'jf-detail__desc', explanation.summary || ''));
      body.appendChild(el('p', 'jf-detail__fit', 'Cocok untuk:'));

      const reasons = Array.isArray(explanation.reasons) && explanation.reasons.length
        ? explanation.reasons
        : ['Kamu yang suka tantangan dan hal baru.'];
      const list = el('ul', 'jf-reasons');

      const icons = [
        '<polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/>', // code
        '<path d="M9 18h6"/><path d="M10 22h4"/><path d="M12 2a7 7 0 0 0-4 12.7c.6.5 1 1.4 1 2.3h6c0-.9.4-1.8 1-2.3A7 7 0 0 0 12 2z"/>' // bulb
      ];
      reasons.slice(0, 4).forEach(function (reason, i) {
        const li = el('li');
        li.appendChild(iconSvg(icons[i % icons.length]));
        li.appendChild(document.createTextNode(reason));
        list.appendChild(li);
      });
      body.appendChild(list);

      // =========================================================================
      // DISINI DIRECT ROUTE DILAKUKAN KE SILABUS SIJA / TJAT
      // =========================================================================
      const link = el('a', 'jf-btn jf-btn--solid', 'Selengkapnya →');
      
      // Deteksi URL Silabus berdasarkan rekomendasi AI
      if (window.JURUFIND_SILABUS_URLS && window.JURUFIND_SILABUS_URLS[primary]) {
        link.href = window.JURUFIND_SILABUS_URLS[primary];
      } else {
        // Fallback route dinamis
        link.href = '/jurusan/' + String(primary).toLowerCase() + '/silabus';
      }

      body.appendChild(link);

      section.appendChild(body);
      return section;
    }

    function stripShort(full, short) {
      return full.replace(new RegExp('^' + short + '\\s*[-–—:]?\\s*', 'i'), '').trim() || full;
    }

    function escapeHtml(str) {
      return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;');
    }

    /* ---- Seksi simpan bukti ---- */
    function buildSave() {
      const section = el('section', 'jf-save');
      section.appendChild(el('h2', 'jf-save__title', 'Ingin Simpan Buktinya?'));
      section.appendChild(el('p', 'jf-save__sub', 'Pilih Tombol Di bawah buat Download'));

      const actions = el('div', 'jf-save__actions');

      const emailBtn = el('button', 'jf-btn jf-btn--pill', '✉  Kirim Ke Email');
      emailBtn.type = 'button';
      emailBtn.addEventListener('click', function () {
        alert('Fitur kirim email segera hadir.');
      });
      actions.appendChild(emailBtn);

      const dlBtn = el('button', 'jf-btn jf-btn--pill', '⬇  Download di Lokal');
      dlBtn.type = 'button';
      dlBtn.addEventListener('click', function () {
        window.print();
      });
      actions.appendChild(dlBtn);

      section.appendChild(actions);
      return section;
    }

    /* ---- Render utama hasil ---- */
    function renderResult(scoring, explanation) {
      resultRoot.textContent = '';
      resultRoot.className = 'jf-resultpage';

      // Hero
      const hero = el('section', 'jf-hero');
      hero.appendChild(el('h1', 'jf-hero__title', 'Jurusan Rekomendasi Kamu!'));
      hero.appendChild(el(
        'p',
        'jf-hero__sub',
        'Berdasarkan jawabanmu, sistem kami menemukan jurusan yang paling cocok dengan minat dan bakatmu.'
      ));
      resultRoot.appendChild(hero);

      // Kartu skor
      const scorecard = el('section', 'jf-scorecard');
      scorecard.appendChild(buildScorePanel(scoring));
      scorecard.appendChild(buildComparison(scoring));
      resultRoot.appendChild(scorecard);

      // Detail jurusan (dengan tombol direct ke silabus)
      resultRoot.appendChild(buildDetail(scoring, explanation));

      if (explanation.fallback === true) {
        const note = el(
          'p',
          'jf-fallback-note',
          'Penjelasan AI sementara tidak tersedia. Persentase tetap dihitung secara deterministik dari jawabanmu.'
        );
        note.style.cssText = 'max-width:1180px;margin:1.5rem auto 0;padding:0 3.5rem;font-size:.82rem;color:var(--jf-muted);font-style:italic;';
        resultRoot.appendChild(note);
      }

      // Simpan bukti
      resultRoot.appendChild(buildSave());

      // Animasi bar setelah mount
      requestAnimationFrame(function () {
        resultRoot.querySelectorAll('.jf-cmp__fill').forEach(function (fill) {
          const w = fill.style.width;
          fill.style.width = '0%';
          requestAnimationFrame(function () { fill.style.width = w; });
        });
      });
    }
  });
})();