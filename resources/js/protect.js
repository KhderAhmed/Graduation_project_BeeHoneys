// resources/js/protect.js
// تأكد من استيراد هذا الملف في Vite (وأعد بناء الأصول)
document.addEventListener('DOMContentLoaded', () => {
  const userName = window.__PROTECT_USER || 'مستخدم';
  const wmCanvas = document.getElementById('wmCanvas');
  const blocker = document.getElementById('blocker');
  const toggleBtn = document.getElementById('toggleProtect');
  const content = document.getElementById('content');

  // ------------- منع النسخ/القوائم/الاختيارات -------------
  // CSS-level prevention is provided via Tailwind utility classes in template.
  // JavaScript event blockers:
  ['copy','cut','paste','contextmenu','selectstart'].forEach(evt => {
    document.addEventListener(evt, e => {
      e.preventDefault();
      e.stopPropagation();
    }, {capture: true});
  });

  // منع اختصارات لوحة مفاتيح شائعة (كمحاولة)
  document.addEventListener('keydown', (e) => {
    const key = e.key.toLowerCase();
    // منع Ctrl/Cmd + (c,x,v,a,s,p,u)
    if ((e.ctrlKey || e.metaKey) && ['c','x','v','a','s','p','u'].includes(key)) {
      e.preventDefault();
      e.stopPropagation();
    }
    // حاول التقاط PrintScreen (قد لا يتم إرساله من المتصفح)
    if (e.key === 'PrintScreen' || key === 'printscreen') {
      // وميض يغطي الصفحة مؤقتًا
      flashCover();
      try { navigator.clipboard.writeText(''); } catch (_) {}
      e.preventDefault();
    }
  }, {capture: true});

  // إخفاء الاختيار في حال السحب باستخدام الماوس (حماية مزدوجة)
  window.addEventListener('selectstart', e => { e.preventDefault(); });

  // ------------- طبقة ردع عند فقد التركيز -------------
  document.addEventListener('visibilitychange', () => {
    if (document.hidden) {
      blocker.style.display = 'block';
    } else {
      blocker.style.display = 'none';
    }
  });

  // زر لإيقاف/تشغيل الحماية مؤقتا
  toggleBtn.addEventListener('click', (e) => {
    e.preventDefault();
    const showing = blocker.style.display !== 'none';
    blocker.style.display = showing ? 'none' : 'block';
  });

  // وميض سريع (ردع بصري)
  function flashCover() {
    const cover = document.createElement('div');
    cover.style.position = 'fixed';
    cover.style.inset = '0';
    cover.style.background = '#fff';
    cover.style.opacity = '0.9';
    cover.style.zIndex = 20000;
    document.body.appendChild(cover);
    setTimeout(() => document.body.removeChild(cover), 180);
  }

  // ------------- Watermark: رسم موزّع على canvas -------------
  function drawWatermark() {
    const dpr = window.devicePixelRatio || 1;
    wmCanvas.width = Math.round(window.innerWidth * dpr);
    wmCanvas.height = Math.round(window.innerHeight * dpr);
    wmCanvas.style.width = window.innerWidth + 'px';
    wmCanvas.style.height = window.innerHeight + 'px';
    const ctx = wmCanvas.getContext('2d');
    ctx.clearRect(0, 0, wmCanvas.width, wmCanvas.height);

    const text = `${userName} • ${new Date().toLocaleString()} • محمي`;
    // تصميم نمط مائعي متكرر
    const fontSize = 18 * dpr;
    ctx.font = `${fontSize}px system-ui, -apple-system, "Segoe UI", Roboto, "Noto Sans"`;
    ctx.fillStyle = 'rgba(0,0,0,0.10)';
    ctx.translate(wmCanvas.width / 2, wmCanvas.height / 2);
    ctx.rotate(-0.35); // زاوية مائلة
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';

    // حواف التكرار
    const stepX = 400 * dpr;
    const stepY = 200 * dpr;
    // ابدأ من منتصف الشاشة وكرر حولها
    for (let x = -wmCanvas.width; x < wmCanvas.width; x += stepX) {
      for (let y = -wmCanvas.height; y < wmCanvas.height; y += stepY) {
        ctx.fillText(text, x, y);
      }
    }

    // عدّل التباين قليلاً عبر فلتر (اختياري)
    ctx.setTransform(1, 0, 0, 1, 0, 0); // إعادة التحويل
  }

  // ارسم أول مرة ثم كل 5 ثوانٍ لتضمين وقت محدث (يصعّب التقطيع)
  drawWatermark();
  const wmInterval = setInterval(drawWatermark, 5000);

  // إعادة رسم عند تغيير حجم النافذة
  window.addEventListener('resize', drawWatermark);

  // ------------- حماية إضافية: منع تحميل الصورة عبر السحب -------------
  // اجعل الصور غير قابلة للسحب
  document.querySelectorAll('img').forEach(img => {
    img.setAttribute('draggable', 'false');
    img.addEventListener('dragstart', e => e.preventDefault());
  });

  // إن أردت إيقاف الحماية نهائياً (نموذجي لإدارة المسؤول)
  window.__disableProtection = () => {
    ['copy','cut','paste','contextmenu','selectstart'].forEach(evt => {
      document.removeEventListener(evt, () => {}, {capture:true});
    });
    window.removeEventListener('keydown', () => {});
    window.removeEventListener('resize', drawWatermark);
    clearInterval(wmInterval);
    wmCanvas.style.display = 'none';
    blocker.style.display = 'none';
  };

  // Accessibility tip: اجعل الزر ظاهرًا للقراء الشاشية
  toggleBtn.setAttribute('aria-pressed', 'false');
  toggleBtn.addEventListener('click', () => {
    const pressed = toggleBtn.getAttribute('aria-pressed') === 'true';
    toggleBtn.setAttribute('aria-pressed', String(!pressed));
  });

});
