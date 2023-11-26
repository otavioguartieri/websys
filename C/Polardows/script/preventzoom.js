document.addEventListener('gesturestart', function (e) {
    e.preventDefault();
}, { passive: false });

document.addEventListener('keydown', function (e) {
    if (e.ctrlKey && (e.key === '+' || e.key === '=' || e.key === '-')) {
    e.preventDefault();
    }
}, { passive: false });

document.addEventListener('mousewheel', function (e) {
    if (e.ctrlKey) {
    e.preventDefault();
    }
}, { passive: false });
