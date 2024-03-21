const resizableColumns = document.querySelectorAll('.resizable');

resizableColumns.forEach(column => {
  const resizeHandle = document.createElement('div');
  resizeHandle.className = 'resize-handle';
  column.appendChild(resizeHandle);

  let startX;
  let startWidth;

  resizeHandle.addEventListener('mousedown', e => {
    startX = e.clientX;
    startWidth = parseInt(document.defaultView.getComputedStyle(column).width, 10);

    document.addEventListener('mousemove', onMouseMove);
    document.addEventListener('mouseup', onMouseUp);
  });

  const onMouseMove = e => {
    const width = startWidth + e.clientX - startX;
    column.style.width = `${width}px`;
  };

  const onMouseUp = () => {
    document.removeEventListener('mousemove', onMouseMove);
    document.removeEventListener('mouseup', onMouseUp);
  };
});
