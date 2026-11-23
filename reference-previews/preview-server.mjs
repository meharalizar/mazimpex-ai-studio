import http from 'node:http';
import fs from 'node:fs';
import path from 'node:path';
import crypto from 'node:crypto';
import zlib from 'node:zlib';
import { fileURLToPath } from 'node:url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const rootDir = path.resolve(__dirname, '..');
const previewDir = __dirname;
const port = Number(process.env.PORT) || 3000;

const exportFiles = [
  'theme-source/functions.php',
  'theme-source/header.php',
  'theme-source/footer.php',
  'theme-source/page.php',
  'theme-source/index.php',
  'theme-source/404.php',
  'theme-source/style.css',
  'theme-source/navigation.js',
  'theme-source/particles.js',
  'docs/REDESIGN-CHANGE-SUMMARY.md',
];

const mimeTypes = {
  '.html': 'text/html; charset=utf-8',
  '.css': 'text/css; charset=utf-8',
  '.js': 'application/javascript; charset=utf-8',
  '.php': 'text/plain; charset=utf-8',
  '.md': 'text/markdown; charset=utf-8',
  '.webp': 'image/webp',
  '.png': 'image/png',
  '.jpg': 'image/jpeg',
  '.svg': 'image/svg+xml',
  '.json': 'application/json; charset=utf-8',
};

// Standard CRC32 table for zero-dependency PKZIP generation.
const crcTable = new Uint32Array(256);
for (let i = 0; i < 256; i += 1) {
  let c = i;
  for (let k = 0; k < 8; k += 1) {
    c = (c & 1) ? (0xedb88320 ^ (c >>> 1)) : (c >>> 1);
  }
  crcTable[i] = c >>> 0;
}

function crc32(buffer) {
  let crc = 0xffffffff;
  for (let i = 0; i < buffer.length; i += 1) {
    crc = crcTable[(crc ^ buffer[i]) & 0xff] ^ (crc >>> 8);
  }
  return (crc ^ 0xffffffff) >>> 0;
}

function buildZip(relPaths) {
  const localParts = [];
  const centralParts = [];
  let offset = 0;

  for (const rel of relPaths) {
    const abs = path.join(rootDir, rel);
    const data = fs.readFileSync(abs);
    const compressed = zlib.deflateRawSync(data);
    const nameBuf = Buffer.from(rel, 'utf8');
    const crc = crc32(data);

    const localHeader = Buffer.alloc(30);
    localHeader.writeUInt32LE(0x04034b50, 0);
    localHeader.writeUInt16LE(20, 4);
    localHeader.writeUInt16LE(0, 6);
    localHeader.writeUInt16LE(8, 8);
    localHeader.writeUInt16LE(0, 10);
    localHeader.writeUInt16LE(0, 12);
    localHeader.writeUInt32LE(crc, 14);
    localHeader.writeUInt32LE(compressed.length, 18);
    localHeader.writeUInt32LE(data.length, 22);
    localHeader.writeUInt16LE(nameBuf.length, 26);
    localHeader.writeUInt16LE(0, 28);

    localParts.push(localHeader, nameBuf, compressed);

    const centralHeader = Buffer.alloc(46);
    centralHeader.writeUInt32LE(0x02014b50, 0);
    centralHeader.writeUInt16LE(20, 4);
    centralHeader.writeUInt16LE(20, 6);
    centralHeader.writeUInt16LE(0, 8);
    centralHeader.writeUInt16LE(8, 10);
    centralHeader.writeUInt16LE(0, 12);
    centralHeader.writeUInt16LE(0, 14);
    centralHeader.writeUInt32LE(crc, 16);
    centralHeader.writeUInt32LE(compressed.length, 20);
    centralHeader.writeUInt32LE(data.length, 24);
    centralHeader.writeUInt16LE(nameBuf.length, 28);
    centralHeader.writeUInt16LE(0, 30);
    centralHeader.writeUInt16LE(0, 32);
    centralHeader.writeUInt16LE(0, 34);
    centralHeader.writeUInt16LE(0, 36);
    centralHeader.writeUInt32LE(0, 38);
    centralHeader.writeUInt32LE(offset, 42);

    centralParts.push(centralHeader, nameBuf);
    offset += localHeader.length + nameBuf.length + compressed.length;
  }

  const centralDir = Buffer.concat(centralParts);
  const eocd = Buffer.alloc(22);
  eocd.writeUInt32LE(0x06054b50, 0);
  eocd.writeUInt16LE(0, 4);
  eocd.writeUInt16LE(0, 6);
  eocd.writeUInt16LE(relPaths.length, 8);
  eocd.writeUInt16LE(relPaths.length, 10);
  eocd.writeUInt32LE(centralDir.length, 12);
  eocd.writeUInt32LE(offset, 16);
  eocd.writeUInt16LE(0, 20);

  return Buffer.concat([...localParts, centralDir, eocd]);
}

