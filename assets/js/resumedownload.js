function downloadPDF() {
    fetch('resume.html')
        .then(response => response.text())
        .then(data => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(data, 'text/html');
            const bodyContent = doc.querySelector('body').innerHTML;
            const element = document.createElement('div');
            element.innerHTML = bodyContent;
            
            // Inject styles directly into the element
            const style = document.createElement('style');
            style.textContent = `
                * {
                    -webkit-font-smoothing: antialiased;
                    -moz-osx-font-smoothing: grayscale;
                    box-sizing: border-box;
                }
                body {
                    width: 21cm;
                    min-height: 29.7cm;
                    margin: 0;
                    padding: 0;
                    color: #333333;
                    line-height: 22px;
                    font: 12px "Source Sans Pro", Arial;
                }
                ${doc.querySelector('style').textContent}
            `;
            element.prepend(style);
            
            // Ensure fonts are loaded
            element.style.fontFamily = '"Source Sans Pro", Arial';
            
            html2pdf()
                .set({
                    filename: 'EtritHasolliResume.pdf',
                    margin: 0,
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
                    html2canvas: { scale: 2 }
                })
                .from(element)
                .save();
        })
        .catch(error => console.error('Error fetching resume:', error));
}