// resources/js/custom.js
export async function loadSVG(url, buttonClass) {
    const response = await fetch(url);
    const svgText = await response.text();
    const container = document.querySelectorAll(buttonClass);
    container.forEach(el => {
            el.innerHTML = svgText;
    });
    
    
}
 
