<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>المخيم الصيفي تازة - تجربة سياحية لا تُنسى</title>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
  :root {
    --blue-deep:    #0B3C5D;   /* palette: deep navy       */
    --blue-ocean:   #00A6B2;   /* palette: teal            */
    --cyan-sky:     #3ec8d3;   /* teal highlight (lighter) */
    --green-nature: #3EB06A;   /* palette: medium green    */
    --green-palm:   #1D5D30;   /* palette: forest green    */
    --yellow-sun:   #FDB813;   /* palette: golden amber    */
    --orange-warm:  #e8a010;   /* amber warm variant       */
    --white:        #FFFFFF;   /* palette: white           */
    --light-bg:     #EDF8FA;   /* powder blue tint         */
    --powder-blue:  #C1E3ED;   /* palette: powder blue     */
    --text-dark:    #0B3C5D;
    --text-mid:     #1D5D30;
    --text-soft:    #5a8fa5;
    --shadow-card:  0 8px 40px rgba(11,60,93,0.13);
    --shadow-hover: 0 20px 60px rgba(0,166,178,0.22);
    --radius-xl: 24px;
    --radius-lg: 16px;
    --radius-md: 12px;
    --transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  html { scroll-behavior: smooth; }

  body {
    font-family: 'Cairo', 'Tajawal', sans-serif;
    background: var(--white);
    color: var(--text-dark);
    overflow-x: hidden;
    direction: rtl;
  }

  /* ─── SCROLLBAR ─── */
  ::-webkit-scrollbar { width: 7px; }
  ::-webkit-scrollbar-track { background: var(--powder-blue); }
  ::-webkit-scrollbar-thumb { background: var(--blue-ocean); border-radius: 4px; }

  /* ─── NAVBAR ─── */
  nav {
    position: fixed; top: 0; width: 100%; z-index: 1000;
    padding: 0 5%;
    display: flex; align-items: center; justify-content: space-between;
    height: 74px;
    background: rgba(11,60,93,0.12);
    backdrop-filter: blur(18px);
    border-bottom: 1px solid rgba(193,227,237,0.18);
    transition: var(--transition);
  }
  nav.scrolled {
    background: rgba(11,60,93,0.97);
    box-shadow: 0 4px 30px rgba(0,0,0,0.25);
  }
  .nav-logo {
    display: flex; align-items: center; gap: 12px; text-decoration: none;
  }
  .nav-logo-icon {
    width: 50px; height: 50px;
    background: linear-gradient(135deg, var(--cyan-sky), var(--blue-ocean));
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px; color: white;
    box-shadow: 0 4px 15px rgba(57,196,224,0.4);
    position: relative; overflow: hidden;
  }
  .nav-logo-icon::before {
    content: '';
    position: absolute; bottom: 0; left: 0; right: 0; height: 40%;
    background: rgba(79,143,58,0.5);
  }
  .nav-logo-text { color: white; }
  .nav-logo-text .brand-name { font-size: 18px; font-weight: 800; line-height: 1.1; }
  .nav-logo-text .brand-sub { font-size: 11px; font-weight: 400; opacity: 0.8; letter-spacing: 0.5px; }
  .nav-links {
    display: flex; gap: 8px; list-style: none; align-items: center;
  }
  .nav-links a {
    color: rgba(255,255,255,0.88); text-decoration: none;
    font-size: 14px; font-weight: 600; padding: 7px 14px;
    border-radius: 8px; transition: var(--transition);
  }
  .nav-links a:hover { background: rgba(255,255,255,0.15); color: var(--cyan-sky); }
  .nav-cta {
    background: linear-gradient(135deg, var(--yellow-sun), var(--orange-warm)) !important;
    color: white !important; padding: 9px 20px !important;
    border-radius: 10px !important; font-weight: 700 !important;
    box-shadow: 0 4px 15px rgba(246,178,26,0.35);
  }
  .nav-cta:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(246,178,26,0.5) !important; }
  .hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; }
  .hamburger span { width: 26px; height: 2.5px; background: white; border-radius: 2px; transition: var(--transition); }

  /* ─── HERO ─── */
  #hero {
    height: 100vh; min-height: 580px;
    position: relative; display: flex;
    align-items: center; overflow: hidden;
  }
  .hero-bg {
    position: absolute; inset: 0; z-index: 0;
    background: linear-gradient(145deg,
      #0B3C5D 0%,
      #0e4e6e 30%,
      #00626b 65%,
      #1D5D30 100%);
  }
  .hero-bg::after {
    content: '';
    position: absolute; bottom: 0; left: 0; right: 0; height: 80px;
    background: linear-gradient(to top, var(--white), transparent);
  }
  /* Animated particles */
  .hero-particles {
    position: absolute; inset: 0; z-index: 1;
    pointer-events: none;
  }
  .particle {
    position: absolute;
    border-radius: 50%;
    background: rgba(255,255,255,0.12);
    animation: float-particle linear infinite;
  }
  @keyframes float-particle {
    0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
    10% { opacity: 1; }
    90% { opacity: 1; }
    100% { transform: translateY(-100px) rotate(360deg); opacity: 0; }
  }
  .hero-content {
    position: relative; z-index: 2; width: 100%;
    max-width: 1280px; margin: 0 auto;
    padding: calc(74px + 14px) 5% 14px;
    display: grid; grid-template-columns: 1fr 1.4fr; gap: 40px; align-items: center;
  }
  .hero-text { animation: slideInRight 1s ease 0.2s both; }
  @keyframes slideInRight {
    from { opacity: 0; transform: translateX(50px); }
    to { opacity: 1; transform: translateX(0); }
  }
  .hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(246,178,26,0.2); border: 1px solid rgba(246,178,26,0.5);
    color: var(--yellow-sun); padding: 5px 14px; border-radius: 50px;
    font-size: 12px; font-weight: 700; margin-bottom: 12px;
    backdrop-filter: blur(8px);
  }
  .hero-badge i { font-size: 12px; }
  .hero-title {
    font-size: clamp(24px, 3.2vw, 46px);
    font-weight: 900; color: white; line-height: 1.2;
    margin-bottom: 10px; text-shadow: 0 2px 20px rgba(0,0,0,0.3);
  }
  .hero-title .accent { color: var(--cyan-sky); }
  .hero-subtitle {
    font-size: clamp(13px, 1.3vw, 15px);
    color: rgba(255,255,255,0.85); line-height: 1.7; margin-bottom: 18px;
    font-weight: 400;
  }
  .hero-btns { display: flex; gap: 16px; flex-wrap: wrap; }
  .btn-primary {
    background: linear-gradient(135deg, var(--yellow-sun), var(--orange-warm));
    color: white; padding: 11px 24px; border-radius: 12px;
    font-size: 14px; font-weight: 800; border: none; cursor: pointer;
    text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
    box-shadow: 0 8px 30px rgba(246,178,26,0.4);
    transition: var(--transition);
  }
  .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 15px 40px rgba(246,178,26,0.55); }
  .btn-secondary {
    background: rgba(255,255,255,0.12); backdrop-filter: blur(10px);
    color: white; padding: 11px 24px; border-radius: 12px;
    font-size: 14px; font-weight: 700; border: 2px solid rgba(255,255,255,0.3);
    cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
    transition: var(--transition);
  }
  .btn-secondary:hover { background: rgba(255,255,255,0.22); transform: translateY(-3px); }
  .hero-stats {
    display: flex; gap: 20px; margin-top: 18px;
  }
  .stat { text-align: center; }
  .stat-num { font-size: 26px; font-weight: 900; color: var(--yellow-sun); line-height: 1; }
  .stat-label { font-size: 11px; color: rgba(255,255,255,0.75); margin-top: 3px; font-weight: 500; }
  .hero-visual { animation: slideInLeft 1s ease 0.4s both; }
  @keyframes slideInLeft {
    from { opacity: 0; transform: translateX(-50px); }
    to { opacity: 1; transform: translateX(0); }
  }
  .hero-logo-card {
    background: rgba(0,0,0,0.35); backdrop-filter: blur(16px);
    border: 1px solid rgba(255,255,255,0.18); border-radius: 20px;
    padding: 12px; text-align: center;
    box-shadow: 0 20px 60px rgba(0,0,0,0.35);
    overflow: hidden;
  }
  /* ─── Video Player Card ─── */
  .hero-video-card {
    width: 100%; aspect-ratio: 16/10;
    border-radius: 12px; overflow: hidden;
    position: relative; background: #000;
    box-shadow: 0 10px 40px rgba(0,0,0,0.45);
  }
  .hero-video-card video {
    width: 100%; height: 100%; object-fit: cover; display: block;
  }
  /* Central play/pause click zone */
  .vid-click-zone {
    position: absolute; inset: 0 0 52px 0;
    cursor: pointer; z-index: 2;
  }
  /* Control bar */
  .vid-controls {
    position: absolute; bottom: 0; left: 0; right: 0; height: 52px;
    background: linear-gradient(to top, rgba(0,0,0,0.85), rgba(0,0,0,0.0));
    display: flex; align-items: center; gap: 10px; padding: 0 14px;
    z-index: 3;
  }
  .vid-btn {
    width: 34px; height: 34px; border-radius: 50%;
    background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.25);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: white; font-size: 14px;
    transition: background 0.2s, transform 0.15s;
    flex-shrink: 0;
  }
  .vid-btn:hover { background: rgba(253,184,19,0.7); transform: scale(1.1); }
  .vid-progress {
    flex: 1; height: 4px; background: rgba(255,255,255,0.25);
    border-radius: 4px; cursor: pointer; position: relative; overflow: hidden;
  }
  .vid-progress-fill {
    height: 100%; width: 0%; background: var(--yellow-sun);
    border-radius: 4px; transition: width 0.1s linear; pointer-events: none;
  }
  .vid-time {
    font-size: 11px; color: rgba(255,255,255,0.75); font-weight: 600;
    white-space: nowrap; flex-shrink: 0;
  }
  /* Big play icon on pause */
  .vid-big-play {
    position: absolute; inset: 0 0 52px 0;
    display: flex; align-items: center; justify-content: center;
    pointer-events: none; z-index: 2;
    opacity: 0; transition: opacity 0.3s;
  }
  .vid-big-play.show { opacity: 1; }
  .vid-big-play i {
    font-size: 64px; color: rgba(255,255,255,0.92);
    filter: drop-shadow(0 2px 12px rgba(0,0,0,0.6));
  }
  .logo-main {
    width: 160px; height: 160px; margin: 0 auto 20px;
    background: linear-gradient(145deg, var(--blue-deep), var(--blue-ocean));
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    position: relative; overflow: hidden;
    box-shadow: 0 10px 40px rgba(17,153,204,0.5), inset 0 0 30px rgba(57,196,224,0.2);
    animation: pulse-logo 3s ease-in-out infinite;
  }
  @keyframes pulse-logo {
    0%, 100% { box-shadow: 0 10px 40px rgba(17,153,204,0.5), inset 0 0 30px rgba(57,196,224,0.2); }
    50% { box-shadow: 0 10px 60px rgba(57,196,224,0.7), inset 0 0 40px rgba(57,196,224,0.3); }
  }
  .logo-main::before {
    content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 45%;
    background: linear-gradient(to top, var(--green-palm), var(--green-nature));
  }
  .logo-main::after {
    content: '';
    position: absolute; top: 15%; left: 50%; transform: translateX(-50%);
    width: 0; height: 0;
    border-left: 35px solid transparent;
    border-right: 35px solid transparent;
    border-bottom: 50px solid rgba(255,255,255,0.15);
  }
  .logo-sun {
    position: absolute; top: 20%; right: 25%;
    width: 28px; height: 28px;
    background: var(--yellow-sun);
    border-radius: 50%;
    box-shadow: 0 0 20px rgba(246,178,26,0.8);
  }
  .logo-waves {
    position: absolute; bottom: 8%; left: 0; right: 0;
    height: 20px; overflow: hidden;
  }
  .logo-name-big { font-size: 26px; font-weight: 900; color: white; margin-bottom: 4px; }
  .logo-name-sub { font-size: 14px; color: rgba(255,255,255,0.7); font-weight: 500; }
  .hero-scroll {
    position: absolute; bottom: 40px; left: 50%; transform: translateX(-50%);
    z-index: 3; display: flex; flex-direction: column; align-items: center; gap: 8px;
    color: rgba(255,255,255,0.7); font-size: 12px; font-weight: 600;
    animation: bounce 2s ease-in-out infinite;
  }
  @keyframes bounce {
    0%, 100% { transform: translateX(-50%) translateY(0); }
    50% { transform: translateX(-50%) translateY(8px); }
  }
  .scroll-icon {
    width: 34px; height: 50px; border: 2px solid rgba(255,255,255,0.5);
    border-radius: 17px; display: flex; justify-content: center; padding-top: 8px;
  }
  .scroll-dot {
    width: 5px; height: 10px; background: rgba(255,255,255,0.8);
    border-radius: 3px; animation: scroll-anim 2s ease infinite;
  }
  @keyframes scroll-anim {
    0% { transform: translateY(0); opacity: 1; }
    100% { transform: translateY(18px); opacity: 0; }
  }

  /* ─── SECTION SHARED ─── */
  section { padding: 90px 5%; }
  .section-header { text-align: center; margin-bottom: 60px; }
  .section-badge {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 13px; font-weight: 700; letter-spacing: 1px;
    color: var(--blue-ocean); margin-bottom: 14px;
    text-transform: uppercase;
  }
  .section-badge::before, .section-badge::after {
    content: ''; width: 30px; height: 2px;
    background: linear-gradient(90deg, var(--cyan-sky), var(--blue-ocean));
    border-radius: 2px;
  }
  .section-title {
    font-size: clamp(28px, 3.5vw, 46px); font-weight: 900;
    color: var(--blue-deep); line-height: 1.3; margin-bottom: 16px;
  }
  .section-subtitle {
    font-size: clamp(14px, 1.4vw, 17px); color: var(--text-soft);
    max-width: 600px; margin: 0 auto; line-height: 1.8;
  }

  /* ─── ABOUT ─── */
  #about { background: var(--light-bg); position: relative; overflow: hidden; }
  #about::before {
    content: ''; position: absolute; top: -80px; right: -80px;
    width: 400px; height: 400px; border-radius: 50%;
    background: radial-gradient(circle, rgba(0,166,178,0.12), transparent);
  }
  .about-grid {
    max-width: 1200px; margin: 0 auto;
    display: grid; grid-template-columns: 1fr 1fr; gap: 70px; align-items: center;
  }
  .about-img-wrap { position: relative; }
  .about-img-main {
    width: 100%; height: 480px; object-fit: cover;
    border-radius: var(--radius-xl); box-shadow: var(--shadow-card);
    display: block;
    background: linear-gradient(135deg, var(--blue-deep), var(--green-palm));
  }
  .about-img-frame {
    width: 100%; height: 480px; border-radius: var(--radius-xl);
    overflow: hidden; box-shadow: var(--shadow-card);
  }
  .about-img-frame img {
    width: 100%; height: 100%; object-fit: cover;
    display: block;
  }
  .about-float-card {
    position: absolute; bottom: -25px; left: -25px;
    background: white; border-radius: var(--radius-lg);
    padding: 18px 24px; box-shadow: var(--shadow-hover);
    display: flex; align-items: center; gap: 14px;
    min-width: 200px;
    animation: floatCard 3s ease-in-out infinite;
  }
  @keyframes floatCard {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
  }
  .about-float-icon {
    width: 50px; height: 50px; border-radius: 14px; flex-shrink: 0;
    background: linear-gradient(135deg, var(--yellow-sun), var(--orange-warm));
    display: flex; align-items: center; justify-content: center;
    color: white; font-size: 22px;
  }
  .about-float-num { font-size: 26px; font-weight: 900; color: var(--blue-deep); line-height: 1; }
  .about-float-text { font-size: 12px; color: var(--text-soft); font-weight: 600; }
  .about-text h2 {
    font-size: clamp(26px, 3vw, 40px); font-weight: 900;
    color: var(--blue-deep); line-height: 1.3; margin-bottom: 20px;
  }
  .about-text h2 span { color: var(--blue-ocean); }
  .about-text p {
    font-size: 16px; color: var(--text-mid); line-height: 1.9; margin-bottom: 32px;
  }
  .features-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 32px; }
  .feature-card {
    background: white; border-radius: var(--radius-lg); padding: 20px;
    display: flex; align-items: center; gap: 14px;
    box-shadow: 0 4px 20px rgba(11,60,93,0.08);
    border: 1px solid rgba(0,166,178,0.15);
    transition: var(--transition);
  }
  .feature-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-hover); border-color: var(--cyan-sky); }
  .feature-icon {
    width: 48px; height: 48px; border-radius: 12px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; color: white;
  }
  .feature-icon.blue { background: linear-gradient(135deg, var(--blue-ocean), var(--cyan-sky)); }
  .feature-icon.green { background: linear-gradient(135deg, var(--green-palm), var(--green-nature)); }
  .feature-icon.yellow { background: linear-gradient(135deg, var(--yellow-sun), var(--orange-warm)); }
  .feature-icon.dark { background: linear-gradient(135deg, var(--blue-deep), var(--blue-ocean)); }
  .feature-label { font-size: 14px; font-weight: 700; color: var(--text-dark); }
  .feature-desc { font-size: 12px; color: var(--text-soft); margin-top: 3px; }

  /* ─── SERVICES ─── */
  #services { background: white; }
  .services-grid {
    max-width: 1200px; margin: 0 auto;
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px;
  }
  .service-card {
    border-radius: var(--radius-xl); padding: 36px 28px;
    background: var(--light-bg);
    border: 1px solid rgba(0,166,178,0.15);
    transition: var(--transition); cursor: default; position: relative;
    overflow: hidden;
  }
  .service-card::before {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(135deg, var(--blue-deep), var(--blue-ocean));
    opacity: 0; transition: var(--transition);
    z-index: 0;
  }
  .service-card:hover { transform: translateY(-10px); box-shadow: var(--shadow-hover); }
  .service-card:hover::before { opacity: 1; }
  .service-card > * { position: relative; z-index: 1; }
  .service-icon-wrap {
    width: 72px; height: 72px; border-radius: 20px; margin-bottom: 22px;
    display: flex; align-items: center; justify-content: center;
    font-size: 30px; color: white;
    background: linear-gradient(135deg, var(--blue-ocean), var(--cyan-sky));
    box-shadow: 0 8px 25px rgba(17,153,204,0.3);
    transition: var(--transition);
  }
  .service-card:hover .service-icon-wrap {
    background: rgba(255,255,255,0.2);
    box-shadow: 0 8px 25px rgba(255,255,255,0.2);
  }
  .service-title {
    font-size: 20px; font-weight: 800; color: var(--blue-deep); margin-bottom: 10px;
    transition: var(--transition);
  }
  .service-card:hover .service-title { color: white; }
  .service-desc {
    font-size: 14px; color: var(--text-soft); line-height: 1.8;
    transition: var(--transition);
  }
  .service-card:hover .service-desc { color: rgba(255,255,255,0.8); }
  .service-arrow {
    margin-top: 20px; display: inline-flex; align-items: center; gap: 6px;
    font-size: 13px; font-weight: 700; color: var(--blue-ocean);
    transition: var(--transition);
  }
  .service-card:hover .service-arrow { color: var(--cyan-sky); gap: 10px; }

  /* ─── GALLERY ─── */
  #gallery { background: var(--light-bg); }
  .gallery-grid {
    max-width: 1200px; margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-template-rows: repeat(2, 240px);
    gap: 14px;
  }
  .gallery-item {
    border-radius: var(--radius-lg); overflow: hidden; cursor: pointer;
    position: relative;
  }
  .gallery-item:nth-child(1) { grid-column: span 2; grid-row: span 2; }
  .gallery-item:nth-child(4) { grid-column: span 2; }
  .gallery-bg {
    width: 100%; height: 100%;
    object-fit: cover; display: block;
    transition: transform 0.5s ease;
  }
  .gallery-bg-div {
    width: 100%; height: 100%;
    background-size: cover; background-position: center;
    transition: transform 0.5s ease;
  }
  .gallery-item:hover .gallery-bg,
  .gallery-item:hover .gallery-bg-div { transform: scale(1.07); }
  .gallery-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(11,79,122,0.75), transparent 60%);
    opacity: 0; transition: var(--transition);
    display: flex; align-items: flex-end; padding: 16px;
  }
  .gallery-item:hover .gallery-overlay { opacity: 1; }
  .gallery-overlay-text { color: white; font-weight: 700; font-size: 14px; }
  .gallery-zoom {
    position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) scale(0);
    width: 50px; height: 50px; background: rgba(255,255,255,0.9);
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    font-size: 18px; color: var(--blue-deep); transition: var(--transition);
  }
  .gallery-item:hover .gallery-zoom { transform: translate(-50%, -50%) scale(1); }
  /* Video badge */
  .gallery-video-badge {
    position: absolute; top: 12px; right: 12px;
    background: rgba(246,178,26,0.9); color: white;
    padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 700;
    display: flex; align-items: center; gap: 5px;
    backdrop-filter: blur(6px);
  }

  /* Lightbox */
  .lightbox {
    position: fixed; inset: 0; z-index: 9999;
    background: rgba(0,0,0,0.94); display: none;
    align-items: center; justify-content: center;
    animation: fadeIn 0.3s ease;
  }
  .lightbox.open { display: flex; }
  @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
  .lightbox-content {
    max-width: 90vw; max-height: 88vh; position: relative;
    display: flex; align-items: center; justify-content: center;
  }
  .lightbox-img {
    max-width: 88vw; max-height: 84vh; object-fit: contain;
    border-radius: 14px; display: block;
    box-shadow: 0 20px 80px rgba(0,0,0,0.6);
  }
  .lightbox-video {
    max-width: 88vw; max-height: 84vh;
    border-radius: 14px; display: block;
    box-shadow: 0 20px 80px rgba(0,0,0,0.6);
    outline: none;
  }
  .lightbox-close {
    position: absolute; top: -18px; left: -18px;
    width: 42px; height: 42px; background: white; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; cursor: pointer; color: var(--blue-deep);
    box-shadow: 0 4px 15px rgba(0,0,0,0.3); z-index: 2;
  }

  /* ─── RESERVATION ─── */
  #reservation {
    background: linear-gradient(160deg, var(--blue-deep) 0%, var(--blue-ocean) 60%, var(--cyan-sky) 100%);
    position: relative; overflow: hidden;
  }
  #reservation::before {
    content: '';
    position: absolute; top: -100px; left: -100px;
    width: 500px; height: 500px; border-radius: 50%;
    background: radial-gradient(circle, rgba(0,166,178,0.2), transparent);
  }
  #reservation .section-title { color: white; }
  #reservation .section-subtitle { color: rgba(255,255,255,0.75); }
  #reservation .section-badge { color: var(--yellow-sun); }
  #reservation .section-badge::before, #reservation .section-badge::after {
    background: var(--yellow-sun);
  }
  .reservation-form {
    max-width: 860px; margin: 0 auto;
    background: rgba(255,255,255,0.1); backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.2); border-radius: 28px;
    padding: 50px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    position: relative; z-index: 1;
  }
  .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
  .form-group { display: flex; flex-direction: column; gap: 8px; }
  .form-group.full { grid-column: span 2; }
  .form-label {
    font-size: 13px; font-weight: 700; color: rgba(255,255,255,0.9);
    display: flex; align-items: center; gap: 6px;
  }
  .form-label i { color: var(--cyan-sky); font-size: 12px; }
  .form-input {
    background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.25);
    border-radius: 12px; padding: 14px 16px;
    color: white; font-size: 14px; font-family: 'Cairo', sans-serif;
    outline: none; transition: var(--transition);
    direction: rtl;
  }
  .form-input::placeholder { color: rgba(255,255,255,0.45); }
  .form-input:focus { border-color: var(--cyan-sky); background: rgba(255,255,255,0.18); box-shadow: 0 0 0 3px rgba(57,196,224,0.2); }
  select.form-input option { background: var(--blue-deep); color: white; }
  .form-submit {
    width: 100%; margin-top: 10px;
    background: linear-gradient(135deg, var(--yellow-sun), var(--orange-warm));
    color: white; padding: 18px; border-radius: 14px;
    font-size: 18px; font-weight: 800; border: none; cursor: pointer;
    box-shadow: 0 8px 30px rgba(246,178,26,0.4); transition: var(--transition);
    font-family: 'Cairo', sans-serif;
    display: flex; align-items: center; justify-content: center; gap: 10px;
  }
  .form-submit:hover { transform: translateY(-3px); box-shadow: 0 15px 40px rgba(246,178,26,0.6); }

  /* ─── TESTIMONIALS ─── */
  #testimonials { background: white; overflow: hidden; }
  .testimonials-slider { max-width: 1200px; margin: 0 auto; position: relative; }
  .testimonials-track {
    display: flex; gap: 24px;
    animation: slide-testimonials 20s linear infinite;
    width: max-content;
  }
  .testimonials-track:hover { animation-play-state: paused; }
  @keyframes slide-testimonials {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
  }
  .testimonial-card {
    min-width: 350px; background: var(--light-bg);
    border-radius: var(--radius-xl); padding: 32px;
    border: 1px solid rgba(0,166,178,0.15);
    box-shadow: var(--shadow-card);
    flex-shrink: 0; transition: var(--transition);
  }
  .testimonial-card:hover { box-shadow: var(--shadow-hover); transform: translateY(-5px); }
  .test-stars { color: var(--yellow-sun); font-size: 18px; margin-bottom: 16px; }
  .test-text {
    font-size: 15px; color: var(--text-mid); line-height: 1.8;
    margin-bottom: 22px; font-style: italic;
  }
  .test-text::before { content: '"'; font-size: 40px; color: var(--cyan-sky); line-height: 0; vertical-align: -15px; }
  .test-author { display: flex; align-items: center; gap: 14px; }
  .test-avatar {
    width: 52px; height: 52px; border-radius: 50%; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; font-weight: 800; color: white;
  }
  .test-name { font-size: 15px; font-weight: 800; color: var(--blue-deep); }
  .test-location { font-size: 12px; color: var(--text-soft); margin-top: 2px; }
  .slider-fade-right {
    position: absolute; top: 0; left: 0; bottom: 0; width: 80px;
    background: linear-gradient(to right, white, transparent);
    pointer-events: none; z-index: 2;
  }
  .slider-fade-left {
    position: absolute; top: 0; right: 0; bottom: 0; width: 80px;
    background: linear-gradient(to left, white, transparent);
    pointer-events: none; z-index: 2;
  }

  /* ─── CONTACT ─── */
  #contact { background: var(--light-bg); }
  .contact-grid {
    max-width: 1200px; margin: 0 auto;
    display: grid; grid-template-columns: 1fr 1.4fr; gap: 50px; align-items: start;
  }
  .contact-info-block { display: flex; flex-direction: column; gap: 20px; }
  .contact-card {
    background: white; border-radius: var(--radius-lg); padding: 22px 24px;
    display: flex; align-items: center; gap: 18px;
    box-shadow: var(--shadow-card); border: 1px solid rgba(0,166,178,0.12);
    transition: var(--transition);
  }
  .contact-card:hover { transform: translateX(-8px); box-shadow: var(--shadow-hover); }
  .contact-icon {
    width: 54px; height: 54px; border-radius: 14px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px; color: white;
  }
  .contact-icon.blue { background: linear-gradient(135deg, var(--blue-ocean), var(--cyan-sky)); }
  .contact-icon.green { background: linear-gradient(135deg, var(--green-palm), var(--green-nature)); }
  .contact-icon.yellow { background: linear-gradient(135deg, var(--yellow-sun), var(--orange-warm)); }
  .contact-icon.dark { background: linear-gradient(135deg, var(--blue-deep), var(--blue-ocean)); }
  .contact-label { font-size: 12px; color: var(--text-soft); font-weight: 600; margin-bottom: 4px; }
  .contact-value { font-size: 15px; font-weight: 700; color: var(--text-dark); }
  .social-links { display: flex; gap: 14px; margin-top: 10px; }
  .social-btn {
    width: 46px; height: 46px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; color: white; text-decoration: none;
    transition: var(--transition);
  }
  .social-btn.fb { background: #1877F2; }
  .social-btn.ig { background: linear-gradient(135deg, #833ab4, #fd1d1d, #fcb045); }
  .social-btn.tw { background: #1DA1F2; }
  .social-btn.yt { background: #FF0000; }
  .social-btn.wa { background: #25D366; }
  .social-btn:hover { transform: translateY(-4px) scale(1.1); box-shadow: 0 8px 20px rgba(0,0,0,0.2); }
  .map-container {
    background: white; border-radius: var(--radius-xl); overflow: hidden;
    box-shadow: var(--shadow-card); height: 400px; position: relative;
  }
  .map-placeholder {
    width: 100%; height: 100%;
    background: linear-gradient(160deg, var(--powder-blue), #a8d8e8);
    display: flex; align-items: center; justify-content: center;
    flex-direction: column; gap: 16px; position: relative; overflow: hidden;
  }
  .map-grid {
    position: absolute; inset: 0;
    background-image: linear-gradient(rgba(0,166,178,0.08) 1px, transparent 1px),
      linear-gradient(90deg, rgba(0,166,178,0.08) 1px, transparent 1px);
    background-size: 40px 40px;
  }
  .map-roads {
    position: absolute; inset: 0; overflow: hidden;
  }
  .map-road-h {
    position: absolute; left: 0; right: 0;
    height: 3px; background: rgba(255,255,255,0.7);
  }
  .map-road-v {
    position: absolute; top: 0; bottom: 0;
    width: 3px; background: rgba(255,255,255,0.7);
  }
  .map-pin {
    width: 56px; height: 56px; background: var(--blue-ocean); border-radius: 50% 50% 50% 0;
    transform: rotate(-45deg); display: flex; align-items: center; justify-content: center;
    position: relative; z-index: 2;
    box-shadow: 0 8px 25px rgba(17,153,204,0.4);
    animation: pin-bounce 2s ease-in-out infinite;
  }
  @keyframes pin-bounce {
    0%, 100% { transform: rotate(-45deg) translateY(0); }
    50% { transform: rotate(-45deg) translateY(-8px); }
  }
  .map-pin i { transform: rotate(45deg); color: white; font-size: 22px; }
  .map-label {
    font-size: 16px; font-weight: 800; color: var(--blue-deep);
    position: relative; z-index: 2;
  }
  .map-sublabel { font-size: 12px; color: var(--text-soft); position: relative; z-index: 2; }

  /* ─── WAVE DIVIDERS ─── */
  .wave-divider { line-height: 0; }
  .wave-divider svg { display: block; width: 100%; }

  /* ─── FOOTER ─── */
  footer {
    background: linear-gradient(160deg, #061928, var(--blue-deep));
    padding: 70px 5% 30px; color: rgba(255,255,255,0.8);
  }
  .footer-grid {
    max-width: 1200px; margin: 0 auto;
    display: grid; grid-template-columns: 1.5fr 1fr 1fr 1fr; gap: 50px;
    padding-bottom: 50px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
  }
  .footer-brand { }
  .footer-logo { display: flex; align-items: center; gap: 12px; margin-bottom: 18px; }
  .footer-logo-icon {
    width: 54px; height: 54px; border-radius: 50%;
    background: linear-gradient(135deg, var(--cyan-sky), var(--blue-ocean));
    display: flex; align-items: center; justify-content: center;
    font-size: 22px; color: white; position: relative; overflow: hidden;
  }
  .footer-logo-icon::before {
    content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 40%;
    background: rgba(79,143,58,0.5);
  }
  .footer-brand-name { font-size: 18px; font-weight: 800; color: white; }
  .footer-brand-sub { font-size: 11px; color: rgba(255,255,255,0.6); }
  .footer-desc { font-size: 14px; line-height: 1.8; color: rgba(255,255,255,0.6); margin-bottom: 20px; }
  .footer-social { display: flex; gap: 10px; }
  .footer-social a {
    width: 38px; height: 38px; border-radius: 10px;
    background: rgba(255,255,255,0.1); display: flex; align-items: center;
    justify-content: center; color: rgba(255,255,255,0.7); font-size: 15px;
    text-decoration: none; transition: var(--transition);
    border: 1px solid rgba(255,255,255,0.1);
  }
  .footer-social a:hover { background: var(--blue-ocean); border-color: var(--blue-ocean); color: white; transform: translateY(-3px); }
  .footer-col-title { font-size: 16px; font-weight: 800; color: white; margin-bottom: 20px; position: relative; padding-bottom: 10px; }
  .footer-col-title::after {
    content: ''; position: absolute; bottom: 0; right: 0;
    width: 30px; height: 2px; background: var(--cyan-sky); border-radius: 2px;
  }
  .footer-links { list-style: none; display: flex; flex-direction: column; gap: 10px; }
  .footer-links a {
    color: rgba(255,255,255,0.6); text-decoration: none; font-size: 14px;
    transition: var(--transition); display: flex; align-items: center; gap: 8px;
  }
  .footer-links a:hover { color: var(--cyan-sky); padding-right: 5px; }
  .footer-links a i { font-size: 10px; color: var(--cyan-sky); }
  .footer-bottom {
    max-width: 1200px; margin: 30px auto 0;
    display: flex; align-items: center; justify-content: space-between;
    flex-wrap: wrap; gap: 12px;
  }
  .footer-copy { font-size: 13px; color: rgba(255,255,255,0.5); }
  .footer-bottom-links { display: flex; gap: 20px; }
  .footer-bottom-links a { font-size: 13px; color: rgba(255,255,255,0.5); text-decoration: none; transition: var(--transition); }
  .footer-bottom-links a:hover { color: var(--cyan-sky); }

  /* ─── SCROLL REVEAL ─── */
  .reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.7s ease, transform 0.7s ease; }
  .reveal.visible { opacity: 1; transform: translateY(0); }
  .reveal-delay-1 { transition-delay: 0.1s; }
  .reveal-delay-2 { transition-delay: 0.2s; }
  .reveal-delay-3 { transition-delay: 0.3s; }
  .reveal-delay-4 { transition-delay: 0.4s; }
  .reveal-delay-5 { transition-delay: 0.5s; }

  /* ─── RESPONSIVE ─── */
  @media (max-width: 1024px) {
    .services-grid { grid-template-columns: repeat(2, 1fr); }
    .footer-grid { grid-template-columns: 1fr 1fr; }
  }
  @media (max-width: 768px) {
    nav { padding: 0 4%; }
    .nav-links { display: none; }
    .hamburger { display: flex; }
    .hero-content { grid-template-columns: 1fr; padding: 100px 4% 70px; }
    .hero-visual { display: none; }
    .hero-stats { gap: 18px; }
    .about-grid { grid-template-columns: 1fr; }
    .about-float-card { display: none; }
    .services-grid { grid-template-columns: 1fr; }
    .gallery-grid { grid-template-columns: repeat(2, 1fr); grid-template-rows: auto; }
    .gallery-item:nth-child(1), .gallery-item:nth-child(4) { grid-column: span 1; }
    .form-grid { grid-template-columns: 1fr; }
    .form-group.full { grid-column: span 1; }
    .reservation-form { padding: 28px 22px; }
    .contact-grid { grid-template-columns: 1fr; }
    .footer-grid { grid-template-columns: 1fr; gap: 35px; }
    .footer-bottom { flex-direction: column; text-align: center; }
    .hero-btns { flex-direction: column; }
    section { padding: 60px 4%; }
  }
  @media (max-width: 480px) {
    .gallery-grid { grid-template-columns: 1fr; }
    .gallery-item:first-child, .gallery-item:nth-child(4) { grid-column: 1; }
    .features-grid { grid-template-columns: 1fr; }
  }

  /* ─── NAV MOBILE MENU ─── */
  .nav-mobile {
    position: fixed; top: 74px; right: 0; left: 0;
    background: rgba(11,60,93,0.97); backdrop-filter: blur(20px);
    padding: 20px; z-index: 999;
    display: none; flex-direction: column; gap: 4px;
    border-bottom: 1px solid rgba(193,227,237,0.15);
  }
  .nav-mobile.open { display: flex; }
  .nav-mobile a {
    color: rgba(255,255,255,0.88); text-decoration: none; padding: 12px 16px;
    font-size: 15px; font-weight: 600; border-radius: 10px; transition: var(--transition);
  }
  .nav-mobile a:hover { background: rgba(255,255,255,0.1); color: var(--cyan-sky); }
</style>
</head>
<body>

<!-- ═══ NAVBAR ═══ -->
<nav id="navbar">
  <a href="#" class="nav-logo">
    <div class="nav-logo-icon">
      <i class="fa-solid fa-mountain-sun" style="position:relative;z-index:1;font-size:18px;"></i>
      <div class="logo-sun" style="width:12px;height:12px;top:8px;right:8px;"></div>
    </div>
    <div class="nav-logo-text">
      <div class="brand-name">المخيم الصيفي تازة</div>
      <div class="brand-sub">Summer Camp Taza</div>
    </div>
  </a>
  <ul class="nav-links">
    <li><a href="#about">عن المخيم</a></li>
    <li><a href="#services">خدماتنا</a></li>
    <li><a href="#gallery">معرض الصور</a></li>
    <li><a href="#testimonials">آراء الزوار</a></li>
    <li><a href="#contact">تواصل معنا</a></li>
    <li><a href="#reservation" class="nav-cta">احجز الآن <i class="fa-solid fa-arrow-left"></i></a></li>
  </ul>
  <div class="hamburger" onclick="toggleMenu()">
    <span></span><span></span><span></span>
  </div>
</nav>

<div class="nav-mobile" id="mobileMenu">
  <a href="#about" onclick="toggleMenu()">عن المخيم</a>
  <a href="#services" onclick="toggleMenu()">خدماتنا</a>
  <a href="#gallery" onclick="toggleMenu()">معرض الصور</a>
  <a href="#testimonials" onclick="toggleMenu()">آراء الزوار</a>
  <a href="#contact" onclick="toggleMenu()">تواصل معنا</a>
  <a href="#reservation" onclick="toggleMenu()" style="color:var(--yellow-sun);font-weight:800;">احجز الآن →</a>
</div>

<!-- ═══ HERO ═══ -->
<section id="hero">
  <div class="hero-bg"></div>
  <div class="hero-particles" id="particles"></div>
  <div class="hero-content">
    <div class="hero-text">
      <div class="hero-badge">
        <i class="fa-solid fa-star"></i>
        وجهة سياحية متميزة في الجزائر
        <i class="fa-solid fa-star"></i>
      </div>
      <h1 class="hero-title">
        استمتع بتجربة سياحية<br><span class="accent">لا تُنسى</span><br>وسط الطبيعة
      </h1>
      <p class="hero-subtitle">
        اكتشف عالماً من الجمال الطبيعي في مخيم تازة الصيفي، حيث تلتقي الجبال الشاهقة بأمواج البحر الهادئة، وتجتمع أسرتك في أجواء من الراحة والمغامرة والترفيه لا مثيل لها.
      </p>
      <div class="hero-btns">
        <a href="#reservation" class="btn-primary">
          <i class="fa-solid fa-calendar-check"></i> احجز الآن
        </a>
        <a href="#services" class="btn-secondary">
          <i class="fa-solid fa-compass"></i> اكتشف المزيد
        </a>
      </div>
      <div class="hero-stats">
        <div class="stat">
          <div class="stat-num">+5K</div>
          <div class="stat-label">زائر سعيد</div>
        </div>
        <div class="stat" style="border-right:1px solid rgba(255,255,255,0.2);border-left:1px solid rgba(255,255,255,0.2);padding:0 28px;">
          <div class="stat-num">15+</div>
          <div class="stat-label">نشاط ترفيهي</div>
        </div>
        <div class="stat">
          <div class="stat-num">4.9</div>
          <div class="stat-label">تقييم الزوار</div>
        </div>
      </div>
    </div>
    <div class="hero-visual">
      <div class="hero-logo-card">
        <div class="hero-video-card" id="heroVideoWrap">
          <video id="heroVid" loop playsinline
                 poster="{{ asset('media/WhatsApp Image 2026-06-02 at 11.08.17.jpeg') }}">
            <source src="{{ asset('media/WhatsApp Video 2026-05-31 at 17.35.40.mp4') }}" type="video/mp4">
          </video>

          <!-- Click zone (centre) to toggle play/pause -->
          <div class="vid-click-zone" onclick="toggleHeroVid()"></div>

          <!-- Big pause icon overlay -->
          <div class="vid-big-play show" id="vidBigPlay">
            <i class="fa-solid fa-circle-play"></i>
          </div>

          <!-- Control bar -->
          <div class="vid-controls">
            <!-- Play / Pause -->
            <div class="vid-btn" onclick="toggleHeroVid()" title="تشغيل / إيقاف">
              <i class="fa-solid fa-play" id="vidPlayIcon"></i>
            </div>

            <!-- Progress bar -->
            <div class="vid-progress" id="vidProgress" onclick="vidSeek(event)">
              <div class="vid-progress-fill" id="vidFill"></div>
            </div>

            <!-- Time -->
            <div class="vid-time" id="vidTime">0:00</div>

            <!-- Mute / Unmute -->
            <div class="vid-btn" onclick="toggleMute()" title="كتم / تشغيل الصوت">
              <i class="fa-solid fa-volume-xmark" id="vidMuteIcon"></i>
            </div>

            <!-- Fullscreen -->
            <div class="vid-btn" onclick="goFullscreen()" title="ملء الشاشة">
              <i class="fa-solid fa-expand"></i>
            </div>
          </div>
        </div>
        <div class="logo-name-big" style="margin-top:14px;font-size:18px;">المخيم الصيفي تازة</div>
        <div class="logo-name-sub">Summer Camp Taza · الجزائر</div>
      </div>
    </div>

  </div>
  <div class="hero-scroll">
    <span>اكتشف</span>
    <div class="scroll-icon">
      <div class="scroll-dot"></div>
    </div>
  </div>
</section>

<!-- ═══ ABOUT ═══ -->
<section id="about">
  <div class="about-grid">
    <div class="about-img-wrap reveal">
      <div class="about-img-frame">
        <img src="{{ asset('media/WhatsApp Image 2026-06-02 at 11.21.01.jpeg') }}" alt="مخيم تازة الصيفي">
      </div>
      <div class="about-float-card">
        <div class="about-float-icon"><i class="fa-solid fa-award"></i></div>
        <div>
          <div class="about-float-num">10+</div>
          <div class="about-float-text">سنوات من التميز السياحي</div>
        </div>
      </div>
    </div>
    <div class="about-text reveal reveal-delay-2">
      <div class="section-badge"><i class="fa-solid fa-circle-info"></i> من نحن</div>
      <h2>وجهتك المثالية للتخييم والاستجمام <span>في قلب الجزائر</span></h2>
      <p>
        يقع المخيم الصيفي تازة في موقع استراتيجي ساحر، يجمع بين روعة الجبال الخضراء وجمال البحر الأبيض المتوسط. نوفر لكم تجربة سياحية متكاملة تجمع بين الراحة والمغامرة والترفيه العائلي في أجواء طبيعية نقية بعيداً عن ضجيج المدن.
      </p>
      <p>
        نؤمن بأن كل عائلة تستحق إجازة لا تُنسى. لذلك نقدم أفضل الخدمات وأرقى المرافق في بيئة آمنة وودية تناسب جميع الأعمار.
      </p>
      <div class="features-grid">
        <div class="feature-card">
          <div class="feature-icon blue"><i class="fa-solid fa-bed"></i></div>
          <div><div class="feature-label">إقامة مريحة</div><div class="feature-desc">غرف وخيام فاخرة</div></div>
        </div>
        <div class="feature-card">
          <div class="feature-icon green"><i class="fa-solid fa-gamepad"></i></div>
          <div><div class="feature-label">أنشطة ترفيهية</div><div class="feature-desc">متعة لا تنتهي</div></div>
        </div>
        <div class="feature-card">
          <div class="feature-icon yellow"><i class="fa-solid fa-utensils"></i></div>
          <div><div class="feature-label">مطاعم وخدمات</div><div class="feature-desc">أشهى المأكولات</div></div>
        </div>
        <div class="feature-card">
          <div class="feature-icon dark"><i class="fa-solid fa-mountain-sun"></i></div>
          <div><div class="feature-label">مناظر طبيعية</div><div class="feature-desc">جمال لا مثيل له</div></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Wave -->
<div class="wave-divider" style="background:var(--light-bg);">
  <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg">
    <path d="M0,30 Q180,0 360,30 Q540,60 720,30 Q900,0 1080,30 Q1260,60 1440,30 L1440,60 L0,60 Z" fill="white"/>
  </svg>
</div>

<!-- ═══ SERVICES ═══ -->
<section id="services">
  <div class="section-header">
    <div class="section-badge reveal"><i class="fa-solid fa-sparkles"></i> خدماتنا المتميزة</div>
    <h2 class="section-title reveal reveal-delay-1">كل ما تحتاجه لإجازة مثالية</h2>
    <p class="section-subtitle reveal reveal-delay-2">نقدم باقة متكاملة من الخدمات السياحية الراقية لضمان تجربة لا تُنسى لكل فرد من العائلة</p>
  </div>
  <div class="services-grid">
    <div class="service-card reveal">
      <div class="service-icon-wrap"><i class="fa-solid fa-house"></i></div>
      <div class="service-title">الإقامة الفاخرة</div>
      <div class="service-desc">غرف وشاليهات مجهزة بأحدث وسائل الراحة مع إطلالة خلابة على الطبيعة والجبال.</div>
      <div class="service-arrow">اكتشف المزيد <i class="fa-solid fa-arrow-left"></i></div>
    </div>
    <div class="service-card reveal reveal-delay-1">
      <div class="service-icon-wrap" style="background:linear-gradient(135deg,var(--green-palm),var(--green-nature));"><i class="fa-solid fa-campground"></i></div>
      <div class="service-title">التخييم الطبيعي</div>
      <div class="service-desc">خيام مريحة في أحضان الطبيعة مع نيران المخيم وسماء النجوم الرائعة في الليل.</div>
      <div class="service-arrow">اكتشف المزيد <i class="fa-solid fa-arrow-left"></i></div>
    </div>
    <div class="service-card reveal reveal-delay-2">
      <div class="service-icon-wrap" style="background:linear-gradient(135deg,#5a8a6a,var(--green-nature));"><i class="fa-solid fa-person-hiking"></i></div>
      <div class="service-title">الرحلات الجبلية</div>
      <div class="service-desc">جولات مرشدة عبر مسارات جبلية خلابة تكشف عن مناظر طبيعية بديعة وتجارب فريدة.</div>
      <div class="service-arrow">اكتشف المزيد <i class="fa-solid fa-arrow-left"></i></div>
    </div>
    <div class="service-card reveal reveal-delay-3">
      <div class="service-icon-wrap" style="background:linear-gradient(135deg,var(--cyan-sky),#20a8d8);"><i class="fa-solid fa-water-ladder"></i></div>
      <div class="service-title">الأنشطة البحرية</div>
      <div class="service-desc">غوص، تجديف، وألعاب مائية متنوعة على شاطئ رملي نقي بمياه نظيفة وآمنة.</div>
      <div class="service-arrow">اكتشف المزيد <i class="fa-solid fa-arrow-left"></i></div>
    </div>
    <div class="service-card reveal reveal-delay-4">
      <div class="service-icon-wrap" style="background:linear-gradient(135deg,var(--orange-warm),#e07010);"><i class="fa-solid fa-bowl-food"></i></div>
      <div class="service-title">المطاعم والمقاهي</div>
      <div class="service-desc">مأكولات جزائرية أصيلة ومأكولات بحرية طازجة في فضاءات تطل على البحر والطبيعة.</div>
      <div class="service-arrow">اكتشف المزيد <i class="fa-solid fa-arrow-left"></i></div>
    </div>
    <div class="service-card reveal reveal-delay-5">
      <div class="service-icon-wrap" style="background:linear-gradient(135deg,#2a9fd6,var(--cyan-sky));"><i class="fa-solid fa-swimming-pool"></i></div>
      <div class="service-title">المسابح الفاخرة</div>
      <div class="service-desc">مسابح خارجية وداخلية للكبار والصغار مع منطقة استجمام وعروض ترفيهية مائية.</div>
      <div class="service-arrow">اكتشف المزيد <i class="fa-solid fa-arrow-left"></i></div>
    </div>
  </div>
</section>

<!-- Wave -->
<div class="wave-divider" style="background:white;">
  <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg">
    <path d="M0,20 Q360,60 720,20 Q1080,0 1440,40 L1440,60 L0,60 Z" fill="var(--light-bg)"/>
  </svg>
</div>

<!-- ═══ GALLERY ═══ -->
<section id="gallery">
  <div class="section-header">
    <div class="section-badge reveal"><i class="fa-solid fa-images"></i> معرض الصور</div>
    <h2 class="section-title reveal reveal-delay-1">جمال لا تصفه الكلمات</h2>
    <p class="section-subtitle reveal reveal-delay-2">نماذج من اللحظات الجميلة التي عاشها زوارنا في رحاب مخيم تازة الصيفي</p>
  </div>
  <div class="gallery-grid reveal">
    <!-- Image 1 — spans 2 cols & 2 rows -->
    <div class="gallery-item" onclick="openLightbox(this)" data-type="image" data-src="{{ asset('media/WhatsApp Image 2026-06-02 at 11.08.17.jpeg') }}">
      <img class="gallery-bg" src="{{ asset('media/WhatsApp Image 2026-06-02 at 11.08.17.jpeg') }}" alt="المخيم الصيفي تازة" style="height:100%;">
      <div class="gallery-overlay"><div class="gallery-overlay-text">المخيم الصيفي تازة</div></div>
      <div class="gallery-zoom"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
    </div>
    <!-- Image 2 -->
    <div class="gallery-item" onclick="openLightbox(this)" data-type="image" data-src="{{ asset('media/WhatsApp Image 2026-06-02 at 11.21.01.jpeg') }}">
      <img class="gallery-bg" src="{{ asset('media/WhatsApp Image 2026-06-02 at 11.21.01.jpeg') }}" alt="مناظر طبيعية" style="height:100%;">
      <div class="gallery-overlay"><div class="gallery-overlay-text">مناظر طبيعية خلابة</div></div>
      <div class="gallery-zoom"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
    </div>
    <!-- Image 3 -->
    <div class="gallery-item" onclick="openLightbox(this)" data-type="image" data-src="{{ asset('media/WhatsApp Image 2026-06-02 at 11.21.35.jpeg') }}">
      <img class="gallery-bg" src="{{ asset('media/WhatsApp Image 2026-06-02 at 11.21.35.jpeg') }}" alt="الأنشطة" style="height:100%;">
      <div class="gallery-overlay"><div class="gallery-overlay-text">لحظات لا تُنسى</div></div>
      <div class="gallery-zoom"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
    </div>
    <!-- Image 4 — spans 2 cols -->
    <div class="gallery-item" onclick="openLightbox(this)" data-type="image" data-src="{{ asset('media/WhatsApp Image 2026-06-02 at 11.28.38.jpeg') }}">
      <img class="gallery-bg" src="{{ asset('media/WhatsApp Image 2026-06-02 at 11.28.38.jpeg') }}" alt="الطبيعة" style="height:100%;">
      <div class="gallery-overlay"><div class="gallery-overlay-text">عالم من الجمال الطبيعي</div></div>
      <div class="gallery-zoom"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
    </div>
    <!-- Image 5 -->
    <div class="gallery-item" onclick="openLightbox(this)" data-type="image" data-src="{{ asset('media/WhatsApp Image 2026-06-02 at 11.30.10.jpeg') }}">
      <img class="gallery-bg" src="{{ asset('media/WhatsApp Image 2026-06-02 at 11.30.10.jpeg') }}" alt="الترفيه" style="height:100%;">
      <div class="gallery-overlay"><div class="gallery-overlay-text">الترفيه والمتعة</div></div>
      <div class="gallery-zoom"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
    </div>
  </div>
  <div style="text-align:center;margin-top:40px;">
    <a href="#" class="btn-primary" style="display:inline-flex;background:linear-gradient(135deg,var(--blue-ocean),var(--cyan-sky));box-shadow:0 8px 30px rgba(17,153,204,0.35);">
      <i class="fa-solid fa-images"></i> عرض كل الصور
    </a>
  </div>
</section>

<!-- Lightbox -->
<div class="lightbox" id="lightbox" onclick="closeLightbox()">
  <div class="lightbox-content" onclick="event.stopPropagation()">
    <div class="lightbox-close" onclick="closeLightbox()"><i class="fa-solid fa-xmark"></i></div>
    <img id="lightboxImg" class="lightbox-img" src="" alt="" style="display:none;">
    <video id="lightboxVideo" class="lightbox-video" controls style="display:none;">
      <source id="lightboxVideoSrc" src="" type="video/mp4">
    </video>
  </div>
</div>

<!-- Wave -->
<div class="wave-divider" style="background:var(--light-bg);">
  <svg viewBox="0 0 1440 80" xmlns="http://www.w3.org/2000/svg">
    <path d="M0,40 Q180,80 360,40 Q540,0 720,40 Q900,80 1080,40 Q1260,0 1440,40 L1440,80 L0,80 Z" fill="#0B4F7A"/>
  </svg>
</div>

<!-- ═══ RESERVATION ═══ -->
<section id="reservation">
  <div class="section-header">
    <div class="section-badge"><i class="fa-solid fa-calendar-days"></i> احجز إقامتك</div>
    <h2 class="section-title">ابدأ رحلتك معنا اليوم</h2>
    <p class="section-subtitle">احجز إقامتك الآن واستمتع بخصومات حصرية وتجربة لا تُنسى في أحضان الطبيعة الجزائرية</p>
  </div>
  @if($errors->any())
  <div style="max-width:860px;margin:0 auto 20px;background:rgba(239,68,68,0.15);border:1px solid rgba(239,68,68,0.4);border-radius:14px;padding:16px 22px;color:#fca5a5;font-size:14px;backdrop-filter:blur(10px);position:relative;z-index:1;">
    <i class="fa-solid fa-circle-exclamation" style="margin-left:8px;"></i>{{ $errors->first() }}
  </div>
  @endif
  <div class="reservation-form reveal">
    <form method="POST" action="{{ route('reservation.store') }}">
      @csrf
      <div class="form-grid">
        <div class="form-group">
          <label class="form-label" for="full_name"><i class="fa-solid fa-user"></i> الاسم الكامل</label>
          <input type="text" id="full_name" name="full_name" class="form-input" placeholder="أدخل اسمك الكامل" value="{{ old('full_name') }}" required>
          @error('full_name')<span style="color:#fca5a5;font-size:12px;margin-top:4px;">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
          <label class="form-label" for="phone_number"><i class="fa-solid fa-phone"></i> رقم الهاتف</label>
          <input type="text" id="phone_number" name="phone_number" class="form-input" placeholder="0555 000 000" value="{{ old('phone_number') }}" required>
          @error('phone_number')<span style="color:#fca5a5;font-size:12px;margin-top:4px;">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
          <label class="form-label" for="reservation_type"><i class="fa-solid fa-tag"></i> نوع الحجز</label>
          <select id="reservation_type" name="reservation_type" class="form-input" required>
            <option value="">-- اختر النوع --</option>
            <option value="single"       @selected(old('reservation_type') === 'single')>فردي</option>
            <option value="group"        @selected(old('reservation_type') === 'group')>جماعي</option>
            <option value="family"       @selected(old('reservation_type') === 'family')>عائلي</option>
            <option value="organisation" @selected(old('reservation_type') === 'organisation')>منظمة</option>
          </select>
          @error('reservation_type')<span style="color:#fca5a5;font-size:12px;margin-top:4px;">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
          <label class="form-label" for="num_beds"><i class="fa-solid fa-bed"></i> عدد الأسرّة المطلوبة</label>
          <input type="number" id="num_beds" name="num_beds" class="form-input" value="{{ old('num_beds', 1) }}" min="1" required>
          @error('num_beds')<span style="color:#fca5a5;font-size:12px;margin-top:4px;">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
          <label class="form-label" for="date"><i class="fa-solid fa-calendar-plus"></i> تاريخ الوصول</label>
          <input type="date" id="date" name="date" class="form-input" value="{{ old('date') }}" min="{{ date('Y-m-d') }}" required>
          @error('date')<span style="color:#fca5a5;font-size:12px;margin-top:4px;">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
          <label class="form-label" for="num_days"><i class="fa-solid fa-moon"></i> عدد الليالي</label>
          <input type="number" id="num_days" name="num_days" class="form-input" value="{{ old('num_days', 1) }}" min="1" max="30" required>
          @error('num_days')<span style="color:#fca5a5;font-size:12px;margin-top:4px;">{{ $message }}</span>@enderror
        </div>
        <div class="form-group full">
          <label class="form-label" for="notes"><i class="fa-solid fa-message"></i> ملاحظات (اختياري)</label>
          <input type="text" id="notes" name="notes" class="form-input" value="{{ old('notes') }}" placeholder="أي طلبات خاصة أو ملاحظات تودّ إخبارنا بها...">
          @error('notes')<span style="color:#fca5a5;font-size:12px;margin-top:4px;">{{ $message }}</span>@enderror
        </div>
      </div>
      <button type="submit" class="form-submit">
        <i class="fa-solid fa-circle-check"></i>
        تأكيد الحجز الآن
        <i class="fa-solid fa-arrow-left"></i>
      </button>
    </form>
  </div>
</section>

<!-- Wave -->
<div class="wave-divider" style="background:linear-gradient(to bottom, #1199CC, #39C4E0);">
  <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg">
    <path d="M0,40 Q360,0 720,40 Q1080,80 1440,20 L1440,60 L0,60 Z" fill="white"/>
  </svg>
</div>

<!-- ═══ TESTIMONIALS ═══ -->
<section id="testimonials">
  <div class="section-header">
    <div class="section-badge reveal"><i class="fa-solid fa-quote-right"></i> آراء زوارنا</div>
    <h2 class="section-title reveal reveal-delay-1">ماذا يقول ضيوفنا عنا؟</h2>
    <p class="section-subtitle reveal reveal-delay-2">آلاف الأسر زارتنا وعادت بذكريات لا تُنسى، هذا ما يقولونه عن تجربتهم</p>
  </div>
  <div class="testimonials-slider">
    <div class="slider-fade-left"></div>
    <div class="slider-fade-right"></div>
    <div class="testimonials-track">
      <!-- Cards x2 for infinite loop -->
      <div class="testimonial-card">
        <div class="test-stars">★★★★★</div>
        <p class="test-text">تجربة رائعة ولا تُنسى! المكان ساحر والموظفون يعاملونك كأهل. الأطفال استمتعوا بكل الأنشطة وسنعود حتماً السنة القادمة.</p>
        <div class="test-author">
          <div class="test-avatar" style="background:linear-gradient(135deg,var(--blue-ocean),var(--cyan-sky));">أ</div>
          <div><div class="test-name">أحمد بن علي</div><div class="test-location"><i class="fa-solid fa-location-dot" style="margin-left:4px;color:var(--cyan-sky);"></i> الجزائر العاصمة</div></div>
        </div>
      </div>
      <div class="testimonial-card">
        <div class="test-stars">★★★★★</div>
        <p class="test-text">قضينا أسبوعاً رائعاً في مخيم تازة. المناظر الطبيعية تأخذ الأنفاس والمطاعم قدّمت أشهى المأكولات. خدمة من الدرجة الأولى.</p>
        <div class="test-author">
          <div class="test-avatar" style="background:linear-gradient(135deg,var(--green-palm),var(--green-nature));">ف</div>
          <div><div class="test-name">فاطمة الزهراء</div><div class="test-location"><i class="fa-solid fa-location-dot" style="margin-left:4px;color:var(--cyan-sky);"></i> وهران</div></div>
        </div>
      </div>
      <div class="testimonial-card">
        <div class="test-stars">★★★★★</div>
        <p class="test-text">من أجمل الأماكن التي زرتها في الجزائر! الجبال والبحر في مكان واحد، هذا شيء نادر. سأنصح كل عائلة بزيارة هذا المخيم.</p>
        <div class="test-author">
          <div class="test-avatar" style="background:linear-gradient(135deg,var(--yellow-sun),var(--orange-warm));">م</div>
          <div><div class="test-name">محمد شريف</div><div class="test-location"><i class="fa-solid fa-location-dot" style="margin-left:4px;color:var(--cyan-sky);"></i> قسنطينة</div></div>
        </div>
      </div>
      <div class="testimonial-card">
        <div class="test-stars">★★★★★</div>
        <p class="test-text">المسابح رائعة والأنشطة البحرية ممتازة. أطفالنا لم يريدوا المغادرة! سنعود بالتأكيد وننصح كل من يبحث عن راحة حقيقية.</p>
        <div class="test-author">
          <div class="test-avatar" style="background:linear-gradient(135deg,#9b59b6,#6c3483);">ن</div>
          <div><div class="test-name">نور الدين حمزة</div><div class="test-location"><i class="fa-solid fa-location-dot" style="margin-left:4px;color:var(--cyan-sky);"></i> عنابة</div></div>
        </div>
      </div>
      <div class="testimonial-card">
        <div class="test-stars">★★★★★</div>
        <p class="test-text">احتفلنا بعيد ميلاد ابنتنا في مخيم تازة وكانت مفاجأة رائعة. الطاقم نظّم كل شيء باحترافية عالية. شكراً جزيلاً!</p>
        <div class="test-author">
          <div class="test-avatar" style="background:linear-gradient(135deg,#e74c3c,#c0392b);">س</div>
          <div><div class="test-name">سلمى بوعلام</div><div class="test-location"><i class="fa-solid fa-location-dot" style="margin-left:4px;color:var(--cyan-sky);"></i> تيزي وزو</div></div>
        </div>
      </div>
      <!-- Duplicate for seamless loop -->
      <div class="testimonial-card">
        <div class="test-stars">★★★★★</div>
        <p class="test-text">تجربة رائعة ولا تُنسى! المكان ساحر والموظفون يعاملونك كأهل. الأطفال استمتعوا بكل الأنشطة وسنعود حتماً السنة القادمة.</p>
        <div class="test-author">
          <div class="test-avatar" style="background:linear-gradient(135deg,var(--blue-ocean),var(--cyan-sky));">أ</div>
          <div><div class="test-name">أحمد بن علي</div><div class="test-location"><i class="fa-solid fa-location-dot" style="margin-left:4px;color:var(--cyan-sky);"></i> الجزائر العاصمة</div></div>
        </div>
      </div>
      <div class="testimonial-card">
        <div class="test-stars">★★★★★</div>
        <p class="test-text">قضينا أسبوعاً رائعاً في مخيم تازة. المناظر الطبيعية تأخذ الأنفاس والمطاعم قدّمت أشهى المأكولات. خدمة من الدرجة الأولى.</p>
        <div class="test-author">
          <div class="test-avatar" style="background:linear-gradient(135deg,var(--green-palm),var(--green-nature));">ف</div>
          <div><div class="test-name">فاطمة الزهراء</div><div class="test-location"><i class="fa-solid fa-location-dot" style="margin-left:4px;color:var(--cyan-sky);"></i> وهران</div></div>
        </div>
      </div>
      <div class="testimonial-card">
        <div class="test-stars">★★★★★</div>
        <p class="test-text">من أجمل الأماكن التي زرتها في الجزائر! الجبال والبحر في مكان واحد، هذا شيء نادر. سأنصح كل عائلة بزيارة هذا المخيم.</p>
        <div class="test-author">
          <div class="test-avatar" style="background:linear-gradient(135deg,var(--yellow-sun),var(--orange-warm));">م</div>
          <div><div class="test-name">محمد شريف</div><div class="test-location"><i class="fa-solid fa-location-dot" style="margin-left:4px;color:var(--cyan-sky);"></i> قسنطينة</div></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══ CONTACT ═══ -->
<section id="contact" style="background:var(--light-bg);">
  <div class="section-header">
    <div class="section-badge reveal"><i class="fa-solid fa-headset"></i> تواصل معنا</div>
    <h2 class="section-title reveal reveal-delay-1">نحن هنا لخدمتك</h2>
    <p class="section-subtitle reveal reveal-delay-2">تواصل معنا في أي وقت وسيكون فريقنا سعيداً بمساعدتك وتقديم كل المعلومات التي تحتاجها</p>
  </div>
  <div class="contact-grid">
    <div class="contact-info-block">
      <div class="contact-card reveal">
        <div class="contact-icon blue"><i class="fa-solid fa-phone"></i></div>
        <div>
          <div class="contact-label">اتصل بنا</div>
          <div class="contact-value">0551920005</div>
          <div class="contact-value" style="font-size:13px;color:var(--text-soft);">0551920005</div>
        </div>
      </div>
      <div class="contact-card reveal reveal-delay-1">
        <div class="contact-icon green"><i class="fa-solid fa-envelope"></i></div>
        <div>
          <div class="contact-label">البريد الإلكتروني</div>
          <div class="contact-value">hallissoufiane@gmail.com</div>
          <div class="contact-value" style="font-size:13px;color:var(--text-soft);">hallissoufiane@gmail.com</div>
        </div>
      </div>
      <div class="contact-card reveal reveal-delay-2">
        <div class="contact-icon yellow"><i class="fa-solid fa-location-dot"></i></div>
        <div>
          <div class="contact-label">العنوان</div>
          <div class="contact-value">ولاية جيجل، منطقة تازة</div>
          <div class="contact-value" style="font-size:13px;color:var(--text-soft);">الجزائر الشرقية، 18000</div>
        </div>
      </div>
      <div class="contact-card reveal reveal-delay-3">
        <div class="contact-icon dark"><i class="fa-solid fa-clock"></i></div>
        <div>
          <div class="contact-label">ساعات العمل</div>
          <div class="contact-value">24/7 — طوال اليوم</div>
          <div class="contact-value" style="font-size:13px;color:var(--text-soft);">الموسم: أبريل — أكتوبر</div>
        </div>
      </div>
      <div class="reveal reveal-delay-4">
        <div style="font-size:14px;font-weight:700;color:var(--blue-deep);margin-bottom:14px;">تابعونا على وسائل التواصل</div>
        <div class="social-links">
          <a href="https://www.facebook.com/profile.php?id=61575660224278" class="social-btn fb"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#" class="social-btn ig"><i class="fa-brands fa-instagram"></i></a>
          <a href="#" class="social-btn tw"><i class="fa-brands fa-twitter"></i></a>
          <a href="#" class="social-btn yt"><i class="fa-brands fa-youtube"></i></a>
          <a href="#" class="social-btn wa"><i class="fa-brands fa-whatsapp"></i></a>
        </div>
      </div>
    </div>
    <div class="map-container reveal reveal-delay-2" style="position:relative;">
      <iframe
        src="https://www.openstreetmap.org/export/embed.html?bbox=5.522621%2C36.695791%2C5.562621%2C36.715791&layer=mapnik&marker=36.705791%2C5.542621"
        style="width:100%;height:100%;border:none;display:block;"
        title="موقع المخيم الصيفي تازة"
        loading="lazy"
        allowfullscreen>
      </iframe>
      <!-- Overlay button -->
      <div style="position:absolute;bottom:16px;left:50%;transform:translateX(-50%);z-index:10;">
        <a href="https://www.google.com/maps?q=36.705791,5.542621"
           target="_blank" rel="noopener noreferrer"
           style="background:var(--blue-ocean);color:white;padding:10px 22px;border-radius:10px;font-size:13px;font-weight:700;text-decoration:none;display:flex;align-items:center;gap:8px;box-shadow:0 4px 20px rgba(17,153,204,0.4);white-space:nowrap;backdrop-filter:blur(4px);">
          <i class="fa-solid fa-map-location-dot"></i> فتح في خرائط جوجل
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ═══ FOOTER ═══ -->
<footer>
  <div class="footer-grid">
    <div class="footer-brand">
      <div class="footer-logo">
        <div class="footer-logo-icon">
          <i class="fa-solid fa-mountain-sun" style="position:relative;z-index:1;font-size:20px;"></i>
        </div>
        <div>
          <div class="footer-brand-name">المخيم الصيفي تازة</div>
          <div class="footer-brand-sub">Summer Camp Taza · Algeria</div>
        </div>
      </div>
      <p class="footer-desc">وجهة سياحية متميزة تجمع بين جمال الطبيعة الجزائرية من جبال وبحار وغابات، لنمنحكم تجربة لا تُنسى مع عائلتكم الكريمة.</p>
      <div class="footer-social">
        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="#"><i class="fa-brands fa-instagram"></i></a>
        <a href="#"><i class="fa-brands fa-youtube"></i></a>
        <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
        <a href="#"><i class="fa-brands fa-tiktok"></i></a>
      </div>
    </div>
    <div>
      <div class="footer-col-title">روابط سريعة</div>
      <ul class="footer-links">
        <li><a href="#about"><i class="fa-solid fa-chevron-left"></i> عن المخيم</a></li>
        <li><a href="#services"><i class="fa-solid fa-chevron-left"></i> خدماتنا</a></li>
        <li><a href="#gallery"><i class="fa-solid fa-chevron-left"></i> معرض الصور</a></li>
        <li><a href="#reservation"><i class="fa-solid fa-chevron-left"></i> الحجز</a></li>
        <li><a href="#testimonials"><i class="fa-solid fa-chevron-left"></i> آراء الزوار</a></li>
        <li><a href="#contact"><i class="fa-solid fa-chevron-left"></i> تواصل معنا</a></li>
      </ul>
    </div>
    <div>
      <div class="footer-col-title">خدماتنا</div>
      <ul class="footer-links">
        <li><a href="#"><i class="fa-solid fa-chevron-left"></i> الإقامة الفاخرة</a></li>
        <li><a href="#"><i class="fa-solid fa-chevron-left"></i> التخييم الطبيعي</a></li>
        <li><a href="#"><i class="fa-solid fa-chevron-left"></i> الرحلات الجبلية</a></li>
        <li><a href="#"><i class="fa-solid fa-chevron-left"></i> الأنشطة البحرية</a></li>
        <li><a href="#"><i class="fa-solid fa-chevron-left"></i> المطاعم</a></li>
        <li><a href="#"><i class="fa-solid fa-chevron-left"></i> المسابح</a></li>
      </ul>
    </div>
    <div>
      <div class="footer-col-title">معلومات الاتصال</div>
      <ul class="footer-links" style="gap:16px;">
        <li style="display:flex;align-items:flex-start;gap:10px;color:rgba(255,255,255,0.6);font-size:13px;">
          <i class="fa-solid fa-location-dot" style="color:var(--cyan-sky);margin-top:3px;"></i>
          <span>ولاية جيجل، منطقة تازة، الجزائر الشرقية</span>
        </li>
        <li style="display:flex;align-items:center;gap:10px;color:rgba(255,255,255,0.6);font-size:13px;">
          <i class="fa-solid fa-phone" style="color:var(--cyan-sky);"></i>
          <span>213+ 555 000 123</span>
        </li>
        <li style="display:flex;align-items:center;gap:10px;color:rgba(255,255,255,0.6);font-size:13px;">
          <i class="fa-solid fa-envelope" style="color:var(--cyan-sky);"></i>
          <span>info@tazacamp.dz</span>
        </li>
      </ul>
      <div style="margin-top:24px;background:rgba(255,255,255,0.06);border-radius:14px;padding:18px;">
        <div style="font-size:13px;font-weight:700;color:rgba(255,255,255,0.8);margin-bottom:10px;">اشترك في نشرتنا</div>
        <div style="display:flex;gap:8px;">
          <input type="email" placeholder="بريدك الإلكتروني" style="flex:1;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.15);border-radius:9px;padding:9px 12px;color:white;font-size:12px;font-family:'Cairo',sans-serif;outline:none;direction:rtl;">
          <button style="background:linear-gradient(135deg,var(--yellow-sun),var(--orange-warm));color:white;border:none;border-radius:9px;padding:9px 14px;cursor:pointer;font-size:13px;">
            <i class="fa-solid fa-paper-plane"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="footer-copy">
      © 2025 المخيم الصيفي تازة · جميع الحقوق محفوظة
    </div>
    <div class="footer-bottom-links">
      <a href="#">سياسة الخصوصية</a>
      <a href="#">شروط الاستخدام</a>
      <a href="#">ملفات تعريف الارتباط</a>
    </div>
  </div>
</footer>

<script>
  // ─── Navbar scroll ───
  window.addEventListener('scroll', () => {
    document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 50);
  });

  // ─── Mobile menu ───
  function toggleMenu() {
    document.getElementById('mobileMenu').classList.toggle('open');
  }

  // ─── Hero card video controller ───
  const heroVid      = document.getElementById('heroVid');
  const vidPlayIcon  = document.getElementById('vidPlayIcon');
  const vidFill      = document.getElementById('vidFill');
  const vidTime      = document.getElementById('vidTime');
  const vidMuteIcon  = document.getElementById('vidMuteIcon');
  const vidBigPlay   = document.getElementById('vidBigPlay');
  const vidProgress  = document.getElementById('vidProgress');

  // Start muted & playing (browser policy)
  heroVid.muted = true;
  heroVid.play().then(() => {
    vidPlayIcon.className = 'fa-solid fa-pause';
    vidBigPlay.classList.remove('show');
  }).catch(() => {});

  function toggleHeroVid() {
    if (heroVid.paused) {
      heroVid.play();
      vidPlayIcon.className = 'fa-solid fa-pause';
      vidBigPlay.classList.remove('show');
    } else {
      heroVid.pause();
      vidPlayIcon.className = 'fa-solid fa-play';
      vidBigPlay.classList.add('show');
    }
  }

  function toggleMute() {
    heroVid.muted = !heroVid.muted;
    vidMuteIcon.className = heroVid.muted
      ? 'fa-solid fa-volume-xmark'
      : 'fa-solid fa-volume-high';
  }

  function goFullscreen() {
    const wrap = document.getElementById('heroVideoWrap');
    if (wrap.requestFullscreen)            wrap.requestFullscreen();
    else if (wrap.webkitRequestFullscreen) wrap.webkitRequestFullscreen();
  }

  function vidSeek(e) {
    const rect = vidProgress.getBoundingClientRect();
    const pct  = (e.clientX - rect.left) / rect.width;
    heroVid.currentTime = pct * heroVid.duration;
  }

  function fmtTime(s) {
    const m = Math.floor(s / 60);
    const ss = String(Math.floor(s % 60)).padStart(2, '0');
    return `${m}:${ss}`;
  }

  heroVid.addEventListener('timeupdate', () => {
    if (!heroVid.duration) return;
    const pct = (heroVid.currentTime / heroVid.duration) * 100;
    vidFill.style.width = pct + '%';
    vidTime.textContent = fmtTime(heroVid.currentTime);
  });

  heroVid.addEventListener('ended', () => {
    vidPlayIcon.className = 'fa-solid fa-play';
    vidBigPlay.classList.add('show');
  });


  // ─── Hero particles ───
  const pContainer = document.getElementById('particles');
  for (let i = 0; i < 18; i++) {
    const p = document.createElement('div');
    p.className = 'particle';
    const size = Math.random() * 40 + 10;
    p.style.cssText = `
      width:${size}px; height:${size}px;
      left:${Math.random()*100}%;
      animation-duration:${Math.random()*15+10}s;
      animation-delay:${Math.random()*10}s;
      opacity:${Math.random()*0.3+0.05};
    `;
    pContainer.appendChild(p);
  }

  // ─── Scroll reveal ───
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); } });
  }, { threshold: 0.12 });
  document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

  // ─── Lightbox ───
  function openLightbox(item) {
    const type = item.dataset.type || 'image';
    const src  = item.dataset.src  || '';
    const lb   = document.getElementById('lightbox');
    const img  = document.getElementById('lightboxImg');
    const vid  = document.getElementById('lightboxVideo');
    const vsrc = document.getElementById('lightboxVideoSrc');

    if (type === 'video') {
      img.style.display = 'none';
      vsrc.src = src;
      vid.load();
      vid.style.display = 'block';
    } else {
      vid.pause();
      vid.style.display = 'none';
      img.src = src;
      img.style.display = 'block';
    }
    lb.classList.add('open');
  }
  function closeLightbox() {
    const vid = document.getElementById('lightboxVideo');
    vid.pause();
    document.getElementById('lightbox').classList.remove('open');
  }
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });
</script>
</body>
</html>
