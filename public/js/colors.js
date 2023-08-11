const colorSelector = document.getElementById('inputColor');

colorSelector.addEventListener('change', () => {
    const selectedOption = colorSelector.options[colorSelector.selectedIndex];
    const backgroundColor = window.getComputedStyle(selectedOption).backgroundColor;
    
    colorSelector.style.backgroundColor = backgroundColor;
});