function renderExportPage() {
  const rows = exportFiles
    .map((rel) => {
      const buf = fs.readFileSync(path.join(rootDir, rel));
      const sha = crypto.createHash('sha256').update(buf).digest('hex');
      return `<tr>
        <td><code>${rel}</code></td>
        <td>${buf.length.toLocaleString('en-GB')} bytes</td>
        <td><code>${sha.slice(0, 16)}&hellip;</code></td>
        <td><a href="/${rel}" download="${path.basename(rel)}">Download</a></td>
      </tr>`;
    })
    .join('\n');

  return `<!doctype html>
<html lang="en-GB">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>MAZ IMPEX WordPress Theme — Finalised Export</title>
<link rel="stylesheet" href="/theme-source/style.css">
</head>
<body class="maz-theme-v3">
<main id="main" class="wrap entry">
<p class="eyebrow">Codex &amp; GitHub Export</p>
<h1>MAZ IMPEX WordPress Theme Redesign Export</h1>
<p class="lead">All 9 modified WordPress theme source files in <code>theme-source/</code> plus <code>docs/REDESIGN-CHANGE-SUMMARY.md</code>, packaged without AI Studio preview scaffolding.</p>
<div class="actions" style="margin-bottom: 2rem;">
<a class="button" href="/export.zip" download="mazimpex-theme-redesign-export.zip">Download complete ZIP (10 files)</a>
<a class="button secondary" href="/">Back to static preview</a>
</div>
<div class="spec-scroll" tabindex="0">
<table>
<thead>
<tr><th>Repository path</th><th>Size</th><th>SHA-256 (prefix)</th><th>File</th></tr>
</thead>
<tbody>
${rows}
</tbody>
</table>
</div>
</main>
</body>
</html>`;
}

const server = http.createServer((req, res) => {
  const urlPath = (req.url || '/').split('?')[0];

  if (urlPath === '/export' || urlPath === '/export/') {
    res.writeHead(200, { 'Content-Type': 'text/html; charset=utf-8', 'Cache-Control': 'no-cache' });
    res.end(renderExportPage());
    return;
  }

  if (urlPath === '/export.zip') {
    const zipBuffer = buildZip(exportFiles);
    res.writeHead(200, {
      'Content-Type': 'application/zip',
      'Content-Disposition': 'attachment; filename="mazimpex-theme-redesign-export.zip"',
      'Content-Length': String(zipBuffer.length),
      'Cache-Control': 'no-cache',
    });
    res.end(zipBuffer);
    return;
  }

  let filePath;
  if (urlPath === '/' || urlPath === '/index.html') {
    filePath = path.join(previewDir, 'index.html');
  } else if (urlPath === '/category-archive.html' || urlPath === '/single-product.html') {
    filePath = path.join(previewDir, path.basename(urlPath));
  } else if (urlPath === '/docs/REDESIGN-CHANGE-SUMMARY.md') {
    filePath = path.join(rootDir, 'docs', 'REDESIGN-CHANGE-SUMMARY.md');
  } else if (urlPath.startsWith('/theme-source/')) {
    const candidate = path.resolve(rootDir, '.' + urlPath);
    if (candidate.startsWith(path.join(rootDir, 'theme-source'))) {
      filePath = candidate;
    }
  }

  if (!filePath || !fs.existsSync(filePath) || fs.statSync(filePath).isDirectory()) {
    res.writeHead(404, { 'Content-Type': 'text/plain; charset=utf-8' });
    res.end('Not found');
    return;
  }

  const ext = path.extname(filePath).toLowerCase();
  res.writeHead(200, {
    'Content-Type': mimeTypes[ext] || 'application/octet-stream',
    'Cache-Control': 'no-cache',
  });
  fs.createReadStream(filePath).pipe(res);
});

server.listen(port, '0.0.0.0', () => {
  console.log(`MAZ IMPEX static WordPress theme review server running at http://0.0.0.0:${port}`);
});
