// Simple scroll animation
window.addEventListener('scroll', () => {
  const nav = document.querySelector('nav');
  if (window.scrollY > 50) {
    nav.classList.add('shadow-2xl', 'shadow-purple-900/50');
  } else {
    nav.classList.remove('shadow-2xl', 'shadow-purple-900/50');
  }
});

// Tailwind script (sudah di-load via CDN)
console.log('%c Lumina Website siap digunakan! ✨', 'color: #c026d3; font-size: 16px; font-weight: bold');