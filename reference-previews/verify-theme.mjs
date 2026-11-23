import fs from 'node:fs';
import path from 'node:path';
import vm from 'node:vm';
import { fileURLToPath } from 'node:url';

const rootDir = path.resolve(path.dirname(fileURLToPath(import.meta.url)), '..');
const themeDir = path.join(rootDir, 'theme-source');

const requiredFiles = [
  'functions.php',
  'header.php',
  'footer.php',
  'page.php',
  'index.php',
  '404.php',
  'style.css',
  'navigation.js',
  'particles.js',
  'assets/brand/maz-logo-header.webp',
  'assets/brand/favicon.png',
  'assets/maz-gold-hero.webp',
  'assets/maz-gold-hero-mobile.webp',
];

let errors = 0;
const fail = (msg) => {
  console.error(`FAIL: ${msg}`);
  errors += 1;
};

for (const rel of requiredFiles) {
  if (!fs.existsSync(path.join(themeDir, rel))) {
    fail(`Missing required theme file: theme-source/${rel}`);
  }
}

// 1. Validate vanilla JavaScript syntax via Node VM parser.
for (const jsFile of ['navigation.js', 'particles.js']) {
  const code = fs.readFileSync(path.join(themeDir, jsFile), 'utf8');
  try {
    new vm.Script(code, { filename: jsFile });
  } catch (err) {
    fail(`JavaScript syntax error in ${jsFile}: ${err.message}`);
  }
}

// 2. Validate CSS brace balance and WordPress theme header.
const css = fs.readFileSync(path.join(themeDir, 'style.css'), 'utf8');
if (!css.includes('Theme Name: MAZ IMPEX') || !css.includes('Text Domain: mazimpex')) {
  fail('style.css is missing required WordPress theme header metadata.');
}
const strippedCss = css.replace(/\/\*[\s\S]*?\*\//g, '').replace(/"(?:\\.|[^"\\])*"|'(?:\\.|[^'\\])*'/g, '');
const openBraces = (strippedCss.match(/\{/g) || []).length;
const closeBraces = (strippedCss.match(/\}/g) || []).length;
if (openBraces !== closeBraces) {
  fail(`style.css has mismatched braces: ${openBraces} opening vs ${closeBraces} closing.`);
}

// 3. Verify critical WordPress, WooCommerce, Elementor, and RFQ hooks remain present.
const checks = [
  ['functions.php', ['woocommerce_before_main_content', 'woocommerce_after_main_content', 'maz_category_details', 'mazimpex-navigation', 'mazimpex-particles', 'mazimpex-font-awesome', 'maz_theme_wordmark']],
  ['header.php', ['language_attributes', 'wp_head', 'body_class', 'wp_body_open', 'href="#main"', 'aria-controls="primary-navigation"', 'post_type', '/request-a-quote/', 'maz_whatsapp']],
  ['footer.php', ['maz_theme_wordmark', 'maz_settings', 'maz_whatsapp', 'wp_footer']],
  ['page.php', ['maz_has_marketing_layout', 'maz-elementor-content', 'maz_render_elementor_review', 'the_content']],
];

for (const [file, tokens] of checks) {
  const content = fs.readFileSync(path.join(themeDir, file), 'utf8');
  for (const token of tokens) {
    if (!content.includes(token)) {
      fail(`${file} is missing required contract token: ${token}`);
    }
  }
}

if (errors > 0) {
  process.exit(1);
}

console.log('OK: All MAZ IMPEX WordPress theme static checks passed (PHP runtime validation still required in isolated WordPress).');
