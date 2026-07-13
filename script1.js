document.addEventListener('DOMContentLoaded', function () {
  const dropdownBtn = document.getElementById('dropdownBtn');
  const dropdownMenu = document.getElementById('dropdownMenu');

  dropdownBtn.addEventListener('click', function (e) {
    e.preventDefault();
    dropdownMenu.classList.toggle('active');
  });

  // Optional: Close the dropdown if clicked outside
  document.addEventListener('click', function (e) {
    if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
      dropdownMenu.classList.remove('active');
    }
  });
});