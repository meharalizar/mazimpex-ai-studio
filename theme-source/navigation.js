const toggle = document.querySelector('.nav-toggle');
const navigation = document.querySelector('#primary-navigation');
if (toggle && navigation) {
  navigation.dataset.collapsed = 'true';
  toggle.addEventListener('click', () => {
    const expanded = toggle.getAttribute('aria-expanded') === 'true';
    toggle.setAttribute('aria-expanded', String(!expanded));
    navigation.dataset.collapsed = String(expanded);
  });
}

document.addEventListener('keydown', event => {
  if (event.key === 'Escape' && toggle?.getAttribute('aria-expanded') === 'true') {
    toggle.click();
    toggle.focus();
  }
});
