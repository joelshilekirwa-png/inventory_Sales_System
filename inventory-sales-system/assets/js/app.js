// Confirm destructive actions and calculate new-sale totals in the browser.
document.addEventListener('click', function (event) {
  const target = event.target.closest('[data-confirm]');
  if (target && !confirm(target.getAttribute('data-confirm') || 'Are you sure?')) event.preventDefault();
});
function calculateSaleTotal() {
  const rows = document.querySelectorAll('.sale-item-row');
  let total = 0;
  rows.forEach(function(row) {
    const select = row.querySelector('.product-select');
    const qty = row.querySelector('.quantity-input');
    const option = select && select.options[select.selectedIndex];
    const price = option ? parseFloat(option.dataset.price || '0') : 0;
    const quantity = qty ? Math.max(0, parseInt(qty.value || '0', 10)) : 0;
    const line = price * quantity;
    const display = row.querySelector('.line-total');
    if (display) display.textContent = line.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2});
    total += line;
  });
  const out = document.getElementById('sale-grand-total');
  if (out) out.textContent = total.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2});
}
document.addEventListener('change', function(e) { if (e.target.matches('.product-select, .quantity-input')) calculateSaleTotal(); });
document.addEventListener('input', function(e) { if (e.target.matches('.quantity-input')) calculateSaleTotal(); });
