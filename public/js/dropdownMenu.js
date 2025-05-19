function openMenu(containerId, menuId) {
  const menu = document.getElementById(menuId);
  const container = document.getElementById(containerId);
  menu.classList.add("show");

  const handleClickOutSide = (e) => {
    if (!container.contains(e.target)) {
      menu.classList.remove("show");
      window.removeEventListener("click", handleClickOutSide)
    }
  };
  window.addEventListener("click", handleClickOutSide);
}