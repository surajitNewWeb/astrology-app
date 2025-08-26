// assets/js/script.js - small helpers and wheel drawing

function escapeHtml(s) {
  if (!s) return '';
  return s.toString().replace(/[&<>"']/g, function(m){
    return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m];
  });
}

function drawWheel(planets) {
  // find or create container
  let container = document.getElementById('kundliWheel');
  if (!container) {
    container = document.createElement('div');
    container.id = 'kundliWheel';
    container.style.width = '100%';
    container.style.height = '360px';
    const parent = document.getElementById('kundliContent') || document.getElementById('kundliVisual');
    if (parent) parent.appendChild(container);
  }
  container.innerHTML = '';
  const width = Math.min(360, container.clientWidth || 360);
  const ns = "http://www.w3.org/2000/svg";
  const svg = document.createElementNS(ns,'svg'); svg.setAttribute('viewBox','0 0 360 360'); svg.setAttribute('width',width); svg.setAttribute('height',width);
  container.appendChild(svg);
  const cx = 180, cy = 180, r = 120;

  const bg = document.createElementNS(ns,'circle'); bg.setAttribute('cx',cx); bg.setAttribute('cy',cy); bg.setAttribute('r',r+30); bg.setAttribute('fill','#ffffff'); bg.setAttribute('opacity','0.03');
  svg.appendChild(bg);

  // ticks for 12 signs
  for (let i=0;i<12;i++){
    const angle = ((i*30)-90) * Math.PI/180;
    const x1 = cx + Math.cos(angle)*(r+10);
    const y1 = cy + Math.sin(angle)*(r+10);
    const x2 = cx + Math.cos(angle)*(r+28);
    const y2 = cy + Math.sin(angle)*(r+28);
    const line = document.createElementNS(ns,'line');
    line.setAttribute('x1',x1); line.setAttribute('y1',y1); line.setAttribute('x2',x2); line.setAttribute('y2',y2);
    line.setAttribute('stroke','rgba(255,255,255,0.06)'); line.setAttribute('stroke-width','2');
    svg.appendChild(line);
  }

  planets.forEach((p,idx) => {
    const deg = Number(p.degree) || 0;
    const rad = (deg - 90) * Math.PI/180;
    const x = cx + Math.cos(rad) * r;
    const y = cy + Math.sin(rad) * r;
    const circle = document.createElementNS(ns,'circle');
    circle.setAttribute('cx',x); circle.setAttribute('cy',y); circle.setAttribute('r',8); circle.setAttribute('fill','#ffd166');
    svg.appendChild(circle);
    const t = document.createElementNS(ns,'text'); t.setAttribute('x', x+12); t.setAttribute('y', y+4); t.setAttribute('fill','#fff'); t.setAttribute('font-size','11');
    t.textContent = `${p.name} ${p.degree}°`;
    svg.appendChild(t);
  });
}

// expose globally
window.escapeHtml = escapeHtml;
window.drawWheel = drawWheel;
