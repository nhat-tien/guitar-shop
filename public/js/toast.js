function showToast(message, type = 'success') {
  const toast = document.createElement('div');
  toast.className = "new-toast";
  toast.innerHTML = `
     <div class="new-toast__icon success">
     </div>
      <div>${message}</div>
  `;

  const container = document.getElementById('toast-container');
  container.appendChild(toast);

  setTimeout(() => {
    toast.remove();
  }, 4000); 
}
