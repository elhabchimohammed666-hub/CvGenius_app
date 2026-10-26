const http = require('node:http');
const { readFile } = require('node:fs/promises');
const { join } = require('node:path');

const server = http.createServer(async (_request, response) => {
  try {
    const page = await readFile(join(__dirname, 'demo.html'));
    response.writeHead(200, {
      'Cache-Control': 'no-store',
      'Content-Type': 'text/html; charset=utf-8',
    });
    response.end(page);
  } catch (error) {
    console.error('Unable to serve demo.html:', error);
    response.writeHead(500, { 'Content-Type': 'text/plain; charset=utf-8' });
    response.end('Impossible de charger la démo.');
  }
});

server.listen(4173, '127.0.0.1', () => {
  console.log('CVGenius demo running at http://127.0.0.1:4173');
});
