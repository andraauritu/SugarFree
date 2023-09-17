let recipeImages = document.querySelectorAll('.recipe-image');
let recipeDescriptions = document.querySelectorAll('#recipe-description');
for (let i = 0; i < 3; i++) {
    let description = recipeDescriptions[i];
    let image = recipeImages[i];
    let brotherDesc = document.createElement('p');
    brotherDesc.innerHTML = description.innerHTML;
    brotherDesc.classList.add('bro');
    image.parentNode.insertBefore(brotherDesc, image.nextSibling);
    brotherDesc.style.display = 'none';
    image.addEventListener('mouseover', function () {
        brotherDesc.style.display = 'block';
        image.style.filter = 'brightness(50%)';
    });
    image.addEventListener('mouseout', function () {
        brotherDesc.style.display = 'none';
        image.style.filter = 'brightness(100%)';
    });
    brotherDesc.style.transition = 'display 0.3s ease, opacity 0.3s ease';
    image.style.transition = 'filter 0.3s ease';
};

