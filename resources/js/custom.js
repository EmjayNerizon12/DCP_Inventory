// resources/js/custom.js
 async function loadSVG(url, buttonClass) {
  try {
        const response = await fetch(url);
        if (!response.ok) throw new Error(`Failed to load ${url}`);
        const svgText = await response.text();
        const containers = document.querySelectorAll(buttonClass);
        containers.forEach(el => el.innerHTML = svgText);
    } catch (err) {
        console.error(err);
    }
    
    
}

 export function renderIcons() {
    
    const icons = [
        { url: '/svg/delete.svg', class: '.delete-icon' },
        { url: '/svg/edit.svg', class: '.edit-icon' },
        { url: '/svg/table.svg', class: '.blocks-icon' },
        { url: '/svg/status.svg', class: '.status-icon' },
        { url: '/svg/person.svg', class: '.person-icon' },
        { url: '/svg/plus.svg', class: '.plus-icon' },
        { url: '/svg/report.svg', class: '.file-icon' },
        { url: '/svg/print.svg', class: '.print-icon' }
    ];

    icons.forEach(icon => loadSVG(icon.url, icon.class));
}
window.renderIcons = renderIcons;
