const products = [
    {id: 1, title: 'Шиномонтаж'},
    {id: 2, title: 'Мойка'},
    {id: 3, title: 'Ремонт авто'},
    {id: 4, title: 'Диагностика'},
    {id: 5, title: 'ТО'},
];

const renderProduct = (product, img = 'https://placehold.it/200x150') => {
    return `<div class="product-item">
                <img src="${img}" alt="Some img">
                <h3>${product.title}</h3>
                 </div>`
};
const renderPage = list => document.querySelector('.products').innerHTML = list.map(item => renderProduct(item)).join('');

renderPage(products);






