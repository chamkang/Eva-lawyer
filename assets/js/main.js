/* BAME KANG & Co – small, dependency-free site script. */
(function () {
  'use strict';
  var doc = document.documentElement;
  doc.classList.add('js');

  /* Sticky header shadow + back-to-top button */
  var header = document.querySelector('.site-header');
  var toTop = document.querySelector('.to-top');
  function onScroll() {
    var y = window.scrollY;
    if (header) header.classList.toggle('scrolled', y > 10);
    if (toTop) toTop.classList.toggle('show', y > 700);
  }
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  /* Mobile navigation */
  var toggle = document.querySelector('.nav-toggle');
  var nav = document.getElementById('site-nav');
  if (toggle && nav) {
    var backdrop = document.createElement('div');
    backdrop.className = 'nav-backdrop';
    document.body.appendChild(backdrop);
    var setOpen = function (open) {
      nav.classList.toggle('open', open);
      document.body.classList.toggle('nav-open', open);
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      toggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
    };
    toggle.addEventListener('click', function () { setOpen(!nav.classList.contains('open')); });
    backdrop.addEventListener('click', function () { setOpen(false); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') setOpen(false); });
  }

  /* Reveal on scroll */
  var revealEls = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) { entry.target.classList.add('in'); io.unobserve(entry.target); }
      });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });
    revealEls.forEach(function (el) { io.observe(el); });
  } else {
    revealEls.forEach(function (el) { el.classList.add('in'); });
  }

  /* Animated counters */
  var counters = document.querySelectorAll('[data-count]');
  if ('IntersectionObserver' in window && counters.length) {
    var co = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        var el = entry.target, end = parseInt(el.getAttribute('data-count'), 10), start = null;
        co.unobserve(el);
        var step = function (t) {
          if (!start) start = t;
          var p = Math.min((t - start) / 1400, 1);
          el.textContent = Math.round(end * (1 - Math.pow(1 - p, 3)));
          if (p < 1) requestAnimationFrame(step);
        };
        requestAnimationFrame(step);
      });
    }, { threshold: 0.4 });
    counters.forEach(function (el) { co.observe(el); });
  }

  /* Services directory: search + category filter */
  var dir = document.querySelector('[data-directory]');
  if (dir) {
    var input = dir.querySelector('input[type="search"]');
    var chips = dir.querySelectorAll('.chip');
    var blocks = dir.querySelectorAll('.category-block');
    var empty = dir.querySelector('.no-results');
    var active = 'all';
    var apply = function () {
      var q = (input.value || '').trim().toLowerCase();
      var shown = 0;
      blocks.forEach(function (block) {
        var inCat = active === 'all' || block.getAttribute('data-category') === active;
        var visibleInBlock = 0;
        block.querySelectorAll('[data-search]').forEach(function (card) {
          var match = inCat && (!q || card.getAttribute('data-search').indexOf(q) !== -1);
          card.hidden = !match;
          if (match) visibleInBlock++;
        });
        block.hidden = visibleInBlock === 0;
        shown += visibleInBlock;
      });
      if (empty) empty.hidden = shown !== 0;
    };
    input.addEventListener('input', apply);
    chips.forEach(function (chip) {
      chip.addEventListener('click', function () {
        active = chip.getAttribute('data-filter');
        chips.forEach(function (c) { c.setAttribute('aria-pressed', c === chip ? 'true' : 'false'); });
        apply();
      });
    });
  }

  /* Client-side form validation (server validates again) */
  document.querySelectorAll('form[data-validate]').forEach(function (form) {
    form.addEventListener('submit', function (e) {
      var ok = true;
      form.querySelectorAll('.error').forEach(function (n) { n.remove(); });
      form.querySelectorAll('.field').forEach(function (f) { f.classList.remove('invalid'); });
      form.querySelectorAll('[required]').forEach(function (el) {
        var valid = el.type === 'checkbox' ? el.checked : el.value.trim() !== '';
        if (valid && el.type === 'email') valid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(el.value.trim());
        if (!valid) {
          ok = false;
          var field = el.closest('.field');
          if (field) {
            field.classList.add('invalid');
            var msg = document.createElement('span');
            msg.className = 'error';
            msg.textContent = el.type === 'email' ? 'Please enter a valid email address.' : 'This field is required.';
            field.appendChild(msg);
          } else if (el.type === 'checkbox') {
            el.closest('label').style.color = '#b3261e';
          }
        }
      });
      if (!ok) {
        e.preventDefault();
        var first = form.querySelector('.invalid input, .invalid textarea, input[type="checkbox"]:not(:checked)[required]');
        if (first) first.focus();
      }
    });
  });
})();
