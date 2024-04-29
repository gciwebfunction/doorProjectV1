const productTable = document.getElementById('productTable');

if (productTable) {
    productTable.addEventListener('click', function () {
        const tds = this.getElementsByTagName('td');
        const productId = tds[0].innerText;

        location.href = "/p/" + productId;
    });
}
